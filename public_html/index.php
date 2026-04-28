<?php
declare(strict_types=1);
/**
 * Nexisco Network — Front Controller
 * Single entry point. Parses the URL and dispatches to the correct page file.
 */

/* ── Bootstrap ───────────────────────────────────────────────────── */
$config = require __DIR__ . '/config/config.php';

define('APP_URL',     $config['app']['url']      ?? 'https://nexisconetwork.ca');
define('APP_DEBUG',   $config['app']['debug']    ?? false);
define('ASSET_VERSION', '1');

if (isset($config['app']['timezone'])) {
    date_default_timezone_set($config['app']['timezone']);
}

if (APP_DEBUG) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

require_once __DIR__ . '/includes/helpers.php';

/* ── Route parsing ───────────────────────────────────────────────── */
$uri    = strtok(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '?');
$uri    = '/' . trim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

/* ── API routes ──────────────────────────────────────────────────── */
if (str_starts_with($uri, '/api/')) {
    $endpoint = substr($uri, 5); // strip /api/

    $api_files = [
        'book'       => 'api/book.php',
        'contact'    => 'api/contact.php',
        'newsletter' => 'api/newsletter.php',
        'partners'   => 'api/partners.php',
    ];

    $file = $api_files[$endpoint] ?? null;

    if ($file && file_exists(__DIR__ . '/' . $file)) {
        require __DIR__ . '/' . $file;
    } else {
        json_response(['success' => false, 'message' => 'Endpoint not found.'], 404);
    }
    exit;
}

/* ── Admin routes ────────────────────────────────────────────────── */
if (str_starts_with($uri, '/admin')) {
    $admin_file = $uri === '/admin' || $uri === '/admin/' ? 'admin/index.php' : ltrim($uri, '/') . '.php';
    if (file_exists(__DIR__ . '/' . $admin_file)) {
        require __DIR__ . '/' . $admin_file;
    } else {
        require __DIR__ . '/pages/404.php';
    }
    exit;
}

/* ── Page routes ─────────────────────────────────────────────────── */
$route_map = [
    '/'                  => 'pages/home.php',
    '/services'          => 'pages/services-index.php',
    '/book'              => 'pages/book.php',
    '/book/confirmation' => 'pages/book-confirmation.php',
    '/membership'        => 'pages/membership.php',
    '/about'             => 'pages/about.php',
    '/faq'               => 'pages/faq.php',
    '/contact'           => 'pages/contact.php',
    '/partners'          => 'pages/partners.php',
    // Legal
    '/privacy'             => 'pages/privacy.php',
    '/terms'               => 'pages/terms.php',
    '/cookie-policy'       => 'pages/cookie-policy.php',
    '/disclaimer'          => 'pages/disclaimer.php',
    '/cancellation-policy' => 'pages/cancellation-policy.php',
    '/eula'                => 'pages/eula.php',
    '/uninstall'           => 'pages/uninstall.php',
    '/opt-in-opt-out'      => 'pages/opt-in-opt-out.php',
    // Meta
    '/robots.txt'          => 'robots.php',
    '/sitemap.xml'         => 'sitemap.php',
];

// Exact route match
if (isset($route_map[$uri])) {
    $file = __DIR__ . '/' . $route_map[$uri];
    if (file_exists($file)) {
        require $file;
        exit;
    }
}

// Dynamic: /services/{slug}
if (preg_match('#^/services/([a-z0-9\-]+)$#', $uri, $matches)) {
    $service_slug = $matches[1];
    if (valid_service_slug($service_slug)) {
        require __DIR__ . '/pages/service-detail.php';
        exit;
    }
}

// 404 fallback
http_response_code(404);
require __DIR__ . '/pages/404.php';
