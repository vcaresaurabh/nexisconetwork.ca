<?php
/**
 * Nexisco Network — Footer
 * Dark cityscape/abstract image at 15% opacity + grid pattern overlay
 * Newsletter form with CASL consent + trust badges + 4-col links
 */
?>

<!-- ── Floating Booking Widget ──────────────────────────────────── -->
<div id="booking-widget">
  <a href="/book" class="widget-btn" aria-label="Book a repair appointment" data-magnetic>
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white"
         stroke-width="2" stroke-linecap="round" aria-hidden="true">
      <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
      <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
      <line x1="8" y1="14" x2="16" y2="14"/>
    </svg>
  </a>
</div>

<footer id="footer" role="contentinfo">

  <!-- ── Background layers ──────────────────────────────────────── -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <!-- TODO: Replace with final footer background image -->
    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=1920&q=60"
         alt="" loading="lazy" width="1920" height="600"
         style="opacity:0.20;object-fit:cover;width:100%;height:100%">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(241,245,249,0.85),rgba(241,245,249,0.98))"></div>
  </div>
  <div class="bg-grid" style="position:absolute;inset:0;z-index:1;pointer-events:none;opacity:0.6" aria-hidden="true"></div>

  <div class="relative z-10">

    <!-- ── Newsletter Strip ─────────────────────────────────── -->
    <div style="border-top:1px solid var(--border-subtle);border-bottom:1px solid var(--border-subtle)">
      <div class="container-wide py-10">
        <div class="grid md:grid-cols-2 gap-8 items-start">
          <div>
            <h3 class="text-lg font-semibold mb-1">Stay in the loop</h3>
            <p class="text-sm" style="color:var(--text-secondary)">
              IT tips, security alerts, and exclusive offers. No spam — we're CASL compliant.
            </p>
          </div>

          <form data-newsletter-form class="w-full md:max-w-[520px] md:ml-auto" novalidate>
            <!-- Honeypot -->
            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
            <input type="hidden" name="casl_consent" value="1">

            <div class="flex flex-col sm:flex-row gap-3">
              <div class="flex-1 min-w-0">
                <label for="newsletter-email" class="sr-only">Email address</label>
                <input type="email" id="newsletter-email" name="email"
                       class="form-input"
                       placeholder="you@example.ca"
                       required autocomplete="email">
              </div>
              <button type="submit" class="btn btn-primary whitespace-nowrap">Subscribe</button>
            </div>

            <p class="text-xs mt-3" style="color:var(--text-tertiary)">
              By subscribing you expressly consent to receive commercial electronic messages from
              Nexisco Network. You may unsubscribe at any time.
              <a href="/privacy" class="underline hover:text-slate-900">Privacy Policy</a>.
            </p>
            <p data-form-msg class="text-sm mt-2" aria-live="polite"></p>
          </form>
        </div>
      </div>
    </div>

    <!-- ── Main Footer Grid ─────────────────────────────────── -->
    <div class="container-wide py-16">
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 lg:gap-12">

        <!-- Brand col -->
        <div class="col-span-2 md:col-span-4 lg:col-span-2">
          <a href="/" class="flex items-center gap-2.5 mb-4" aria-label="Home">
            <svg width="32" height="32" viewBox="0 0 36 36" fill="none" aria-hidden="true">
              <path d="M4 30 L4 6 L18 18 L32 6 L32 30" stroke="#0891B2" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              <circle cx="18" cy="18" r="2.5" fill="#4F46E5"/>
            </svg>
            <span class="text-lg font-semibold" style="font-family:'General Sans',sans-serif">
              Nexisco <span style="color:var(--accent)">Network</span>
            </span>
          </a>
          <p class="text-sm mb-5 max-w-xs leading-relaxed" style="color:var(--text-secondary)">
            Smart IT. Seamless Support. Professional computer repair and IT services across Canada.
          </p>
          <!-- Contact info -->
          <address class="not-italic text-sm space-y-2" style="color:var(--text-secondary)">
            <div>
              <a href="tel:+18257717727" class="hover:text-slate-900 transition-colors">
                📞 +1 (825) 771-7727
              </a>
            </div>
            <div>
              <a href="mailto:support@nexisconetwork.ca" class="hover:text-slate-900 transition-colors">
                ✉️ support@nexisconetwork.ca
              </a>
            </div>
            <div class="leading-relaxed">
              📍 1404, 49A Street NW<br>
              Edmonton, Alberta T6L 6H6, Canada
            </div>
          </address>
          <!-- Social -->
          <div class="flex items-center gap-3 mt-5">
            <a href="#" class="w-9 h-9 glass rounded-full flex items-center justify-center hover:border-[var(--accent)] transition-colors"
               aria-label="Facebook" rel="noopener noreferrer" target="_blank">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
              </svg>
            </a>
            <a href="#" class="w-9 h-9 glass rounded-full flex items-center justify-center hover:border-[var(--accent)] transition-colors"
               aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                <circle cx="4" cy="4" r="2"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Services -->
        <div>
          <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color:var(--text-tertiary)">Services</h4>
          <ul class="space-y-2.5 text-sm" style="color:var(--text-secondary)">
            <li><a href="/services/virus-malware-removal" class="hover:text-slate-900 transition-colors">Virus Removal</a></li>
            <li><a href="/services/pc-laptop-repair"      class="hover:text-slate-900 transition-colors">PC & Laptop Repair</a></li>
            <li><a href="/services/data-recovery"         class="hover:text-slate-900 transition-colors">Data Recovery</a></li>
            <li><a href="/services/network-wifi-setup"    class="hover:text-slate-900 transition-colors">Network & WiFi</a></li>
            <li><a href="/services/software-installation" class="hover:text-slate-900 transition-colors">Software Install</a></li>
            <li><a href="/services/remote-support"        class="hover:text-slate-900 transition-colors">Remote Support</a></li>
            <li><a href="/services/business-it-support"   class="hover:text-slate-900 transition-colors">Business IT</a></li>
            <li><a href="/services/hardware-upgrades"     class="hover:text-slate-900 transition-colors">Hardware Upgrades</a></li>
            <li><a href="/services/smart-home-iot"        class="hover:text-slate-900 transition-colors">Smart Home & IoT</a></li>
          </ul>
        </div>

        <!-- Company -->
        <div>
          <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color:var(--text-tertiary)">Company</h4>
          <ul class="space-y-2.5 text-sm" style="color:var(--text-secondary)">
            <li><a href="/about"      class="hover:text-slate-900 transition-colors">About Us</a></li>
            <li><a href="/membership" class="hover:text-slate-900 transition-colors">Membership Plans</a></li>
            <li><a href="/partners"   class="hover:text-slate-900 transition-colors">Partner Program</a></li>
            <li><a href="/faq"        class="hover:text-slate-900 transition-colors">FAQ</a></li>
            <li><a href="/contact"    class="hover:text-slate-900 transition-colors">Contact</a></li>
            <li><a href="/book"       class="hover:text-slate-900 transition-colors">Book a Repair</a></li>
          </ul>
        </div>

        <!-- Legal -->
        <div>
          <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color:var(--text-tertiary)">Legal</h4>
          <ul class="space-y-2.5 text-sm" style="color:var(--text-secondary)">
            <li><a href="/privacy"             class="hover:text-slate-900 transition-colors">Privacy Policy</a></li>
            <li><a href="/terms"               class="hover:text-slate-900 transition-colors">Terms of Service</a></li>
            <li><a href="/cookie-policy"       class="hover:text-slate-900 transition-colors">Cookie Policy</a></li>
            <li><a href="/cancellation-policy" class="hover:text-slate-900 transition-colors">Cancellation Policy</a></li>
            <li><a href="/disclaimer"          class="hover:text-slate-900 transition-colors">Disclaimer</a></li>
            <li><a href="/opt-in-opt-out"      class="hover:text-slate-900 transition-colors">Opt-In / Opt-Out</a></li>
          </ul>
        </div>
      </div>

      <!-- ── Trust Badges ─────────────────────────────────────── -->
      <div class="border-t mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-6"
           style="border-color:var(--border-subtle)">

        <div class="flex flex-wrap items-center gap-4 justify-center md:justify-start">
          <!-- Trust badge pills -->
          <?php
          $badges = [
            ['icon' => '🔒', 'label' => 'SSL Secured'],
            ['icon' => '🇨🇦', 'label' => 'PIPEDA Compliant'],
            ['icon' => '✉️', 'label' => 'CASL Compliant'],
            ['icon' => '⭐', 'label' => '5-Star Rated'],
            ['icon' => '🛡️', 'label' => '30-Day Guarantee'],
          ];
          foreach ($badges as $b): ?>
          <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs"
               style="background:var(--glass-bg);border:1px solid var(--border-subtle);color:var(--text-secondary)">
            <span aria-hidden="true"><?= $b['icon'] ?></span>
            <?= htmlspecialchars($b['label'], ENT_QUOTES, 'UTF-8') ?>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="text-xs text-center md:text-right" style="color:var(--text-tertiary)">
          <p>© <?= date('Y') ?> Nexisco Network Inc. All rights reserved.</p>
          <p class="mt-1">Serving clients across Canada — GST/HST applicable per province.</p>
        </div>
      </div>

    </div>
  </div>
</footer>
