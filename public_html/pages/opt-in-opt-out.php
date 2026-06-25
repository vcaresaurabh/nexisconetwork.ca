<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Opt-In / Opt-Out | Nexisco Network';
$page_description = 'How Nexisco Network handles email and SMS marketing consent under Canada\'s CASL. What subscribers receive, and how to unsubscribe or opt out at any time.';
$page_canonical   = 'https://nexisconetwork.ca/opt-in-opt-out';
$last_updated     = 'June 18, 2026';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Opt-In / Opt-Out</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: <?= e($last_updated) ?></p>
  </div>
</section>

<section class="relative py-16 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <p><em>This Opt-In / Opt-Out Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel before relying on it for your business.</em></p>

      <h2>1. About This Policy</h2>
      <p>Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada) ("Nexisco Network", "we", "our", "us") is a global digital agency delivering web development, digital marketing, and ecommerce development services to clients across the United States, Canada, and worldwide. This policy explains how we obtain consent to send you marketing communications, what those communications contain, and how you can opt out at any time. It supplements our <a href="/privacy">Privacy Policy</a>.</p>

      <h2>2. Express Opt-In Consent Under CASL</h2>
      <p>Canada's Anti-Spam Legislation, <em>S.C. 2010, c. 23</em> ("CASL"), requires us to obtain consent before sending you a commercial electronic message ("CEM"). We rely on your <strong>express opt-in consent</strong> for marketing messages: you actively choose to subscribe — for example, by entering your email in a newsletter signup form, ticking a clearly-worded consent box, or asking to receive our growth tips. We do not add you to a marketing list by default, and we never buy or rent email lists.</p>
      <p>When you give consent, we record what you agreed to, when, and how, so we can demonstrate it if asked. In limited cases CASL also permits messages based on an existing business relationship; where we rely on that, the same easy opt-out described below still applies.</p>

      <h2>3. What Subscribers Receive</h2>
      <p>If you opt in to our marketing list, you can expect occasional, relevant emails such as:</p>
      <ul>
        <li>Agency news and announcements about new services or capabilities</li>
        <li>Case studies and recent project highlights from our work</li>
        <li>Practical growth tips on web, marketing, and ecommerce</li>
        <li>Invitations, offers, and updates that may interest you</li>
      </ul>
      <p>We aim to send useful content on a reasonable cadence rather than flooding your inbox. We do <strong>not</strong> send unsolicited bulk mail.</p>

      <h2>4. Transactional Messages Are Separate</h2>
      <p>Some messages are not marketing and are required to deliver the service you requested — for example, quote confirmations, proposals, invoices and receipts (in USD or CAD), and project status updates. These transactional messages are sent because we are working together, and they are not part of the marketing list you can unsubscribe from. If you no longer wish to receive them, the appropriate step is to conclude or pause your engagement with us.</p>

      <h2>5. How to Opt Out / Unsubscribe</h2>
      <p>You can withdraw your consent and stop receiving marketing emails at any time, free of charge:</p>
      <ul>
        <li>Click the <strong>unsubscribe</strong> link included at the bottom of every commercial email we send.</li>
        <li>Or email us at <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a> with "Unsubscribe" in the subject line and the email address you wish to remove.</li>
      </ul>
      <p>Every CEM we send identifies us as the sender, includes our mailing address, and provides a working unsubscribe mechanism that stays valid for at least 60 days. We honour unsubscribe requests promptly and, as required under section 11 of CASL, within 10 business days. You may keep using our services even if you opt out of marketing.</p>

      <h2>6. SMS / Text-Message Consent (If Used)</h2>
      <p>If we ever offer SMS or text-message updates, we will collect separate express consent before sending them — opting in to email does not opt you in to SMS. Standard message and data rates from your carrier may apply. Where SMS is used, you can opt out at any time by replying <strong>STOP</strong> to any message we send, or by emailing <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>. Replying <strong>HELP</strong> requests assistance. We do not currently run an SMS marketing program; this section applies only if and when one is introduced.</p>

      <h2>7. Re-Subscribing</h2>
      <p>You are welcome back any time. To rejoin our marketing list after opting out, use the newsletter signup on our website or email <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>. Re-subscribing gives fresh express consent under CASL.</p>

      <h2>8. How We Handle Your Data</h2>
      <p>We process the contact details you provide for these communications in accordance with Canada's <em>Personal Information Protection and Electronic Documents Act</em> (PIPEDA) and our <a href="/privacy">Privacy Policy</a>. For visitors in the European Union, the United Kingdom, and other regions with comparable laws, we also respect internationally recognized data-protection principles such as the GDPR. We retain marketing contact data only until you unsubscribe or withdraw consent, after which we suppress or delete it as appropriate. We do not sell your personal information.</p>

      <h2>9. Changes to This Policy</h2>
      <p>We may update this Opt-In / Opt-Out Policy from time to time. When we do, we will revise the "Last updated" date above. Material changes will be communicated where required by law.</p>

      <h2>10. Contact Us</h2>
      <p>For any questions about your communication preferences or consent, please contact us:</p>
      <address class="not-italic">
        <strong>Nexisco Network — Communications &amp; CASL Compliance</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a><br>
        Email: <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a><br>
        Privacy matters: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>
      </address>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
