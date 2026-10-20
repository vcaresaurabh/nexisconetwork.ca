<?php
declare(strict_types=1);
/**
 * Nexisco Network — Admin Panel
 * Password-protected dashboard: leads from the database, or the debug log
 * files when no database is configured (or a query fails).
 *
 * Reached two ways: through index.php (/admin), or directly as a real file
 * (Apache serves /admin/ from this directory; so does `php -S` with
 * dev-router.php). Both paths must load the same config and behave the same.
 */

// index.php has already loaded $config; a direct request has not. Don't use
// require_once for this — it returns true, not the array, once included.
$cfg = (isset($config) && is_array($config)) ? $config : require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Admin pages are never cached by the browser or a proxy.
header('Cache-Control: no-store');

// Session cookie: not readable from JS, not sent on cross-site POSTs.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => ($_SERVER['HTTPS'] ?? '') !== '' && $_SERVER['HTTPS'] !== 'off',
    ]);
    session_start();
}

// app.admin_pass must be a password_hash() value. Empty, or anything that
// isn't a hash (e.g. a plain-text password), disables the admin. There is
// no fallback password.
$admin_hash    = is_string($cfg['app']['admin_pass'] ?? null) ? $cfg['app']['admin_pass'] : '';
$admin_enabled = $admin_hash !== '' && password_get_info($admin_hash)['algoName'] !== 'unknown';

// Handle login — rate limit first, then CSRF token, then password
if ($admin_enabled && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_password'])) {
    $password = is_string($_POST['admin_password']) ? $_POST['admin_password'] : '';
    $token    = is_string($_POST['_token'] ?? null) ? $_POST['_token'] : '';

    if (!rate_limit('admin_login_' . client_ip(), 5, 900)) {
        $login_error = 'Too many sign-in attempts. Try again in 15 minutes.';
    } elseif ($token === '' || !csrf_verify($token)) { // '' would match a session with no token yet
        $login_error = 'Your session expired. Reload the page and sign in again.';
    } elseif (password_verify($password, $admin_hash)) {
        session_regenerate_id(true); // new session id after login (no fixation)
        $_SESSION['admin_auth'] = true;
        $_SESSION['admin_at']   = time();
        $_SESSION['admin_key']  = hash('sha256', $admin_hash); // ties the sign-in to this password
        header('Location: /admin');
        exit;
    } else {
        $login_error = 'Incorrect password.';
    }
}

// Handle logout — POST with a valid CSRF token only. A GET link (?logout=1) or a
// cross-site request can't sign the admin out.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_logout'])) {
    $token = is_string($_POST['_token'] ?? null) ? $_POST['_token'] : '';
    if ($token !== '' && csrf_verify($token)) {
        unset($_SESSION['admin_auth'], $_SESSION['admin_at'], $_SESSION['admin_key']);
        session_regenerate_id(true); // the signed-in session id stops working
        header('Location: /admin');
        exit;
    }
    $logout_error = 'Sign-out failed because the page was out of date. Reload the page and try again.';
}

// Auth timeout — 2 hours. A disabled admin never counts as signed in, and
// changing app.admin_pass signs out every session made with the old one.
if (!$admin_enabled
    || (!empty($_SESSION['admin_auth']) && (time() - ($_SESSION['admin_at'] ?? 0)) > 7200)
    || !hash_equals(hash('sha256', $admin_hash), (string)($_SESSION['admin_key'] ?? ''))) {
    unset($_SESSION['admin_auth'], $_SESSION['admin_at'], $_SESSION['admin_key']);
}

$authenticated = $admin_enabled && !empty($_SESSION['admin_auth']);

/**
 * Leads from the database: the latest 50 rows of each table plus a total count.
 * Null when any query fails (db_run() logs why) — the page then shows the debug log.
 *
 * @return array<string, array{count: int, rows: list<array<string, mixed>>}>|null
 */
function admin_db_leads(): ?array {
    $queries = [
        'contacts' => [
            'SELECT COUNT(*) FROM contacts',
            'SELECT created_at, name, email, subject FROM contacts ORDER BY created_at DESC, id DESC LIMIT 50',
        ],
        'newsletter' => [
            'SELECT COUNT(*) FROM newsletter WHERE subscribed = 1',
            'SELECT email, consent_timestamp, consent_method FROM newsletter WHERE subscribed = 1
             ORDER BY consent_timestamp DESC, id DESC LIMIT 50',
        ],
        'partners' => [
            'SELECT COUNT(*) FROM partners',
            'SELECT created_at, business_name, contact_name, email, partner_type FROM partners
             ORDER BY created_at DESC, id DESC LIMIT 50',
        ],
    ];
    $leads = [];
    foreach ($queries as $table => [$count_sql, $rows_sql]) {
        // Stop at the first failure: an unreachable server then costs one connect timeout, not two.
        $count = db_run($count_sql);
        if ($count === null) return null;
        $rows = db_run($rows_sql);
        if ($rows === null) return null;
        $leads[$table] = ['count' => (int)$count->fetchColumn(), 'rows' => $rows->fetchAll(PDO::FETCH_ASSOC)];
    }
    return $leads;
}

/** Lines of a debug log file in the temp dir, newest first. */
function read_log(string $filename): array {
    $path = sys_get_temp_dir() . '/' . $filename;
    if (!is_file($path)) return [];
    return array_reverse(file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: []);
}

/**
 * True when a debug-log line records a submission that was actually emailed or stored.
 * Contact/partner lines end in "| sent=N stored=N" — only that last field is read, since
 * the visitor's name, business and service sit earlier on the line. Newsletter lines are
 * matched on every field except the email address (the only visitor-supplied value).
 */
function log_line_ok(string $line, string $kind): bool {
    $fields = array_map('trim', explode('|', $line));
    if ($kind === 'newsletter') {
        $fields = array_filter($fields, static fn(string $f): bool => !str_contains($f, '@'));
        return preg_match('/\b(?:stored=1|confirmed)\b/i', implode(' | ', $fields)) === 1;
    }
    return preg_match('/\b(?:sent|stored)=1\b/', (string)end($fields)) === 1;
}

// Leads are loaded for a signed-in admin only — nothing is queried or read otherwise.
$leads       = null;   // database view
$log_leads   = null;   // debug-log fallback
$log_reason  = '';
if ($authenticated) {
    if (db_configured()) {
        require_once __DIR__ . '/../includes/db.php';
        $leads = admin_db_leads();
        $log_reason = $leads === null ? 'A database query failed (see the PHP error log).' : '';
    } else {
        $log_reason = 'No database is configured in config/config.php.';
    }
    if ($leads === null) {
        $log_leads = [];
        foreach (['contacts' => 'nxn_contact.log', 'newsletter' => 'nxn_newsletter.log', 'partners' => 'nxn_partners.log'] as $kind => $file) {
            $lines = read_log($file);
            $log_leads[$kind] = [
                'count' => count(array_filter($lines, static fn(string $l): bool => log_line_ok($l, $kind))),
                'rows'  => array_slice($lines, 0, 50),
            ];
        }
    }
}

// Section titles and, for the database view, the columns shown (column => heading).
$lead_sections = [
    'contacts'   => ['title' => 'Recent Contacts',      'stat' => 'Contacts',
                     'cols'  => ['created_at' => 'Received', 'name' => 'Name', 'email' => 'Email', 'subject' => 'Subject']],
    'newsletter' => ['title' => 'Recent Subscribers',   'stat' => 'Subscribers',
                     'cols'  => ['email' => 'Email', 'consent_timestamp' => 'Consent given', 'consent_method' => 'Consent method']],
    'partners'   => ['title' => 'Partner Applications', 'stat' => 'Partner Apps',
                     'cols'  => ['created_at' => 'Received', 'business_name' => 'Business', 'contact_name' => 'Contact',
                                 'email' => 'Email', 'partner_type' => 'Type']],
];

?><!DOCTYPE html>
<html lang="en-CA">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — Nexisco Network</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="/assets/css/app.css">
  <style>
    body { background:#FAFBFC; color:#0F172A; font-family:'Inter',sans-serif; min-height:100vh; }
    .admin-card { background:#FFFFFF; border:1px solid rgba(15,23,42,0.08); border-radius:16px; padding:24px; box-shadow:0 1px 3px rgba(15,23,42,0.04); }
    .log-entry { font-family:'JetBrains Mono',monospace; font-size:0.8rem; color:#475569; padding:6px 0; border-bottom:1px solid rgba(15,23,42,0.06); }
    .stat-num { font-size:2rem; font-weight:700; color:#0891B2; font-family:'JetBrains Mono',monospace; }
    .lead-table { width:100%; border-collapse:collapse; font-size:0.8rem; }
    .lead-table th { text-align:left; font-size:0.7rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#64748B; padding:6px 8px; border-bottom:1px solid rgba(15,23,42,0.08); white-space:nowrap; }
    .lead-table td { padding:6px 8px; border-bottom:1px solid rgba(15,23,42,0.06); color:#334155; vertical-align:top; overflow-wrap:anywhere; }
    .lead-table td.when { font-family:'JetBrains Mono',monospace; color:#475569; white-space:nowrap; }
    .lead-table a { color:#0891B2; text-decoration:none; }
    .source-note { font-size:0.8rem; color:#475569; margin-bottom:16px; }
    .source-note strong { color:#0F172A; }
  </style>
</head>
<body>

<?php if (!$authenticated): ?>
<!-- ── Login Form ──────────────────────────────────────────────── -->
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center">
  <div style="width:100%;max-width:400px;padding:24px">
    <div class="admin-card">
      <div class="text-center mb-8">
        <svg width="40" height="40" viewBox="0 0 36 36" fill="none" class="mx-auto mb-3" aria-hidden="true">
          <path d="M4 30 L4 6 L18 18 L32 6 L32 30" stroke="#0891B2" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round" fill="none"/>
          <circle cx="18" cy="18" r="2.5" fill="#4F46E5"/>
        </svg>
        <h1 style="font-size:1.25rem;font-weight:600">Nexisco Admin</h1>
      </div>

      <?php if (!$admin_enabled): ?>
      <!-- No valid password hash in config — show how to set one, never the value -->
      <p style="background:rgba(217,119,6,0.08);border:1px solid rgba(217,119,6,0.25);color:#92400E;padding:12px;border-radius:8px;font-size:0.875rem;line-height:1.5">
        Admin is disabled. Set <code>app.admin_pass</code> in <code>config/config.php</code> to a
        <code>password_hash()</code> value, e.g.
        <code style="display:block;margin-top:8px;font-family:'JetBrains Mono',monospace;font-size:0.75rem;word-break:break-all">php -r "echo password_hash('your-password', PASSWORD_DEFAULT);"</code>
      </p>
      <?php else: ?>

      <?php if (!empty($login_error)): ?>
      <p style="background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.25);color:#dc2626;padding:12px;border-radius:8px;font-size:0.875rem;margin-bottom:16px">
        <?= e($login_error) ?>
      </p>
      <?php endif; ?>

      <form method="POST" autocomplete="off">
        <?= csrf_field() ?>
        <label style="display:block;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:#64748B;margin-bottom:6px">Password</label>
        <input type="password" name="admin_password" autofocus required
               style="width:100%;background:#FFFFFF;border:1px solid rgba(15,23,42,0.14);border-radius:8px;padding:10px 14px;color:#0F172A;font-size:0.875rem;outline:none;box-sizing:border-box">
        <button type="submit"
                style="width:100%;margin-top:16px;background:linear-gradient(135deg,#0891B2,#4F46E5);border:none;border-radius:8px;padding:12px;color:#FFFFFF;font-weight:600;cursor:pointer;font-size:0.875rem">
          Sign In
        </button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php else: ?>
<!-- ── Dashboard ──────────────────────────────────────────────── -->
<div style="padding:24px;max-width:1200px;margin:0 auto">

  <!-- Header -->
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;padding-bottom:16px;border-bottom:1px solid rgba(15,23,42,0.08)">
    <div style="display:flex;align-items:center;gap:12px">
      <svg width="32" height="32" viewBox="0 0 36 36" fill="none" aria-hidden="true">
        <path d="M4 30 L4 6 L18 18 L32 6 L32 30" stroke="#0891B2" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <circle cx="18" cy="18" r="2.5" fill="#4F46E5"/>
      </svg>
      <h1 style="font-size:1.125rem;font-weight:600">Nexisco Admin</h1>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
      <a href="/" target="_blank" style="font-size:0.8rem;color:#475569;text-decoration:none">View Site ↗</a>
      <!-- POST + CSRF token: a link or a cross-site request can't sign the admin out.
           No action: post to this same URL, like the login form. On Apache /admin is a
           real directory, so a POST to /admin would be 301-redirected to /admin/ as a GET. -->
      <form method="POST" style="display:inline;margin:0">
        <?= csrf_field() ?>
        <input type="hidden" name="admin_logout" value="1">
        <button type="submit" style="font-size:0.8rem;color:#dc2626;text-decoration:none;background:none;border:none;padding:0;margin:0;font-family:inherit;cursor:pointer">Sign Out</button>
      </form>
    </div>
  </div>

  <?php if (!empty($logout_error)): ?>
  <p style="background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.25);color:#dc2626;padding:12px;border-radius:8px;font-size:0.875rem;margin-bottom:16px">
    <?= e($logout_error) ?>
  </p>
  <?php endif; ?>

  <?php $source = $leads ?? $log_leads ?? []; ?>
  <p class="source-note">
    <?php if ($leads !== null): ?>
    <strong>Source: database.</strong> Totals below; each table lists the latest 50 entries.
    <?php else: ?>
    <strong>Source: debug log</strong> (APP_DEBUG files in the server's temp directory) — <?= e($log_reason) ?>
    Counts include only entries that were emailed or stored; the lists show the latest 50 log lines, failed attempts included.
    <?php endif; ?>
  </p>

  <!-- Stats -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:32px">
    <?php foreach ($lead_sections as $key => $sec): ?>
    <div class="admin-card" style="text-align:center">
      <div class="stat-num"><?= (int)($source[$key]['count'] ?? 0) ?></div>
      <div style="font-size:0.75rem;color:#64748B;text-transform:uppercase;letter-spacing:0.1em;margin-top:4px">
        <?= e($sec['stat']) ?><?= $leads === null ? ' (debug log)' : '' ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if ($leads !== null): ?>
  <!-- Database tables -->
  <div style="display:grid;grid-template-columns:1fr;gap:16px">
    <?php foreach ($lead_sections as $key => $sec): ?>
    <div class="admin-card">
      <h2 style="font-size:0.875rem;font-weight:600;margin-bottom:12px;color:#0F172A"><?= e($sec['title']) ?></h2>
      <?php if (empty($leads[$key]['rows'])): ?>
      <p style="font-size:0.8rem;color:#94A3B8">No entries yet.</p>
      <?php else: ?>
      <div style="max-height:420px;overflow:auto">
        <table class="lead-table">
          <thead>
            <tr>
              <?php foreach ($sec['cols'] as $heading): ?>
              <th scope="col"><?= e($heading) ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($leads[$key]['rows'] as $row): ?>
            <tr>
              <?php foreach (array_keys($sec['cols']) as $col):
                $value = (string)($row[$col] ?? ''); ?>
              <?php if ($col === 'email' && $value !== ''): ?>
              <td><a href="mailto:<?= e($value) ?>"><?= e($value) ?></a></td>
              <?php else: ?>
              <td<?= in_array($col, ['created_at', 'consent_timestamp'], true) ? ' class="when"' : '' ?>><?= e($value !== '' ? $value : '—') ?></td>
              <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <?php else: ?>
  <!-- Debug-log fallback (no database, or a query failed) -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,420px),1fr));gap:16px">
    <?php foreach ($lead_sections as $key => $sec): ?>
    <div class="admin-card">
      <h2 style="font-size:0.875rem;font-weight:600;margin-bottom:12px;color:#0F172A"><?= e($sec['title']) ?> — debug log</h2>
      <?php if (empty($log_leads[$key]['rows'])): ?>
      <p style="font-size:0.8rem;color:#94A3B8">No entries yet.</p>
      <?php else: ?>
      <div style="max-height:300px;overflow-y:auto">
        <?php foreach ($log_leads[$key]['rows'] as $row): ?>
        <div class="log-entry"><?= e($row) ?></div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <p style="font-size:0.75rem;color:#94A3B8;text-align:center;margin-top:24px">
    Debug log only — stored leads appear here once the database in config/config.php is configured and reachable.
  </p>
  <?php endif; ?>
</div>
<?php endif; ?>

</body>
</html>
