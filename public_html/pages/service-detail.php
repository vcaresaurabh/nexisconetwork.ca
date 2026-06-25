<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../data/services.php';

// $service_slug is set by index.php router
$service = null;
foreach ($SERVICES as $s) {
    if ($s['slug'] === $service_slug) { $service = $s; break; }
}
if (!$service) { http_response_code(404); require __DIR__ . '/404.php'; exit; }

$page_title       = e($service['name']) . ' | Nexisco Network';
$page_description = e($service['description']);
$page_canonical   = 'https://nexisconetwork.ca/services/' . e($service['slug']);
$extra_head       = Seo::service($service)
                  . Seo::faq_page($service['faqs'])
                  . Seo::breadcrumbs([
                      ['name' => 'Home',     'url' => 'https://nexisconetwork.ca/'],
                      ['name' => 'Services', 'url' => 'https://nexisconetwork.ca/services'],
                      ['name' => $service['name']],
                    ]);

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ─────────────────────────────────────────────────────── -->
<section class="relative min-h-[85vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="<?= e($service['hero_image']) ?>"
         onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1920&q=60'"
         alt="" loading="eager" width="1920" height="1080"
         style="opacity:0.70;width:100%;height:100%;object-fit:cover" data-parallax="-30">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.4) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"  style="width:500px;height:500px;top:5%;right:10%;opacity:0.18" aria-hidden="true"></div>

  <!-- Breadcrumbs -->
  <div class="absolute top-24 left-0 right-0 z-10">
    <div class="container-wide">
      <nav aria-label="Breadcrumb">
        <ol class="flex items-center gap-2 text-sm" style="color:var(--text-tertiary)">
          <li><a href="/" class="hover:text-slate-900 transition-colors">Home</a></li>
          <li aria-hidden="true" class="opacity-40">/</li>
          <li><a href="/services" class="hover:text-slate-900 transition-colors">Services</a></li>
          <li aria-hidden="true" class="opacity-40">/</li>
          <li style="color:var(--accent)"><?= e($service['name']) ?></li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="relative z-10 container-wide pb-20 pt-52">
    <div class="flex items-center gap-4 mb-5" data-anim="fade-up">
      <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
           style="background:linear-gradient(135deg,rgba(8,145,178,0.2),rgba(79,70,229,0.2));border:1px solid var(--border-subtle)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <?= $service['icon_path'] ?>
        </svg>
      </div>
      <div class="label-tag"><?= e($service['price_label']) ?></div>
    </div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words"><?= e($service['name']) ?></h1>
    <p class="text-xl max-w-2xl mb-8" style="color:var(--text-secondary)" data-anim="fade-up">
      <?= e($service['description']) ?>
    </p>
    <div class="flex flex-wrap gap-4" data-anim="fade-up">
      <a href="/start-project?service=<?= e($service['slug']) ?>" class="btn btn-gradient btn-lg" data-magnetic>
        Get a Free Quote
      </a>
      <a href="/pricing" class="btn btn-secondary btn-lg" data-magnetic>View Pricing</a>
    </div>
  </div>
</section>

<!-- ── What's Included / Capabilities ─────────────────────────────── -->
<section class="relative section-padding overflow-hidden" style="background:var(--bg-secondary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="text-center mb-14">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">What's included</div>
      <h2 class="text-h1 mb-3" data-split="words">Everything you need to grow</h2>
      <p class="text-lg" style="color:var(--text-secondary)" data-anim="fade-up">
        Senior-level delivery, built around your goals — for clients in the US, Canada &amp; worldwide.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" data-stagger>
      <?php foreach ($service['capabilities'] as $cap): ?>
      <div class="glass rounded-2xl p-6 hover:border-[var(--accent)] transition-colors duration-300">
        <div class="flex items-start gap-3 mb-2">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
               stroke-width="2.5" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0 mt-0.5">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          <h3 class="text-base font-semibold leading-snug"><?= e($cap['name']) ?></h3>
        </div>
        <p class="text-sm leading-relaxed pl-7" style="color:var(--text-secondary)"><?= e($cap['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Process ────────────────────────────────────────────────────── -->
<section class="relative section-padding overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-indigo" style="width:500px;height:500px;top:10%;left:-10%;opacity:0.12" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="text-center mb-16">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Process</div>
      <h2 class="text-h1" data-split="words">How we deliver</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" data-stagger>
      <?php foreach ($service['process'] as $step): ?>
      <div class="relative text-center">
        <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center font-mono text-xl font-bold"
             style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle);color:var(--accent)">
          <?= e($step['step']) ?>
        </div>
        <h3 class="text-lg font-semibold mb-2"><?= e($step['title']) ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($step['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Deliverables + Tech ────────────────────────────────────────── -->
<section class="relative section-padding overflow-hidden" style="background:var(--bg-secondary)">
  <div class="relative z-10 container-wide">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start">

      <!-- Deliverables -->
      <div data-anim="fade-up">
        <div class="label-tag mb-3">Deliverables</div>
        <h2 class="text-h2 mb-6" data-split="words">What you'll receive</h2>
        <ul class="space-y-3">
          <?php foreach ($service['deliverables'] as $d): ?>
          <li class="flex items-start gap-3 glass rounded-xl p-4">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                 stroke-width="2.5" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0 mt-0.5">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span class="text-sm" style="color:var(--text-secondary)"><?= e($d) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Tech / Tools -->
      <div data-anim="fade-up">
        <div class="label-tag mb-3">Tech &amp; tools</div>
        <h2 class="text-h2 mb-6" data-split="words">What we work with</h2>
        <div class="flex flex-wrap gap-3">
          <?php foreach ($service['tech'] as $t): ?>
          <span class="px-4 py-2 rounded-full text-sm font-medium"
                style="background:rgba(8,145,178,0.08);border:1px solid rgba(8,145,178,0.22);color:var(--text-secondary)">
            <?= e($t) ?>
          </span>
          <?php endforeach; ?>
        </div>
        <div class="glass rounded-2xl p-6 mt-8">
          <p class="text-sm leading-relaxed" style="color:var(--text-secondary)">
            Not sure which approach fits your business? We'll recommend the right stack and scope in your
            free quote — no jargon, no pressure.
          </p>
          <a href="/start-project?service=<?= e($service['slug']) ?>"
             class="btn btn-primary btn-sm mt-4" data-magnetic>Start your project →</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────────────────────────── -->
<section class="relative section-padding overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="relative z-10 container-narrow">
    <div class="text-center mb-14">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">FAQ</div>
      <h2 class="text-h1" data-split="words">Common questions</h2>
    </div>

    <div class="space-y-3" data-stagger>
      <?php foreach ($service['faqs'] as $i => $faq): ?>
      <div x-data="{ open: false }" class="glass rounded-2xl overflow-hidden">
        <button @click="open = !open"
                class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left"
                :aria-expanded="open.toString()">
          <span class="font-medium text-base"><?= e($faq['q']) ?></span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" aria-hidden="true"
               class="flex-shrink-0 transition-transform duration-300" :class="{ 'rotate-180': open }">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </button>
        <div x-show="open" x-collapse class="px-6 pb-5">
          <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($faq['a']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CTA ────────────────────────────────────────────────────────── -->
<section class="relative section-padding overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-40" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.55)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Ready to grow?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Get a free quote for <?= e($service['name']) ?> — free consultation, global delivery, USD &amp; CAD.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/start-project?service=<?= e($service['slug']) ?>" class="btn btn-gradient btn-lg" data-magnetic>
        Get a Free Quote
      </a>
      <a href="/services" class="btn btn-secondary btn-lg" data-magnetic>All Services</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
