<?php
declare(strict_types=1);
/**
 * Nexisco Network — Helper functions
 */

/* ── Output escaping ─────────────────────────────────────────── */
function e(mixed $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/* ── Business details (config/business.php) ──────────────────── */
function business(?string $key = null): mixed {
    static $biz = null;
    $biz ??= require __DIR__ . '/../config/business.php';
    return $key === null ? $biz : ($biz[$key] ?? null);
}

/** "1404, 49A Street NW, Edmonton, AB T6L 6H6" — add ", Canada" with $with_country. */
function business_address(bool $with_country = false): string {
    $o = business('registered_office');
    $line = "{$o['street']}, {$o['city']}, {$o['region']} {$o['postal_code']}";
    return $with_country ? "{$line}, {$o['country']}" : $line;
}

function business_tel_href(): string {
    return 'tel:' . business('phone_e164');
}

function business_mailto(?string $email = null): string {
    return 'mailto:' . ($email ?? business('email'));
}

/** Legal identification sentence used at the top of every legal page. */
function business_identity(): string {
    return sprintf(
        '%s ("%s", "we", "us"), an %s corporation (Corporate Access Number %s) with its registered office at %s',
        business('legal_name'), business('brand_name'), business('jurisdiction_short'),
        business('corporate_access_no'), business_address()
    );
}

/** Footer registration line: "Alberta Corporate Access Number … · Registered office: …". */
function business_registration_line(): string {
    return sprintf(
        '%s Corporate Access Number %s · Registered office: %s',
        business('jurisdiction_short'), business('corporate_access_no'), business_address()
    );
}

/* ── App config (config/config.php, gitignored) ──────────────── */
function app_config(): array {
    static $config = null;
    $config ??= require __DIR__ . '/../config/config.php';
    return $config;
}

/** True once real SMTP credentials are set in config/config.php. */
function mail_configured(): bool {
    $smtp = app_config()['smtp'] ?? [];
    foreach (['host', 'user', 'pass', 'from_address'] as $key) {
        $value = (string)($smtp[$key] ?? '');
        if ($value === '' || str_starts_with($value, 'CHANGE_ME')) return false;
    }
    return true;
}

/** True once real database credentials (or a DSN) are set in config/config.php. */
function db_configured(): bool {
    $db = app_config()['db'] ?? [];
    if (!empty($db['dsn'])) return true;
    $pass = (string)($db['pass'] ?? '');
    return !empty($db['user']) && $pass !== '' && !str_starts_with($pass, 'CHANGE_ME');
}

/** The newsletter needs both: a database for the consent record and email for double opt-in. */
function newsletter_available(): bool {
    return db_configured() && mail_configured();
}

/** Shown when a form can be neither emailed nor stored — never claim success then. */
function form_unavailable_message(): string {
    return sprintf(
        "Sorry — we couldn't send this just now. Please email %s or call %s (%s).",
        business('email'), business('phone'), business('hours')
    );
}

/* ── Asset URL helper ────────────────────────────────────────── */
function asset(string $path): string {
    $v = defined('ASSET_VERSION') ? '?v=' . ASSET_VERSION : '';
    return '/assets/' . ltrim($path, '/') . $v;
}

/* ── URL builder ─────────────────────────────────────────────── */
function url(string $path = '/'): string {
    $base = rtrim(defined('APP_URL') ? APP_URL : 'https://nexisconetwork.ca', '/');
    return $base . '/' . ltrim($path, '/');
}

/* ── CSRF token ──────────────────────────────────────────────── */
function csrf_token(): string {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify(mixed $token): bool {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $expected = $_SESSION['csrf_token'] ?? '';
    // An empty (or non-string) token must never match a session that has no token yet
    return is_string($token) && $token !== '' && $expected !== '' && hash_equals($expected, $token);
}

/* ── Rate limiting (filesystem-based, no Redis required) ─────── */
function rate_limit(string $key, int $max, int $windowSeconds): bool {
    $dir  = sys_get_temp_dir() . '/nxn_rl/';
    if (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir)) return true; // fail open if temp isn't writable

    $fh = fopen($dir . md5($key) . '.json', 'c+');
    if ($fh === false) return true;
    flock($fh, LOCK_EX); // read-modify-write under one lock so concurrent requests can't all pass

    $now  = time();
    $data = json_decode((string)stream_get_contents($fh), true);
    $data = is_array($data) ? $data : [];

    // Remove timestamps outside the window
    $data = array_filter($data, fn($ts) => is_int($ts) && $ts > $now - $windowSeconds);

    $allowed = count($data) < $max;
    if ($allowed) {
        $data[] = $now;
        ftruncate($fh, 0);
        rewind($fh);
        fwrite($fh, json_encode(array_values($data)));
    }
    flock($fh, LOCK_UN);
    fclose($fh);
    return $allowed;
}

/* ── IP helper ───────────────────────────────────────────────── */
function client_ip(): string {
    // Proxy headers are set by the client unless a proxy overwrites them, so
    // only the one named in app.client_ip_header is read ('' = REMOTE_ADDR only;
    // 'CF-Connecting-IP' behind Cloudflare; 'X-Forwarded-For' behind a load
    // balancer, rightmost entry = the one the proxy appended). Used for rate
    // limiting and the newsletter consent record only — never to vary page content.
    $header = (string)(app_config()['app']['client_ip_header'] ?? '');
    if ($header !== '') {
        $raw = $_SERVER['HTTP_' . strtoupper(str_replace('-', '_', $header))] ?? '';
        $parts = array_map('trim', explode(',', (string)$raw));
        $ip = strcasecmp($header, 'X-Forwarded-For') === 0 ? end($parts) : $parts[0];
        if ($ip && filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
    }
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

/* ── Sanitize & validate ─────────────────────────────────────── */
function sanitize_string(string $value, int $maxLen = 500): string {
    // Byte limit without splitting a multibyte character
    return mb_strcut(trim(strip_tags(mb_scrub($value, 'UTF-8'))), 0, $maxLen, 'UTF-8');
}

/** Single-line fields (names, subjects…): control characters incl. CR/LF become spaces. */
function sanitize_line(string $value, int $maxLen = 500): string {
    return sanitize_string(preg_replace('/[\x00-\x1F\x7F]+/u', ' ', $value) ?? '', $maxLen);
}

function sanitize_email(string $email): string|false {
    $clean = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    return filter_var($clean, FILTER_VALIDATE_EMAIL) ? strtolower($clean) : false;
}

function sanitize_phone(string $phone): string {
    return preg_replace('/[^\d+\-() ]/', '', substr(trim($phone), 0, 20));
}

/* ── JSON response helper (for API endpoints) ────────────────── */
function json_response(array $data, int $status = 200): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

/* ── Service slug whitelist ──────────────────────────────────── */
function valid_service_slug(string $slug): bool {
    $valid = [
        'web-development',
        'digital-marketing',
        'ecommerce-development',
    ];
    return in_array($slug, $valid, true);
}

/* ── Free email domain blocklist (for partner form) ─────────── */
function is_free_email_domain(string $email): bool {
    $domain   = strtolower(explode('@', $email)[1] ?? '');
    $blocked  = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com',
                 'icloud.com', 'protonmail.com', 'aol.com', 'live.com'];
    return in_array($domain, $blocked, true);
}

/* ── Debug helper (dev only) ─────────────────────────────────── */
function dd(mixed ...$vars): never {
    if (!defined('APP_DEBUG') || !APP_DEBUG) exit;
    echo '<pre>';
    foreach ($vars as $v) var_dump($v);
    echo '</pre>';
    exit;
}
