<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Privacy Policy | Nexisco Network';
$page_description = 'Nexisco Network privacy policy. How we collect, use, and protect your personal information under Canada\'s PIPEDA legislation.';
$page_canonical   = 'https://nexisconetwork.ca/privacy';
$last_updated     = 'April 28, 2026';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Privacy Policy</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: <?= e($last_updated) ?></p>
  </div>
</section>

<section class="relative py-16 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <h2>1. Our Commitment to Privacy</h2>
      <p>Nexisco Network Inc. (federally incorporated in Canada and headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6) ("Nexisco Network", "we", "our", "us") is committed to protecting the personal information you entrust to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your personal information in accordance with Canada's <em>Personal Information Protection and Electronic Documents Act</em> (PIPEDA), Alberta's <em>Personal Information Protection Act</em> (PIPA), and other applicable provincial privacy legislation.</p>

      <h2>2. What Personal Information We Collect</h2>
      <p>We collect personal information necessary to provide our services, including:</p>
      <ul>
        <li><strong>Contact information:</strong> name, email address, phone number, postal address</li>
        <li><strong>Account information:</strong> username, password (hashed), service history</li>
        <li><strong>Device information:</strong> make, model, serial number (when provided for repair)</li>
        <li><strong>Payment information:</strong> processed by PCI-compliant third-party processors; we do not store card numbers</li>
        <li><strong>Communications:</strong> emails, chat logs, support tickets</li>
        <li><strong>Technical data:</strong> IP address, browser type, pages visited (via server logs and cookies)</li>
      </ul>

      <h2>3. How We Use Your Personal Information</h2>
      <p>We use personal information to:</p>
      <ul>
        <li>Provide and improve our IT services</li>
        <li>Process bookings and payments</li>
        <li>Communicate about your service requests</li>
        <li>Send transactional emails (booking confirmations, invoices)</li>
        <li>Send commercial electronic messages (newsletters, promotions) — only with your express consent under CASL</li>
        <li>Comply with legal obligations</li>
        <li>Prevent fraud and protect our systems</li>
      </ul>

      <h2>4. Consent</h2>
      <p>We obtain your express or implied consent before collecting, using, or disclosing personal information. You may withdraw consent at any time, subject to legal or contractual restrictions, by contacting us at <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>.</p>

      <p>For commercial electronic messages under Canada's Anti-Spam Legislation (CASL), we require express opt-in consent. Every commercial message we send includes a clear unsubscribe mechanism.</p>

      <h2>5. Data Retention</h2>
      <p>We retain personal information only as long as necessary for the purposes for which it was collected, or as required by law. Service records are retained for 7 years for tax and warranty purposes. Marketing data is retained until you unsubscribe or withdraw consent.</p>

      <h2>6. Data Storage — Canada First</h2>
      <p>All personal information is stored on servers located in Canada. We do not transfer personal information outside of Canada without your prior consent, except as required by law.</p>

      <h2>7. Disclosure of Personal Information</h2>
      <p>We do not sell, rent, or trade your personal information. We may share information with:</p>
      <ul>
        <li><strong>Service providers:</strong> hosting, payment processing, email delivery — under confidentiality agreements</li>
        <li><strong>Law enforcement:</strong> when required by court order or law</li>
        <li><strong>Business transfers:</strong> in the event of a merger or acquisition, subject to equivalent privacy protections</li>
      </ul>

      <h2>8. Cookies and Tracking</h2>
      <p>We use session cookies for security (CSRF protection) and functional cookies for preferences. We do not use third-party advertising trackers. See our <a href="/cookie-policy">Cookie Policy</a> for details.</p>

      <h2>9. Your Rights Under PIPEDA &amp; Alberta PIPA</h2>
      <p>You have the right to:</p>
      <ul>
        <li>Access the personal information we hold about you</li>
        <li>Correct inaccurate information</li>
        <li>Withdraw consent for non-essential uses</li>
        <li>Request deletion of your data (subject to legal retention requirements)</li>
        <li>File a complaint with the <a href="https://www.priv.gc.ca" rel="noopener noreferrer" target="_blank">Office of the Privacy Commissioner of Canada</a> or, for Alberta residents, the <a href="https://oipc.ab.ca" rel="noopener noreferrer" target="_blank">Office of the Information and Privacy Commissioner of Alberta</a></li>
      </ul>

      <h2>10. Security</h2>
      <p>We use industry-standard security measures including SSL/TLS encryption, hashed passwords, rate limiting, and CSRF protection. However, no transmission over the internet is 100% secure.</p>

      <h2>11. Children's Privacy</h2>
      <p>Our services are not directed to individuals under 13. We do not knowingly collect personal information from children.</p>

      <h2>12. Contact Our Privacy Officer</h2>
      <p>For questions, access requests, or complaints, please contact our designated Privacy Officer:</p>
      <address class="not-italic">
        <strong>Privacy Officer — Nexisco Network Inc.</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18257717727">+1 (825) 771-7727</a><br>
        Email: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a><br>
        We will respond within 30 days as required by PIPEDA.
      </address>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
