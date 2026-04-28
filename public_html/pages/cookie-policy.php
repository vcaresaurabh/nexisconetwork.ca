<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Cookie Policy | Nexisco Network Inc.';
$page_description = 'How Nexisco Network Inc. uses cookies and similar technologies on nexisconetwork.ca.';
$page_canonical   = 'https://nexisconetwork.ca/cookie-policy';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>
<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Cookie Policy</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: April 28, 2026</p>
  </div>
</section>
<section class="relative py-16" style="background:var(--bg-primary)">
  <div class="container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">
      <p><em>This Cookie Policy is issued by Nexisco Network Inc., a corporation incorporated under the laws of Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6 ("Nexisco Network", "we", "our", "us") and forms part of our <a href="/privacy">Privacy Policy</a>.</em></p>

      <h2>What are cookies?</h2>
      <p>Cookies are small text files placed on your device when you visit a website. We use only the minimum cookies and equivalent local-storage technologies necessary to operate this site securely and to remember your preferences.</p>

      <h2>Cookies we use</h2>
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <th style="text-align:left;padding:8px 0">Name</th>
            <th style="text-align:left;padding:8px">Type</th>
            <th style="text-align:left;padding:8px">Purpose</th>
            <th style="text-align:left;padding:8px">Duration</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0"><code>PHPSESSID</code></td>
            <td style="padding:8px">Essential</td>
            <td style="padding:8px">Session management, CSRF security</td>
            <td style="padding:8px">Session</td>
          </tr>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0"><code>nxn_pref</code></td>
            <td style="padding:8px">Functional</td>
            <td style="padding:8px">Saves your membership billing preference</td>
            <td style="padding:8px">30 days</td>
          </tr>
        </tbody>
      </table>

      <h2>Cookies we do NOT use</h2>
      <p>We do not use advertising cookies, third-party tracking pixels, Google Analytics, Facebook Pixel, or any cross-site tracking technologies.</p>

      <h2>How to control cookies</h2>
      <p>You can disable cookies in your browser settings. Disabling the session cookie may prevent the contact form and booking wizard from functioning correctly (they rely on CSRF tokens for security).</p>

      <h2>Contact</h2>
      <address class="not-italic">
        <strong>Privacy Officer — Nexisco Network Inc.</strong><br>
        1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada<br>
        Phone: <a href="tel:+18257717727">+1 (825) 771-7727</a><br>
        Email: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>
      </address>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
