<?php
header('Content-Type: text/plain; charset=utf-8');
header('X-Robots-Tag: noindex');
// Every public page is crawlable by everyone, Google's crawlers included
// (Googlebot, AdsBot-Google, Google-InspectionTool). Only non-public
// directories are listed below. Never add a rule that blocks a crawler.
?>
User-agent: *
Allow: /

Disallow: /admin/
Disallow: /api/
Disallow: /config/
Disallow: /includes/
Disallow: /data/
Disallow: /lib/

Sitemap: <?= business('url') ?>/sitemap.xml
