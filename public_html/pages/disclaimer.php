<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Disclaimer | Nexisco Network';
$page_description = 'Legal disclaimer for Nexisco Network, a global digital agency. Marketing and SEO results vary and are not guaranteed; performance depends on third-party platforms; website content is general information, not professional advice.';
$page_canonical   = 'https://nexisconetwork.ca/disclaimer';
$last_updated     = 'June 18, 2026';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:-5%;right:5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Legal</div>
    <h1 class="text-h1 mb-2">Disclaimer</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Last updated: <?= e($last_updated) ?></p>
  </div>
</section>

<section class="relative py-16 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <p><em>This Disclaimer is provided for general information. We recommend you have it reviewed by qualified legal counsel before relying on it for your business.</em></p>

      <p><em>This Disclaimer is issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada ("Nexisco Network", "we", "our", "us"). Nexisco Network is a global digital agency serving clients across the United States, Canada, and worldwide on a remote-friendly basis. This Disclaimer applies to all visitors to and users of <a href="https://nexisconetwork.ca">nexisconetwork.ca</a> and to our web development, digital marketing, and ecommerce development services.</em></p>

      <h2>1. General Information Only</h2>
      <p>The information published on this website — including our blog, guides, case studies, and resource articles — is provided for general informational purposes only. While we make reasonable efforts to keep our content accurate and current, we make no representations or warranties of any kind, express or implied, about the accuracy, completeness, reliability, suitability, or availability of any information, products, or services described on the website. Any reliance you place on such information is strictly at your own risk.</p>

      <h2>2. No Professional (Legal or Financial) Advice</h2>
      <p>Nothing on this website constitutes professional, legal, financial, tax, accounting, or investment advice, and it should not be treated as a substitute for advice from a qualified professional. Articles about digital strategy, marketing, search, ecommerce, or technology are general commentary only. Before acting on anything you read here, you should obtain independent advice tailored to your specific circumstances. We are not liable for decisions you make based on website content.</p>

      <h2>3. Marketing &amp; SEO Results Vary — No Guarantees</h2>
      <p>Outcomes from digital marketing, search engine optimization, paid advertising, content, and ecommerce work depend on many factors outside our control — including your market, competition, budget, product, pricing, brand, timing, and how third-party platforms operate and rank content. For this reason, <strong>we do not guarantee any specific result.</strong> Without limitation, we do not promise particular search-engine rankings or positions, a set amount of website traffic, a number of leads or conversions, or any level of sales, revenue, or return on investment.</p>
      <p>Any projections, estimates, forecasts, or sample figures we share reflect our professional judgment at the time and are illustrative only; they are not a promise or warranty of future performance. Past performance, including results we may describe in case studies, is not a guarantee of comparable results for your business.</p>

      <h2>4. Dependence on Third-Party Platforms</h2>
      <p>Our services often rely on platforms, networks, and tools owned and operated by third parties — for example search engines and advertising networks such as Google, social and advertising platforms such as Meta, ecommerce platforms such as Shopify, and providers of web hosting, domains, email delivery, analytics, and payment processing. We do not control these platforms. Their algorithms, policies, pricing, features, availability, approval decisions, and ranking systems can change at any time, without notice, and can affect the performance of work we deliver. We are not responsible for outages, account suspensions, policy changes, or other actions taken by third-party platforms that are outside our reasonable control.</p>

      <h2>5. No Partnership or Endorsement Implied</h2>
      <p>References to third-party platforms, brands, products, or trademarks are for identification and descriptive purposes only. Such references do not imply any partnership, certification, affiliation, sponsorship, or endorsement between Nexisco Network and those third parties unless we expressly state otherwise in writing. All trademarks belong to their respective owners.</p>

      <h2>6. External Links</h2>
      <p>This website may contain hyperlinks or references to third-party websites, applications, or tools that are not owned or controlled by Nexisco Network. We have no control over, and assume no responsibility for, the content, privacy practices, security, or availability of any third-party site or service. The inclusion of any link does not imply endorsement, and accessing third-party sites is at your own risk.</p>

      <h2>7. No Professional Relationship Until Engaged</h2>
      <p>Nothing on this website creates a professional, contractual, or fiduciary relationship between you and Nexisco Network. Such a relationship begins only when a written engagement, proposal, or order is accepted by both parties and any required deposit is paid. Fees and payments under our engagements are charged in US dollars (USD) or Canadian dollars (CAD) as specified at the time of quoting.</p>

      <h2>8. Limitation of Liability</h2>
      <p>To the fullest extent permitted by applicable law, Nexisco Network, its directors, officers, employees, and contractors disclaim all liability for any direct, indirect, incidental, special, consequential, or punitive loss or damage — including, without limitation, lost profits, lost revenue, lost data, or business interruption — arising out of or in connection with your access to or use of this website, our content, or our services. Where liability cannot be excluded under applicable law, our total aggregate liability shall not exceed the amount actually paid by you to us for the specific service giving rise to the claim.</p>

      <h2>9. Governing Law</h2>
      <p>This Disclaimer is governed by the laws of the Province of Alberta and the federal laws of Canada applicable therein, without regard to conflict-of-laws principles. This does not affect any mandatory consumer-protection or data-protection rights you may have under the laws of your own country or region.</p>

      <h2>10. Contact</h2>
      <address class="not-italic">
        <strong>Nexisco Network</strong><br>
        1404, 49A Street NW<br>
        Edmonton, Alberta T6L 6H6<br>
        Canada<br>
        Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a><br>
        Email: <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>
      </address>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
