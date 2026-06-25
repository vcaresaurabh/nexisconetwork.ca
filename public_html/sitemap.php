<?php
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/data/services.php';

header('Content-Type: application/xml; charset=utf-8');
header('X-Robots-Tag: noindex');

$base     = 'https://nexisconetwork.ca';
$today    = date('Y-m-d');

$static_urls = [
    ['loc' => $base . '/',              'priority' => '1.0', 'changefreq' => 'weekly'],
    ['loc' => $base . '/services',      'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => $base . '/portfolio',     'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => $base . '/pricing',       'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => $base . '/about',         'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => $base . '/contact',       'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => $base . '/start-project', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => $base . '/faq',           'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => $base . '/partners',      'priority' => '0.6', 'changefreq' => 'monthly'],
    ['loc' => $base . '/privacy',       'priority' => '0.3', 'changefreq' => 'yearly'],
    ['loc' => $base . '/terms',         'priority' => '0.3', 'changefreq' => 'yearly'],
    ['loc' => $base . '/refund-policy', 'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/cookie-policy', 'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/cancellation-policy', 'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/disclaimer',    'priority' => '0.2', 'changefreq' => 'yearly'],
    ['loc' => $base . '/opt-in-opt-out','priority' => '0.2', 'changefreq' => 'yearly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($static_urls as $url): ?>
  <url>
    <loc><?= htmlspecialchars($url['loc'], ENT_QUOTES, 'UTF-8') ?></loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq><?= $url['changefreq'] ?></changefreq>
    <priority><?= $url['priority'] ?></priority>
  </url>
<?php endforeach; ?>

<?php foreach ($SERVICES as $svc): ?>
  <url>
    <loc><?= htmlspecialchars($base . '/services/' . $svc['slug'], ENT_QUOTES, 'UTF-8') ?></loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>
</urlset>
