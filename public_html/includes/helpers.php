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

function csrf_verify(string $token): bool {
    if (session_status() === PHP_SESSION_NONE) session_start();
    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

/* ── Rate limiting (filesystem-based, no Redis required) ─────── */
function rate_limit(string $key, int $max, int $windowSeconds): bool {
    $dir  = sys_get_temp_dir() . '/nxn_rl/';
    if (!is_dir($dir)) mkdir($dir, 0700, true);

    $file = $dir . md5($key) . '.json';
    $now  = time();

    $data = [];
    if (file_exists($file)) {
        $raw  = file_get_contents($file);
        $data = $raw ? json_decode($raw, true) : [];
    }

    // Remove timestamps outside the window
    $data = array_filter($data, fn($ts) => $ts > $now - $windowSeconds);

    if (count($data) >= $max) return false; // limit exceeded

    $data[] = $now;
    file_put_contents($file, json_encode(array_values($data)), LOCK_EX);
    return true;
}

/* ── IP helper ───────────────────────────────────────────────── */
function client_ip(): string {
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(explode(',', $_SERVER[$key])[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
        }
    }
    return '0.0.0.0';
}

/* ── Sanitize & validate ─────────────────────────────────────── */
function sanitize_string(string $value, int $maxLen = 500): string {
    return substr(trim(strip_tags($value)), 0, $maxLen);
}

function sanitize_email(string $email): string|false {
    $clean = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    return filter_var($clean, FILTER_VALIDATE_EMAIL) ? strtolower($clean) : false;
}

function sanitize_phone(string $phone): string {
    return preg_replace('/[^\d+\-() ]/', '', substr(trim($phone), 0, 20));
}

/* ── Booking reference generator ────────────────────────────── */
function generate_booking_ref(): string {
    $prefix = 'NXN';
    $date   = date('ymd');
    $rand   = strtoupper(substr(base_convert(bin2hex(random_bytes(3)), 16, 36), 0, 4));
    return "{$prefix}-{$date}-{$rand}";
}

/* ── JSON response helper (for API endpoints) ────────────────── */
function json_response(array $data, int $status = 200): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
