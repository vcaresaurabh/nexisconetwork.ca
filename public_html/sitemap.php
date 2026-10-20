<?php
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/data/services.php';

header('Content-Type: application/xml; charset=utf-8');
header('X-Robots-Tag: noindex');

$base = business('url');

// lastmod = when the page's template (or the data / business facts it shows)
// last changed — not "today" on every request.
$lastmod = function (string ...$files): string {
    $times = array_map(fn($f) => filemtime(__DIR__ . '/' . $f) ?: 0, [...$files, 'config/business.php']);
    return date('Y-m-d', max($times));
};

// Live public pages only. Retired URLs (portfolio, old IT-repair pages) stay out.
$static_urls = [
    ['loc' => $base . '/',                    'file' => 'pages/home.php',                'priority' => '1.0', 'changefreq' => 'weekly'],
    ['loc' => $base . '/services',            'file' => 'pages/services-index.php',      'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => $base . '/pricing',             'file' => 'pages/pricing.php',             'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => $base . '/about',               'file' => 'pages/about.php',               'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => $base . '/contact',             'file' => 'pages/contact.php',             'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => $base . '/start-project',       'file' => 'pages/start-project.php',       'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => $base . '/faq',                 'file' => 'pages/faq.php',                 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => $base . '/partners',            'file' => 'pages/partners.php',            'priority' => '0.6', 'changefreq' => 'monthly'],
    ['loc' => $base . '/privacy',             'file' => 'pages/privacy.php',             'priority' => '0.3', 'changefreq' => 'yearly'],
    ['loc' => $base . '/terms',               'file' => 'pages/terms.php',               'priority' => '0.3', 'changefreq' => 'yearly'],
    ['loc' => $base . '/refund-policy',       'file' => 'pages/refund-policy.php',       'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/cookie-policy',       'file' => 'pages/cookie-policy.php',       'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/cancellation-policy', 'file' => 'pages/cancellation-policy.php', 'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/disclaimer',          'file' => 'pages/disclaimer.php',          'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/opt-in-opt-out',      'file' => 'pages/opt-in-opt-out.php',      'priority' => '0.2', 'changefreq' => 'yearly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($static_urls as $url): ?>
  <url>
    <loc><?= htmlspecialchars($url['loc'], ENT_QUOTES, 'UTF-8') ?></loc>
    <lastmod><?= $lastmod($url['file']) ?></lastmod>
    <changefreq><?= $url['changefreq'] ?></changefreq>
    <priority><?= $url['priority'] ?></priority>
  </url>
<?php endforeach; ?>

<?php foreach ($SERVICES as $svc): ?>
  <url>
    <loc><?= htmlspecialchars($base . '/services/' . $svc['slug'], ENT_QUOTES, 'UTF-8') ?></loc>
    <lastmod><?= $lastmod('pages/service-detail.php', 'data/services.php') ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>
</urlset>
