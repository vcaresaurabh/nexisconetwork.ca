<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Privacy Policy | Nexisco Network';
$page_description = 'Nexisco Network privacy policy. How our global digital agency collects, uses, and protects your personal information under Canada\'s PIPEDA and Alberta PIPA, with GDPR-style rights for international visitors.';
$page_canonical   = 'https://nexisconetwork.ca/privacy';
$last_updated     = 'June 18, 2026';
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

      <p><em>This Privacy Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel before relying on it for your business.</em></p>

      <h2>1. Our Commitment to Privacy</h2>
      <p>Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada) ("Nexisco Network", "we", "our", "us") is a global digital agency serving clients across the United States, Canada, and worldwide. We deliver web development, digital marketing, and ecommerce development services on a remote-friendly basis across multiple time zones. We are committed to protecting the personal information you entrust to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your personal information in accordance with Canada's <em>Personal Information Protection and Electronic Documents Act</em> (PIPEDA), Alberta's <em>Personal Information Protection Act</em> (PIPA), and — for visitors in the European Union, the United Kingdom, and other regions with comparable laws — internationally recognized data-protection principles such as the GDPR.</p>

      <h2>2. What Personal Information We Collect</h2>
      <p>We collect personal information necessary to provide our services, including:</p>
      <ul>
        <li><strong>Contact and quote-form data:</strong> name, email address, phone number, company, project details, and budget range you share when requesting a free quote or starting a project</li>
        <li><strong>Communications:</strong> emails, messages, proposals, and project correspondence</li>
        <li><strong>Payment information:</strong> processed by PCI-compliant third-party payment processors in USD or CAD; we do not store full card numbers</li>
        <li><strong>Technical and log data:</strong> IP address, browser type, device type, referring pages, and pages visited (via server logs and cookies)</li>
        <li><strong>Analytics data:</strong> aggregated usage and traffic insights collected through privacy-respecting analytics tools</li>
        <li><strong>Cookie data:</strong> small identifiers stored in your browser, as described in our <a href="/cookie-policy">Cookie Policy</a></li>
      </ul>

      <h2>3. How We Use Your Personal Information</h2>
      <p>We use personal information to:</p>
      <ul>
        <li>Provide and improve our web development, digital marketing, and ecommerce development services</li>
        <li>Respond to free-quote requests and manage client projects from kickoff to delivery</li>
        <li>Send transactional emails such as proposals, invoices, and project updates</li>
        <li>Send commercial electronic messages (newsletters, promotions) — only with your express opt-in consent under Canada's Anti-Spam Legislation (CASL)</li>
        <li>Comply with legal, tax, and accounting obligations</li>
        <li>Detect, prevent, and respond to fraud and protect the integrity of our systems</li>
      </ul>

      <h2>4. Consent</h2>
      <p>We obtain your express or implied consent before collecting, using, or disclosing personal information, except where the law permits or requires otherwise. You may withdraw consent at any time, subject to legal or contractual restrictions, by contacting us at <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>.</p>
      <p>For commercial electronic messages under CASL, we require express opt-in consent. Every commercial message we send includes a clear, working unsubscribe mechanism. See our <a href="/opt-in-opt-out">Opt-In / Opt-Out Policy</a> for more detail.</p>

      <h2>5. Data Retention</h2>
      <p>We retain personal information only as long as necessary for the purposes for which it was collected, or as required by law. Project and billing records are retained for the period required by applicable tax and accounting rules. Marketing data is retained until you unsubscribe or withdraw consent. When data is no longer needed, we securely delete or anonymize it.</p>

      <h2>6. Cross-Border Processing and Data Storage</h2>
      <p>We are a global agency and rely on reputable third-party service providers — including analytics, payment processing, email delivery, and cloud hosting — to operate our business. Some of these providers may store or process personal information on servers located outside Canada, including in the United States and other jurisdictions. When personal information is processed in another country, it may be subject to the laws of that jurisdiction.</p>
      <p>Where we transfer personal information across borders, we use contractual and technical safeguards designed to provide a comparable level of protection, and we disclose cross-border processing as required by PIPEDA. We do not claim that all data is stored exclusively in Canada.</p>

      <h2>7. Disclosure of Personal Information</h2>
      <p>We do not sell, rent, or trade your personal information. We may share information with:</p>
      <ul>
        <li><strong>Service providers:</strong> hosting, payment processing, analytics, and email delivery — under confidentiality and data-processing agreements</li>
        <li><strong>Law enforcement and regulators:</strong> when required by court order, subpoena, or applicable law</li>
        <li><strong>Business transfers:</strong> in connection with a merger, acquisition, or sale of assets, subject to equivalent privacy protections</li>
      </ul>

      <h2>8. Cookies and Tracking</h2>
      <p>We use session cookies for security (including CSRF protection), functional cookies for preferences, and privacy-respecting analytics cookies to understand site usage. We do not sell your browsing data. See our <a href="/cookie-policy">Cookie Policy</a> for full details and your choices.</p>

      <h2>9. Your Privacy Rights</h2>
      <p><strong>For Canadian users (PIPEDA &amp; Alberta PIPA):</strong> You have the right to access the personal information we hold about you, request corrections to inaccurate information, withdraw consent for non-essential uses, and request deletion subject to legal retention requirements. You may also file a complaint with the <a href="https://www.priv.gc.ca" rel="noopener noreferrer" target="_blank">Office of the Privacy Commissioner of Canada</a> or, for Alberta residents, the <a href="https://oipc.ab.ca" rel="noopener noreferrer" target="_blank">Office of the Information and Privacy Commissioner of Alberta</a>.</p>
      <p><strong>For international and EU/UK visitors (GDPR-style rights):</strong> Where applicable law grants them, you have the right to access, rectification, erasure, restriction of processing, data portability, and objection to certain processing. You may also lodge a complaint with your local data-protection authority.</p>
      <p><strong>No sale of personal data:</strong> We do not sell your personal information to anyone.</p>
      <p><strong>How to make a privacy request:</strong> Email <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a> with your request. We may ask you to verify your identity before acting. We aim to respond within 30 days, consistent with PIPEDA.</p>

      <h2>10. Security</h2>
      <p>We use reasonable, industry-standard safeguards including SSL/TLS encryption in transit, hashed credentials, access controls, rate limiting, and CSRF protection. No method of transmission or storage is completely secure, so we cannot guarantee absolute security.</p>

      <h2>11. Children's Privacy</h2>
      <p>Our services are intended for businesses and adults. They are not directed to individuals under 16, and we do not knowingly collect personal information from children. If you believe a child has provided us personal information, please contact us so we can delete it.</p>

      <h2>12. Changes to This Policy</h2>
      <p>We may update this Privacy Policy from time to time. When we do, we will revise the "Last updated" date above. Material changes will be communicated where required by law.</p>

      <h2>13. Contact Our Privacy Officer</h2>
      <p>For questions, access requests, or complaints, please contact our designated Privacy Officer:</p>
      <address class="not-italic">
        <strong>Privacy Officer — Nexisco Network</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a><br>
        Email: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a><br>
        We aim to respond within 30 days, as required by PIPEDA.
      </address>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
