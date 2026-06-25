<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../data/pricing.php';

$page_title       = 'Pricing — Web, Marketing & Ecommerce Plans (USD & CAD) | Nexisco Network';
$page_description = 'Transparent monthly plans for web development, digital marketing, and ecommerce — billed in USD or CAD. Find the right plan for your growth stage, or request a custom quote.';
$page_canonical   = 'https://nexisconetwork.ca/pricing';

// Reactive price map for Alpine (keyed by plan id → currency → amount)
$price_map = [];
foreach ($PRICING_PLANS as $p) {
    $price_map[$p['id']] = $p['price'];
}
$price_json = json_encode($price_map, JSON_UNESCAPED_SLASHES);

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[50vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.5;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.5) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"   style="width:500px;height:500px;top:-5%;right:5%;opacity:0.15" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:0;left:5%;opacity:0.12;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Pricing</div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words">Find the right plan<br>for your business.</h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Choose a plan that fits your growth stage — billed in USD or CAD. Need something bespoke?
      Request a custom project quote.
    </p>
  </div>
</section>

<!-- ── Pricing Tiers ─────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)"
         x-data="{ cur: 'usd', prices: <?= htmlspecialchars($price_json, ENT_QUOTES, 'UTF-8') ?> }">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>

  <div class="relative z-10 container-wide">

    <!-- Currency toggle -->
    <div class="flex items-center justify-center mb-12" data-anim="fade-up">
      <div class="glass rounded-full p-1 flex gap-1" role="group" aria-label="Select currency">
        <button @click="cur = 'usd'"
                :class="cur === 'usd' ? 'text-white' : 'text-[var(--text-secondary)] hover:text-slate-900'"
                :style="cur === 'usd' ? 'background:var(--accent-gradient)' : ''"
                class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-200"
                :aria-pressed="(cur === 'usd').toString()">USD $</button>
        <button @click="cur = 'cad'"
                :class="cur === 'cad' ? 'text-white' : 'text-[var(--text-secondary)] hover:text-slate-900'"
                :style="cur === 'cad' ? 'background:var(--accent-gradient)' : ''"
                class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-200"
                :aria-pressed="(cur === 'cad').toString()">CAD $</button>
      </div>
    </div>

    <!-- Plan grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5 items-stretch" data-stagger>
      <?php foreach ($PRICING_PLANS as $plan): ?>
      <div class="relative rounded-3xl overflow-hidden flex flex-col transition-transform duration-300 hover:-translate-y-1 <?= $plan['featured'] ? 'membership-card featured ring-1 ring-[var(--accent)]' : '' ?>"
           style="background:var(--bg-secondary);border:1px solid var(--border-subtle)">

        <?php if ($plan['featured']): ?>
        <div class="absolute top-0 left-0 right-0 h-px" style="background:var(--accent-gradient)" aria-hidden="true"></div>
        <div class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold"
             style="background:var(--accent-gradient);color:#FFFFFF"><?= e($plan['badge'] ?? 'Most Popular') ?></div>
        <?php endif; ?>

        <div class="p-6 flex flex-col flex-1">
          <div class="text-sm font-semibold uppercase tracking-wider mb-1" style="color:var(--text-tertiary)">
            <?= e($plan['name']) ?>
          </div>
          <div class="mb-2">
            <span class="text-4xl font-bold font-mono" style="color:var(--accent)"
                  x-text="'$' + prices.<?= e($plan['id']) ?>[cur]">$<?= e((string)$plan['price']['usd']) ?></span>
            <span class="text-sm ml-1" style="color:var(--text-tertiary)">/mo <span x-text="cur.toUpperCase()">USD</span></span>
          </div>
          <p class="text-sm mb-6" style="color:var(--text-secondary)"><?= e($plan['tagline']) ?></p>

          <ul class="space-y-2.5 mb-8">
            <?php foreach ($plan['features'] as $feat): ?>
            <li class="flex items-start gap-2.5 text-sm">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                   stroke-width="2.5" stroke-linecap="round" class="mt-0.5 flex-shrink-0" aria-hidden="true">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span style="color:var(--text-secondary)"><?= e($feat) ?></span>
            </li>
            <?php endforeach; ?>
          </ul>

          <a href="/start-project?plan=<?= e($plan['id']) ?>"
             class="btn <?= $plan['featured'] ? 'btn-gradient' : 'btn-secondary' ?> w-full text-center mt-auto"
             data-magnetic>
            Get Started
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-center text-sm mt-10" style="color:var(--text-secondary)" data-anim="fade-up">
      All plans available in <strong>USD or CAD</strong>. Custom project quotes available on request.
      Applicable taxes added where required.
    </p>
  </div>
</section>

<!-- ── Pricing FAQ ───────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle)">
  <div class="relative z-10 container-narrow">
    <div class="text-center mb-12">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Pricing FAQ</div>
      <h2 class="text-h1" data-split="words">Questions about plans</h2>
    </div>

    <div class="space-y-3" data-stagger>
      <?php
      $pricing_faqs = [
        ['q' => 'What\'s included in the Starter plan?',
         'a' => 'The Starter plan includes a responsive 5-page website with custom UI/UX design, basic SEO setup, contact-form integration, and full mobile optimization — everything a new business needs to launch a professional presence.'],
        ['q' => 'Can I upgrade my plan later?',
         'a' => 'Yes. You can move up to a higher plan at any time as your business grows, and we\'ll carry your work forward. Upgrades take effect from your next billing cycle.'],
        ['q' => 'Do you offer custom pricing for large projects?',
         'a' => 'Absolutely. For enterprise platforms, multi-site builds, or full marketing programs, we provide tailored quotes. Tell us your goals on the Start a Project page and we\'ll scope it for you.'],
        ['q' => 'Are there any hidden fees?',
         'a' => 'No. Your plan or proposal lists exactly what\'s included and what it costs. Any optional add-ons or third-party costs (ad spend, premium apps, stock assets) are agreed in advance.'],
        ['q' => 'Which currencies do you accept?',
         'a' => 'We accept payments in both USD and CAD — use the toggle above to view prices in your currency. Invoices are issued in your selected currency, with applicable taxes added where required.'],
      ];
      foreach ($pricing_faqs as $faq): ?>
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

    <p class="text-xs text-center mt-8" style="color:var(--text-tertiary)">
      All plans available in USD or CAD. Custom project quotes available on request. Applicable taxes added where required.
    </p>
  </div>
</section>

<!-- ── CTA ────────────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.75)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Not sure which plan?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Tell us your goals and we'll recommend the right fit — and a custom quote if you need one.
    </p>
    <a href="/start-project" class="btn btn-gradient btn-lg" data-magnetic>Get a Free Quote</a>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
