<?php
declare(strict_types=1);
/**
 * Nexisco Network — About (digital agency)
 * Hero | Business Model & Payments | Mission | What We Do |
 * Stats band | Why Nexisco | Company Details | Team | CTA
 */

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';

$page_title       = 'About Nexisco Network — Building Digital Experiences That Drive Growth';
$page_description = 'Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce development for clients in the US, Canada, and worldwide — billed in USD or CAD.';
$page_canonical   = 'https://nexisconetwork.ca/about';
$extra_head       = Seo::organization();

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ================================================================
     HERO
     ================================================================ -->
<section class="relative min-h-[58vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=70"
         alt="" loading="eager"
         style="opacity:0.55;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.55) 0%,rgba(250,251,252,0.96) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"  style="width:500px;height:500px;top:-5%;right:5%;opacity:0.15" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:5%;left:5%;opacity:0.12;animation-delay:2.5s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">About Us</div>
    <h1 class="text-display mb-5 max-w-3xl" data-split="words">
      Building digital experiences<br>that drive growth.
    </h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Nexisco Network is a global digital agency. We design, market, and scale brands through
      three things done exceptionally well — web development, digital marketing, and ecommerce development.
    </p>
  </div>
</section>

<!-- ================================================================
     OUR BUSINESS MODEL & PAYMENT STRUCTURE
     ================================================================ -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <!-- Text -->
      <div>
        <div class="label-tag mb-4" data-anim="fade-up">How We Work</div>
        <h2 class="text-h1 mb-5" data-split="words">Our business model &amp; payments.</h2>
        <div class="space-y-4 text-base leading-relaxed" style="color:var(--text-secondary)">
          <p data-anim="fade-up">
            We deliver professional digital services across our three pillars — web development,
            digital marketing, and ecommerce development. Engage us for a one-time project, or
            partner with us on a recurring monthly plan when you need ongoing growth.
          </p>
          <p data-anim="fade-up">
            Payment is collected upfront, or through an agreed milestone schedule for larger
            engagements — clear scope, clear cost, no surprises. Every quote is fixed and explained
            before work begins.
          </p>
          <p data-anim="fade-up">
            We serve clients in the United States, Canada, and worldwide, working remotely across
            time zones. Invoices are billed in <strong style="color:var(--text-primary)">USD or CAD</strong>,
            and all transactions are processed securely with encryption.
          </p>
        </div>
        <div class="flex flex-wrap gap-4 mt-8" data-anim="fade-up">
          <a href="/start-project" class="btn btn-gradient" data-magnetic>Get a Free Quote</a>
          <a href="/pricing"  class="btn btn-secondary" data-magnetic>See Pricing</a>
        </div>
      </div>

      <!-- Payment facts card -->
      <div class="glass-strong rounded-3xl p-8 md:p-10" data-anim="fade-up">
        <h3 class="text-lg font-semibold mb-6">At a glance</h3>
        <ul class="space-y-5">
          <?php
          $model = [
            ['icon' => '🗂️', 'title' => 'Project or monthly',  'desc' => 'One-time projects or recurring monthly plans — whichever fits your goals.'],
            ['icon' => '📅', 'title' => 'Upfront or milestones','desc' => 'Pay upfront, or across an agreed milestone schedule for larger builds.'],
            ['icon' => '🌍', 'title' => 'Global delivery',      'desc' => 'Clients in the US, Canada & worldwide, served remotely across time zones.'],
            ['icon' => '💳', 'title' => 'USD &amp; CAD',        'desc' => 'Major credit &amp; debit cards, PayPal, and bank/wire transfer — billed in your currency.'],
            ['icon' => '🔒', 'title' => 'Secure by default',    'desc' => 'All transactions are processed securely with encryption.'],
          ];
          foreach ($model as $m): ?>
          <li class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 text-lg"
                 style="background:rgba(8,145,178,0.08);border:1px solid rgba(8,145,178,0.15)">
              <?= $m['icon'] ?>
            </div>
            <div>
              <div class="font-semibold mb-0.5"><?= $m['title'] ?></div>
              <div class="text-sm" style="color:var(--text-secondary)"><?= $m['desc'] ?></div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     OUR MISSION
     ================================================================ -->
<section class="relative section-padding overflow-hidden grain" style="background:var(--bg-secondary)" aria-label="Our mission">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:10%;right:-5%;opacity:0.10" aria-hidden="true"></div>
  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Our Mission</p>
      <h2>Helping brands <span class="text-gradient">grow online</span></h2>
      <p>We exist to turn ambitious ideas into digital products and campaigns that perform — built with craft, measured by results.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger data-stagger-delay="0.08">
      <?php
      $mission = [
        ['icon' => '🎯', 'title' => 'Results-Driven Strategy', 'desc' => 'Every decision ties back to a measurable business outcome — not vanity metrics.'],
        ['icon' => '💡', 'title' => 'Innovation & Creativity', 'desc' => 'Original design and fresh thinking that help your brand stand apart.'],
        ['icon' => '🤝', 'title' => 'Client-Centered Approach','desc' => 'Clear communication, honest advice, and a partner invested in your success.'],
        ['icon' => '🚀', 'title' => 'Scalable Growth',         'desc' => 'Solutions built to grow with you — from first launch to ongoing momentum.'],
      ];
      foreach ($mission as $v): ?>
      <div class="glass rounded-2xl p-8 text-center">
        <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center text-2xl"
             style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle)">
          <?= $v['icon'] ?>
        </div>
        <h3 class="text-lg font-semibold mb-3"><?= e($v['title']) ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($v['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     WHAT WE DO — three pillars
     ================================================================ -->
<section class="relative section-padding overflow-hidden" style="background:var(--bg-primary)" aria-label="What we do">
  <div class="glow-orb glow-orb-indigo" style="width:500px;height:500px;bottom:0;right:-5%;opacity:0.10" aria-hidden="true"></div>
  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">What We Do</p>
      <h2>Three pillars. <span class="text-gradient-warm">One partner.</span></h2>
      <p>From the first pixel to the final sale, we cover the full digital journey — with SEO and brand design woven through everything we build.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="0.08">
      <?php
      $pillars = [
        [
          'slug'  => 'web-development',
          'icon'  => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
          'name'  => 'Web Development',
          'desc'  => 'Fast, mobile-first websites and landing pages that load quickly, rank well, and turn visitors into customers.',
          'subs'  => ['Custom website design', 'Landing pages', 'CMS & headless builds', 'UI/UX & branding'],
        ],
        [
          'slug'  => 'digital-marketing',
          'icon'  => '<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>',
          'name'  => 'Digital Marketing',
          'desc'  => 'Data-driven campaigns that grow your pipeline — every channel tracked, reported, and tuned for return on investment.',
          'subs'  => ['SEO', 'Google Ads & paid social', 'Email & content', 'Conversion optimization'],
        ],
        [
          'slug'  => 'ecommerce-development',
          'icon'  => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>',
          'name'  => 'Ecommerce Development',
          'desc'  => 'Online stores designed to sell — built on the right platform and optimized for a smooth path to checkout.',
          'subs'  => ['Shopify & WooCommerce', 'Product & cart UX', 'Payments setup', 'Conversion-focused design'],
        ],
      ];
      foreach ($pillars as $p): ?>
      <a href="/services/<?= e($p['slug']) ?>"
         class="glass rounded-2xl p-8 group block transition-all duration-300 hover:-translate-y-1"
         data-tilt data-tilt-max="4"
         aria-label="<?= e($p['name']) ?>">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 transition-transform duration-300 group-hover:scale-110"
             style="background:rgba(8,145,178,0.10);border:1px solid rgba(8,145,178,0.25)">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0891B2"
               stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <?= $p['icon'] ?>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2"><?= e($p['name']) ?></h3>
        <p class="text-sm leading-relaxed mb-5" style="color:var(--text-secondary)"><?= e($p['desc']) ?></p>
        <ul class="space-y-1.5 mb-5">
          <?php foreach ($p['subs'] as $sub): ?>
          <li class="flex items-center gap-2 text-sm" style="color:var(--text-secondary)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                 stroke-width="3" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <?= e($sub) ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <span class="text-sm font-medium inline-flex items-center gap-1" style="color:var(--accent)">
          Explore <?= e($p['name']) ?> →
        </span>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-10" data-anim="fade-up">
      <a href="/services" class="btn btn-secondary" data-magnetic>View All Services</a>
    </div>
  </div>
</section>

<!-- ================================================================
     VALUE BAND  (factual value-stats — see config/site-stats.php for real figures)
     ================================================================ -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle)" aria-label="How we work">
  <div class="glow-orb glow-orb-cyan" style="width:350px;height:350px;top:-80px;left:-60px;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8 max-w-3xl mx-auto" data-stagger data-stagger-delay="0.1">
      <?php
      $value_stats = [
        ['big' => 'Global Delivery',   'sub' => 'Clients in the US, Canada &amp; worldwide, served remotely'],
        ['big' => 'Full-Service Team', 'sub' => 'Web, marketing &amp; ecommerce specialists under one roof'],
      ];
      foreach ($value_stats as $s): ?>
      <div class="glass rounded-2xl p-10 text-center flex flex-col justify-center min-h-[150px]">
        <div class="text-2xl md:text-3xl font-bold leading-tight text-gradient"><?= $s['big'] ?></div>
        <div class="text-sm mt-3" style="color:var(--text-secondary)"><?= $s['sub'] ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     WHY CHOOSE NEXISCO
     ================================================================ -->
<section class="relative section-padding overflow-hidden grain" style="background:var(--bg-primary)" aria-label="Why choose Nexisco Network">
  <div class="glow-orb glow-orb-cyan" style="width:500px;height:500px;top:-8%;left:-6%;opacity:0.12" aria-hidden="true"></div>
  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Why Nexisco</p>
      <h2>The growth team your brand <span class="text-gradient-electric">actually needs.</span></h2>
      <p>A senior-level partner that thinks strategically, builds creatively, and reports honestly.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger data-stagger-delay="0.07">
      <?php
      $reasons = [
        ['icon' => '🏅', 'title' => 'Proven Expertise',          'desc' => 'Experienced designers, developers, and marketers across all three pillars — no juniors learning on your dime.'],
        ['icon' => '🧠', 'title' => 'Strategic & Creative Thinking','desc' => 'We pair sharp strategy with original design, so your brand is both effective and memorable.'],
        ['icon' => '🤝', 'title' => 'Client-Centered Approach',   'desc' => 'A dedicated point of contact, clear communication, and your goals at the center of every decision.'],
        ['icon' => '📈', 'title' => 'Results That Matter',        'desc' => 'We measure what counts and report it in plain English — built to drive real business outcomes.'],
        ['icon' => '🚀', 'title' => 'Scalable Solutions',         'desc' => 'Whether a one-time project or ongoing monthly plan, our work is built to grow with you.'],
        ['icon' => '🌍', 'title' => 'Global Delivery',            'desc' => 'Remote-friendly delivery for clients in the US, Canada, and worldwide — across time zones, billed in USD or CAD.'],
      ];
      foreach ($reasons as $r): ?>
      <div class="glass rounded-2xl p-8">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-xl"
             style="background:rgba(8,145,178,0.08);border:1px solid rgba(8,145,178,0.15)">
          <?= $r['icon'] ?>
        </div>
        <h3 class="text-lg font-semibold mb-2"><?= e($r['title']) ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($r['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     COMPANY DETAILS
     ================================================================ -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-secondary)" aria-label="Company details">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <!-- Text -->
      <div>
        <div class="label-tag mb-4" data-anim="fade-up">Company Details</div>
        <h2 class="text-h1 mb-5" data-split="words">A global agency,<br>rooted in Canada.</h2>
        <div class="space-y-4 text-base leading-relaxed" style="color:var(--text-secondary)">
          <p data-anim="fade-up">
            Nexisco Network was established in 2026 and is headquartered in Edmonton, Alberta, Canada.
            From day one, we built for the web — partnering with clients far beyond our home city.
          </p>
          <p data-anim="fade-up">
            Today we serve businesses in the United States, Canada, and around the world, delivering remotely
            across time zones. Wherever you are, you get the same senior-level craft and clear communication.
          </p>
        </div>
        <div class="flex flex-wrap gap-4 mt-8" data-anim="fade-up">
          <a href="/contact" class="btn btn-gradient" data-magnetic>Get in Touch</a>
          <a href="/portfolio"  class="btn btn-secondary" data-magnetic>View Our Work</a>
        </div>
      </div>

      <!-- Details card -->
      <div class="glass-strong rounded-3xl p-8 md:p-10" data-anim="fade-up">
        <dl class="space-y-5">
          <?php
          $details = [
            ['k' => 'Legal entity', 'v' => 'Nexisco Network'],
            ['k' => 'Established',   'v' => '2026'],
            ['k' => 'Headquarters',  'v' => '1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada'],
            ['k' => 'Reach',         'v' => 'US, Canada &amp; worldwide — remote-friendly, across time zones'],
            ['k' => 'Billing',       'v' => 'USD &amp; CAD'],
            ['k' => 'Governing law', 'v' => 'Province of Alberta, Canada'],
          ];
          foreach ($details as $d): ?>
          <div class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-4 pb-4"
               style="border-bottom:1px solid var(--border-subtle)">
            <dt class="text-xs uppercase tracking-widest flex-shrink-0 sm:w-36" style="color:var(--text-tertiary)"><?= $d['k'] ?></dt>
            <dd class="text-sm font-medium" style="color:var(--text-primary)"><?= $d['v'] ?></dd>
          </div>
          <?php endforeach; ?>
        </dl>
        <div class="mt-6 space-y-2 text-sm" style="color:var(--text-secondary)">
          <p>
            <span style="color:var(--text-tertiary)">Phone:</span>
            <a href="tel:+18889099466" class="font-medium hover:underline" style="color:var(--accent)">+1 (888) 909-9466</a>
          </p>
          <p>
            <span style="color:var(--text-tertiary)">Email:</span>
            <a href="mailto:support@nexisconetwork.ca" class="font-medium hover:underline" style="color:var(--accent)">support@nexisconetwork.ca</a>
          </p>
          <p><span style="color:var(--text-tertiary)">Hours:</span> Mon–Fri 8am–7pm PT · Sat 9am–5pm PT</p>
          <p class="text-xs pt-1" style="color:var(--text-tertiary)">PIPEDA &amp; CASL compliant.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     OUR TEAM / EXPERTISE
     ================================================================ -->
<section class="relative section-padding overflow-hidden grain" style="background:var(--bg-primary)" aria-label="Our expertise">
  <div class="glow-orb glow-orb-indigo" style="width:400px;height:400px;top:5%;right:-5%;opacity:0.10" aria-hidden="true"></div>
  <div class="container-wide relative z-10">
    <div class="section-heading" data-anim="fade-up">
      <p class="eyebrow">Our Team</p>
      <h2>A full-service team <span class="text-gradient">on your side</span></h2>
      <p>Specialists across design, development, and marketing — collaborating as one team on your project.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger data-stagger-delay="0.08">
      <?php
      $disciplines = [
        ['icon' => '🎨', 'title' => 'Design &amp; UI/UX',    'desc' => 'Brand-aligned interfaces and experiences designed to convert.'],
        ['icon' => '💻', 'title' => 'Web Development',       'desc' => 'Fast, accessible, SEO-ready builds on modern stacks.'],
        ['icon' => '📈', 'title' => 'Digital Marketing',     'desc' => 'SEO, paid ads, social, and email that grow your pipeline.'],
        ['icon' => '🛒', 'title' => 'Ecommerce',             'desc' => 'Shopify &amp; WooCommerce stores built to sell.'],
      ];
      foreach ($disciplines as $d): ?>
      <div class="glass rounded-2xl p-8 text-center">
        <div class="w-14 h-14 rounded-2xl mx-auto mb-4 flex items-center justify-center text-2xl"
             style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle)">
          <?= $d['icon'] ?>
        </div>
        <h3 class="font-semibold mb-1"><?= $d['title'] ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($d['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================================
     CTA
     ================================================================ -->
<section class="relative py-20 overflow-hidden grain" aria-label="Get a free quote">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.75)" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-cyan" style="width:500px;height:500px;top:-150px;left:50%;transform:translateX(-50%);opacity:0.22" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Ready to grow with us?</h2>
    <p class="text-lg mb-8 max-w-xl mx-auto" style="color:var(--text-secondary)">
      Tell us your goals and we'll map the fastest path to growth — in web, marketing, ecommerce, or all three.
      Free quote, no obligation, billed in USD or CAD.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/start-project" class="btn btn-gradient btn-lg" data-magnetic>Get a Free Quote</a>
      <a href="/contact" class="btn btn-secondary btn-lg" data-magnetic>Contact Us</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
