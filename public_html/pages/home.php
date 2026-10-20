<?php
declare(strict_types=1);
/**
 * Nexisco Network — Homepage (digital agency)
 * Hero | Marquee | At a Glance | What We Do | Why Nexisco |
 * How It Works | Pricing preview | Why Work With Nexisco | FAQ | CTA
 */

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../data/services.php';
require_once __DIR__ . '/../data/pricing.php';
require_once __DIR__ . '/../data/faqs.php';

$page_title       = 'Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency';
$page_description = 'Nexisco Network is an ' . business('positioning') . ', delivering web development, digital marketing, and ecommerce development.';
$page_canonical   = 'https://nexisconetwork.ca/';

// Homepage FAQs (first 5 from General category)
$home_faqs = array_slice($FAQS[0]['items'] ?? [], 0, 5);

// Pricing preview tiers
$preview_plan_ids = ['starter', 'pro', 'advanced'];
$preview_plans = array_values(array_filter($PRICING_PLANS, fn($p) => in_array($p['id'], $preview_plan_ids, true)));

$extra_head = !empty($home_faqs) ? Seo::faq_page($home_faqs) : '';

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ================================================================
     HERO SECTION
     ================================================================ -->
<section id="hero" aria-label="Hero — Nexisco Network">

  <!-- Layer 1: image background -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <video class="bg-video" autoplay muted loop playsinline
           poster="/assets/img/hero/hero-poster.jpg"
           style="opacity:0.75">
      <?php /* NOTE (owner): add agency video sources (hero-bg.webm + hero-bg.mp4) */ ?>
    </video>
    <!-- Poster fallback -->
    <img src="https://images.unsplash.com/photo-1559028012-481c04fa702d?w=1920&q=70"
         alt=""
         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.78"
         data-preload
         width="1920" height="1080">
  </div>

  <!-- Layer 2: Light wash overlay -->
  <div class="bg-overlay-dark" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center top,transparent 35%,rgba(250,251,252,0.55) 100%);z-index:1;pointer-events:none" aria-hidden="true"></div>

  <!-- Layer 3: Mouse-reactive morphing colour blobs -->
  <div id="hero-blob-1" class="hero-blob"  aria-hidden="true" style="top:-8%;left:-6%"></div>
  <div id="hero-blob-2" class="hero-blob b2" aria-hidden="true" style="bottom:-12%;right:-4%;animation-delay:-6s"></div>

  <!-- Layer 4: Orbital service icons (desktop only) -->
  <div class="hero-orbit" aria-hidden="true">
    <div class="hero-orbit-ring" style="width:780px;height:780px">
      <div class="hero-orbit-icon" style="top:-28px;left:50%;margin-left:-28px">
        <!-- code -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
      </div>
      <div class="hero-orbit-icon" style="top:50%;right:-28px;margin-top:-28px">
        <!-- chart (marketing) -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
      </div>
      <div class="hero-orbit-icon" style="bottom:-28px;left:50%;margin-left:-28px">
        <!-- cart (ecommerce) -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      </div>
      <div class="hero-orbit-icon" style="top:50%;left:-28px;margin-top:-28px">
        <!-- layout (web) -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
      </div>
    </div>
    <div class="hero-orbit-ring r2" style="width:520px;height:520px">
      <div class="hero-orbit-icon" style="top:-28px;left:50%;margin-left:-28px">
        <!-- search (SEO) -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </div>
      <div class="hero-orbit-icon" style="bottom:-28px;left:50%;margin-left:-28px">
        <!-- megaphone -->
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
      </div>
    </div>
  </div>

  <!-- Layer 5: Canvas particle network -->
  <canvas id="hero-canvas" aria-hidden="true"></canvas>

  <!-- Layer 6: Content -->
  <div class="hero-content container-wide w-full">
    <div class="max-w-3xl pt-36 pb-24 md:pt-44 md:pb-28">

      <!-- Live status pill -->
      <div data-anim="fade-up" class="hero-status mb-6">
        <span class="pulse-dot"></span>
        <span class="text-accent-font"><?= e(business('positioning')) ?></span>
      </div>

      <!-- Headline -->
      <h1 class="text-display mb-6" style="line-height:0.95;font-family:var(--font-display)">
        <span class="block" data-split="chars">We build,</span>
        <span class="block">
          <span class="text-serif text-gradient-turquoise">market</span>
          <span class="text-gradient-anim" data-split="chars">&nbsp;&amp; scale.</span>
        </span>
      </h1>

      <!-- Subtitle with rotating typewriter -->
      <p data-anim="fade-up"
         class="text-lg md:text-xl mb-10 max-w-xl"
         style="color:var(--text-secondary);line-height:1.7">
        Professional
        <span class="typewriter" id="hero-typewriter">web development</span>
        for ambitious brands.<br>
        High-performing websites, data-driven marketing, and ecommerce stores that sell — for businesses in Canada and the US.
      </p>

      <!-- CTAs -->
      <div data-anim="fade-up" class="flex flex-wrap gap-4">
        <a href="/start-project" class="btn btn-gradient btn-lg"  data-magnetic>Get a Free Quote</a>
        <a href="/services"      class="btn btn-secondary btn-lg" data-magnetic>See Our Services →</a>
      </div>

      <!-- Trust micro-badges -->
      <div data-anim="fade-up" class="flex flex-wrap gap-3 mt-8">
        <?php
        $trust = [
          ['🌎', 'Serving Canada &amp; the US'],
          ['💳', 'Billed in USD &amp; CAD'],
          ['📝', 'Free, no-obligation quotes'],
          ['💻', 'Remote Delivery'],
        ];
        foreach ($trust as [$icon, $label]): ?>
        <span class="text-xs px-3 py-2 rounded-full inline-flex items-center gap-1.5 text-accent-font font-semibold"
              style="background:rgba(255,255,255,0.85);border:1px solid rgba(15,23,42,0.08);color:var(--text-secondary);backdrop-filter:blur(10px) saturate(160%);box-shadow:0 4px 14px rgba(15,23,42,0.05)">
          <span aria-hidden="true"><?= $icon ?></span><?= $label ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Floating tag chips -->
  <div class="hero-chip" style="top:18%;right:6%;animation-delay:-1s">
    <span class="chip-icon">⚡</span>
    Conversion-focused
  </div>
  <div class="hero-chip" style="bottom:22%;right:14%;animation-delay:-3s">
    <span class="chip-icon" style="background:linear-gradient(135deg,rgba(244,114,182,0.15),rgba(251,146,60,0.15));color:#EC4899">✓</span>
    Fixed written quotes
  </div>

  <!-- Scroll indicator -->
  <div class="scroll-indicator" aria-hidden="true">
    <span class="text-xs uppercase tracking-[0.15em] text-accent-font" style="color:var(--text-tertiary)">Scroll</span>
    <div style="width:1px;height:40px;background:linear-gradient(to bottom,rgba(15,23,42,0.4),transparent)"></div>
  </div>
</section>

<!-- ================================================================
     TRUST MARQUEE
     ================================================================ -->
<section class="py-6 grain overflow-hidden"
         style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle);border-bottom:1px solid var(--border-subtle)"
         aria-label="What we do">

  <div style="display:flex;overflow:hidden">
    <div class="marquee-track" aria-hidden="true">
      <?php
      $marquee = [
        'Web Development', 'UI/UX', 'SEO', 'Google Ads', 'Social Media', 'Shopify',
        'WooCommerce', 'Conversion Optimization', 'Email Marketing', 'Branding', 'Canada & US', 'USD & CAD',
        'Web Development', 'UI/UX', 'SEO', 'Google Ads', 'Social Media', 'Shopify',
        'WooCommerce', 'Conversion Optimization', 'Email Marketing', 'Branding', 'Canada & US', 'USD & CAD',
      ];
      foreach ($marquee as $item): ?>
      <span style="display:inline-flex;align-items:center;gap:0.75rem;white-space:nowrap;font-size:0.8125rem;font-weight:500;letter-spacing:0.05em;color:var(--text-tertiary)">
        <?= e($item) ?>
        <span style="color:var(--accent);opacity:0.4">◆</span>
      </span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     AT A GLANCE  (plain business facts — no statistics)
     ================================================================ -->
<section id="stats" class="relative section-padding overflow-hidden" aria-label="Nexisco at a glance">

  <div class="bg-media-wrapper" aria-hidden="true">
    <?php /* NOTE (owner): replace with final stats background image */ ?>
    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&q=70"
         alt="" loading="lazy" width="1920" height="900"
         data-parallax="-20"
         style="opacity:0.75;width:100%;height:115%;object-fit:cover">
  </div>
  <div class="bg-overlay-dark" aria-hidden="true"></div>

  <div class="glow-orb glow-orb-cyan"   style="width:400px;height:400px;top:-100px;left:-100px;opacity:0.5" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:300px;height:300px;bottom:-50px;right:5%;opacity:0.4;animation-delay:2s" aria-hidden="true"></div>

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">At a Glance</p>
      <h2>Nexisco <span class="text-gradient">at a glance</span></h2>
      <p>Web development, digital marketing, and ecommerce for businesses in Canada and the US.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8" data-stagger data-stagger-delay="0.1">
      <?php
      // Plain business facts only — location comes from config/business.php.
      // Do not add client counts, results or other statistics here.
      $office      = business('registered_office');
      $city_region = e($office['city'] . ', ' . $office['region_name']);
      $value_stats = [
        ['big' => $city_region,          'sub' => 'Based in ' . $city_region],
        ['big' => '3 Core Services',     'sub' => 'Web, marketing &amp; ecommerce'],
        ['big' => 'USD or CAD',          'sub' => 'Billed in USD or CAD'],
        ['big' => 'Free Quotes',         'sub' => 'Free, no-obligation quotes'],
      ];
      foreach ($value_stats as $s): ?>
      <div class="glass rounded-2xl p-8 text-center flex flex-col justify-center min-h-[150px]">
        <div class="text-xl md:text-2xl font-bold leading-tight text-gradient"><?= $s['big'] ?></div>
        <div class="text-xs md:text-sm mt-3" style="color:var(--text-secondary)"><?= $s['sub'] ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     WHAT WE DO — 3 pillars
     ================================================================ -->
<section id="services" class="relative section-padding gradient-mesh-services grain" aria-label="What we do">
  <div class="glow-orb glow-orb-cyan"   style="width:600px;height:600px;top:-10%;left:-8%;opacity:0.14"   aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:500px;height:500px;bottom:0;right:-5%;opacity:0.10" aria-hidden="true"></div>

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">What We Do</p>
      <h2>Three pillars. <span class="text-gradient-warm">One partner.</span></h2>
      <p>From the first pixel to the final sale — we design, market, and scale digital businesses.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="0.08">
      <?php foreach ($SERVICES as $svc): ?>
      <a href="/services/<?= e($svc['slug']) ?>"
         class="service-card card rounded-2xl min-h-[320px] flex flex-col justify-end p-8 group"
         data-tilt style="min-height:320px"
         aria-label="<?= e($svc['name']) ?> — <?= e($svc['tagline']) ?>">

        <div class="card-bg" style="background-image:url('<?= e($svc['card_image']) ?>')"></div>
        <div class="card-gradient"></div>

        <div class="relative z-10">
          <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110"
               style="background:rgba(8,145,178,0.10);border:1px solid rgba(8,145,178,0.25)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0891B2"
                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <?= $svc['icon_path'] ?>
            </svg>
          </div>

          <h3 class="text-lg font-semibold mb-1"><?= e($svc['name']) ?></h3>
          <p class="text-sm mb-3" style="color:var(--text-secondary)"><?= e($svc['tagline']) ?></p>

          <div class="flex items-center justify-between">
            <span class="text-xs font-medium" style="color:var(--accent)"><?= e($svc['price_label']) ?></span>
            <span class="text-sm flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                  style="color:var(--accent)">
              Learn more →
            </span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-10" data-anim="fade-up">
      <a href="/services" class="btn btn-secondary" data-magnetic>View All Services</a>
    </div>
  </div>
</section>

<!-- ================================================================
     WHY NEXISCO
     ================================================================ -->
<section id="why-us" class="relative section-padding overflow-hidden" aria-label="Why choose Nexisco Network">

  <div class="container-wide relative z-10">
    <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

      <!-- Left: Parallax image with floating badge widgets -->
      <div class="relative" data-reveal="circle">
        <div class="parallax-wrap rounded-3xl overflow-hidden aspect-[4/5]">
          <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=80"
               alt="Laptop on a desk showing an analytics dashboard"
               loading="lazy" width="1200" height="1500"
               class="parallax-img" data-ken-burns>
        </div>

        <div class="floating-badge rounded-2xl px-5 py-4 absolute -right-4 top-12"
             data-anim="fade-up" style="max-width:180px">
          <div class="stat-number text-3xl leading-none">💻</div>
          <div class="text-xs mt-2 font-medium" style="color:var(--text-secondary)">Work delivered<br>online</div>
        </div>

        <div class="floating-badge rounded-2xl px-5 py-4 absolute -left-4 bottom-16"
             data-anim="fade-up" style="max-width:200px">
          <div class="flex items-center gap-2 mb-2">
            <span style="width:8px;height:8px;background:#10B981;border-radius:50%;display:inline-block;box-shadow:0 0 10px rgba(16,185,129,0.6);animation:widget-pulse 2s ease-in-out infinite"></span>
            <span class="text-xs font-semibold" style="color:#059669">USD &amp; CAD</span>
          </div>
          <div class="text-sm font-semibold" style="color:var(--text-primary)">Transparent, fixed pricing</div>
        </div>
      </div>

      <!-- Right: Benefits text -->
      <div>
        <p class="text-eyebrow mb-4" data-anim="fade-up">Why Nexisco</p>
        <h2 class="text-h1 mb-6" data-split="words">
          The growth partner your brand <span class="text-gradient-electric">actually needs.</span>
        </h2>
        <p class="text-base mb-8 leading-relaxed" style="color:var(--text-secondary)" data-anim="fade-up">
          We design, build, and grow digital businesses with fixed written quotes, your approval at
          each stage, plain-English monthly reports, and one point of contact.
        </p>

        <?php
        $benefits = [
          ['icon' => '📝', 'title' => 'Fixed Written Quotes',       'desc' => 'Scope, timeline and price are agreed in writing before work starts.'],
          ['icon' => '🎯', 'title' => 'Conversion-Focused Design',  'desc' => 'Every page and campaign is built to drive a measurable business outcome.'],
          ['icon' => '📊', 'title' => 'Data-Driven Marketing',      'desc' => 'We test, measure, and explain every change in a plain-English monthly report.'],
          ['icon' => '📈', 'title' => 'Transparent Reporting',      'desc' => 'Live dashboards and plain-English monthly reports — no vanity metrics.'],
          ['icon' => '💻', 'title' => 'Remote Delivery',           'desc' => 'Work is delivered online for businesses in Canada and the US.'],
          ['icon' => '🤝', 'title' => 'One Point of Contact',       'desc' => 'One point of contact from quote to launch, so you always know who to ask.'],
        ];
        ?>
        <ul class="space-y-5" data-stagger data-stagger-delay="0.07">
          <?php foreach ($benefits as $b): ?>
          <li class="flex items-start gap-4 p-4 rounded-xl transition-all duration-300 hover:bg-slate-900/[0.03]"
              style="border:1px solid transparent;border-radius:0.75rem">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 text-lg"
                 style="background:rgba(8,145,178,0.08);border:1px solid rgba(8,145,178,0.15)">
              <?= $b['icon'] ?>
            </div>
            <div>
              <div class="font-semibold mb-0.5"><?= e($b['title']) ?></div>
              <div class="text-sm" style="color:var(--text-secondary)"><?= e($b['desc']) ?></div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>

        <div class="mt-8" data-anim="fade-up">
          <a href="/about" class="btn btn-primary" data-magnetic>About Nexisco →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     HOW IT WORKS — Horizontal scroll
     ================================================================ -->
<section class="how-it-works-intro relative overflow-hidden" aria-label="How Nexisco works" style="background:var(--bg-secondary)">
  <div class="container-wide section-padding relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">The Process</p>
      <h2>From idea to launch in <span class="text-gradient-ocean">4 steps</span></h2>
      <p>A clear, collaborative engagement — you approve every stage.</p>
    </div>
  </div>
</section>

<section class="how-it-works-h-scroll relative overflow-hidden" aria-label="Process steps" style="background:var(--bg-secondary)">

  <div class="horizontal-scroll-container" style="position:relative">
    <?php
    $steps = [
      ['num' => '01', 'title' => 'Discovery & Quote',  'desc' => 'We learn your goals, audience, and scope, then send a clear, fixed quote in USD or CAD — free, no obligation.', 'img' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1200&q=70', 'color' => '#0891B2'],
      ['num' => '02', 'title' => 'Strategy & Proposal','desc' => 'A prioritized plan and proposal: deliverables, timeline, and the channels or build we recommend for your goals.', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200&q=70', 'color' => '#4F46E5'],
      ['num' => '03', 'title' => 'Design & Build',     'desc' => 'We design, build, and launch campaigns — with check-ins and approvals so there are never any surprises.', 'img' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=1200&q=70', 'color' => '#10B981'],
      ['num' => '04', 'title' => 'Launch & Optimize',  'desc' => 'We go live, then measure and optimize — with plain-English monthly reports.', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=70', 'color' => '#F59E0B'],
    ];
    foreach ($steps as $i => $step): ?>
    <div class="horizontal-scroll-panel" style="background:var(--bg-primary)">
      <div class="panel-bg bg-media-wrapper" aria-hidden="true">
        <img src="<?= e($step['img']) ?>" alt="" loading="lazy" width="1200" height="800"
             style="opacity:0.22;width:100%;height:100%;object-fit:cover;filter:blur(2px)">
      </div>
      <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(248,250,252,0.96) 0%,rgba(241,245,249,0.94) 100%);z-index:1" aria-hidden="true"></div>

      <div class="relative z-10 h-full flex items-center container-wide">
        <div class="max-w-xl panel-content-card">
          <span class="font-mono text-[6rem] md:text-[7rem] font-extrabold leading-none block mb-2"
                style="color:<?= e($step['color']) ?>;opacity:0.95;text-shadow:0 4px 24px rgba(15,23,42,0.08)"
                aria-hidden="true"><?= e($step['num']) ?></span>

          <h3 class="text-h2 mt-2 mb-4 font-bold" data-split="words"
              style="--split-color:<?= e($step['color']) ?>;color:#0f172a">
            <?= e($step['title']) ?>
          </h3>

          <p class="text-base md:text-lg leading-relaxed mb-8 font-medium" style="color:#334155">
            <?= e($step['desc']) ?>
          </p>

          <div class="flex gap-2">
            <?php for ($j = 0; $j < count($steps); $j++): ?>
            <div style="width:<?= $j === $i ? '24px' : '8px' ?>;height:8px;border-radius:4px;
                        background:<?= $j === $i ? $step['color'] : 'rgba(15,23,42,0.25)' ?>;
                        transition:all 0.3s ease"></div>
            <?php endfor; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ================================================================
     PRICING PREVIEW
     ================================================================ -->
<section id="pricing-preview" class="relative section-padding gradient-mesh grain overflow-hidden" aria-label="Pricing preview">
  <div class="glow-orb glow-orb-cyan" style="width:500px;height:500px;top:-100px;right:-100px;opacity:0.3" aria-hidden="true"></div>

  <div class="container-wide relative z-10" style="max-width:1100px">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Pricing</p>
      <h2>Plans for every <span class="text-gradient-sunset">growth stage</span></h2>
      <p>Transparent monthly plans in USD or CAD — or a custom quote for larger projects.</p>
    </div>

    <div class="grid sm:grid-cols-3 gap-6 lg:gap-8 items-start" data-stagger>
      <?php foreach ($preview_plans as $plan): ?>
      <div class="membership-card <?= !empty($plan['featured']) ? 'featured' : '' ?> relative">
        <?php if (!empty($plan['badge'])): ?>
        <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full text-xs font-semibold"
             style="background:var(--accent-gradient);color:#FFFFFF"><?= e($plan['badge']) ?></div>
        <?php endif; ?>

        <div class="mb-6">
          <h3 class="text-xl font-bold mb-1"><?= e($plan['name']) ?></h3>
          <p class="text-sm" style="color:var(--text-secondary)"><?= e($plan['tagline']) ?></p>
        </div>

        <div class="mb-6">
          <div class="flex items-baseline gap-1">
            <span class="text-4xl font-bold">$<?= e((string)$plan['price']['usd']) ?></span>
            <span class="text-sm" style="color:var(--text-tertiary)">USD/mo</span>
          </div>
          <p class="text-xs mt-1" style="color:var(--text-tertiary)">CAD pricing on the Pricing page</p>
        </div>

        <ul class="space-y-2.5 mb-8">
          <?php foreach (array_slice($plan['features'], 0, 5) as $feature): ?>
          <li class="flex items-start gap-2.5 text-sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0891B2"
                 stroke-width="2.5" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0 mt-0.5">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <?= e($feature) ?>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="/pricing" class="btn <?= !empty($plan['featured']) ? 'btn-gradient' : 'btn-secondary' ?> w-full text-center" data-magnetic>
          View Plan
        </a>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-center text-xs mt-6" style="color:var(--text-tertiary)" data-anim="fade-up">
      All plans available in USD or CAD. Custom project quotes available on request.
      <a href="/pricing" class="underline hover:text-slate-900">See all 5 plans →</a>
    </p>
  </div>
</section>

<!-- ================================================================
     WHY WORK WITH NEXISCO  (how the work runs — process facts only)
     ================================================================ -->
<section id="why-clients" class="relative section-padding overflow-hidden" style="background:var(--bg-primary)" aria-label="Why work with Nexisco">

  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=1920&q=60"
         alt="" loading="lazy" width="1920" height="900"
         style="opacity:0.30;width:100%;height:100%;object-fit:cover;filter:blur(3px)">
  </div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.85);z-index:1" aria-hidden="true"></div>

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Why Nexisco</p>
      <h2>Why work with <span class="text-gradient">Nexisco</span></h2>
      <p>Conversion-focused work and transparent delivery — for businesses in Canada and the US.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger data-stagger-delay="0.08">
      <?php
      $why_cards = [
        ['icon' => '✅', 'title' => 'Approval at every stage',  'desc' => 'Nothing goes live until you\'ve reviewed and approved it.'],
        ['icon' => '🎯', 'title' => 'Conversion-focused builds', 'desc' => 'Every site and campaign is designed to turn visitors into customers.'],
        ['icon' => '📊', 'title' => 'Transparent reporting',     'desc' => 'Clear metrics and plain-English updates — no jargon, no vanity numbers.'],
        ['icon' => '💻', 'title' => 'Remote delivery',           'desc' => 'Work is delivered online, on a timeline confirmed in your proposal.'],
      ];
      foreach ($why_cards as $c): ?>
      <div class="glass rounded-2xl p-6 h-full">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl mb-4"
             style="background:rgba(8,145,178,0.08);border:1px solid rgba(8,145,178,0.18)">
          <?= $c['icon'] ?>
        </div>
        <h3 class="font-semibold mb-1.5"><?= e($c['title']) ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($c['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Section CTA -->
    <div class="mt-12 text-center" data-anim="fade-up">
      <a href="/start-project" class="btn btn-gradient" data-magnetic>Start your project →</a>
    </div>
  </div>
</section>

<!-- ================================================================
     FAQ TEASER
     ================================================================ -->
<section id="faq-teaser" class="relative section-padding bg-dots grain"
         style="background-color:var(--bg-secondary)"
         aria-label="Frequently asked questions">

  <div class="container-narrow relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Got Questions?</p>
      <h2>Frequently <span class="text-gradient-electric">Asked Questions</span></h2>
    </div>

    <div data-faq-group data-stagger data-stagger-delay="0.06">
      <?php foreach ($home_faqs as $faq): ?>
      <div class="faq-item">
        <button class="faq-trigger" aria-expanded="false">
          <span><?= e($faq['q']) ?></span>
          <span class="faq-icon" aria-hidden="true">+</span>
        </button>
        <div class="faq-body">
          <p class="faq-body-inner"><?= e($faq['a']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-10" data-anim="fade-up">
      <a href="/faq" class="btn btn-secondary" data-magnetic>View All FAQs →</a>
    </div>
  </div>
</section>

<!-- ================================================================
     CTA SECTION
     ================================================================ -->
<section id="cta" class="relative section-padding overflow-hidden" aria-label="Get a free quote">

  <div class="bg-media-wrapper" aria-hidden="true">
    <video class="bg-video" autoplay muted loop playsinline
           poster="/assets/img/backgrounds/cta-poster.jpg"
           style="opacity:0.6"></video>
    <?php /* NOTE (owner): replace with final CTA background image */ ?>
    <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=1920&q=60"
         alt="" loading="lazy" width="1920" height="800"
         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.45">
  </div>
  <div class="bg-overlay-full" aria-hidden="true" style="background:rgba(250,251,252,0.8)"></div>

  <div class="glow-orb glow-orb-cyan"   style="width:600px;height:600px;top:-200px;left:50%;transform:translateX(-50%);opacity:0.3" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:400px;height:400px;bottom:-100px;right:10%;opacity:0.25;animation-delay:3s" aria-hidden="true"></div>

  <div class="container-narrow relative z-10 text-center">
    <div class="glass-strong rounded-3xl p-12 md:p-20">

      <p class="text-eyebrow mb-4" data-anim="fade-up">Ready to grow?</p>
      <h2 class="text-display mb-6" data-split="words">
        Let's build something<br><span class="text-gradient-anim">that performs.</span>
      </h2>
      <p class="text-lg mb-10 max-w-xl mx-auto" style="color:var(--text-secondary)" data-anim="fade-up">
        Get a free quote today. Tell us your goals and we'll send a clear plan and a fixed,
        written quote — for web, marketing, ecommerce, or all three.
      </p>

      <div class="flex flex-wrap gap-4 justify-center" data-anim="fade-up">
        <a href="/start-project" class="btn btn-gradient text-lg px-8 py-4" data-magnetic>Get a Free Quote</a>
        <a href="/services"      class="btn btn-secondary text-lg px-8 py-4" data-magnetic>See Our Services</a>
      </div>

      <div class="flex flex-wrap justify-center gap-6 mt-10 text-sm"
           style="color:var(--text-tertiary)" data-anim="fade-up">
        <span>✓ Free consultation</span>
        <span>✓ Work delivered online</span>
        <span>✓ USD &amp; CAD</span>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
