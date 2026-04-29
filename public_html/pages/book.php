<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../data/services.php';

$page_title       = 'Book a Repair | Nexisco Network';
$page_description = 'Book your IT repair or service online. Same-day availability. Get an instant booking reference. All prices in CAD.';
$page_canonical   = 'https://nexisconetwork.ca/book';

// Pre-select service if passed via query string
$preselect = '';
if (!empty($_GET['service']) && valid_service_slug($_GET['service'])) {
    $preselect = $_GET['service'];
}

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[45vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.55;width:100%;height:100%;object-fit:cover" data-parallax="-15">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.6) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.15" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-14 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Book Online</div>
    <h1 class="text-display mb-4 max-w-2xl" data-split="words">Book your repair in 2 minutes.</h1>
    <p class="text-lg max-w-xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Choose a service, tell us about your issue, pick a time slot — done.
      You'll get an instant booking reference.
    </p>
  </div>
</section>

<!-- ── Booking Wizard ──────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>

  <div class="relative z-10 container-narrow"
       x-data="bookingWizard()"
       x-init="init('<?= e($preselect) ?>')">

    <!-- Step indicators -->
    <div class="flex items-center justify-center gap-0 mb-12" aria-label="Booking steps">
      <template x-for="i in totalSteps" :key="i">
        <div class="flex items-center">
          <div class="flex items-center justify-center w-9 h-9 rounded-full text-sm font-semibold transition-all duration-300"
               :class="step >= i ? 'text-white' : 'text-[var(--text-tertiary)]'"
               :style="step >= i ? 'background:var(--accent-gradient)' : 'background:var(--bg-tertiary);border:1px solid var(--border-subtle)'"
               :aria-current="step === i ? 'step' : false">
            <span x-show="step > i">✓</span>
            <span x-show="step <= i" x-text="i"></span>
          </div>
          <div x-show="i < totalSteps" class="w-12 md:w-20 h-px transition-colors duration-300"
               :style="step > i ? 'background:var(--accent)' : 'background:var(--border-subtle)'"></div>
        </div>
      </template>
    </div>

    <!-- Step 1 — Service -->
    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
      <h2 class="text-h2 text-center mb-2">Choose a service</h2>
      <p class="text-sm text-center mb-8" style="color:var(--text-secondary)">What can we help you with today?</p>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        <?php foreach ($SERVICES as $s): ?>
        <label class="cursor-pointer">
          <input type="radio" name="service" value="<?= e($s['slug']) ?>"
                 x-model="service" class="sr-only">
          <div class="glass rounded-2xl p-4 h-full transition-all duration-200"
               :class="service === '<?= e($s['slug']) ?>' ? 'border-[var(--accent)] !bg-[rgba(8,145,178,0.08)]' : 'hover:border-[rgba(15,23,42,0.15)]'">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-xl flex-shrink-0 flex items-center justify-center"
                   style="background:rgba(8,145,178,0.1);border:1px solid var(--border-subtle)">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="var(--accent)" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                  <?= $s['icon_path'] ?>
                </svg>
              </div>
              <div>
                <div class="text-sm font-semibold leading-tight"><?= e($s['name']) ?></div>
                <div class="text-xs mt-0.5" style="color:var(--text-tertiary)"><?= e($s['price_label']) ?></div>
              </div>
            </div>
          </div>
        </label>
        <?php endforeach; ?>
      </div>
      <p x-show="errors.service" class="text-red-400 text-sm mt-3 text-center" x-text="errors.service"></p>
      <div class="flex justify-center mt-8">
        <button @click="step1Next()" class="btn btn-gradient btn-lg px-12" data-magnetic>
          Continue →
        </button>
      </div>
    </div>

    <!-- Step 2 — Details -->
    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
      <h2 class="text-h2 text-center mb-2">Describe your issue</h2>
      <p class="text-sm text-center mb-8" style="color:var(--text-secondary)">The more detail, the faster we can help.</p>
      <div class="glass rounded-3xl p-8 space-y-5">
        <div>
          <label class="form-label">Device type *</label>
          <select x-model="deviceType" class="form-input">
            <option value="">— Select device —</option>
            <option>Windows PC (Desktop)</option>
            <option>Windows Laptop</option>
            <option>MacBook / Mac</option>
            <option>iPhone / iPad</option>
            <option>Android Phone / Tablet</option>
            <option>Smart Home Device</option>
            <option>Network / Router</option>
            <option>Other</option>
          </select>
          <p x-show="errors.deviceType" class="text-red-400 text-xs mt-1" x-text="errors.deviceType"></p>
        </div>
        <div>
          <label class="form-label">Describe the issue *</label>
          <textarea x-model="issue" class="form-input" rows="4"
                    placeholder="e.g. My laptop won't start, it shows a blue screen. Started after Windows update yesterday…"></textarea>
          <p x-show="errors.issue" class="text-red-400 text-xs mt-1" x-text="errors.issue"></p>
        </div>
        <div>
          <label class="form-label">Preferred service type</label>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <?php foreach (['Remote (Online)', 'Drop-off (In-person)', 'On-site (We come to you)'] as $stype): ?>
            <label class="cursor-pointer">
              <input type="radio" name="serviceType" value="<?= e($stype) ?>" x-model="serviceType" class="sr-only">
              <div class="glass rounded-xl p-3 text-sm text-center transition-colors duration-200"
                   :class="serviceType === '<?= e($stype) ?>' ? 'border-[var(--accent)] !bg-[rgba(8,145,178,0.08)]' : 'hover:border-[rgba(15,23,42,0.15)]'">
                <?= e($stype) ?>
              </div>
            </label>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="flex gap-4 justify-center mt-8">
        <button @click="step--" class="btn btn-secondary btn-lg px-8">← Back</button>
        <button @click="step2Next()" class="btn btn-gradient btn-lg px-12" data-magnetic>Continue →</button>
      </div>
    </div>

    <!-- Step 3 — Contact Info -->
    <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
      <h2 class="text-h2 text-center mb-2">Your contact info</h2>
      <p class="text-sm text-center mb-8" style="color:var(--text-secondary)">We'll confirm your booking via email.</p>
      <div class="glass rounded-3xl p-8 space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="form-label">First name *</label>
            <input type="text" x-model="firstName" class="form-input" placeholder="Jane" autocomplete="given-name">
            <p x-show="errors.firstName" class="text-red-400 text-xs mt-1" x-text="errors.firstName"></p>
          </div>
          <div>
            <label class="form-label">Last name *</label>
            <input type="text" x-model="lastName" class="form-input" placeholder="Smith" autocomplete="family-name">
            <p x-show="errors.lastName" class="text-red-400 text-xs mt-1" x-text="errors.lastName"></p>
          </div>
        </div>
        <div>
          <label class="form-label">Email *</label>
          <input type="email" x-model="email" class="form-input" placeholder="jane@example.ca" autocomplete="email">
          <p x-show="errors.email" class="text-red-400 text-xs mt-1" x-text="errors.email"></p>
        </div>
        <div>
          <label class="form-label">Phone (optional)</label>
          <input type="tel" x-model="phone" class="form-input" placeholder="(825) 555-0100" autocomplete="tel">
        </div>
        <div>
          <label class="form-label">Preferred appointment date</label>
          <input type="date" x-model="preferredDate" class="form-input"
                 :min="new Date().toISOString().split('T')[0]">
        </div>
      </div>
      <div class="flex gap-4 justify-center mt-8">
        <button @click="step--" class="btn btn-secondary btn-lg px-8">← Back</button>
        <button @click="step3Next()" class="btn btn-gradient btn-lg px-12" data-magnetic>Review →</button>
      </div>
    </div>

    <!-- Step 4 — Review & Submit -->
    <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
      <h2 class="text-h2 text-center mb-2">Review & confirm</h2>
      <p class="text-sm text-center mb-8" style="color:var(--text-secondary)">Double-check your details before submitting.</p>
      <div class="glass rounded-3xl p-8 space-y-4 mb-6">
        <div class="grid grid-cols-2 gap-4 text-sm">
          <div><span style="color:var(--text-tertiary)">Service</span><br><strong x-text="service"></strong></div>
          <div><span style="color:var(--text-tertiary)">Device</span><br><strong x-text="deviceType"></strong></div>
          <div><span style="color:var(--text-tertiary)">Type</span><br><strong x-text="serviceType"></strong></div>
          <div><span style="color:var(--text-tertiary)">Date</span><br><strong x-text="preferredDate || 'Flexible'"></strong></div>
          <div><span style="color:var(--text-tertiary)">Name</span><br><strong x-text="firstName + ' ' + lastName"></strong></div>
          <div><span style="color:var(--text-tertiary)">Email</span><br><strong x-text="email"></strong></div>
        </div>
        <div class="text-sm pt-2 border-t" style="border-color:var(--border-subtle)">
          <span style="color:var(--text-tertiary)">Issue:</span><br>
          <span x-text="issue"></span>
        </div>
      </div>

      <div x-show="submitError" class="text-sm rounded-xl px-4 py-3 mb-4 bg-red-900/30 text-red-400 border border-red-800" x-text="submitError"></div>

      <div class="flex gap-4 justify-center">
        <button @click="step--" class="btn btn-secondary btn-lg px-8">← Back</button>
        <button @click="submitBooking()" :disabled="submitting" class="btn btn-gradient btn-lg px-12" data-magnetic>
          <span x-show="!submitting">Confirm Booking</span>
          <span x-show="submitting">Submitting…</span>
        </button>
      </div>
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
