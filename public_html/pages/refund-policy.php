<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Refund Policy | Nexisco Network';
$page_description = 'Nexisco Network refund policy for digital professional services. How deposits, milestone payments, work-in-progress, and monthly retainers are handled, with refunds issued in the original currency (USD or CAD).';
$page_canonical   = 'https://nexisconetwork.ca/refund-policy';
$last_updated     = 'June 18, 2026';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Refund Policy</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: <?= e($last_updated) ?></p>
  </div>
</section>

<section class="relative py-16 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <p><em>This Refund Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel before relying on it for your business.</em></p>

      <h2>1. About This Policy</h2>
      <p>This Refund Policy ("Policy") is issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada ("Nexisco Network", "we", "our", "us"). We are a global digital agency serving clients across the United States, Canada, and worldwide, delivering web development, digital marketing, and ecommerce development on a remote-friendly basis across multiple time zones. This Policy forms part of, and should be read together with, our <a href="/terms">Terms of Service</a> and our <a href="/cancellation-policy">Cancellation Policy</a>. Where a term is defined in those documents, it carries the same meaning here.</p>

      <h2>2. Digital Professional Services — No Physical Returns</h2>
      <p>Everything we sell is a <strong>digital professional service</strong>: design, strategy, development, marketing, and the deliverables produced through that work. There is <strong>no physical product, no shipment, and nothing to return or ship back</strong>. Because our services involve skilled labour, time, and tooling committed specifically to your project, refunds are assessed based on the work performed rather than on a "return" of goods.</p>

      <h2>3. Deposits</h2>
      <p>Most engagements begin with a deposit (also called a kickoff or onboarding payment) that reserves capacity on our schedule and funds the discovery and planning phase. Once we have begun discovery, planning, or production work for your project, the deposit reflects work that has already started and is generally <strong>non-refundable</strong> to the extent that effort has been spent. If you cancel before any work has begun, we will refund the unspent portion of your deposit. See our <a href="/cancellation-policy">Cancellation Policy</a> for how to cancel.</p>

      <h2>4. Milestone Payments and Work in Progress</h2>
      <p>Projects are typically billed in milestones tied to phases such as discovery, design, build, and launch. Our guiding principle is simple: <strong>you pay for the work that has been completed and approved up to the date of cancellation.</strong></p>
      <ul>
        <li><strong>Completed and approved milestones</strong> are earned in full and are non-refundable.</li>
        <li><strong>Work in progress</strong> at the time of cancellation is charged on a fair, pro-rated basis for the effort spent on the current milestone, calculated from our time records and the deliverables produced to date.</li>
        <li><strong>Prepaid milestones not yet started</strong> are refundable, less any costs we have already committed on your behalf (for example, third-party licences, stock assets, or paid-media spend already placed).</li>
      </ul>
      <p>Where we have produced and you have paid for a deliverable, that deliverable is provided to you on cancellation in accordance with the ownership and licensing terms in our <a href="/terms">Terms of Service</a>.</p>

      <h2>5. What Is and Isn't Refundable</h2>
      <p><strong>Generally refundable:</strong></p>
      <ul>
        <li>The unspent portion of a deposit when no work has begun.</li>
        <li>Prepaid milestones that we have not started.</li>
        <li>Duplicate or incorrect charges, and amounts billed in clear error on our part.</li>
        <li>Unused portions of prepaid third-party costs that can still be recovered.</li>
      </ul>
      <p><strong>Generally not refundable:</strong></p>
      <ul>
        <li>Work that has been completed, delivered, or approved.</li>
        <li>The pro-rated value of work in progress at the time of cancellation.</li>
        <li>Non-recoverable third-party costs we incurred on your behalf (licences, stock assets, domain or platform fees, and paid-media spend already placed).</li>
        <li>Fees for the current cycle of an active monthly plan or retainer (see Section 6).</li>
        <li>Dissatisfaction with outcomes that depend on factors outside our control — for example, search rankings, ad performance, or sales — where we delivered the agreed scope of work in good faith. We do not guarantee specific results.</li>
      </ul>

      <h2>6. Monthly Plans and Retainers</h2>
      <p>Some services — including ongoing digital marketing and maintenance — are provided under a recurring monthly plan or retainer. For these arrangements:</p>
      <ul>
        <li><strong>Current cycle:</strong> the fee for the cycle already in progress is non-refundable, because the team, time, and budget for that cycle have already been allocated and largely spent. Your services continue through the end of the paid cycle.</li>
        <li><strong>Future cycles:</strong> you may cancel before the next renewal so that you are not billed for future cycles. Charges already taken for a future cycle that has not yet begun are refundable.</li>
        <li><strong>Notice and renewal:</strong> cancellation timing and renewal notice requirements are set out in our <a href="/cancellation-policy">Cancellation Policy</a>.</li>
      </ul>

      <h2>7. Currency of Refunds</h2>
      <p>We accept payment in U.S. dollars (USD) and Canadian dollars (CAD). <strong>Any refund is issued in the same currency in which you originally paid</strong>, to the original payment method where possible. We are not responsible for differences in value caused by currency-exchange fluctuations between the date of payment and the date of refund, or for fees charged by your bank, card issuer, or payment provider.</p>

      <h2>8. How to Request a Refund</h2>
      <p>To request a refund, email <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a> with your project name, invoice or payment reference, and the reason for your request. We will acknowledge your request, review the work completed and any committed costs, and respond with a clear breakdown of any refundable amount.</p>

      <h2>9. Processing Time</h2>
      <p>Once a refund is approved, we typically process it within <strong>5–10 business days</strong>. The time it takes for the funds to appear in your account depends on your bank, card issuer, or payment provider and may take additional days beyond our processing window.</p>

      <h2>10. Chargebacks</h2>
      <p>If you believe you have been charged in error, please contact us first so we can resolve it quickly. Initiating a chargeback before contacting us may delay resolution and, where a chargeback is later found to be unwarranted, we reserve the right to recover the disputed amount and any associated fees, and to pause active work.</p>

      <h2>11. Statutory Consumer Rights</h2>
      <p>Nothing in this Policy limits or excludes any non-waivable rights you may have under applicable consumer-protection law in your jurisdiction, including, for clients in Alberta, the <em>Consumer Protection Act</em> (Alberta). Where this Policy conflicts with a mandatory legal right that applies to you, that law prevails to the extent of the conflict.</p>

      <h2>12. Governing Law</h2>
      <p>This Policy is governed by the laws of the Province of Alberta and the federal laws of Canada applicable therein, without regard to conflict-of-laws principles. This choice of law does not deprive you of mandatory consumer protections available in your place of residence.</p>

      <h2>13. Changes to This Policy</h2>
      <p>We may update this Refund Policy from time to time. When we do, we will revise the "Last updated" date above. The Policy in effect on the date you commissioned a service governs that engagement.</p>

      <h2>14. Contact Us</h2>
      <p>For questions about this Policy or a specific refund, please contact us:</p>
      <address class="not-italic">
        <strong>Nexisco Network</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a><br>
        Email: <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a><br>
        Hours: Mon–Fri 8am–7pm PT · Sat 9am–5pm PT.
      </address>

      <p class="text-sm" style="color:var(--text-tertiary)">Related: <a href="/terms">Terms of Service</a> · <a href="/cancellation-policy">Cancellation Policy</a> · <a href="/start-project">Get a Free Quote</a></p>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
