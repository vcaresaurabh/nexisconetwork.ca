<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../data/services.php';

$page_title       = 'IT Services | Nexisco Network — Canada';
$page_description = 'Professional IT services across Canada: virus removal, PC repair, data recovery, network setup, remote support, business IT, and more. Starting at $49 CAD.';
$page_canonical   = 'https://nexisconetwork.ca/services';

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[55vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.18;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.6) 0%,rgba(250,251,252,0.95) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"  style="width:600px;height:600px;top:-10%;right:5%;opacity:0.15" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:400px;height:400px;bottom:0;left:10%;opacity:0.12;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Our Services</div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words">
      Every IT problem,<br>expertly solved.
    </h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Nine specialist services. Same-day availability. Prices in CAD.
    </p>
  </div>
</section>

<!-- ── Services Grid ──────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-30" aria-hidden="true"></div>

  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-stagger>
      <?php foreach ($SERVICES as $svc): ?>
      <article class="group relative overflow-hidden rounded-2xl"
               style="background:var(--bg-secondary);border:1px solid var(--border-subtle)"
               data-tilt data-tilt-max="4" data-tilt-glare data-tilt-max-glare="0.06">

        <!-- Card image -->
        <div class="relative overflow-hidden aspect-video">
          <img src="<?= e($svc['card_image']) ?>"
               onerror="this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&q=60'"
               alt="<?= e($svc['name']) ?>"
               loading="lazy" width="800" height="450"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
               data-ken-burns>
          <div style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,rgba(250,251,252,0.9) 100%)"></div>
          <!-- Price badge -->
          <div class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold font-mono"
               style="background:rgba(8,145,178,0.15);border:1px solid rgba(8,145,178,0.3);color:var(--accent)">
            <?= e($svc['price_label']) ?>
          </div>
        </div>

        <!-- Card body -->
        <div class="p-6">
          <div class="flex items-start gap-4 mb-3">
            <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center"
                 style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle)">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                   stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <?= $svc['icon_path'] ?>
              </svg>
            </div>
            <div>
              <h2 class="text-lg font-semibold leading-snug"><?= e($svc['name']) ?></h2>
              <p class="text-sm mt-0.5" style="color:var(--accent)"><?= e($svc['tagline']) ?></p>
            </div>
          </div>
          <p class="text-sm leading-relaxed mb-5" style="color:var(--text-secondary)">
            <?= e(mb_substr($svc['description'], 0, 130)) ?>…
          </p>

          <div class="flex gap-3">
            <a href="/services/<?= e($svc['slug']) ?>" class="btn btn-secondary btn-sm flex-1 text-center">Learn More</a>
            <a href="/book?service=<?= e($svc['slug']) ?>" class="btn btn-gradient btn-sm flex-1 text-center" data-magnetic>Book Now</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CTA Band ──────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.75)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Not sure which service you need?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Book a free 15-minute consultation and we'll point you in the right direction.
    </p>
    <a href="/contact" class="btn btn-gradient btn-lg" data-magnetic>Get Free Advice</a>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
