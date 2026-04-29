<?php
declare(strict_types=1);
/**
 * Nexisco Network — Admin Panel
 * Basic password-protected dashboard. Replace with full auth in production.
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Simple session-based auth guard
if (session_status() === PHP_SESSION_NONE) session_start();

$admin_password = $config['app']['admin_pass'] ?? 'nexisco_dev_2025';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_password'])) {
    if (hash_equals($admin_password, $_POST['admin_password'] ?? '')) {
        $_SESSION['admin_auth'] = true;
        $_SESSION['admin_at']   = time();
        header('Location: /admin');
        exit;
    }
    $login_error = 'Incorrect password.';
}

// Handle logout
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_auth'], $_SESSION['admin_at']);
    header('Location: /admin');
    exit;
}

// Auth timeout — 2 hours
if (!empty($_SESSION['admin_auth']) && (time() - ($_SESSION['admin_at'] ?? 0)) > 7200) {
    unset($_SESSION['admin_auth'], $_SESSION['admin_at']);
}

$authenticated = !empty($_SESSION['admin_auth']);

// Read dev log files if they exist
function read_log(string $filename, int $max = 50): array {
    $path = sys_get_temp_dir() . '/' . $filename;
    if (!file_exists($path)) return [];
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    return array_reverse(array_slice($lines, -$max));
}

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
      <a href="/admin?logout=1" style="font-size:0.8rem;color:#dc2626;text-decoration:none">Sign Out</a>
    </div>
  </div>

  <!-- Stats -->
  <?php
  $bookings   = read_log('nxn_bookings.log');
  $contacts   = read_log('nxn_contact.log');
  $newsletter = read_log('nxn_newsletter.log');
  $partners   = read_log('nxn_partners.log');
  ?>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:32px">
    <?php
    $stats = [
      ['label' => 'Bookings',    'count' => count($bookings)],
      ['label' => 'Contacts',    'count' => count($contacts)],
      ['label' => 'Subscribers', 'count' => count($newsletter)],
      ['label' => 'Partner Apps','count' => count($partners)],
    ];
    foreach ($stats as $stat): ?>
    <div class="admin-card" style="text-align:center">
      <div class="stat-num"><?= $stat['count'] ?></div>
      <div style="font-size:0.75rem;color:#64748B;text-transform:uppercase;letter-spacing:0.1em;margin-top:4px"><?= e($stat['label']) ?></div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Log tables -->
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
    <?php
    $sections = [
      ['title' => 'Recent Bookings',    'rows' => $bookings],
      ['title' => 'Recent Contacts',    'rows' => $contacts],
      ['title' => 'Recent Subscribers', 'rows' => $newsletter],
      ['title' => 'Partner Applications','rows' => $partners],
    ];
    foreach ($sections as $sec): ?>
    <div class="admin-card">
      <h2 style="font-size:0.875rem;font-weight:600;margin-bottom:12px;color:#0F172A"><?= e($sec['title']) ?></h2>
      <?php if (empty($sec['rows'])): ?>
      <p style="font-size:0.8rem;color:#94A3B8">No entries yet.</p>
      <?php else: ?>
      <div style="max-height:300px;overflow-y:auto">
        <?php foreach ($sec['rows'] as $row): ?>
        <div class="log-entry"><?= e($row) ?></div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <p style="font-size:0.75rem;color:#94A3B8;text-align:center;margin-top:24px">
    Dev log only — integrate a real database for production use.
  </p>
</div>
<?php endif; ?>

</body>
</html>
