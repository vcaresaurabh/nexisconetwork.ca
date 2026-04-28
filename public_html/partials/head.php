<?php
/**
 * Nexisco Network — <head> partial
 * Loaded by every page. $seo and $page_title must be set before including.
 */
$page_title       = $page_title       ?? 'Nexisco Network — Smart IT. Seamless Support.';
$page_description = $page_description ?? 'Professional IT services in Canada. Virus & malware removal, PC & laptop repair, data recovery, network & WiFi setup, and managed business IT. Book online — same-day service available.';
$page_canonical   = $page_canonical   ?? 'https://nexisconetwork.ca' . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$og_image         = $og_image         ?? 'https://nexisconetwork.ca/assets/img/og-image.png';
$theme_color      = '#06B6D4';
$page_keywords    = $page_keywords    ?? 'IT services Canada, computer repair Toronto, virus removal, data recovery, laptop repair, network setup, WiFi installation, PC tune-up, business IT support, managed IT services, smart home setup, remote tech support, Nexisco Network';
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
  <meta name="color-scheme" content="dark light">
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
  <meta property="og:image:alt"   content="Nexisco Network — Smart IT, Seamless Support across Canada">
  <meta property="og:locale"      content="en_CA">

  <!-- ── Twitter / X Card ──────────────────────────────────── -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:site"        content="@NexiscoNetwork">
  <meta name="twitter:creator"     content="@NexiscoNetwork">
  <meta name="twitter:title"       content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:image"       content="<?= htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="twitter:image:alt"   content="Nexisco Network — Smart IT services across Canada">

  <!-- ── Canadian Geo Meta ─────────────────────────────────── -->
  <meta name="geo.region"     content="CA-AB">
  <meta name="geo.country"    content="Canada">
  <meta name="geo.placename"  content="Edmonton, Alberta">
  <meta name="geo.position"   content="53.5461;-113.4938">
  <meta name="ICBM"           content="53.5461, -113.4938">
  <meta name="DC.title"       content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="DC.language"    content="en-CA">

  <!-- ── Favicon Set ───────────────────────────────────────── -->
  <link rel="icon"             href="/favicon.ico" sizes="any">
  <link rel="icon"             href="/assets/img/icon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
  <link rel="manifest"         href="/site.webmanifest">
  <meta name="msapplication-TileColor" content="#070A0F">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
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
  <link rel="preload" href="/assets/css/app.css" as="style">

  <!-- ── Google Fonts (display=swap for fast text render) ──── -->
  <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@600;700&family=JetBrains+Mono:wght@400&display=swap">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@600;700&family=JetBrains+Mono:wght@400&display=swap"
        media="print" onload="this.media='all'">
  <noscript><link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@600;700&family=JetBrains+Mono:wght@400&display=swap"></noscript>
  <style>
    /* Map Space Grotesk → General Sans slot for display headings */
    :root {
      --font-display: "Space Grotesk", "Inter", sans-serif;
      --font-body:    "Inter", sans-serif;
      --font-mono:    "JetBrains Mono", monospace;
    }
  </style>

  <!-- ── Compiled Tailwind CSS ─────────────────────────────── -->
  <link rel="stylesheet" href="/assets/css/app.css">

  <!-- ── CSRF Token for JS fetch() calls ───────────────────── -->
  <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

  <!-- Alpine.js loaded AFTER app.js in scripts.php so x-data components register first -->

  <!-- ── Preloader inline critical CSS ─────────────────────── -->
  <style>
    /* Ensure preloader shows immediately before app.css loads */
    #preloader {
      position: fixed;
      inset: 0;
      background: #070A0F;
      z-index: 10000;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 2rem;
    }
    body { overflow: hidden; } /* unlocked by preloader.js */
  </style>

  <!-- ── Structured Data: Organization / LocalBusiness ────── -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": "https://nexisconetwork.ca/#business",
    "name": "Nexisco Network Inc.",
    "legalName": "Nexisco Network Inc.",
    "alternateName": "Nexisco",
    "description": "Professional IT services across Canada — virus & malware removal, PC & laptop repair, data recovery, network setup, and managed business IT. Headquartered in Edmonton, Alberta.",
    "url": "https://nexisconetwork.ca",
    "logo": "https://nexisconetwork.ca/assets/img/logo.png",
    "image": "https://nexisconetwork.ca/assets/img/og-image.png",
    "telephone": "+1-825-771-7727",
    "email": "support@nexisconetwork.ca",
    "priceRange": "$$",
    "areaServed": {
      "@type": "Country",
      "name": "Canada"
    },
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
      "telephone": "+1-825-771-7727",
      "contactType": "customer service",
      "email": "support@nexisconetwork.ca",
      "areaServed": "CA",
      "availableLanguage": ["en"]
    }],
    "openingHoursSpecification": [{
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
      "opens": "08:00",
      "closes": "21:00"
    }],
    "sameAs": [
      "https://www.facebook.com/NexiscoNetwork",
      "https://www.linkedin.com/company/nexisco-network",
      "https://twitter.com/NexiscoNetwork"
    ],
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.9",
      "reviewCount": "247"
    }
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
</head>
<body class="bg-[#070A0F] text-[#F8FAFC] antialiased overflow-x-hidden">

<!-- ── Scroll Progress Bar ───────────────────────────────────── -->
<div id="scroll-progress" aria-hidden="true"></div>

<!-- ── Preloader ──────────────────────────────────────────────── -->
<div id="preloader" role="status" aria-label="Loading Nexisco Network">
  <!-- Logo: replace with real SVG -->
  <svg id="preloader-logo" width="64" height="64" viewBox="0 0 64 64" fill="none"
       xmlns="http://www.w3.org/2000/svg" style="opacity:0" aria-hidden="true">
    <path id="preloader-logo-path"
      d="M8 56 L8 8 L32 32 L56 8 L56 56"
      stroke="#06B6D4" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
      fill="none"/>
    <circle cx="32" cy="32" r="4" fill="#06B6D4" opacity="0.6"/>
  </svg>

  <div class="preloader-bar-track" style="width:200px;height:2px;background:rgba(255,255,255,0.06);border-radius:1px;overflow:hidden">
    <div id="preloader-bar-fill" class="preloader-bar-fill" style="height:100%;width:0%;background:linear-gradient(90deg,#06B6D4,#6366F1);border-radius:1px;transition:width 0.1s ease"></div>
  </div>

  <span id="preloader-counter" style="font-family:'JetBrains Mono',monospace;font-size:0.875rem;color:#64748B;letter-spacing:0.05em">0%</span>

  <!-- Curtain overlay for exit wipe -->
  <div id="preloader-curtain" style="position:absolute;inset:0;background:#070A0F;transform-origin:top;pointer-events:none"></div>
</div>

<!-- ── Custom Cursor (desktop only) ──────────────────────────── -->
<div id="cursor" aria-hidden="true"></div>

<!-- ── Page Transition Overlay ───────────────────────────────── -->
<div id="page-transition" aria-hidden="true"
     style="position:fixed;inset:0;background:#070A0F;z-index:9997;transform:scaleY(0);transform-origin:bottom;pointer-events:none"></div>
