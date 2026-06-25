<?php
/**
 * Nexisco Network — Footer
 * Newsletter (CASL consent) + business block + trust badges + link columns
 */
?>

<!-- ── Floating Quote Widget ────────────────────────────────────── -->
<div id="booking-widget">
  <a href="/start-project" class="widget-btn" aria-label="Get a free quote" data-magnetic>
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white"
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
    </svg>
  </a>
</div>

<footer id="footer" role="contentinfo">

  <!-- ── Background layers ──────────────────────────────────────── -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <!-- NOTE (owner): replace with final footer background image -->
    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=60"
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
            <h3 class="text-lg font-semibold mb-1">Grow with us</h3>
            <p class="text-sm" style="color:var(--text-secondary)">
              Web, marketing, and ecommerce insights — straight to your inbox. No spam; unsubscribe anytime. (CASL compliant.)
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
                       placeholder="you@company.com"
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
          <a href="/" class="flex items-center mb-4" aria-label="Home">
            <img src="/assets/img/logo.png?v=2"
                 srcset="/assets/img/logo.png?v=2 1x, /assets/img/logo@2x.png?v=2 2x, /assets/img/logo@3x.png?v=2 3x"
                 alt="Nexisco Network"
                 width="360" height="166"
                 class="h-14 md:h-16 w-auto"
                 style="object-fit:contain"
                 decoding="async" loading="lazy">
          </a>
          <p class="text-sm mb-5 max-w-xs leading-relaxed" style="color:var(--text-secondary)">
            Web. Marketing. Ecommerce. Growth, engineered. A global digital agency for businesses in the US, Canada, and worldwide.
          </p>
          <!-- Contact info -->
          <address class="not-italic text-sm space-y-2" style="color:var(--text-secondary)">
            <div>
              <a href="tel:+18889099466" class="hover:text-slate-900 transition-colors">
                📞 +1 (888) 909-9466
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
            <div class="leading-relaxed pt-1" style="color:var(--text-tertiary)">
              🕑 Mon–Fri 8am–7pm PT · Sat 9am–5pm PT<br>
              Support: 9am–8pm, 7 days
            </div>
            <div class="leading-relaxed pt-1" style="color:var(--text-tertiary)">
              🌍 We work across time zones to support clients in the US, Canada, and worldwide.
            </div>
          </address>
        </div>

        <!-- Services -->
        <div>
          <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color:var(--text-tertiary)">Services</h4>
          <ul class="space-y-2.5 text-sm" style="color:var(--text-secondary)">
            <li><a href="/services/web-development"       class="hover:text-slate-900 transition-colors">Web Development</a></li>
            <li><a href="/services/digital-marketing"     class="hover:text-slate-900 transition-colors">Digital Marketing</a></li>
            <li><a href="/services/ecommerce-development" class="hover:text-slate-900 transition-colors">Ecommerce Development</a></li>
            <li><a href="/services"                       class="hover:text-slate-900 transition-colors">All Services</a></li>
          </ul>
        </div>

        <!-- Company -->
        <div>
          <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color:var(--text-tertiary)">Company</h4>
          <ul class="space-y-2.5 text-sm" style="color:var(--text-secondary)">
            <li><a href="/about"         class="hover:text-slate-900 transition-colors">About Us</a></li>
            <li><a href="/portfolio"     class="hover:text-slate-900 transition-colors">Portfolio</a></li>
            <li><a href="/pricing"       class="hover:text-slate-900 transition-colors">Pricing</a></li>
            <li><a href="/partners"      class="hover:text-slate-900 transition-colors">Partner Program</a></li>
            <li><a href="/faq"           class="hover:text-slate-900 transition-colors">FAQ</a></li>
            <li><a href="/contact"       class="hover:text-slate-900 transition-colors">Contact</a></li>
          </ul>
        </div>

        <!-- Legal -->
        <div>
          <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color:var(--text-tertiary)">Legal</h4>
          <ul class="space-y-2.5 text-sm" style="color:var(--text-secondary)">
            <li><a href="/privacy"             class="hover:text-slate-900 transition-colors">Privacy Policy</a></li>
            <li><a href="/terms"               class="hover:text-slate-900 transition-colors">Terms of Service</a></li>
            <li><a href="/refund-policy"       class="hover:text-slate-900 transition-colors">Refund Policy</a></li>
            <li><a href="/cancellation-policy" class="hover:text-slate-900 transition-colors">Cancellation Policy</a></li>
            <li><a href="/cookie-policy"       class="hover:text-slate-900 transition-colors">Cookie Policy</a></li>
            <li><a href="/disclaimer"          class="hover:text-slate-900 transition-colors">Disclaimer</a></li>
            <li><a href="/opt-in-opt-out"      class="hover:text-slate-900 transition-colors">Opt-In / Opt-Out</a></li>
          </ul>
        </div>
      </div>

      <!-- ── Trust & Payment Badges ───────────────────────────── -->
      <div class="border-t mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-6"
           style="border-color:var(--border-subtle)">

        <div class="flex flex-col gap-3 items-center md:items-start">
          <div class="flex flex-wrap items-center gap-3 justify-center md:justify-start">
            <?php
            $badges = [
              ['icon' => '🔒', 'label' => 'SSL Secured'],
              ['icon' => '🇨🇦', 'label' => 'PIPEDA Compliant'],
              ['icon' => '✉️', 'label' => 'CASL Compliant'],
              ['icon' => '💳', 'label' => 'Payments in USD &amp; CAD'],
            ];
            foreach ($badges as $b): ?>
            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs"
                 style="background:var(--glass-bg);border:1px solid var(--border-subtle);color:var(--text-secondary)">
              <span aria-hidden="true"><?= $b['icon'] ?></span>
              <?= $b['label'] ?>
            </div>
            <?php endforeach; ?>
          </div>
          <!-- NOTE (owner): swap in real card-network / processor logos when confirmed. -->
          <p class="text-xs" style="color:var(--text-tertiary)">
            We accept major credit &amp; debit cards, PayPal, and bank/wire transfer.
          </p>
        </div>

        <div class="text-xs text-center md:text-right" style="color:var(--text-tertiary)">
          <p>© <?= date('Y') ?> Nexisco Network All rights reserved.</p>
          <p class="mt-1">Serving clients in the US, Canada &amp; worldwide. Payments in USD &amp; CAD; applicable taxes added where required.</p>
        </div>
      </div>

    </div>
  </div>
</footer>
