<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../data/faqs.php';

// Flatten all Q&As for schema
$all_faqs = [];
foreach ($FAQS as $cat) {
    foreach ($cat['items'] as $item) {
        $all_faqs[] = $item;
    }
}

$page_title       = 'FAQ | Nexisco Network — Frequently Asked Questions';
$page_description = 'Answers to common questions about Nexisco Network\'s IT services, pricing, turnaround times, privacy, and membership plans.';
$page_canonical   = 'https://nexisconetwork.ca/faq';
$extra_head       = Seo::faq_page($all_faqs);

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[50vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.15;width:100%;height:100%;object-fit:cover" data-parallax="-15">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.6) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"  style="width:450px;height:450px;top:-5%;right:8%;opacity:0.14" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">FAQ</div>
    <h1 class="text-display mb-4 max-w-2xl" data-split="words">Got questions?<br>We've got answers.</h1>
    <p class="text-xl max-w-xl" style="color:var(--text-secondary)" data-anim="fade-up">
      <?= count($all_faqs) ?> answers across <?= count($FAQS) ?> categories.
      Can't find what you need? <a href="/contact" class="underline hover:text-[var(--accent)] transition-colors">Contact us</a>.
    </p>
  </div>
</section>

<!-- ── FAQ Accordion ──────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)"
         x-data="{ activeCategory: '<?= e($FAQS[0]['category'] ?? '') ?>' }">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>

  <div class="relative z-10 container-wide">
    <div class="flex flex-col lg:flex-row gap-10">

      <!-- Category sidebar -->
      <aside class="lg:w-64 flex-shrink-0">
        <div class="glass rounded-2xl p-4 sticky top-28">
          <div class="text-xs font-semibold uppercase tracking-wider mb-3 px-2" style="color:var(--text-tertiary)">Categories</div>
          <nav aria-label="FAQ categories">
            <ul class="space-y-1">
              <?php foreach ($FAQS as $cat): ?>
              <li>
                <button @click="activeCategory = '<?= e($cat['category']) ?>'"
                        class="w-full text-left px-3 py-2.5 rounded-xl text-sm transition-all duration-200"
                        :class="activeCategory === '<?= e($cat['category']) ?>' ? 'font-semibold' : 'hover:bg-[rgba(15,23,42,0.04)]'"
                        :style="activeCategory === '<?= e($cat['category']) ?>' ? 'background:rgba(8,145,178,0.10);color:var(--accent)' : 'color:var(--text-secondary)'">
                  <?= e($cat['category']) ?>
                  <span class="text-xs ml-1 opacity-60">(<?= count($cat['items']) ?>)</span>
                </button>
              </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        </div>
      </aside>

      <!-- FAQ items -->
      <div class="flex-1 min-w-0">
        <?php foreach ($FAQS as $cat): ?>
        <div x-show="activeCategory === '<?= e($cat['category']) ?>'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0">

          <h2 class="text-h2 mb-6"><?= e($cat['category']) ?></h2>

          <div class="space-y-3">
            <?php foreach ($cat['items'] as $i => $faq): ?>
            <div x-data="{ open: <?= $i === 0 ? 'true' : 'false' ?> }"
                 class="glass rounded-2xl overflow-hidden transition-colors duration-200"
                 :class="open ? 'border-[rgba(8,145,178,0.2)]' : ''">

              <button @click="open = !open"
                      class="w-full flex items-start justify-between gap-4 px-6 py-5 text-left"
                      :aria-expanded="open.toString()">
                <span class="font-medium text-base leading-snug"><?= e($faq['q']) ?></span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" aria-hidden="true"
                     class="flex-shrink-0 mt-0.5 transition-transform duration-300"
                     :class="{ 'rotate-180': open }">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </button>

              <div x-show="open" x-collapse>
                <div class="px-6 pb-5">
                  <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($faq['a']) ?></p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ── Still have questions? ─────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.75)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Still need help?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Our team responds within 2 hours on business days.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/contact" class="btn btn-gradient btn-lg" data-magnetic>Contact Us</a>
      <a href="/book"    class="btn btn-secondary btn-lg" data-magnetic>Book a Repair</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
