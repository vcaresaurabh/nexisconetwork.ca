<?php
require_once __DIR__ . '/../includes/helpers.php';

$page_title       = 'Partner Program — White-Label Web, Marketing & Ecommerce | Nexisco Network';
$page_description = 'Resell or white-label Nexisco Network\'s web development, digital marketing, and ecommerce services under your own brand. For agencies, freelancers, and consultants worldwide — billed in USD or CAD.';
$page_canonical   = 'https://nexisconetwork.ca/partners';

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[60vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.55;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.5) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"   style="width:500px;height:500px;top:-5%;right:5%;opacity:0.14" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:0;left:5%;opacity:0.12;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Partner Program</div>
    <h1 class="text-display mb-4 max-w-3xl" data-split="words">Your brand.<br>Our delivery.</h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Resell or white-label our web development, digital marketing, and ecommerce work under your own name.
      Built for agencies, freelancers, and consultants worldwide — billed in USD or CAD.
    </p>
    <div class="flex flex-wrap gap-4 mt-8" data-anim="fade-up">
      <a href="#apply" class="btn btn-gradient btn-lg" data-magnetic>Become a Partner</a>
      <a href="#how"   class="btn btn-secondary btn-lg" data-magnetic>How It Works</a>
    </div>
  </div>
</section>

<!-- ── How the partnership works ──────────────────────────────────── -->
<section id="how" class="relative py-24 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="text-center mb-16">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">How It Works</div>
      <h2 class="text-h1" data-split="words">Three ways to partner.</h2>
      <p class="text-lg max-w-2xl mx-auto mt-4" style="color:var(--text-secondary)" data-anim="fade-up">
        Pick the model that fits how you work. Move between them as your client base grows —
        every tier is delivered by the same senior team across web, marketing, and ecommerce.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-stagger>
      <?php
      $models = [
        [
          'name'  => 'Refer',
          'tag'   => 'Send us the lead',
          'desc'  => 'Introduce a client who needs a website, marketing, or an online store. We scope, quote, and deliver — you earn a referral reward on completed work.',
          'points'=> ['No delivery work on your side', 'You stay in the loop', 'Competitive referral reward'],
          'featured' => false,
        ],
        [
          'name'  => 'White-Label',
          'tag'   => 'Under your brand',
          'desc'  => 'We deliver the work in the background and you present it as your own. Your client never sees Nexisco — just your name on senior-level web, marketing, and ecommerce output.',
          'points'=> ['Unbranded deliverables & reports', 'You set your own client pricing', 'Preferred wholesale rates'],
          'featured' => true,
        ],
        [
          'name'  => 'Reseller',
          'tag'   => 'Resell our plans',
          'desc'  => 'List our project work and monthly plans in your own catalogue at margins you control. We handle production; you own the client relationship and billing.',
          'points'=> ['Resell projects & monthly plans', 'Your margin, your invoicing', 'Flexible reseller terms'],
          'featured' => false,
        ],
      ];
      foreach ($models as $m): ?>
      <div class="glass rounded-3xl p-8 <?= $m['featured'] ? 'ring-1 ring-[var(--accent)]' : '' ?>">
        <?php if ($m['featured']): ?>
        <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-4"
             style="background:var(--accent-gradient);color:#FFFFFF">Most Popular</div>
        <?php endif; ?>
        <div class="text-2xl font-bold mb-1"><?= e($m['name']) ?></div>
        <div class="text-sm mb-5" style="color:var(--accent)"><?= e($m['tag']) ?></div>
        <p class="text-sm leading-relaxed mb-6" style="color:var(--text-secondary)"><?= e($m['desc']) ?></p>
        <ul class="space-y-2 text-sm text-left">
          <?php foreach ($m['points'] as $pt): ?>
          <li class="flex items-start gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                 stroke-width="2.5" stroke-linecap="round" aria-hidden="true" class="flex-shrink-0 mt-0.5">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span style="color:var(--text-secondary)"><?= e($pt) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-xs text-center mt-8 max-w-2xl mx-auto" style="color:var(--text-tertiary)">
      Referral rewards, wholesale rates, and reseller terms are confirmed in your partner
      agreement. All partner billing is available in USD or CAD.
    </p>
  </div>
</section>

<!-- ── Benefits ───────────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle)">
  <div class="relative z-10 container-wide">
    <div class="text-center mb-16">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Why Partner With Us</div>
      <h2 class="text-h1" data-split="words">Extend your team,<br>not your overhead.</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger>
      <?php
      $benefits = [
        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
          'title' => 'Senior Delivery, Your Brand', 'desc' => 'Experienced designers, developers, and marketers ship the work — your client only ever sees your name.'],
        ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
          'title' => 'Global & Remote-Friendly', 'desc' => 'Serve clients in the US, Canada, and worldwide. We work across time zones and bill in USD or CAD.'],
        ['icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
          'title' => 'Transparent Reporting', 'desc' => 'Clear scopes, timelines, and plain-English progress updates you can pass straight to your client.'],
        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
          'title' => 'Dedicated Project Manager', 'desc' => 'One point of contact who keeps every engagement on time, on scope, and easy to hand off.'],
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

    <p class="text-xs text-center mt-10 max-w-2xl mx-auto" style="color:var(--text-tertiary)">
      You bring the client relationship and the brand. We bring the production capacity across web
      development, digital marketing, and ecommerce — so you can say yes to more projects without hiring.
    </p>
  </div>
</section>

<!-- ── Application Form ───────────────────────────────────────────── -->
<section id="apply" class="relative py-24 overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-indigo" style="width:400px;height:400px;top:10%;left:-5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="text-center mb-12">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Apply Now</div>
      <h2 class="text-h1 mb-3" data-split="words">Apply to the partner program.</h2>
      <p class="text-lg" style="color:var(--text-secondary)" data-anim="fade-up">
        Takes about 2 minutes. We review every application and reply within 1 business day.
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
            <input type="text" name="business" class="form-input" placeholder="Acme Creative Studio" required>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="form-label">Business Email *</label>
            <input type="email" name="email" class="form-input" placeholder="you@yourcompany.com" required autocomplete="email">
            <p class="text-xs mt-1" style="color:var(--text-tertiary)">Must be a business email address.</p>
          </div>
          <div>
            <label class="form-label">Phone *</label>
            <input type="tel" name="phone" class="form-input" placeholder="+1 (888) 909-9466" required autocomplete="tel">
          </div>
        </div>

        <div>
          <label class="form-label">Business type *</label>
          <select name="business_type" class="form-input" required>
            <option value="">— Select —</option>
            <option>Digital / Creative Agency</option>
            <option>Marketing Agency</option>
            <option>Web Design Studio</option>
            <option>Freelancer / Independent Designer</option>
            <option>Independent Consultant</option>
            <option>Software / SaaS Company</option>
            <option>Ecommerce Consultant</option>
            <option>Other</option>
          </select>
        </div>

        <div>
          <label class="form-label">Preferred partnership model</label>
          <select name="monthly_referrals" class="form-input">
            <option value="">— Select —</option>
            <option value="refer">Refer (send us leads)</option>
            <option value="white">White-Label (under your brand)</option>
            <option value="resell">Reseller (resell our plans)</option>
            <option value="unsure">Not sure yet</option>
          </select>
        </div>

        <div>
          <label class="form-label">Tell us about your clients</label>
          <textarea name="audience" class="form-input" rows="3"
                    placeholder="Describe the clients you work with and which services you'd want to white-label or resell — web development, digital marketing, ecommerce, or all three…"></textarea>
        </div>

        <div id="partner-feedback" class="text-sm rounded-xl px-4 py-3 hidden" aria-live="polite"></div>

        <button type="submit" id="partner-submit" class="btn btn-gradient w-full btn-lg" data-magnetic>
          Submit Application
        </button>
        <p class="text-xs text-center" style="color:var(--text-tertiary)">
          By submitting you agree to our <a href="/terms" class="underline">Terms</a> and
          <a href="/privacy" class="underline">Privacy Policy</a>.
          Questions? Email <a href="mailto:support@nexisconetwork.ca" class="underline">support@nexisconetwork.ca</a>.
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
