<?php
declare(strict_types=1);
/**
 * Nexisco Network — Homepage (digital agency)
 * Hero | Marquee | Stats | What We Do | Why Nexisco |
 * How It Works | Portfolio preview | Pricing preview | Testimonials | FAQ | CTA
 */

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../data/services.php';
require_once __DIR__ . '/../data/pricing.php';
require_once __DIR__ . '/../data/portfolio.php';
require_once __DIR__ . '/../data/faqs.php';

$page_title       = 'Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency';
$page_description = 'Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce solutions for businesses in the US, Canada, and worldwide.';
$page_canonical   = 'https://nexisconetwork.ca/';

// Homepage FAQs (first 5 from General category)
$home_faqs = array_slice($FAQS[0]['items'] ?? [], 0, 5);

// Portfolio preview — 2 per pillar (web, marketing, ecommerce)
$preview = [];
foreach (['web', 'marketing', 'ecommerce'] as $cat) {
    $n = 0;
    foreach ($PORTFOLIO as $p) {
        if ($p['cat'] === $cat) { $preview[] = $p; if (++$n >= 2) break; }
    }
}

// Pricing preview tiers
$preview_plan_ids = ['starter', 'pro', 'advanced'];
$preview_plans = array_values(array_filter($PRICING_PLANS, fn($p) => in_array($p['id'], $preview_plan_ids, true)));

$extra_head = Seo::organization() . Seo::professional_service();
if (!empty($home_faqs)) {
    $extra_head .= Seo::faq_page($home_faqs);
}

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
      <!-- NOTE (owner): add agency video sources (hero-bg.webm + hero-bg.mp4) -->
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
        <span class="text-accent-font">Global digital agency · Serving the US, Canada &amp; worldwide</span>
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
        Expert
        <span class="typewriter" id="hero-typewriter">web development</span>
        for ambitious brands.<br>
        High-performing websites, data-driven marketing, and ecommerce stores that sell — in the US, Canada &amp; worldwide.
      </p>

      <!-- CTAs -->
      <div data-anim="fade-up" class="flex flex-wrap gap-4">
        <a href="/start-project" class="btn btn-gradient btn-lg"  data-magnetic>Get a Free Quote</a>
        <a href="/portfolio"     class="btn btn-secondary btn-lg" data-magnetic>View Our Work →</a>
      </div>

      <!-- Trust micro-badges -->
      <div data-anim="fade-up" class="flex flex-wrap gap-3 mt-8">
        <?php
        $trust = [
          ['🌎', 'Serving the US &amp; Canada'],
          ['💳', 'Billed in USD &amp; CAD'],
          ['🎯', 'Results-Focused'],
          ['🌍', 'Global Delivery'],
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
    <span class="chip-icon" style="background:linear-gradient(135deg,rgba(244,114,182,0.15),rgba(251,146,60,0.15));color:#EC4899">★</span>
    Senior-level talent
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
        'WooCommerce', 'Conversion Optimization', 'Email Marketing', 'Branding', 'Global Clients', 'USD & CAD',
        'Web Development', 'UI/UX', 'SEO', 'Google Ads', 'Social Media', 'Shopify',
        'WooCommerce', 'Conversion Optimization', 'Email Marketing', 'Branding', 'Global Clients', 'USD & CAD',
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
     VALUE-STATS SECTION  (factual; real figures optional via config/site-stats.php)
     ================================================================ -->
<section id="stats" class="relative section-padding overflow-hidden" aria-label="Nexisco by the numbers">

  <div class="bg-media-wrapper" aria-hidden="true">
    <!-- NOTE (owner): replace with final stats background image -->
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
      <p class="eyebrow">Our Track Record</p>
      <h2>Results that <span class="text-gradient">compound</span></h2>
      <p>Measurable outcomes for brands, startups, and growing businesses worldwide.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8" data-stagger data-stagger-delay="0.1">
      <?php
      // Factual value-stats. To show real numeric figures instead, set verifiable
      // values in config/site-stats.php and wire them here.
      $value_stats = [
        ['big' => 'US · CA · Worldwide', 'sub' => 'Clients served across borders'],
        ['big' => '3 Core Services',     'sub' => 'Web, marketing &amp; ecommerce, one team'],
        ['big' => 'USD &amp; CAD',       'sub' => 'Billed in your currency'],
        ['big' => 'Senior Specialists',  'sub' => 'Design, development &amp; marketing experts'],
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
          <!-- NOTE (owner): replace with a real team / studio photo -->
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80"
               alt="The Nexisco Network team collaborating on a digital project"
               loading="lazy" width="1200" height="1500"
               class="parallax-img" data-ken-burns>
        </div>

        <div class="floating-badge rounded-2xl px-5 py-4 absolute -right-4 top-12"
             data-anim="fade-up" style="max-width:180px">
          <div class="stat-number text-3xl leading-none">🌍</div>
          <div class="text-xs mt-2 font-medium" style="color:var(--text-secondary)">Global delivery<br>across time zones</div>
        </div>

        <div class="floating-badge rounded-2xl px-5 py-4 absolute -left-4 bottom-16"
             data-anim="fade-up" style="max-width:200px">
          <div class="flex items-center gap-2 mb-2">
            <span style="width:8px;height:8px;background:#10B981;border-radius:50%;display:inline-block;box-shadow:0 0 10px rgba(16,185,129,0.6);animation:widget-pulse 2s ease-in-out infinite"></span>
            <span class="text-xs font-semibold" style="color:#059669">USD &amp; CAD</span>
          </div>
          <div class="text-sm font-semibold" style="color:var(--text-primary)">Transparent, results-driven pricing</div>
        </div>
      </div>

      <!-- Right: Benefits text -->
      <div>
        <p class="text-eyebrow mb-4" data-anim="fade-up">Why Nexisco</p>
        <h2 class="text-h1 mb-6" data-split="words">
          The growth team your brand <span class="text-gradient-electric">actually needs.</span>
        </h2>
        <p class="text-base mb-8 leading-relaxed" style="color:var(--text-secondary)" data-anim="fade-up">
          We're a senior-level agency that designs, builds, and grows digital businesses — with clear
          communication, data-driven decisions, and a dedicated project manager on every engagement.
        </p>

        <?php
        $benefits = [
          ['icon' => '🧠', 'title' => 'Senior-Level Talent',       'desc' => 'Experienced designers, developers & marketers — no juniors learning on your dime.'],
          ['icon' => '🎯', 'title' => 'Conversion-Focused Design',  'desc' => 'Every page and campaign is built to drive a measurable business outcome.'],
          ['icon' => '📊', 'title' => 'Data-Driven Marketing',      'desc' => 'We test, measure, and optimize so your budget compounds over time.'],
          ['icon' => '📈', 'title' => 'Transparent Reporting',      'desc' => 'Live dashboards and plain-English monthly reports — no vanity metrics.'],
          ['icon' => '🌍', 'title' => 'Global Delivery',           'desc' => 'Remote-friendly delivery for clients in the US, Canada, and worldwide.'],
          ['icon' => '🤝', 'title' => 'Dedicated Project Manager',  'desc' => 'One point of contact who keeps your project on time and on scope.'],
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
      ['num' => '02', 'title' => 'Strategy & Proposal','desc' => 'A prioritized plan and proposal: deliverables, timeline, and the channels or build that will move the needle.', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200&q=70', 'color' => '#4F46E5'],
      ['num' => '03', 'title' => 'Design & Build',     'desc' => 'We design, build, and launch campaigns — with check-ins and approvals so there are never any surprises.', 'img' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=1200&q=70', 'color' => '#10B981'],
      ['num' => '04', 'title' => 'Launch & Optimize',  'desc' => 'We go live, then measure and optimize — compounding your results with transparent monthly reporting.', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=70', 'color' => '#F59E0B'],
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
     PORTFOLIO PREVIEW
     ================================================================ -->
<section id="work" class="relative section-padding overflow-hidden grain" style="background:var(--bg-primary)" aria-label="Featured work">
  <div class="glow-orb glow-orb-cyan" style="width:500px;height:500px;top:-8%;right:-6%;opacity:0.12" aria-hidden="true"></div>
  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Featured Work</p>
      <h2>A look at <span class="text-gradient">what we build</span></h2>
      <p>A selection of projects across web, marketing, and ecommerce. <a href="/portfolio" class="underline hover:text-slate-900">See the full portfolio →</a></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="0.08">
      <?php foreach ($preview as $p): ?>
      <a href="/portfolio" class="group relative overflow-hidden rounded-2xl block"
         style="background:var(--bg-secondary);border:1px solid var(--border-subtle)">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?= e($p['image']) ?>"
               onerror="this.src='https://images.unsplash.com/photo-1559028012-481c04fa702d?w=900&q=60'"
               alt="<?= e($p['title']) ?> — <?= e($p['tag']) ?>"
               loading="lazy" width="900" height="675"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(15,23,42,0.55) 0%,transparent 55%)"></div>
          <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold"
               style="background:rgba(255,255,255,0.9);color:var(--accent)"><?= e($p['tag']) ?></div>
          <div class="absolute bottom-3 left-4 right-4">
            <div class="text-white font-semibold"><?= e($p['title']) ?></div>
            <div class="text-white/80 text-xs mt-0.5"><?= e($p['desc']) ?></div>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-10" data-anim="fade-up">
      <a href="/portfolio" class="btn btn-secondary" data-magnetic>View Full Portfolio</a>
    </div>
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
            <span class="text-sm" style="color:var(--text-tertiary)">/mo · USD / CAD</span>
          </div>
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
     WHY CLIENTS CHOOSE NEXISCO  (value section — the reviews carousel
     can be re-enabled once genuine client testimonials are supplied)
     ================================================================ -->
<section id="why-clients" class="relative section-padding overflow-hidden" style="background:var(--bg-primary)" aria-label="Why clients choose Nexisco">

  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=1920&q=60"
         alt="" loading="lazy" width="1920" height="900"
         style="opacity:0.30;width:100%;height:100%;object-fit:cover;filter:blur(3px)">
  </div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.85);z-index:1" aria-hidden="true"></div>

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Why Nexisco</p>
      <h2>Why clients <span class="text-gradient">choose Nexisco</span></h2>
      <p>Senior talent, conversion-focused work, and transparent delivery — across the US, Canada, and worldwide.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger data-stagger-delay="0.08">
      <?php
      $why_cards = [
        ['icon' => '🧠', 'title' => 'Senior-level talent',      'desc' => 'Your work is handled by specialists — not juniors learning on the job.'],
        ['icon' => '🎯', 'title' => 'Conversion-focused builds', 'desc' => 'Every site and campaign is designed to turn visitors into customers.'],
        ['icon' => '📊', 'title' => 'Transparent reporting',     'desc' => 'Clear metrics and plain-English updates — no jargon, no vanity numbers.'],
        ['icon' => '🌍', 'title' => 'Global, on-time delivery',  'desc' => 'Remote-friendly delivery across time zones, on schedule.'],
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
      <a href="/start-project" class="btn btn-gradient" data-magnetic>Be our next success story →</a>
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
    <!-- NOTE (owner): replace with final CTA background image -->
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
        Get a free quote today. Tell us your goals and we'll map the fastest path to growth —
        in web, marketing, ecommerce, or all three.
      </p>

      <div class="flex flex-wrap gap-4 justify-center" data-anim="fade-up">
        <a href="/start-project" class="btn btn-gradient text-lg px-8 py-4" data-magnetic>Get a Free Quote</a>
        <a href="/portfolio"     class="btn btn-secondary text-lg px-8 py-4" data-magnetic>View Our Work</a>
      </div>

      <div class="flex flex-wrap justify-center gap-6 mt-10 text-sm"
           style="color:var(--text-tertiary)" data-anim="fade-up">
        <span>✓ Free consultation</span>
        <span>✓ Global delivery</span>
        <span>✓ USD &amp; CAD</span>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
