<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Terms of Service | Nexisco Network';
$page_description = 'Terms of Service for Nexisco Network — a global digital agency offering web development, digital marketing, and ecommerce development. Governing law: Province of Alberta, Canada.';
$page_canonical   = 'https://nexisconetwork.ca/terms';
$last_updated     = 'June 18, 2026';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Terms of Service</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: <?= e($last_updated) ?></p>
  </div>
</section>

<section class="relative py-16 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <p><em>These Terms of Service ("Terms") form a binding agreement between you ("you", "Client") and Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada ("Nexisco Network", "Company", "we", "our", "us"). We are a digital agency serving clients in the United States, Canada, and worldwide. Please read these Terms carefully before engaging our services. We recommend you have your own legal advisor review any agreement before signing; nothing on this page is legal advice.</em></p>

      <h2>1. Scope of Services</h2>
      <p>Nexisco Network provides three categories of professional services: <strong>web development</strong>, <strong>digital marketing</strong>, and <strong>ecommerce development</strong>. Within these pillars we deliver capabilities such as website design and build, search engine optimization, paid media (including search and social advertising), social media, email marketing, content, conversion optimization, online store design and build, and related branding and UI/UX work. These Terms govern every engagement unless a separately signed agreement expressly states otherwise. Where a signed proposal, statement of work, or quote (a "Proposal") conflicts with these Terms, the Proposal controls for that engagement.</p>

      <h2>2. Engagements, Quotes &amp; Proposals</h2>
      <p>A project begins when we issue a written Proposal and you accept it. The Proposal defines the agreed scope, deliverables, timeline, fees, currency, and any assumptions or exclusions.</p>
      <ul>
        <li>Quotes and Proposals are valid for thirty (30) calendar days from the date issued unless stated otherwise.</li>
        <li>Acceptance occurs when you sign the Proposal, confirm acceptance in writing (including by email), or pay the initial invoice or deposit — whichever comes first.</li>
        <li>The signed or accepted Proposal, together with these Terms, governs the scope of work. Anything not described in the Proposal is out of scope and may be quoted separately as a change request.</li>
        <li>We work remotely with clients across time zones and coordinate around mutually workable hours.</li>
      </ul>

      <h2>3. Payment Terms</h2>
      <ul>
        <li>Fees are billed in <strong>U.S. Dollars (USD) or Canadian Dollars (CAD)</strong>, as set out in the applicable Proposal or invoice.</li>
        <li>Project work typically requires a <strong>deposit</strong> before work begins, followed by <strong>milestone payments</strong> tied to agreed phases. Ongoing services (such as marketing or maintenance) are billed as <strong>monthly retainers</strong> in advance.</li>
        <li>Invoices are due within the period stated on the invoice (net fourteen (14) days unless otherwise agreed in writing).</li>
        <li><strong>Late payments</strong> may accrue interest at 1.5% per month (19.56% per annum) on overdue balances, plus reasonable collection costs. We may pause work on an engagement while an invoice is overdue.</li>
        <li><strong>Applicable taxes</strong> (such as GST/HST/PST in Canada, or sales tax and similar charges in other jurisdictions) are added to invoices where required by law.</li>
        <li>Card and online payments are processed by PCI-DSS compliant third-party processors; we do not store full card numbers.</li>
        <li>Deposits and amounts already invoiced for work performed are governed by our <a href="/refund-policy">Refund Policy</a> and <a href="/cancellation-policy">Cancellation Policy</a>, which form part of these Terms.</li>
      </ul>

      <h2>4. Revisions</h2>
      <p>Each Proposal defines the number of <strong>revision rounds</strong> included for the relevant deliverables. A revision round is a consolidated set of feedback returned to us as a single batch. Revisions must stay within the originally agreed scope. Work that exceeds the included rounds, or that changes the agreed scope, is treated as a change request and quoted separately before we proceed.</p>

      <h2>5. Intellectual Property &amp; Ownership</h2>
      <p>Subject to <strong>full payment</strong> of all amounts due for an engagement, ownership of the final deliverables created specifically for you under the Proposal transfers to you on receipt of that payment. Until full payment is received, all deliverables, working files, and associated intellectual property remain the property of Nexisco Network.</p>
      <ul>
        <li>Pre-existing materials, frameworks, tools, libraries, and know-how that we owned before or develop outside your engagement remain ours; where these are embedded in a deliverable, you receive a non-exclusive licence to use them as part of that deliverable.</li>
        <li>Third-party assets (such as stock media, fonts, plugins, themes, or platform subscriptions) are licensed under their own terms, and you are responsible for maintaining any required licences after handover.</li>
        <li><strong>Portfolio rights:</strong> we may showcase work we deliver for you — including visuals, descriptions, and results — in our portfolio, case studies, and marketing, <strong>unless you opt out in writing</strong>. We will honour reasonable confidentiality requests.</li>
      </ul>

      <h2>6. Client Responsibilities</h2>
      <p>Successful delivery depends on your timely cooperation. You agree to provide:</p>
      <ul>
        <li>Content, copy, images, brand assets, and other materials in the formats and by the dates we reasonably request;</li>
        <li>Access to accounts, platforms, hosting, domains, analytics, and advertising or store accounts needed to perform the work;</li>
        <li>Prompt reviews, approvals, and feedback at each agreed checkpoint;</li>
        <li>Accurate, complete, and lawful information, and confirmation that you hold the rights to any materials you supply to us.</li>
      </ul>
      <p>You are responsible for the legality and accuracy of content you provide and for compliance with the laws and platform policies that apply to your business.</p>

      <h2>7. Timelines &amp; Delays</h2>
      <p>Any dates and durations in a Proposal are good-faith <strong>estimates</strong> that assume timely input from you. Delays in delivering content, approvals, access, or payments may shift the schedule accordingly. We will communicate material changes to a timeline as soon as we are aware of them. We are not responsible for delays caused by your action or inaction, or by third parties outside our reasonable control.</p>

      <h2>8. Third-Party Platforms</h2>
      <p>Our services often rely on platforms we do not own or control, including but not limited to Google, Meta, Shopify, WooCommerce, hosting providers, payment processors, email and CRM tools, and other third-party services. We do not control and are not responsible for those platforms' availability, policies, pricing, algorithm changes, account decisions, outages, or data handling. Changes by a third-party platform may affect deliverables or results, and any required platform subscriptions or ad spend are your responsibility unless the Proposal states otherwise.</p>

      <h2>9. Marketing Results Disclaimer</h2>
      <p>Digital marketing and ecommerce outcomes depend on many factors beyond our control — including market conditions, competition, budgets, product fit, pricing, and the policies and algorithms of third-party platforms. We apply professional methods and reasonable effort, but we <strong>do not guarantee</strong> any specific search rankings, traffic levels, conversion rates, sales, or revenue. Any projections or examples we share are illustrative and not a promise of results.</p>

      <h2>10. Limitation of Liability</h2>
      <p>To the maximum extent permitted by applicable law, the total aggregate liability of Nexisco Network, its directors, officers, employees, contractors, and affiliates arising out of or in connection with these Terms or the Services — whether in contract, tort (including negligence), strict liability, or otherwise — shall not exceed the total fees actually paid by you to us for the specific engagement giving rise to the claim during the three (3) months immediately preceding the event giving rise to liability. <strong>In no event shall Nexisco Network be liable for any indirect, incidental, special, exemplary, punitive, or consequential damages, including without limitation lost profits, lost revenue, lost data, business interruption, or loss of goodwill, even if advised of the possibility of such damages.</strong> Except as expressly set out in these Terms, all other warranties, conditions, and representations, express or implied, statutory or otherwise — including implied warranties of merchantability, fitness for a particular purpose, and non-infringement — are excluded to the fullest extent permitted by applicable law. Nothing in these Terms limits liability for fraud, gross negligence, willful misconduct, or any liability that cannot lawfully be excluded.</p>

      <h2>11. Termination</h2>
      <p>Either party may terminate an engagement with written notice as set out in the applicable Proposal, or where no notice period is stated, on fourteen (14) days' written notice. Retainer engagements may be cancelled in line with our <a href="/cancellation-policy">Cancellation Policy</a>. On termination:</p>
      <ul>
        <li>You will pay for all work performed and approved up to the effective date of termination, plus any non-cancellable third-party costs we incurred on your behalf.</li>
        <li>Deposits and milestone payments are handled per our <a href="/refund-policy">Refund Policy</a>.</li>
        <li>Ownership of deliverables transfers only once the corresponding amounts are paid in full, per Section 5.</li>
        <li>Either party may terminate immediately if the other commits a material breach that remains uncured for fourteen (14) days after written notice.</li>
      </ul>

      <h2>12. Governing Law &amp; Dispute Resolution</h2>
      <p>These Terms, and any non-contractual obligations arising out of or in connection with them, are governed by and construed in accordance with the laws of the <strong>Province of Alberta</strong> and the federal laws of Canada applicable therein, without regard to conflict-of-law principles. The parties will first attempt to resolve any dispute through good-faith negotiation. If a dispute cannot be resolved informally, the parties irrevocably attorn to the exclusive jurisdiction of the courts of the Province of Alberta sitting in the Judicial District of Edmonton, save that Nexisco Network may seek injunctive or equitable relief in any court of competent jurisdiction. For clients outside Canada, this choice of law and forum applies regardless of where you are located.</p>

      <h2>13. Communications &amp; CASL Consent</h2>
      <p>If you opt in to receive marketing communications from us by email or SMS, you agree to the following:</p>
      <ul>
        <li><strong>Consent.</strong> We send commercial electronic messages only with your express consent, in line with Canada's Anti-Spam Legislation (CASL) and applicable communication laws in your jurisdiction. We do not sell your contact details, and we do not share them with third parties for their own marketing.</li>
        <li><strong>What you may receive.</strong> Project updates, invoices, and other transactional messages relating to your engagement, and — where you opt in — newsletters, offers, and agency news.</li>
        <li><strong>Frequency &amp; rates.</strong> Message frequency varies by communication type. For SMS, standard message and data rates may apply depending on your carrier; international rates may differ.</li>
        <li><strong>Opting out.</strong> You can unsubscribe from email at any time using the link in every commercial message, or stop SMS by replying <strong>"STOP"</strong>. For help, reply <strong>"HELP"</strong> or contact us at <a href="tel:+18889099466">+1 (888) 909-9466</a> or <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>. See our <a href="/opt-in-opt-out">Opt-In / Opt-Out</a> page for full details.</li>
      </ul>

      <h2>14. Changes to These Terms</h2>
      <p>We may update these Terms from time to time. The "Last updated" date at the top of this page reflects the latest revision. Continued use of our Services after a change takes effect constitutes acceptance of the revised Terms. Where changes are material, we will provide reasonable notice by email or a prominent notice on the Site. These Terms, together with our <a href="/privacy">Privacy Policy</a>, <a href="/refund-policy">Refund Policy</a>, <a href="/cancellation-policy">Cancellation Policy</a>, <a href="/cookie-policy">Cookie Policy</a>, and <a href="/disclaimer">Disclaimer</a>, form the entire agreement between the parties and supersede prior communications on the same subject. If any provision is held invalid or unenforceable, the remaining provisions continue in full force and effect.</p>

      <h2>15. Contact</h2>
      <address class="not-italic">
        <strong>Nexisco Network</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a><br>
        Email: <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a><br>
        Start a project: <a href="/start-project">Get a Free Quote</a>
      </address>

      <p class="text-sm" style="color:var(--text-tertiary)"><em>This page is a general template and not legal advice. We recommend you have a qualified lawyer review these Terms before relying on them.</em></p>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
