<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../data/services.php';

$page_title       = 'Start a Project — Get a Free Quote | Nexisco Network';
$page_description = 'Tell us about your project and get a free quote in USD or CAD. Web development, digital marketing, and ecommerce for clients in the US, Canada, and worldwide.';
$page_canonical   = 'https://nexisconetwork.ca/start-project';

// Map slug → label for preselect
$service_labels = [
  'web-development'        => 'Web Development',
  'digital-marketing'     => 'Digital Marketing',
  'ecommerce-development' => 'Ecommerce Development',
];
$preselect = '';
if (!empty($_GET['service']) && isset($service_labels[$_GET['service']])) {
    $preselect = $service_labels[$_GET['service']];
}
// A plan deep-link (?plan=pro) pre-fills the message
$plan_hint = '';
if (!empty($_GET['plan'])) {
    $plan_hint = 'I\'m interested in the ' . ucfirst(preg_replace('/[^a-z]/', '', strtolower($_GET['plan']))) . ' plan. ';
}

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[45vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.5;width:100%;height:100%;object-fit:cover" data-parallax="-15">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.6) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.15" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-14 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Start a Project</div>
    <h1 class="text-display mb-4 max-w-2xl" data-split="words">Get a free quote.</h1>
    <p class="text-lg max-w-xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Tell us about your goals and we'll reply with a clear, no-obligation quote in USD or CAD.
      We work with clients in the US, Canada, and worldwide.
    </p>
  </div>
</section>

<!-- ── Quote Form ────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>

  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">

      <!-- What to expect -->
      <div class="lg:col-span-2 space-y-6" data-stagger>
        <div>
          <h2 class="text-h2 mb-3">What happens next</h2>
          <p class="text-sm" style="color:var(--text-secondary)">
            A simple, transparent process — no pressure, no jargon.
          </p>
        </div>
        <?php
        $steps = [
          ['1', 'You share your goals', 'Send us your project details and budget — it takes two minutes.'],
          ['2', 'We send a free quote',  'A clear proposal and quote in USD or CAD, usually within 1–2 business days.'],
          ['3', 'We get to work',        'Once you approve, we move into strategy, design, and build.'],
        ];
        foreach ($steps as [$n, $t, $d]): ?>
        <div class="glass rounded-2xl p-5 flex items-start gap-4">
          <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center font-mono font-bold"
               style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle);color:var(--accent)">
            <?= $n ?>
          </div>
          <div>
            <div class="font-semibold mb-0.5"><?= e($t) ?></div>
            <div class="text-sm" style="color:var(--text-secondary)"><?= e($d) ?></div>
          </div>
        </div>
        <?php endforeach; ?>

        <div class="glass rounded-2xl p-5 text-sm" style="color:var(--text-secondary)">
          Prefer to talk? Call <a href="tel:+18889099466" class="font-medium hover:text-[var(--accent)]">+1 (888) 909-9466</a>
          or email <a href="mailto:support@nexisconetwork.ca" class="font-medium hover:text-[var(--accent)]">support@nexisconetwork.ca</a>.
        </div>
      </div>

      <!-- Form -->
      <div class="lg:col-span-3">
        <div class="glass rounded-3xl p-8 md:p-10">
          <h2 class="text-h2 mb-2">Project details</h2>
          <p class="text-sm mb-8" style="color:var(--text-secondary)">Fields marked * are required. Payments accepted in USD &amp; CAD.</p>

          <form id="project-form" novalidate class="space-y-5">
            <?= csrf_field() ?>
            <!-- Honeypot -->
            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label for="pf-name" class="form-label">Full Name *</label>
                <input type="text" id="pf-name" name="name" class="form-input" placeholder="Jane Smith" required autocomplete="name">
              </div>
              <div>
                <label for="pf-email" class="form-label">Email *</label>
                <input type="email" id="pf-email" name="email" class="form-input" placeholder="jane@company.com" required autocomplete="email">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label for="pf-company" class="form-label">Company</label>
                <input type="text" id="pf-company" name="company" class="form-input" placeholder="Company name" autocomplete="organization">
              </div>
              <div>
                <label for="pf-country" class="form-label">Country</label>
                <input type="text" id="pf-country" name="country" class="form-input" placeholder="United States, Canada, …" autocomplete="country-name">
              </div>
            </div>

            <div>
              <label for="pf-service" class="form-label">Service of interest *</label>
              <select id="pf-service" name="service" class="form-input" required>
                <option value="">— Select a service —</option>
                <?php foreach (['Web Development', 'Digital Marketing', 'Ecommerce Development', 'Multiple'] as $opt): ?>
                <option value="<?= e($opt) ?>" <?= $preselect === $opt ? 'selected' : '' ?>><?= e($opt) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label for="pf-budget" class="form-label">Budget range</label>
                <select id="pf-budget" name="budget" class="form-input">
                  <option value="">— Select a range —</option>
                  <option>Under 1,000</option>
                  <option>1,000 – 5,000</option>
                  <option>5,000 – 15,000</option>
                  <option>15,000 – 50,000</option>
                  <option>50,000+</option>
                  <option>Not sure yet</option>
                </select>
              </div>
              <div>
                <label for="pf-currency" class="form-label">Currency</label>
                <select id="pf-currency" name="currency" class="form-input">
                  <option value="USD">USD ($)</option>
                  <option value="CAD">CAD ($)</option>
                </select>
              </div>
            </div>

            <div>
              <label for="pf-message" class="form-label">Tell us about your project *</label>
              <textarea id="pf-message" name="message" class="form-input" rows="5"
                        placeholder="What are you trying to build or grow? Share goals, timeline, links, or anything useful…" required><?= e($plan_hint) ?></textarea>
            </div>

            <div id="pf-feedback" class="text-sm rounded-xl px-4 py-3 hidden" aria-live="polite"></div>

            <button type="submit" id="pf-submit" class="btn btn-gradient w-full btn-lg" data-magnetic>
              Get My Free Quote
            </button>
            <p class="text-xs text-center" style="color:var(--text-tertiary)">
              Your information is protected under PIPEDA. We never share your data. No obligation.
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  const form = document.getElementById('project-form');
  const btn  = document.getElementById('pf-submit');
  const fb   = document.getElementById('pf-feedback');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    btn.disabled = true;
    btn.textContent = 'Sending…';
    fb.className = 'text-sm rounded-xl px-4 py-3 hidden';

    const data = new FormData(form);
    try {
      const r = await fetch('/api/contact', { method: 'POST', body: data });
      const j = await r.json();
      fb.className = 'text-sm rounded-xl px-4 py-3 ' + (j.success ? 'bg-green-900/30 text-green-400 border border-green-800' : 'bg-red-900/30 text-red-400 border border-red-800');
      fb.textContent = j.message;
      if (j.success) form.reset();
    } catch {
      fb.className = 'text-sm rounded-xl px-4 py-3 bg-red-900/30 text-red-400 border border-red-800';
      fb.textContent = 'Network error — please try again.';
    }
    btn.disabled = false;
    btn.textContent = 'Get My Free Quote';
  });
})();
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
