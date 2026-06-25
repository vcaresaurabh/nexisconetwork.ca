<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../data/portfolio.php';

$page_title       = 'Portfolio — Web, Marketing, Ecommerce & Branding | Nexisco Network';
$page_description = 'A selection of projects we craft for brands, startups, and growing businesses worldwide — across web design, digital marketing, ecommerce, and branding.';
$page_canonical   = 'https://nexisconetwork.ca/portfolio';
$extra_head       = Seo::breadcrumbs([
                      ['name' => 'Home',      'url' => 'https://nexisconetwork.ca/'],
                      ['name' => 'Portfolio'],
                    ]);

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[50vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.5;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.55) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan" style="width:500px;height:500px;top:-5%;right:8%;opacity:0.15" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Our Work</div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words">Our Portfolio</h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      A selection of projects we've crafted for brands, startups, and growing businesses worldwide.
    </p>
  </div>
</section>

<!-- ── Filterable Grid ───────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-primary)"
         x-data="{ filter: 'all' }">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>

  <div class="relative z-10 container-wide">

    <!-- Filter tabs -->
    <div class="flex flex-wrap justify-center gap-2 mb-12" role="tablist" aria-label="Filter portfolio">
      <?php foreach ($PORTFOLIO_CATEGORIES as $key => $label): ?>
      <button @click="filter = '<?= e($key) ?>'"
              :class="filter === '<?= e($key) ?>' ? 'text-white' : 'text-[var(--text-secondary)] hover:text-slate-900'"
              :style="filter === '<?= e($key) ?>' ? 'background:var(--accent-gradient);border-color:transparent' : 'background:var(--bg-secondary)'"
              class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200"
              style="border:1px solid var(--border-subtle)"
              role="tab" :aria-selected="(filter === '<?= e($key) ?>').toString()">
        <?= e($label) ?>
      </button>
      <?php endforeach; ?>
    </div>

    <!-- NOTE (owner): these are illustrative showcase items. Replace each with a real client
         case study — swap the title, descriptor, image, and add a results summary — before running paid traffic. -->
    <p class="text-center text-xs mb-10" style="color:var(--text-tertiary)">
      A selection of the kinds of projects we deliver. Real client case studies are on the way.
    </p>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($PORTFOLIO as $p): ?>
      <article x-show="filter === 'all' || filter === '<?= e($p['cat']) ?>'"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0 translate-y-3"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="group relative overflow-hidden rounded-2xl"
               style="background:var(--bg-secondary);border:1px solid var(--border-subtle)">

        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?= e($p['image']) ?>"
               onerror="this.src='https://images.unsplash.com/photo-1559028012-481c04fa702d?w=900&q=60'"
               alt="<?= e($p['title']) ?> — <?= e($p['tag']) ?>"
               loading="lazy" width="900" height="675"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
               data-ken-burns>
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(15,23,42,0.6) 0%,transparent 55%)"></div>
          <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold"
               style="background:rgba(255,255,255,0.92);color:var(--accent)"><?= e($p['tag']) ?></div>
        </div>

        <div class="p-6">
          <h2 class="text-lg font-semibold mb-1"><?= e($p['title']) ?></h2>
          <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($p['desc']) ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CTA ────────────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.75)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Like what you see?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Let's create your next standout project — websites, campaigns, and stores that perform.
    </p>
    <a href="/start-project" class="btn btn-gradient btn-lg" data-magnetic>Start Your Project</a>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
