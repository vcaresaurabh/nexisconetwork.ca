<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Cookie Policy | Nexisco Network';
$page_description = 'How Nexisco Network, a global digital agency, uses cookies and similar technologies on nexisconetwork.ca — strictly necessary, functional, and analytics cookies, plus your choices.';
$page_canonical   = 'https://nexisconetwork.ca/cookie-policy';
$last_updated     = 'June 18, 2026';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Cookie Policy</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: <?= e($last_updated) ?></p>
  </div>
</section>

<section class="relative py-16 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <p><em>This Cookie Policy is provided for general information and forms part of our <a href="/privacy">Privacy Policy</a>. We recommend you have it reviewed by qualified legal counsel before relying on it for your business.</em></p>

      <p>This Cookie Policy is issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada ("Nexisco Network", "we", "our", "us"). We are a global digital agency serving clients across the United States, Canada, and worldwide, delivering web development, digital marketing, and ecommerce development on a remote-friendly basis. This policy explains how we use cookies and similar technologies on <strong>nexisconetwork.ca</strong> and how you can control them.</p>

      <h2>1. What Are Cookies?</h2>
      <p>Cookies are small text files that a website places on your device when you visit. They let a site remember your actions and preferences over time, keep your session secure, and help the owner understand how the site is used. We also use related browser technologies such as <code>localStorage</code> and <code>sessionStorage</code>, which work in a similar way. In this policy, "cookies" refers to all of these technologies.</p>
      <p>Cookies can be "first-party" (set by us, on this domain) or "third-party" (set by another service we use). They can also be "session" cookies, which expire when you close your browser, or "persistent" cookies, which remain for a set period.</p>

      <h2>2. Why We Use Cookies</h2>
      <p>We keep our use of cookies to the minimum needed to run this site securely and to remember your choices. Specifically, we use cookies to:</p>
      <ul>
        <li>Keep the site secure, including protecting forms against cross-site request forgery (CSRF)</li>
        <li>Maintain your session as you move between pages</li>
        <li>Remember your preferences, such as display settings and whether you have dismissed the cookie banner</li>
        <li>Understand, in aggregate, how visitors use the site so we can improve it</li>
      </ul>

      <h2>3. Types of Cookies We Use</h2>

      <h3>3.1 Strictly Necessary (Security &amp; Session)</h3>
      <p>These cookies are essential for the site to function and cannot be switched off in our systems. They are usually set in response to actions you take, such as submitting the quote form or contact form. For example, our session cookie (<code>PHPSESSID</code>) maintains your session and underpins our CSRF security tokens, which protect form submissions from malicious requests. Because these cookies are required to deliver a service you have requested, they do not require consent under most privacy laws.</p>

      <h3>3.2 Functional (Preferences)</h3>
      <p>These cookies let the site remember choices you make to give you a better experience — for example, recording that you have dismissed the cookie-consent banner or retaining a preference you set during your visit. They do not track you across other websites.</p>

      <h3>3.3 Analytics / Performance</h3>
      <p>These cookies help us understand how visitors interact with the site — which pages are most useful and where people encounter friction — using aggregated, privacy-respecting analytics. The information is used to improve the site and is not used to identify you personally or to build advertising profiles.</p>

      <h2>4. Cookies We Currently Use</h2>
      <p>The table below summarizes the cookies and similar technologies in use on this site. Names and durations may change as we improve the site; we will update this table accordingly.</p>
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
            <td style="padding:8px">Strictly necessary</td>
            <td style="padding:8px">Maintains your session and supports CSRF security on forms</td>
            <td style="padding:8px">Session</td>
          </tr>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0"><code>nxn_consent</code></td>
            <td style="padding:8px">Functional</td>
            <td style="padding:8px">Remembers your cookie-consent choice so the banner is not shown again</td>
            <td style="padding:8px">6 months</td>
          </tr>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0"><code>nxn_pref</code></td>
            <td style="padding:8px">Functional</td>
            <td style="padding:8px">Stores non-essential display or form preferences you set during your visit</td>
            <td style="padding:8px">30 days</td>
          </tr>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0"><code>_ga / _gid</code></td>
            <td style="padding:8px">Analytics / performance</td>
            <td style="padding:8px">Aggregated, privacy-respecting usage measurement — active only if an analytics tool (such as Google Analytics) is enabled on the site</td>
            <td style="padding:8px">Up to 24 months</td>
          </tr>
        </tbody>
      </table>
      <!-- NOTE (owner): if you enable a different analytics provider, update the cookie names / retention above; if you use no analytics, remove this row. -->
      <p class="text-sm" style="color:var(--text-tertiary)">Analytics cookies are only set if and when an analytics tool is enabled on the site. You can disable analytics and other non-essential cookies at any time through the cookie banner or your browser settings.</p>

      <h2>5. Advertising and Cross-Site Tracking</h2>
      <p>We do not use third-party advertising cookies or cross-site tracking pixels to build marketing profiles of visitors to this website, and we do not sell your browsing data. If we ever introduce advertising or remarketing technologies, we will update this policy, list the specific tools and cookies involved, and request your consent first where the law requires it.</p>

      <h2>6. Consent and the Cookie Banner</h2>
      <p>When you first visit the site, a cookie-consent banner explains that we use cookies and lets you accept or decline non-essential cookies. Strictly necessary cookies are always active because the site cannot function securely without them. Functional and analytics cookies are set only in line with your choice. You can change your mind at any time by clearing the cookies in your browser (see below), which will cause the banner to appear again.</p>
      <p>For visitors in the European Union, the United Kingdom, and other regions with comparable laws, we aim to obtain consent for non-essential cookies before they are set, consistent with internationally recognized data-protection principles such as the GDPR.</p>

      <h2>7. How to Manage or Disable Cookies</h2>
      <p>You are in control of cookies. Most browsers let you view, block, or delete cookies through their settings. Helpful instructions are available here:</p>
      <ul>
        <li><a href="https://support.google.com/chrome/answer/95647" rel="noopener noreferrer" target="_blank">Google Chrome</a></li>
        <li><a href="https://support.mozilla.org/kb/clear-cookies-and-site-data-firefox" rel="noopener noreferrer" target="_blank">Mozilla Firefox</a></li>
        <li><a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" rel="noopener noreferrer" target="_blank">Apple Safari</a></li>
        <li><a href="https://support.microsoft.com/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" rel="noopener noreferrer" target="_blank">Microsoft Edge</a></li>
      </ul>
      <p>Please note: if you block or delete the strictly necessary session cookie, parts of the site that rely on CSRF security tokens — such as the contact form and the "Get a Free Quote" flow — may stop working correctly.</p>

      <h2>8. Changes to This Cookie Policy</h2>
      <p>We may update this Cookie Policy from time to time to reflect changes in the technologies we use or in applicable law. When we do, we will revise the "Last updated" date at the top of this page. We encourage you to review this policy periodically.</p>

      <h2>9. More Information and Contact</h2>
      <p>For more detail on how we handle personal information generally, please read our <a href="/privacy">Privacy Policy</a>. If you have questions about our use of cookies, contact us:</p>
      <address class="not-italic">
        <strong>Privacy Officer — Nexisco Network</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a><br>
        Email: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>
      </address>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
