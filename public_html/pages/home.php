<?php
declare(strict_types=1);
/**
 * Nexisco Network — Homepage
 * Per-section visual map from STARTUP_PROGRESS.md implemented:
 * Hero | Trust Marquee | Stats | Services Grid | Why Choose Us |
 * How It Works | Membership | Testimonials | FAQ Teaser | CTA
 */

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../data/services.php';
require_once __DIR__ . '/../data/memberships.php';
require_once __DIR__ . '/../data/testimonials.php';
require_once __DIR__ . '/../data/faqs.php';

$page_title       = 'Nexisco Network — Smart IT. Seamless Support. | Canada\'s IT Experts';
$page_description = 'Professional IT services across Canada. Virus removal, PC repair, data recovery, network setup & business IT. Book online today — fast, reliable, guaranteed.';
$page_canonical   = 'https://nexisconetwork.ca/';

// Homepage FAQs (first 5 from General category)
$home_faqs = array_slice($FAQS[0]['items'] ?? [], 0, 5);

// Pass membership plans to Alpine.js
$membership_json = json_encode($MEMBERSHIP_PLANS, JSON_HEX_TAG | JSON_HEX_AMP);

$extra_head = Seo::organization() . Seo::local_business();
if (!empty($home_faqs)) {
    $extra_head .= Seo::faq_page($home_faqs);
}

$extra_scripts = "<script>window.MEMBERSHIP_PLANS = {$membership_json};</script>";

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ================================================================
     HERO SECTION
     Layer stack: video bg → particle canvas → gradient fade → content
     ================================================================ -->
<section id="hero" aria-label="Hero — Nexisco Network">

  <!-- Layer 1: Video background -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <!--
      Mobile: video hidden, poster shown via CSS
      Desktop: autoplay muted loop
      TODO: Add real video sources (hero-bg.mp4 + hero-bg.webm)
    -->
    <video class="bg-video" autoplay muted loop playsinline
           poster="/assets/img/hero/hero-poster.jpg"
           style="opacity:0.45">
      <!-- TODO: Add video sources -->
      <!-- <source src="/assets/video/hero-bg.webm" type="video/webm"> -->
      <!-- <source src="/assets/video/hero-bg.mp4"  type="video/mp4"> -->
    </video>

    <!-- Poster fallback (always visible, video overlaid on desktop) -->
    <!-- TODO: Replace with final hero poster image -->
    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1920&q=70"
         alt=""
         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.4"
         data-preload
         width="1920" height="1080">
    <!-- TODO: Replace with final image -->
  </div>

  <!-- Layer 2: Gradient overlay (bottom fade) -->
  <div class="bg-overlay-dark" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center top,transparent 40%,rgba(250,251,252,0.6) 100%);z-index:1;pointer-events:none" aria-hidden="true"></div>

  <!-- Layer 3: Canvas particle network -->
  <canvas id="hero-canvas" aria-hidden="true"></canvas>

  <!-- Layer 4: Content -->
  <div class="hero-content container-wide w-full">
    <div class="max-w-3xl pt-36 pb-24 md:pt-44 md:pb-28">

      <!-- Eyebrow label -->
      <div data-anim="fade-up"
           style="display:inline-flex;align-items:center;gap:0.5rem;margin-bottom:1.5rem">
        <span class="text-eyebrow">Canada's IT Experts</span>
        <span style="width:32px;height:1px;background:var(--accent);opacity:0.6"></span>
        <span class="text-eyebrow" style="color:var(--text-tertiary)">Est. 2018</span>
      </div>

      <!-- Headline — char-by-char SplitType reveal -->
      <h1 data-split="chars"
          class="text-display mb-6"
          style="line-height:0.95">
        Smart IT.<br>
        <span class="text-gradient">Seamless Support.</span>
      </h1>

      <!-- Subtitle -->
      <p data-anim="fade-up"
         class="text-lg md:text-xl mb-10 max-w-xl"
         style="color:var(--text-secondary);line-height:1.7">
        Expert computer repair, network setup, virus removal &amp; business IT
        across Canada. Fast turnaround. Guaranteed results.
      </p>

      <!-- CTAs -->
      <div data-anim="fade-up" class="flex flex-wrap gap-4">
        <a href="/book"     class="btn btn-gradient"    data-magnetic>Book a Repair</a>
        <a href="/services" class="btn btn-secondary"   data-magnetic>View Services →</a>
      </div>

      <!-- Trust micro-badges -->
      <div data-anim="fade-up" class="flex flex-wrap gap-4 mt-8">
        <?php
        $trust = ['⭐ 4.9/5 Rating','🛡️ 30-Day Guarantee','🇨🇦 Canadian Owned','⚡ Same-Day Service'];
        foreach ($trust as $t): ?>
        <span class="text-xs px-3 py-1.5 rounded-full"
              style="background:rgba(255,255,255,0.7);border:1px solid rgba(15,23,42,0.08);color:var(--text-secondary);backdrop-filter:blur(8px)">
          <?= $t ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="scroll-indicator" aria-hidden="true">
    <span class="text-xs uppercase tracking-[0.15em]" style="color:var(--text-tertiary)">Scroll</span>
    <div style="width:1px;height:40px;background:linear-gradient(to bottom,rgba(15,23,42,0.4),transparent)"></div>
  </div>
</section>

<!-- ================================================================
     TRUST MARQUEE
     CSS-only infinite scroll on subtle texture strip
     ================================================================ -->
<section class="py-6 grain overflow-hidden"
         style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle);border-bottom:1px solid var(--border-subtle)"
         aria-label="Trusted by clients across Canada">

  <div style="display:flex;overflow:hidden">
    <div class="marquee-track" aria-hidden="true">
      <?php
      $trust_items = [
        'Virus Removal', 'PC Repair', 'Data Recovery', 'Network Setup',
        'Remote Support', 'Business IT', 'Smart Home', 'Hardware Upgrades',
        '247+ Five-Star Reviews', 'PIPEDA Compliant', '30-Day Guarantee', 'Canada-Wide Service',
        'Virus Removal', 'PC Repair', 'Data Recovery', 'Network Setup',
        'Remote Support', 'Business IT', 'Smart Home', 'Hardware Upgrades',
        '247+ Five-Star Reviews', 'PIPEDA Compliant', '30-Day Guarantee', 'Canada-Wide Service',
      ];
      foreach ($trust_items as $item): ?>
      <span style="display:inline-flex;align-items:center;gap:0.75rem;white-space:nowrap;font-size:0.8125rem;font-weight:500;letter-spacing:0.05em;color:var(--text-tertiary)">
        <?= e($item) ?>
        <span style="color:var(--accent);opacity:0.4">◆</span>
      </span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     STATS SECTION
     Full-bleed dark cityscape photo + parallax + floating orbs + counters
     ================================================================ -->
<section id="stats" class="relative section-padding overflow-hidden" aria-label="Nexisco by the numbers">

  <!-- Background: dark data center photo with parallax -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <!-- TODO: Replace with final stats section background image -->
    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&q=70"
         alt="" loading="lazy" width="1920" height="900"
         data-parallax="-20"
         style="opacity:0.35;width:100%;height:115%;object-fit:cover">
    <!-- TODO: Replace with final image -->
  </div>
  <div class="bg-overlay-dark" aria-hidden="true"></div>

  <!-- Floating glow orbs -->
  <div class="glow-orb glow-orb-cyan"
       style="width:400px;height:400px;top:-100px;left:-100px;opacity:0.5"
       aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo"
       style="width:300px;height:300px;bottom:-50px;right:5%;opacity:0.4;animation-delay:2s"
       aria-hidden="true"></div>

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Our Track Record</p>
      <h2>Trusted by Canadians <span class="text-gradient">Nationwide</span></h2>
      <p>Real results from real clients — from Newfoundland to British Columbia.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8" data-stagger data-stagger-delay="0.1">
      <?php
      $stats = [
        ['number' => 2500, 'suffix' => '+', 'label' => 'Repairs Completed',    'note' => 'and counting'],
        ['number' => 99,   'suffix' => '%', 'label' => 'Satisfaction Rate',    'note' => 'from client surveys'],
        ['number' => 247,  'suffix' => '+', 'label' => '5-Star Reviews',       'note' => 'across platforms'],
        ['number' => 6,    'suffix' => 'yr', 'label' => 'Years in Business',   'note' => 'since 2018'],
      ];
      foreach ($stats as $s): ?>
      <div class="glass rounded-2xl p-10 text-center">
        <div class="stat-number">
          <span data-counter="<?= $s['number'] ?>" data-suffix="<?= $s['suffix'] ?>">0</span>
        </div>
        <div class="text-sm font-semibold mt-3 mb-1.5"><?= e($s['label']) ?></div>
        <div class="text-xs" style="color:var(--text-tertiary)"><?= e($s['note']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     SERVICES GRID
     Per-card service images (grayscale→color) + VanillaTilt + circuit bg
     ================================================================ -->
<section id="services" class="relative section-padding bg-circuit grain" aria-label="Our IT services">

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">What We Do</p>
      <h2>9 IT Services. <span class="text-gradient">One Team.</span></h2>
      <p>From urgent virus removal to managed business IT — we've got every technology need covered.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="0.08">
      <?php foreach ($SERVICES as $svc): ?>
      <a href="/services/<?= e($svc['slug']) ?>"
         class="service-card card rounded-2xl min-h-[320px] flex flex-col justify-end p-8 group"
         data-tilt style="min-height:320px"
         aria-label="<?= e($svc['name']) ?> — <?= e($svc['tagline']) ?>">

        <!-- Card background image (grayscale → color on hover) -->
        <div class="card-bg"
             style="background-image:url('<?= e($svc['card_image']) ?>')">
        </div>
        <!-- TODO: Replace card_image paths with final service images -->

        <!-- Gradient overlay -->
        <div class="card-gradient"></div>

        <!-- Content -->
        <div class="relative z-10">
          <!-- Service icon -->
          <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110"
               style="background:rgba(8,145,178,0.10);border:1px solid rgba(8,145,178,0.25)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0891B2"
                 stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
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
     WHY CHOOSE US
     Split layout: large parallax image left + floating badges + benefits right
     ================================================================ -->
<section id="why-us" class="relative section-padding overflow-hidden" aria-label="Why choose Nexisco Network">

  <div class="container-wide relative z-10">
    <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

      <!-- Left: Parallax image with floating badge widgets -->
      <div class="relative" data-reveal="circle">
        <div class="parallax-wrap rounded-3xl overflow-hidden aspect-[4/5]">
          <!-- TODO: Replace with final "Why Us" section image -->
          <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?w=1200&q=80"
               alt="Nexisco Network technician working on a computer repair"
               loading="lazy" width="1200" height="1500"
               class="parallax-img" data-ken-burns>
          <!-- TODO: Replace with final image -->
        </div>

        <!-- Floating badge: Years experience -->
        <div class="floating-badge rounded-2xl px-5 py-4 absolute -right-4 top-12"
             data-anim="fade-up" style="max-width:170px">
          <div class="stat-number text-3xl leading-none">6+</div>
          <div class="text-xs mt-2 font-medium" style="color:var(--text-secondary)">Years serving<br>Canadian clients</div>
        </div>

        <!-- Floating badge: Response time -->
        <div class="floating-badge rounded-2xl px-5 py-4 absolute -left-4 bottom-16"
             data-anim="fade-up" style="max-width:190px">
          <div class="flex items-center gap-2 mb-2">
            <span style="width:8px;height:8px;background:#10B981;border-radius:50%;display:inline-block;box-shadow:0 0 10px rgba(16,185,129,0.6);animation:widget-pulse 2s ease-in-out infinite"></span>
            <span class="text-xs font-semibold" style="color:#059669">Same-Day Available</span>
          </div>
          <div class="text-sm font-semibold" style="color:var(--text-primary)">Most repairs done within 24 hours</div>
        </div>
      </div>

      <!-- Right: Benefits text -->
      <div>
        <p class="text-eyebrow mb-4" data-anim="fade-up">Why Nexisco</p>
        <h2 class="text-h1 mb-6" data-split="words">
          The IT team your business <span class="text-gradient">actually needs.</span>
        </h2>
        <p class="text-base mb-8 leading-relaxed" style="color:var(--text-secondary)" data-anim="fade-up">
          We're not a call centre. We're certified Canadian technicians who solve real problems
          fast, communicate clearly, and back every job with a guarantee.
        </p>

        <?php
        $benefits = [
          ['icon' => '⚡', 'title' => 'Same-Day Service',       'desc' => 'Most repairs completed same-day or next business day.'],
          ['icon' => '🛡️', 'title' => '30-Day Guarantee',      'desc' => 'If it\'s not fixed right, we fix it again — free.'],
          ['icon' => '🇨🇦', 'title' => 'Canadian Owned',       'desc' => 'PIPEDA compliant, Canadian data storage, Canadian service.'],
          ['icon' => '💬', 'title' => 'Plain-Language Support', 'desc' => 'No jargon. Clear explanations. Friendly technicians.'],
          ['icon' => '🔒', 'title' => 'Privacy First',         'desc' => 'Your data is handled with strict confidentiality.'],
          ['icon' => '📱', 'title' => 'Remote or On-Site',     'desc' => 'We come to you, or fix it remotely in minutes.'],
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
          <a href="/about" class="btn btn-primary" data-magnetic>Meet Our Team →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     HOW IT WORKS — Horizontal scroll (desktop) / stacked (mobile)
     ================================================================ -->
<section class="how-it-works-intro relative overflow-hidden"
         aria-label="How Nexisco works"
         style="background:var(--bg-secondary)">
  <div class="container-wide section-padding relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">The Process</p>
      <h2>How It Works in <span class="text-gradient">4 Simple Steps</span></h2>
      <p>Getting your tech fixed is easier than you think.</p>
    </div>
  </div>
</section>

<section class="how-it-works-h-scroll relative overflow-hidden"
         aria-label="Process steps"
         style="background:var(--bg-secondary)">

  <!-- Horizontal scroll container -->
  <div class="horizontal-scroll-container" style="position:relative">

    <?php
    $steps = [
      [
        'num'   => '01',
        'title' => 'Book Online',
        'desc'  => 'Choose your service, pick a time, and fill in your details. Takes less than 2 minutes. Instant booking confirmation sent to your email.',
        'img'   => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=1200&q=70',
        'color' => '#0891B2',
        // TODO: Replace with final step image
      ],
      [
        'num'   => '02',
        'title' => 'Free Diagnosis',
        'desc'  => 'We assess the issue thoroughly — no charge. You get a clear quote before any work begins. No surprises.',
        'img'   => 'https://images.unsplash.com/photo-1581092335397-9583eb92d232?w=1200&q=70',
        'color' => '#4F46E5',
        // TODO: Replace with final step image
      ],
      [
        'num'   => '03',
        'title' => 'Expert Fix',
        'desc'  => 'Certified technicians get to work. Most repairs are done same-day. You\'ll get updates along the way.',
        'img'   => 'https://images.unsplash.com/photo-1487887235947-a955ef187fcc?w=1200&q=70',
        'color' => '#10B981',
        // TODO: Replace with final step image
      ],
      [
        'num'   => '04',
        'title' => 'Done & Guaranteed',
        'desc'  => 'Pick up your device — or get it back via secure remote handoff. Every repair comes with our 30-day guarantee.',
        'img'   => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&q=70',
        'color' => '#F59E0B',
        // TODO: Replace with final step image
      ],
    ];
    foreach ($steps as $i => $step): ?>
    <div class="horizontal-scroll-panel" style="background:var(--bg-primary)">

      <!-- Panel background image with overlay -->
      <div class="panel-bg bg-media-wrapper" aria-hidden="true">
        <img src="<?= e($step['img']) ?>" alt="" loading="lazy" width="1200" height="800"
             style="opacity:0.2;width:100%;height:100%;object-fit:cover">
      </div>
      <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(250,251,252,0.9) 0%,rgba(250,251,252,0.7) 100%);z-index:1"></div>

      <div class="relative z-10 h-full flex items-center container-wide">
        <div class="max-w-xl">
          <span class="font-mono text-[5rem] font-bold leading-none"
                style="color:<?= e($step['color']) ?>;opacity:0.15"
                aria-hidden="true"><?= e($step['num']) ?></span>

          <h3 class="text-h2 mt-2 mb-4" data-split="words"
              style="--split-color:<?= e($step['color']) ?>">
            <?= e($step['title']) ?>
          </h3>

          <p class="text-base leading-relaxed mb-8" style="color:var(--text-secondary)">
            <?= e($step['desc']) ?>
          </p>

          <!-- Step indicator dots -->
          <div class="flex gap-2">
            <?php for ($j = 0; $j < count($steps); $j++): ?>
            <div style="width:<?= $j === $i ? '24px' : '8px' ?>;height:8px;border-radius:4px;
                        background:<?= $j === $i ? $step['color'] : 'rgba(15,23,42,0.2)' ?>;
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
     MEMBERSHIP SECTION
     Animated CSS gradient mesh bg + glassmorphic cards + Alpine.js billing toggle
     ================================================================ -->
<section id="membership" class="relative section-padding gradient-mesh grain overflow-hidden"
         aria-label="Membership plans">

  <!-- Glow orbs -->
  <div class="glow-orb glow-orb-cyan"
       style="width:500px;height:500px;top:-100px;right:-100px;opacity:0.3"
       aria-hidden="true"></div>

  <div class="container-wide relative z-10" style="max-width:1200px"
       x-data="membership()" x-init="$store = window.MEMBERSHIP_PLANS ?? plans">

    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Membership Plans</p>
      <h2>Regular IT Care. <span class="text-gradient">Predictable Price.</span></h2>
      <p>Choose a plan and get ongoing IT support, priority response, and serious savings on repairs.</p>
    </div>

    <!-- Billing period toggle -->
    <div class="flex justify-center mb-10" data-anim="fade-up">
      <div class="glass rounded-full p-1 flex gap-1">
        <?php
        $periods = ['6mo' => '6 Months', '1yr' => '1 Year', '2yr' => '2 Years', '3yr' => '3 Years'];
        foreach ($periods as $key => $label): ?>
        <button @click="period = '<?= $key ?>'"
                :class="period === '<?= $key ?>' ? 'bg-gradient-to-r from-[#0891B2] to-[#4F46E5] text-white' : 'text-[var(--text-secondary)] hover:text-slate-900'"
                class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200">
          <?= $label ?>
        </button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Plans grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8" data-stagger>
      <?php foreach ($MEMBERSHIP_PLANS as $plan): ?>
      <div class="membership-card <?= $plan['featured'] ? 'featured' : '' ?> relative">

        <?php if (!empty($plan['badge'])): ?>
        <div class="absolute -top-3 left-1/2 -translate-x-1/2
                    px-4 py-1 rounded-full text-xs font-semibold"
             style="background:var(--accent-gradient);color:var(--bg-primary)">
          <?= e($plan['badge']) ?>
        </div>
        <?php endif; ?>

        <!-- Plan header -->
        <div class="mb-6">
          <h3 class="text-xl font-bold mb-1"><?= e($plan['name']) ?></h3>
          <p class="text-sm" style="color:var(--text-secondary)"><?= e($plan['tagline']) ?></p>
        </div>

        <!-- Price (reactive — defaults to 1yr, updates with billing toggle) -->
        <?php $defaultPrice = $plan['pricing']['1yr']; ?>
        <div class="mb-6"
             x-data="{ pricing: <?= htmlspecialchars(json_encode($plan['pricing']), ENT_QUOTES, 'UTF-8') ?> }">
          <div class="flex items-baseline gap-1">
            <span class="text-4xl font-bold"
                  x-text="'$' + (pricing[period]?.price ?? '<?= $defaultPrice['price'] ?>')">$<?= $defaultPrice['price'] ?></span>
            <span class="text-sm" style="color:var(--text-tertiary)">/mo CAD</span>
          </div>
          <p class="text-xs mt-1 min-h-[1rem]"
             style="color:var(--accent)"
             x-text="pricing[period]?.savings ?? ''"><?= e($defaultPrice['savings'] ?? '') ?></p>
        </div>

        <!-- Features -->
        <ul class="space-y-2.5 mb-8">
          <?php foreach ($plan['features'] as $feature): ?>
          <li class="flex items-start gap-2.5 text-sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0891B2"
                 stroke-width="2.5" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0 mt-0.5">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <?= e($feature) ?>
          </li>
          <?php endforeach; ?>
          <?php foreach ($plan['not_included'] as $not): ?>
          <li class="flex items-start gap-2.5 text-sm opacity-40">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0 mt-0.5">
              <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            <?= e($not) ?>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="/membership#<?= e($plan['id']) ?>"
           class="btn <?= $plan['featured'] ? 'btn-gradient' : 'btn-secondary' ?> w-full text-center"
           data-magnetic>
          Get <?= e($plan['name']) ?> Plan
        </a>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-center text-xs mt-6" style="color:var(--text-tertiary)" data-anim="fade-up">
      All prices in CAD. Applicable GST/HST added at checkout. Cancel anytime.
      <a href="/cancellation-policy" class="underline hover:text-slate-900">Cancellation Policy</a>.
    </p>
  </div>
</section>

<!-- ================================================================
     TESTIMONIALS
     Blurred tech photography behind glassmorphic cards + carousel
     ================================================================ -->
<section id="testimonials" class="relative section-padding overflow-hidden"
         style="background:var(--bg-primary)"
         aria-label="Client testimonials">

  <!-- Background: blurred tech photography -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <!-- TODO: Replace with final testimonials section background image -->
    <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=1920&q=60"
         alt="" loading="lazy" width="1920" height="900"
         style="opacity:0.08;width:100%;height:100%;object-fit:cover;filter:blur(3px)">
    <!-- TODO: Replace with final image -->
  </div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.85);z-index:1" aria-hidden="true"></div>

  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Client Stories</p>
      <h2>Don't Take Our <span class="text-gradient">Word for It</span></h2>
      <p>247+ five-star reviews from real Canadian clients.</p>
    </div>

    <!-- Testimonials carousel -->
    <div class="testimonials-carousel relative" style="min-height:280px">
      <div class="carousel-track" style="position:relative;min-height:260px">
        <?php foreach ($TESTIMONIALS as $i => $t): ?>
        <div class="testimonial-card <?= $i === 0 ? '' : 'absolute inset-0' ?>"
             style="<?= $i > 0 ? 'opacity:0;pointer-events:none' : '' ?>">
          <div class="flex items-center gap-3 mb-4">
            <!-- Avatar -->
            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 font-semibold text-sm"
                 style="background:<?= e($t['color']) ?>20;border:2px solid <?= e($t['color']) ?>40;color:<?= e($t['color']) ?>">
              <?= e($t['avatar']) ?>
            </div>
            <div>
              <div class="font-semibold"><?= e($t['name']) ?></div>
              <div class="text-xs" style="color:var(--text-tertiary)"><?= e($t['role']) ?> — <?= e($t['city']) ?></div>
            </div>
            <div class="ml-auto text-right">
              <div class="star-rating" aria-label="<?= $t['rating'] ?> out of 5 stars">
                <?= str_repeat('★', $t['rating']) ?><?= str_repeat('☆', 5 - $t['rating']) ?>
              </div>
              <div class="text-xs mt-0.5" style="color:var(--text-tertiary)"><?= e($t['service']) ?></div>
            </div>
          </div>
          <p class="text-base leading-relaxed" style="color:var(--text-secondary)">
            "<?= e($t['review']) ?>"
          </p>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Navigation -->
      <div class="flex items-center justify-center gap-3 mt-8">
        <button data-carousel-prev
                class="w-10 h-10 glass rounded-full flex items-center justify-center hover:border-[var(--accent)] transition-colors"
                aria-label="Previous testimonial">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
        </button>

        <?php foreach ($TESTIMONIALS as $i => $_): ?>
        <button class="carousel-dot w-2 h-2 rounded-full transition-all duration-300 <?= $i === 0 ? 'active' : '' ?>"
                style="background:<?= $i === 0 ? 'var(--accent)' : 'rgba(15,23,42,0.2)' ?>;width:<?= $i === 0 ? '24px' : '8px' ?>"
                aria-label="Go to testimonial <?= $i + 1 ?>">
        </button>
        <?php endforeach; ?>

        <button data-carousel-next
                class="w-10 h-10 glass rounded-full flex items-center justify-center hover:border-[var(--accent)] transition-colors"
                aria-label="Next testimonial">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     FAQ TEASER
     Dark tech texture background + subtle grid overlay
     ================================================================ -->
<section id="faq-teaser" class="relative section-padding bg-dots grain"
         style="background-color:var(--bg-secondary)"
         aria-label="Frequently asked questions">

  <div class="container-narrow relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Got Questions?</p>
      <h2>Frequently <span class="text-gradient">Asked Questions</span></h2>
    </div>

    <!-- FAQ accordion (first 5 from General category) -->
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
     Looping ambient video bg + glow orbs + glass panel + magnetic buttons
     ================================================================ -->
<section id="cta" class="relative section-padding overflow-hidden" aria-label="Book your repair">

  <!-- Layer 1: Ambient video background -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <video class="bg-video" autoplay muted loop playsinline
           poster="/assets/img/backgrounds/cta-poster.jpg"
           style="opacity:0.3">
      <!-- TODO: Add video sources -->
      <!-- <source src="/assets/video/cta-bg.webm" type="video/webm"> -->
      <!-- <source src="/assets/video/cta-bg.mp4"  type="video/mp4"> -->
    </video>
    <!-- Fallback poster -->
    <!-- TODO: Replace with final CTA section background image -->
    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=1920&q=60"
         alt="" loading="lazy" width="1920" height="800"
         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.15">
    <!-- TODO: Replace with final image -->
  </div>
  <div class="bg-overlay-full" aria-hidden="true" style="background:rgba(250,251,252,0.8)"></div>

  <!-- Glow orbs -->
  <div class="glow-orb glow-orb-cyan"
       style="width:600px;height:600px;top:-200px;left:50%;transform:translateX(-50%);opacity:0.3"
       aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo"
       style="width:400px;height:400px;bottom:-100px;right:10%;opacity:0.25;animation-delay:3s"
       aria-hidden="true"></div>

  <!-- Glass panel with CTA content -->
  <div class="container-narrow relative z-10 text-center">
    <div class="glass-strong rounded-3xl p-12 md:p-20">

      <p class="text-eyebrow mb-4" data-anim="fade-up">Ready to Get Started?</p>
      <h2 class="text-display mb-6" data-split="words">
        Your tech problems,<br><span class="text-gradient">solved today.</span>
      </h2>
      <p class="text-lg mb-10 max-w-xl mx-auto" style="color:var(--text-secondary)" data-anim="fade-up">
        Book online in 2 minutes. Free diagnosis. Guaranteed results.
        No fix, no fee on data recovery.
      </p>

      <div class="flex flex-wrap gap-4 justify-center" data-anim="fade-up">
        <a href="/book"    class="btn btn-gradient text-lg px-8 py-4" data-magnetic>Book a Repair Now</a>
        <a href="/contact" class="btn btn-secondary text-lg px-8 py-4" data-magnetic>Ask a Question</a>
      </div>

      <!-- Quick trust signals -->
      <div class="flex flex-wrap justify-center gap-6 mt-10 text-sm"
           style="color:var(--text-tertiary)" data-anim="fade-up">
        <span>✓ No fix, no fee</span>
        <span>✓ Same-day service available</span>
        <span>✓ 30-day guarantee</span>
        <span>✓ PIPEDA compliant</span>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
