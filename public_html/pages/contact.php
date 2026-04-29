<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';

$page_title       = 'Contact Us | Nexisco Network';
$page_description = 'Get in touch with Nexisco Network. Call, email, or send a message. We respond within 2 business hours.';
$page_canonical   = 'https://nexisconetwork.ca/contact';
$extra_head       = Seo::local_business();

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[50vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.15;width:100%;height:100%;object-fit:cover" data-parallax="-15">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(250,251,252,0.6) 0%,rgba(250,251,252,0.97) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:0;right:10%;opacity:0.15" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">Contact</div>
    <h1 class="text-display mb-4 max-w-2xl" data-split="words">We're here to help.</h1>
    <p class="text-xl max-w-xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Questions, quotes, or just need advice — we respond within 2 business hours.
    </p>
  </div>
</section>

<!-- ── Contact Columns ──────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">

      <!-- Info column -->
      <div class="lg:col-span-2 space-y-6" data-stagger>

        <?php
        $channels = [
          ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
            'label' => 'Phone', 'value' => '+1 (825) 771-7727', 'href' => 'tel:+18257717727'],
          ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'label' => 'Email', 'value' => 'support@nexisconetwork.ca', 'href' => 'mailto:support@nexisconetwork.ca'],
          ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'label' => 'Hours', 'value' => 'Mon–Fri 9–6, Sat 10–4 MT', 'href' => null],
          ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',
            'label' => 'Head Office', 'value' => '1404, 49A Street NW, Edmonton, AB T6L 6H6', 'href' => null],
        ];
        foreach ($channels as $c): ?>
        <div class="glass rounded-2xl p-5 flex items-start gap-4">
          <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center"
               style="background:linear-gradient(135deg,rgba(8,145,178,0.15),rgba(79,70,229,0.15));border:1px solid var(--border-subtle)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="var(--accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="<?= e($c['icon']) ?>"/>
            </svg>
          </div>
          <div>
            <div class="text-xs uppercase tracking-widest mb-1" style="color:var(--text-tertiary)"><?= e($c['label']) ?></div>
            <?php if ($c['href']): ?>
            <a href="<?= e($c['href']) ?>" class="font-medium hover:text-[var(--accent)] transition-colors">
              <?= e($c['value']) ?>
            </a>
            <?php else: ?>
            <span class="font-medium"><?= e($c['value']) ?></span>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Form column -->
      <div class="lg:col-span-3">
        <div class="glass rounded-3xl p-8 md:p-10">
          <h2 class="text-h2 mb-2">Send us a message</h2>
          <p class="text-sm mb-8" style="color:var(--text-secondary)">We'll get back to you within 2 business hours.</p>

          <form id="contact-form" novalidate class="space-y-5">
            <?= csrf_field() ?>
            <!-- Honeypot -->
            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label for="cf-name" class="form-label">Full Name *</label>
                <input type="text" id="cf-name" name="name" class="form-input" placeholder="Jane Smith" required autocomplete="name">
              </div>
              <div>
                <label for="cf-email" class="form-label">Email *</label>
                <input type="email" id="cf-email" name="email" class="form-input" placeholder="jane@company.ca" required autocomplete="email">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label for="cf-phone" class="form-label">Phone (optional)</label>
                <input type="tel" id="cf-phone" name="phone" class="form-input" placeholder="(416) 555-0100" autocomplete="tel">
              </div>
              <div>
                <label for="cf-service" class="form-label">Service Interest</label>
                <select id="cf-service" name="service" class="form-input">
                  <option value="">— Select a service —</option>
                  <option value="virus-malware-removal">Virus &amp; Malware Removal</option>
                  <option value="pc-laptop-repair">PC &amp; Laptop Repair</option>
                  <option value="data-recovery">Data Recovery</option>
                  <option value="network-wifi-setup">Network &amp; WiFi Setup</option>
                  <option value="software-installation">Software Installation</option>
                  <option value="remote-support">Remote Support</option>
                  <option value="business-it-support">Business IT Support</option>
                  <option value="hardware-upgrades">Hardware Upgrades</option>
                  <option value="smart-home-iot">Smart Home &amp; IoT</option>
                  <option value="general">General Enquiry</option>
                </select>
              </div>
            </div>

            <div>
              <label for="cf-message" class="form-label">Message *</label>
              <textarea id="cf-message" name="message" class="form-input" rows="5"
                        placeholder="Describe your issue or question…" required></textarea>
            </div>

            <div id="cf-feedback" class="text-sm rounded-xl px-4 py-3 hidden" aria-live="polite"></div>

            <button type="submit" id="cf-submit" class="btn btn-gradient w-full btn-lg" data-magnetic>
              Send Message
            </button>
            <p class="text-xs text-center" style="color:var(--text-tertiary)">
              Your information is protected under PIPEDA. We never share your data.
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  const form = document.getElementById('contact-form');
  const btn  = document.getElementById('cf-submit');
  const fb   = document.getElementById('cf-feedback');
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
    btn.textContent = 'Send Message';
  });
})();
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
