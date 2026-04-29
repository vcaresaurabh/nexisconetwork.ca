<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../data/partners.php';

$page_title       = 'Partner Program | Nexisco Network — IT Referral Partners';
$page_description = 'Join the Nexisco Network Partner Program. Refer clients, earn commissions, and grow your business with Canada\'s trusted IT services provider.';
$page_canonical   = 'https://nexisconetwork.ca/partners';

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[60vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.18;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.5) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"   style="width:500px;height:500px;top:-5%;right:5%;opacity:0.14" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:0;left:5%;opacity:0.12;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Partner Program</div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words">Grow together.<br>Earn together.</h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Refer clients to Nexisco Network and earn up to 15% recurring commission.
      Zero risk, zero cost to join.
    </p>
    <div class="flex flex-wrap gap-4 mt-8" data-anim="fade-up">
      <a href="#apply" class="btn btn-gradient btn-lg" data-magnetic>Apply to Partner</a>
      <a href="#tiers" class="btn btn-secondary btn-lg" data-magnetic>See Commission Rates</a>
    </div>
  </div>
</section>

<!-- ── Why Partner ────────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="text-center mb-16">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Why Partner With Us</div>
      <h2 class="text-h1" data-split="words">Built for mutual success.</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger>
      <?php
      $benefits = [
        ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
          'title' => 'Up to 15% Commission', 'desc' => 'Earn on every referred client — including recurring memberships.'],
        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
          'title' => 'Fast Payouts', 'desc' => 'E-Transfer within 5 business days of invoice payment.'],
        ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
          'title' => 'Real-Time Tracking', 'desc' => 'Log in to your partner portal to track referrals and earnings.'],
        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
          'title' => 'Dedicated Support', 'desc' => 'A partner success manager to help you close deals.'],
      ];
      foreach ($benefits as $b): ?>
      <div class="glass rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-xl mx-auto mb-4 flex items-center justify-center"
             style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle)">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
               stroke="var(--accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="<?= e($b['icon']) ?>"/>
          </svg>
        </div>
        <h3 class="font-semibold mb-2"><?= e($b['title']) ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($b['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Commission Tiers ───────────────────────────────────────────── -->
<section id="tiers" class="relative py-24 overflow-hidden" style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle)">
  <div class="relative z-10 container-narrow">
    <div class="text-center mb-14">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Commission Structure</div>
      <h2 class="text-h1" data-split="words">The more you refer,<br>the more you earn.</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-stagger>
      <?php
      $tiers = [
        ['name' => 'Silver', 'range' => '1–4 referrals/month', 'rate' => '8%', 'perks' => ['Co-branded materials', 'Email support']],
        ['name' => 'Gold',   'range' => '5–9 referrals/month', 'rate' => '12%', 'featured' => true, 'perks' => ['Everything in Silver', 'Priority partner support', 'Quarterly bonus payout']],
        ['name' => 'Platinum','range' => '10+ referrals/month','rate' => '15%', 'perks' => ['Everything in Gold', 'Dedicated partner manager', 'Co-marketing budget', 'Invited to annual summit']],
      ];
      foreach ($tiers as $tier): ?>
      <div class="glass rounded-3xl p-8 text-center <?= ($tier['featured'] ?? false) ? 'ring-1 ring-[var(--accent)]' : '' ?>">
        <?php if ($tier['featured'] ?? false): ?>
        <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-4"
             style="background:var(--accent-gradient);color:#FFFFFF">Most Common</div>
        <?php endif; ?>
        <div class="text-4xl font-bold font-mono mb-1" style="color:var(--accent)"><?= e($tier['rate']) ?></div>
        <div class="text-lg font-semibold mb-1"><?= e($tier['name']) ?></div>
        <div class="text-sm mb-6" style="color:var(--text-tertiary)"><?= e($tier['range']) ?></div>
        <ul class="space-y-2 text-sm text-left">
          <?php foreach ($tier['perks'] as $perk): ?>
          <li class="flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                 stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span style="color:var(--text-secondary)"><?= e($perk) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-xs text-center mt-6" style="color:var(--text-tertiary)">
      * Commissions paid on first-time client payments. Membership commissions are recurring monthly.
      Referrals tracked via unique partner link or code.
    </p>
  </div>
</section>

<!-- ── Application Form ───────────────────────────────────────────── -->
<section id="apply" class="relative py-24 overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-indigo" style="width:400px;height:400px;top:10%;left:-5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="text-center mb-12">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Apply Now</div>
      <h2 class="text-h1 mb-3" data-split="words">Join our partner network.</h2>
      <p class="text-lg" style="color:var(--text-secondary)" data-anim="fade-up">
        Takes 2 minutes. We review all applications within 1 business day.
      </p>
    </div>

    <div class="glass rounded-3xl p-8 md:p-10">
      <form id="partner-form" novalidate class="space-y-5">
        <?= csrf_field() ?>
        <input type="text" name="website_hp" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="form-label">Your Name *</label>
            <input type="text" name="name" class="form-input" placeholder="Jane Smith" required autocomplete="name">
          </div>
          <div>
            <label class="form-label">Business Name *</label>
            <input type="text" name="business" class="form-input" placeholder="Acme IT Solutions" required>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="form-label">Business Email *</label>
            <input type="email" name="email" class="form-input" placeholder="you@yourcompany.ca" required autocomplete="email">
            <p class="text-xs mt-1" style="color:var(--text-tertiary)">Must be a business email address.</p>
          </div>
          <div>
            <label class="form-label">Phone *</label>
            <input type="tel" name="phone" class="form-input" placeholder="(416) 555-0100" required autocomplete="tel">
          </div>
        </div>

        <div>
          <label class="form-label">Business type *</label>
          <select name="business_type" class="form-input" required>
            <option value="">— Select —</option>
            <option>IT / Technology Company</option>
            <option>MSP (Managed Service Provider)</option>
            <option>Freelance Tech Consultant</option>
            <option>Real Estate Agent / Brokerage</option>
            <option>Accountant / Financial Advisor</option>
            <option>Marketing / Creative Agency</option>
            <option>Property Manager</option>
            <option>Other</option>
          </select>
        </div>

        <div>
          <label class="form-label">Estimated referrals per month</label>
          <select name="monthly_referrals" class="form-input">
            <option value="">— Estimate —</option>
            <option value="1-4">1–4 (Silver tier)</option>
            <option value="5-9">5–9 (Gold tier)</option>
            <option value="10+">10+ (Platinum tier)</option>
          </select>
        </div>

        <div>
          <label class="form-label">Tell us about your audience</label>
          <textarea name="audience" class="form-input" rows="3"
                    placeholder="Describe the types of clients you work with and why they'd benefit from Nexisco Network services…"></textarea>
        </div>

        <div id="partner-feedback" class="text-sm rounded-xl px-4 py-3 hidden" aria-live="polite"></div>

        <button type="submit" id="partner-submit" class="btn btn-gradient w-full btn-lg" data-magnetic>
          Submit Application
        </button>
        <p class="text-xs text-center" style="color:var(--text-tertiary)">
          By submitting you agree to our <a href="/terms" class="underline">Terms</a> and
          <a href="/privacy" class="underline">Privacy Policy</a>.
        </p>
      </form>
    </div>
  </div>
</section>

<script>
(function () {
  const form = document.getElementById('partner-form');
  const btn  = document.getElementById('partner-submit');
  const fb   = document.getElementById('partner-feedback');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    btn.disabled = true;
    btn.textContent = 'Submitting…';
    fb.className = 'text-sm rounded-xl px-4 py-3 hidden';

    try {
      const r = await fetch('/api/partners', { method: 'POST', body: new FormData(form) });
      const j = await r.json();
      fb.className = 'text-sm rounded-xl px-4 py-3 ' + (j.success ? 'bg-green-900/30 text-green-400 border border-green-800' : 'bg-red-900/30 text-red-400 border border-red-800');
      fb.textContent = j.message;
      if (j.success) form.reset();
    } catch {
      fb.className = 'text-sm rounded-xl px-4 py-3 bg-red-900/30 text-red-400 border border-red-800';
      fb.textContent = 'Network error — please try again.';
    }
    btn.disabled = false;
    btn.textContent = 'Submit Application';
  });
})();
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
