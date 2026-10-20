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
define('ANALYTICS_ID', $config['app']['analytics_id'] ?? '');
define('ASSET_VERSION', '5'); // bumped for the pre-appeal fixes — busts cached app.css / app.js

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
        'contact'    => 'api/contact.php',
        'newsletter' => 'api/newsletter.php',
        'partners'   => 'api/partners.php',
    ];

    $file = $api_files[$endpoint] ?? null;

    if ($file && file_exists(__DIR__ . '/' . $file)) {
        // Form fields are strings; anything else (e.g. name[]=x) is treated as empty
        $_POST = array_map(static fn($v) => is_string($v) ? $v : '', $_POST);
        require __DIR__ . '/' . $file;
    } else {
        json_response(['success' => false, 'message' => 'Endpoint not found.'], 404);
    }
    exit;
}

/* ── Admin routes ────────────────────────────────────────────────── */
// Only /admin itself (the trim above turns /admin/ into /admin). Every other
// /admin/* path is a 404 — no file path is ever built from the URL.
if ($uri === '/admin' || str_starts_with($uri, '/admin/')) {
    if ($uri === '/admin') {
        require __DIR__ . '/admin/index.php';
    } else {
        http_response_code(404);
        require __DIR__ . '/pages/404.php';
    }
    exit;
}

/* ── 410 Gone (URLs from the previous IT-repair / booking site) ──── */
// These pages described services this business does not offer. They are gone
// for good: answer 410 instead of redirecting them to agency pages.
$gone = [
    '/membership',
    '/book',
    '/book/confirmation',
    '/book-confirmation',
    '/eula',
    '/uninstall',
    '/services/virus-malware-removal',
    '/services/pc-laptop-repair',
    '/services/data-recovery',
    '/services/network-wifi-setup',
    '/services/software-installation',
    '/services/remote-support',
    '/services/business-it-support',
    '/services/hardware-upgrades',
    '/services/smart-home-iot',
];
if (in_array($uri, $gone, true)) {
    require __DIR__ . '/pages/410.php';
    exit;
}

/* ── 301 Redirects ───────────────────────────────────────────────── */
// The only page-level redirect. http → https and www → apex live in .htaccess.
// Nothing here may depend on who the visitor is (IP, country, user-agent, referrer).
$redirects = [
    // Portfolio of stock images removed (pre-appeal fixes, Oct 2026). Bring the
    // page back only with real, client-approved work.
    '/portfolio' => '/services',
];
if (isset($redirects[$uri])) {
    // Keep the query string (e.g. gclid / utm_*) so ad clicks stay attributed.
    $qs = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: ' . $redirects[$uri] . ($qs !== '' ? '?' . $qs : ''), true, 301);
    exit;
}

/* ── Page routes ─────────────────────────────────────────────────── */
$route_map = [
    '/'                  => 'pages/home.php',
    '/services'          => 'pages/services-index.php',
    '/pricing'           => 'pages/pricing.php',
    '/start-project'     => 'pages/start-project.php',
    '/about'             => 'pages/about.php',
    '/faq'               => 'pages/faq.php',
    '/contact'           => 'pages/contact.php',
    '/partners'          => 'pages/partners.php',
    // Legal
    '/privacy'             => 'pages/privacy.php',
    '/terms'               => 'pages/terms.php',
    '/refund-policy'       => 'pages/refund-policy.php',
    '/cookie-policy'       => 'pages/cookie-policy.php',
    '/disclaimer'          => 'pages/disclaimer.php',
    '/cancellation-policy' => 'pages/cancellation-policy.php',
    '/opt-in-opt-out'      => 'pages/opt-in-opt-out.php',
    // Newsletter double opt-in (links from the confirmation / welcome emails; not in the sitemap)
    '/newsletter/confirm'     => 'pages/newsletter.php',
    '/newsletter/unsubscribe' => 'pages/newsletter.php',
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
