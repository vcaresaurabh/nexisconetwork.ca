<?php
/**
 * Nexisco Network — <head> partial
 * Loaded by every page. $seo and $page_title must be set before including.
 */
$page_title       = $page_title       ?? 'Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency';
$page_description = $page_description ?? 'Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce solutions for businesses in the US, Canada, and worldwide.';
$page_canonical   = $page_canonical   ?? 'https://nexisconetwork.ca' . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$og_image         = $og_image         ?? 'https://nexisconetwork.ca/assets/img/og-image.png';
$theme_color      = '#0891B2';
$page_keywords    = $page_keywords    ?? 'web development, web design, digital marketing agency, SEO, PPC, social media marketing, ecommerce development, Shopify, WooCommerce, conversion optimization, branding, Nexisco Network';
$page_type        = $page_type        ?? 'website'; // override per page (article, service, etc.)

// CSRF token
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en-CA" class="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- ── Primary Meta ─────────────────────────────────────── -->
  <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="keywords"    content="<?= htmlspecialchars($page_keywords, ENT_QUOTES, 'UTF-8') ?>">
  <link rel="canonical"    href="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="author"      content="Nexisco Network">
  <meta name="publisher"   content="Nexisco Network">
  <meta name="robots"      content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="googlebot"   content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="bingbot"     content="index, follow">
  <meta name="rating"      content="general">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="7 days">
  <meta name="format-detection" content="telephone=no">
  <meta name="theme-color" content="<?= $theme_color ?>">
  <meta name="color-scheme" content="light">
  <meta name="application-name" content="Nexisco Network">
  <meta name="referrer" content="strict-origin-when-cross-origin">

  <!-- ── Open Graph ────────────────────────────────────────── -->
  <meta property="og:type"        content="<?= htmlspecialchars($page_type, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:site_name"   content="Nexisco Network">
  <meta property="og:title"       content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:url"         content="<?= htmlspecialchars($page_canonical, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:image"       content="<?= htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:image:secure_url" content="<?= htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:image:type"  content="image/png">
  <meta property="og:image:width"  content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt"   content="Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency">
  <meta property="og:locale"      content="en_CA">

  <!-- ── Twitter / X Card ──────────────────────────────────── -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:site"        content="@NexiscoNetwork">
  <meta name="twitter:creator"     content="@NexiscoNetwork">
  <meta name="twitter:title"       content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:image"       content="<?= htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:image:alt"   content="Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency">

  <!-- ── Canadian Geo Meta ─────────────────────────────────── -->
  <meta name="geo.region"     content="CA-AB">
  <meta name="geo.country"    content="Canada">
  <meta name="geo.placename"  content="Edmonton, Alberta">
  <meta name="geo.position"   content="53.5461;-113.4938">
  <meta name="ICBM"           content="53.5461, -113.4938">
  <meta name="DC.title"       content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="DC.language"    content="en-CA">

  <!-- ── Favicon Set ───────────────────────────────────────── -->
  <link rel="icon"             href="/favicon.ico?v=2" sizes="any">
  <link rel="icon" type="image/png" sizes="16x16"   href="/assets/img/favicon-16.png?v=2">
  <link rel="icon" type="image/png" sizes="32x32"   href="/assets/img/favicon-32.png?v=2">
  <link rel="icon" type="image/png" sizes="48x48"   href="/assets/img/favicon-48.png?v=2">
  <link rel="icon" type="image/png" sizes="96x96"   href="/assets/img/favicon-96.png?v=2">
  <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/icon-192.png?v=2">
  <link rel="icon" type="image/png" sizes="512x512" href="/assets/img/icon-512.png?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png?v=2">
  <link rel="manifest"         href="/site.webmanifest?v=2">
  <meta name="msapplication-TileColor" content="#FAFBFC">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="Nexisco">
  <meta name="mobile-web-app-capable" content="yes">

  <!-- ── DNS Prefetch & Preconnect (perf) ──────────────────── -->
  <link rel="dns-prefetch" href="https://fonts.googleapis.com">
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
  <link rel="dns-prefetch" href="https://images.unsplash.com">
  <link rel="preconnect"   href="https://fonts.googleapis.com">
  <link rel="preconnect"   href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect"   href="https://cdn.jsdelivr.net" crossorigin>

  <!-- ── Critical CSS preload ─────────────────────────────── -->
  <link rel="preload" href="/assets/css/app.css?v=<?= defined('ASSET_VERSION') ? ASSET_VERSION : '1' ?>" as="style">

  <!-- ── Google Fonts (display=swap for fast text render) ──── -->
  <?php
    // Multi-family pairing for editorial light theme:
    //   Inter           — body
    //   Bricolage       — display headlines (modern grotesque w/ optical sizing)
    //   Playfair        — serif accent for editorial pull-quotes / hero phrase
    //   Outfit          — alt sans for buttons / labels
    //   JetBrains Mono  — code / data
    $fonts_url = 'https://fonts.googleapis.com/css2?'
      . 'family=Inter:wght@400;500;600;700'
      . '&family=Bricolage+Grotesque:opsz,wght@10..48,400;10..48,500;10..48,600;10..48,700;10..48,800'
      . '&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700'
      . '&family=Outfit:wght@400;500;600;700'
      . '&family=JetBrains+Mono:wght@400;500'
      . '&display=swap';
  ?>
  <link rel="preload" as="style" href="<?= $fonts_url ?>">
  <link rel="stylesheet" href="<?= $fonts_url ?>" media="print" onload="this.media='all'">
  <noscript><link rel="stylesheet" href="<?= $fonts_url ?>"></noscript>
  <style>
    /* Font slot mapping — used by Tailwind v4 @theme + utility classes */
    :root {
      --font-display: "Bricolage Grotesque", "Inter", system-ui, sans-serif;
      --font-body:    "Inter", system-ui, sans-serif;
      --font-serif:   "Playfair Display", "Georgia", serif;
      --font-accent:  "Outfit", "Inter", sans-serif;
      --font-mono:    "JetBrains Mono", ui-monospace, monospace;
    }
  </style>

  <!-- ── Compiled Tailwind CSS ─────────────────────────────── -->
  <link rel="stylesheet" href="/assets/css/app.css?v=<?= defined('ASSET_VERSION') ? ASSET_VERSION : '1' ?>">

  <!-- ── CSRF Token for JS fetch() calls ───────────────────── -->
  <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

  <!-- Alpine.js loaded AFTER app.js in scripts.php so x-data components register first -->

  <!-- ── Preloader inline critical CSS ─────────────────────── -->
  <style>
    /* Ensure preloader shows immediately before app.css loads */
    #preloader {
      position: fixed;
      inset: 0;
      background: #FAFBFC;
      z-index: 10000;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 2rem;
    }
    body { overflow: hidden; } /* unlocked by preloader.js */
  </style>

  <!-- ── Structured Data: ProfessionalService (global digital agency) ── -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "@id": "https://nexisconetwork.ca/#agency",
    "name": "Nexisco Network",
    "legalName": "Nexisco Network",
    "alternateName": "Nexisco",
    "description": "Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce development for businesses in the US, Canada, and worldwide.",
    "url": "https://nexisconetwork.ca",
    "logo": "https://nexisconetwork.ca/assets/img/logo.png",
    "image": "https://nexisconetwork.ca/assets/img/og-image.png",
    "telephone": "+1-888-909-9466",
    "email": "support@nexisconetwork.ca",
    "priceRange": "$$",
    "currenciesAccepted": "USD, CAD",
    "paymentAccepted": "Credit Card, Debit Card, Online Payment, Bank Transfer",
    "areaServed": ["US", "CA", "Worldwide"],
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "1404, 49A Street NW",
      "addressLocality": "Edmonton",
      "addressRegion": "AB",
      "postalCode": "T6L 6H6",
      "addressCountry": "CA"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 53.5461,
      "longitude": -113.4938
    },
    "contactPoint": [{
      "@type": "ContactPoint",
      "telephone": "+1-888-909-9466",
      "contactType": "customer service",
      "email": "support@nexisconetwork.ca",
      "areaServed": ["US", "CA", "Worldwide"],
      "availableLanguage": ["en"]
    }],
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Digital Services",
      "itemListElement": [
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Web Development", "url": "https://nexisconetwork.ca/services/web-development" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Digital Marketing", "url": "https://nexisconetwork.ca/services/digital-marketing" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Ecommerce Development", "url": "https://nexisconetwork.ca/services/ecommerce-development" } }
      ]
    },
    "sameAs": [
      "https://www.facebook.com/NexiscoNetwork",
      "https://www.linkedin.com/company/nexisco-network",
      "https://twitter.com/NexiscoNetwork"
    ]
  }
  </script>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "@id": "https://nexisconetwork.ca/#website",
    "url": "https://nexisconetwork.ca",
    "name": "Nexisco Network",
    "publisher": { "@id": "https://nexisconetwork.ca/#business" },
    "inLanguage": "en-CA",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://nexisconetwork.ca/services?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>

  <?php if (!empty($extra_jsonld)) echo $extra_jsonld; ?>
  <?php if (!empty($extra_head)) echo $extra_head; ?>

  <?php /* Google Analytics 4 — only emitted when a real Measurement ID is set in config */ ?>
  <?php if (defined('ANALYTICS_ID') && ANALYTICS_ID !== ''): $gid = htmlspecialchars(ANALYTICS_ID, ENT_QUOTES, 'UTF-8'); ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $gid ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?= $gid ?>');
  </script>
  <?php endif; ?>
</head>
<body class="bg-[#FAFBFC] text-[#0F172A] antialiased overflow-x-hidden">

<!-- ── Scroll Progress Bar ───────────────────────────────────── -->
<div id="scroll-progress" aria-hidden="true"></div>

<!-- ── Preloader ──────────────────────────────────────────────── -->
<div id="preloader" role="status" aria-label="Loading Nexisco Network">
  <img id="preloader-logo" src="/assets/img/logo-mark.png"
       alt="Nexisco Network"
       width="96" height="96"
       style="opacity:0;width:96px;height:96px;object-fit:contain"
       decoding="async">

  <div class="preloader-bar-track" style="width:200px;height:2px;background:rgba(15,23,42,0.08);border-radius:1px;overflow:hidden">
    <div id="preloader-bar-fill" class="preloader-bar-fill" style="height:100%;width:0%;background:linear-gradient(90deg,#0891B2,#4F46E5);border-radius:1px;transition:width 0.1s ease"></div>
  </div>

  <span id="preloader-counter" style="font-family:'JetBrains Mono',monospace;font-size:0.875rem;color:#64748B;letter-spacing:0.05em">0%</span>

  <!-- Curtain overlay for exit wipe -->
  <div id="preloader-curtain" style="position:absolute;inset:0;background:#FAFBFC;transform-origin:top;pointer-events:none"></div>
</div>

<!-- ── Custom Cursor (desktop only) ──────────────────────────── -->
<div id="cursor" aria-hidden="true"></div>

<!-- ── Page Transition Overlay ───────────────────────────────── -->
<div id="page-transition" aria-hidden="true"
     style="position:fixed;inset:0;background:#FAFBFC;z-index:9997;transform:scaleY(0);transform-origin:bottom;pointer-events:none"></div>
