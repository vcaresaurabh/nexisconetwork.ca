<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Cookie Policy | Nexisco Network';
$page_description = 'How Nexisco Network, an ' . business('positioning') . ', uses cookies on nexisconetwork.ca — the one strictly necessary session cookie it sets today, how any future analytics cookies would be handled, and your choices.';
$page_canonical   = 'https://nexisconetwork.ca/cookie-policy';
$last_updated     = 'October 20, 2026';
$privacy_contact  = business('privacy_contact');
$privacy_email    = $privacy_contact['email'];
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

      <p>This Cookie Policy is issued by <?= e(business_identity()) ?>, and forms part of our <a href="/privacy">Privacy Policy</a>. We are an <?= e(business('positioning')) ?>. We provide web development, digital marketing, and ecommerce development services, and our work is delivered online. This policy explains how we use cookies and similar technologies on <strong>nexisconetwork.ca</strong> and how you can control them.</p>

      <h2>1. What Are Cookies?</h2>
      <p>Cookies are small text files that a website places on your device when you visit. They let a site remember your actions and preferences over time, keep your session secure, and help the owner understand how the site is used. Related browser technologies such as <code>localStorage</code> and <code>sessionStorage</code> work in a similar way; in this policy, "cookies" refers to all of these technologies. This site does not currently use <code>localStorage</code> or <code>sessionStorage</code>.</p>
      <p>Cookies can be "first-party" (set by us, on this domain) or "third-party" (set by another service we use). They can also be "session" cookies, which expire when you close your browser, or "persistent" cookies, which remain for a set period.</p>

      <h2>2. Why We Use Cookies</h2>
      <p>We keep our use of cookies to the minimum needed to run this site securely. Today, the site sets a single cookie, which we use to:</p>
      <ul>
        <li>Keep the site secure, including protecting forms against cross-site request forgery (CSRF)</li>
        <li>Maintain your session as you move between pages</li>
      </ul>
      <p>We do not currently use cookies to remember preferences or to measure how visitors use the site. If we start doing so, we will update this policy first (see Sections 3 and 6).</p>

      <h2>3. Types of Cookies</h2>

      <h3>3.1 Strictly Necessary (Security &amp; Session)</h3>
      <p>These cookies are essential for the site to function and cannot be switched off in our systems. This site sets one: our session cookie (<code>PHPSESSID</code>), which is set when you load a page. It maintains your session and underpins our CSRF security tokens, which protect form submissions — such as the quote form and contact form — from malicious requests. Because these cookies are required to deliver a service you have requested, they do not require consent under most privacy laws.</p>

      <h3>3.2 Functional (Preferences)</h3>
      <p>We do not currently set any functional or preference cookies. If we introduce them — for example, to remember a setting you choose during your visit — we will list them in the table below and ask for your consent before setting them where the law requires it. They would not be used to track you across other websites.</p>

      <h3>3.3 Analytics / Performance</h3>
      <p>We do not use an analytics tool today, so no analytics cookies are set. If we enable one (such as Google Analytics), its cookies would help us understand how visitors interact with the site — which pages are most useful and where people encounter friction — using aggregated statistics. The information would be used to improve the site and not to identify you personally or to build advertising profiles. Before enabling it, we will add its cookies to the table below and ask for your consent before setting them where the law requires it.</p>

      <h2>4. Cookies We Currently Use</h2>
      <p>The table below lists the cookies this site sets today. If we add a cookie or change a cookie's name or duration, we will update this table.</p>
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
        </tbody>
      </table>
      <?php /* OWNER NOTE: this table must list every cookie the site actually sets. Today that is only PHPSESSID
               (session_start() in partials/head.php). Setting the analytics_id config value turns on Google Analytics 4
               (partials/head.php), which sets its own cookies (e.g. _ga, _ga_<ID>). Before enabling it: add a consent
               mechanism where the law requires one, add its rows here, update Privacy Policy §8, and bump $last_updated. */ ?>
      <p class="text-sm" style="color:var(--text-tertiary)"><code>PHPSESSID</code> is the only cookie this site sets today. We do not currently set functional, preference, analytics, or advertising cookies. If we enable an analytics tool such as Google Analytics, we will add its cookies to this table and ask for your consent before setting them where the law requires it. You can block or delete cookies at any time in your browser settings (see Section 7).</p>

      <h2>5. Advertising and Cross-Site Tracking</h2>
      <p>We do not use third-party advertising cookies or cross-site tracking pixels to build marketing profiles of visitors to this website, and we do not sell your browsing data. If we ever introduce advertising or remarketing technologies, we will update this policy, list the specific tools and cookies involved, and request your consent first where the law requires it.</p>

      <h2>6. Consent for Non-Essential Cookies</h2>
      <p>This site does not currently display a cookie banner, because the only cookie it sets is the strictly necessary session cookie described above. Strictly necessary cookies are always active because the site cannot function securely without them. Before we set any non-essential cookie — such as an analytics or preference cookie — we will ask for your consent first where the law requires it. You can also block or delete cookies at any time through your browser settings (see below).</p>
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
      <?php $reg_office = business('registered_office'); ?>
      <address class="not-italic">
        <strong>Privacy Officer: <?= e($privacy_contact['name']) ?>, <?= e($privacy_contact['title']) ?>, <?= e(business('legal_name')) ?></strong><br>
        <?= e($reg_office['street']) ?><br>
        <?= e($reg_office['city']) ?>, <?= e($reg_office['region']) ?> <?= e($reg_office['postal_code']) ?><br>
        <?= e($reg_office['country']) ?><br>
        Phone: <a href="<?= e(business_tel_href()) ?>"><?= e(business('phone')) ?></a><br>
        Email: <a href="<?= e(business_mailto($privacy_email)) ?>"><?= e($privacy_email) ?></a>
      </address>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
