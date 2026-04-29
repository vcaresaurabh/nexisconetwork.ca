<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../data/memberships.php';

$page_title       = 'Membership Plans | Nexisco Network — Monthly IT Support';
$page_description = 'Choose a Nexisco Network membership plan for ongoing IT support, priority service, and exclusive savings. Plans from $29/month CAD.';
$page_canonical   = 'https://nexisconetwork.ca/membership';

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[55vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1559526324-593bc073d938?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.15;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.5) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"   style="width:500px;height:500px;top:-5%;right:5%;opacity:0.15" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:0;left:5%;opacity:0.12;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Membership Plans</div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words">Unlimited IT support<br>for one flat rate.</h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Priority service, exclusive discounts, and proactive monitoring — starting at $29/month CAD.
    </p>
  </div>
</section>

<!-- ── Pricing Cards ─────────────────────────────────────────────── -->
<?php
$_plans_js = json_encode(array_combine(
  array_column($MEMBERSHIP_PLANS, 'id'),
  array_map(fn($p) => $p['pricing'], $MEMBERSHIP_PLANS)
), JSON_UNESCAPED_SLASHES);
?>
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)"
         x-data="{ term: 'monthly', plans: <?= $_plans_js ?> }">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>

  <div class="relative z-10 container-wide">
    <!-- Billing toggle -->
    <div class="flex items-center justify-center gap-4 mb-14">
      <span class="text-sm" :class="term === 'monthly' ? '!text-slate-900 font-semibold' : ''" style="color:var(--text-secondary)">Monthly</span>
      <div class="relative w-14 h-7 rounded-full cursor-pointer transition-colors duration-300"
           style="background:var(--bg-tertiary);border:1px solid var(--border-subtle)"
           @click="term = (term === 'monthly') ? '1yr' : 'monthly'" role="switch" :aria-checked="term !== 'monthly'">
        <div class="absolute top-1 w-5 h-5 rounded-full transition-all duration-300"
             style="background:var(--accent-gradient)"
             :class="term !== 'monthly' ? 'left-8' : 'left-1'"></div>
      </div>
      <span class="text-sm flex items-center gap-2" :class="term !== 'monthly' ? '!text-slate-900 font-semibold' : ''" style="color:var(--text-secondary)">
        Annual
        <span class="px-2 py-0.5 rounded-full text-xs font-semibold"
              style="background:rgba(8,145,178,0.10);border:1px solid rgba(8,145,178,0.25);color:var(--accent)">
          Save up to 30%
        </span>
      </span>
    </div>

    <!-- Select term -->
    <div class="flex items-center justify-center gap-3 mb-10" x-show="term !== 'monthly'">
      <?php foreach (['6mo' => '6 Months', '1yr' => '1 Year', '2yr' => '2 Years', '3yr' => '3 Years'] as $k => $label): ?>
      <button @click="term = '<?= e($k) ?>'"
              class="px-4 py-1.5 rounded-full text-sm transition-all duration-200"
              :class="term === '<?= e($k) ?>' ? 'text-white font-semibold' : 'hover:border-[rgba(15,23,42,0.2)]'"
              :style="term === '<?= e($k) ?>' ? 'background:var(--accent-gradient)' : 'background:var(--bg-tertiary);border:1px solid var(--border-subtle);color:var(--text-secondary)'">
        <?= e($label) ?>
      </button>
      <?php endforeach; ?>
    </div>

    <!-- Plan cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start" data-stagger>
      <?php foreach ($MEMBERSHIP_PLANS as $plan): ?>
      <div class="relative rounded-3xl overflow-hidden transition-transform duration-300 hover:-translate-y-1 <?= $plan['featured'] ? 'membership-card featured ring-1 ring-[var(--accent)]' : '' ?>"
           style="background:var(--bg-secondary);border:1px solid var(--border-subtle)">

        <?php if ($plan['featured']): ?>
        <div class="absolute top-0 left-0 right-0 h-px" style="background:var(--accent-gradient)" aria-hidden="true"></div>
        <div class="absolute top-3 right-4 px-3 py-1 rounded-full text-xs font-semibold"
             style="background:var(--accent-gradient);color:#FFFFFF">Most Popular</div>
        <?php endif; ?>

        <div class="p-8">
          <div class="text-sm font-semibold uppercase tracking-wider mb-1" style="color:var(--text-tertiary)">
            <?= e($plan['name']) ?>
          </div>
          <div class="mb-2">
            <span class="text-4xl font-bold font-mono" style="color:var(--accent)"
                  x-text="'$' + plans.<?= e($plan['id']) ?>[term].per_month"></span>
            <span class="text-sm ml-1" style="color:var(--text-tertiary)">/mo CAD</span>
          </div>
          <p class="text-sm mb-6" style="color:var(--text-secondary)"><?= e($plan['tagline']) ?></p>

          <!-- Features -->
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
            <?php foreach ($plan['not_included'] ?? [] as $feat): ?>
            <li class="flex items-start gap-2.5 text-sm opacity-40">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" class="mt-0.5 flex-shrink-0" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
              <span><?= e($feat) ?></span>
            </li>
            <?php endforeach; ?>
          </ul>

          <a href="/book?plan=<?= e($plan['id']) ?>"
             class="btn <?= $plan['featured'] ? 'btn-gradient' : 'btn-secondary' ?> w-full text-center"
             data-magnetic>
            Get <?= e($plan['name']) ?>
          </a>

          <p class="text-xs text-center mt-3" style="color:var(--text-tertiary)">
            Billed <span x-text="term === 'monthly' ? 'monthly' : 'upfront'"></span>.
            Cancel any time.
          </p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Feature Comparison ─────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle)">
  <div class="relative z-10 container-narrow">
    <h2 class="text-h1 text-center mb-12" data-split="words">Compare plans</h2>
    <div class="overflow-x-auto">
      <table class="w-full text-sm" style="border-collapse:separate;border-spacing:0">
        <thead>
          <tr>
            <th class="text-left p-4 font-medium" style="color:var(--text-tertiary)">Feature</th>
            <?php foreach ($MEMBERSHIP_PLANS as $plan): ?>
            <th class="p-4 font-semibold text-center <?= $plan['featured'] ? '' : '' ?>"
                style="color:<?= $plan['featured'] ? 'var(--accent)' : 'inherit' ?>">
              <?= e($plan['name']) ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $rows = [
            'Remote support sessions/month'  => ['1', 'Unlimited', 'Unlimited'],
            'Priority response time'          => ['48 hrs', '4 hrs', '1 hr'],
            'On-site visits/month'            => ['—', '1', '2'],
            'Discount on repair services'     => ['10%', '20%', '30%'],
            'Proactive security monitoring'   => ['✗', '✓', '✓'],
            'Monthly health report'           => ['✗', '✓', '✓'],
            'Dedicated technician'            => ['✗', '✗', '✓'],
            'Business IT support'             => ['✗', '✗', '✓'],
          ];
          $i = 0;
          foreach ($rows as $feature => $cells):
          $i++;
          ?>
          <tr style="border-top:1px solid var(--border-subtle);background:<?= $i % 2 === 0 ? 'rgba(15,23,42,0.02)' : 'transparent' ?>">
            <td class="p-4 font-medium"><?= e($feature) ?></td>
            <?php foreach ($cells as $ci => $cell): ?>
            <td class="p-4 text-center" style="color:<?= $cell === '✓' ? 'var(--accent)' : ($cell === '✗' ? 'var(--text-tertiary)' : 'inherit') ?>">
              <?= e($cell) ?>
            </td>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ── CTA ────────────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(250,251,252,0.75)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Not sure which plan?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Talk to us — we'll recommend the right fit for your needs and budget.
    </p>
    <a href="/contact" class="btn btn-gradient btn-lg" data-magnetic>Talk to a Specialist</a>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
