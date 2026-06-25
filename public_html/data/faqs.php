<?php
declare(strict_types=1);
/**
 * Nexisco Network — FAQ Data
 * Agency FAQ across 6 categories. The first category's first 5 items also
 * render on the homepage FAQ teaser, so the most important answers live there.
 */

$FAQS = [
  [
    'category' => 'General',
    'slug'     => 'general',
    'icon'     => '💬',
    'items'    => [
      ['q' => 'What services do you offer?',
       'a' => 'Nexisco Network is a digital agency focused on three things: web development, digital marketing, and ecommerce development. We are not an IT-support or computer-repair provider — our work is designing and building websites and online stores, and growing them with data-driven marketing.'],
      ['q' => 'Where are you located and who do you work with?',
       'a' => 'We are headquartered in Edmonton, Alberta, Canada, and we work with clients in the United States, Canada, and worldwide. Delivery is fully remote-friendly, and we collaborate across time zones to keep your project moving.'],
      ['q' => 'What currencies and payment methods do you accept?',
       'a' => 'We accept major credit and debit cards, PayPal, and bank/wire transfer. All work is billed in your choice of USD or CAD. Applicable taxes are added where required.'],
      ['q' => 'How do projects start?',
       'a' => 'Every engagement begins with a free quote. Tell us about your goals on the Start a Project page, we send a clear proposal and quote, and once you approve we move into strategy, design, and build.'],
      ['q' => 'What are typical project timelines?',
       'a' => 'Landing pages can launch in days, most marketing websites in 3–6 weeks, and larger custom or ecommerce builds in 6–12 weeks. Marketing campaigns run as ongoing monthly programs. We confirm timelines in your proposal.'],
    ],
  ],
  [
    'category' => 'Projects & Process',
    'slug'     => 'process',
    'icon'     => '🧭',
    'items'    => [
      ['q' => 'How does your project process work?',
       'a' => 'We follow four steps: Discovery & Quote, Strategy & Proposal, Design & Build, and Launch & Optimize. You approve the scope and designs before development begins, and you stay in the loop the whole way through.'],
      ['q' => 'Do you offer one-time projects or ongoing plans?',
       'a' => 'Both. You can engage us for a one-time project (a website or store) or a recurring monthly plan (marketing retainers, ongoing growth, and iteration). Many clients combine the two.'],
      ['q' => 'How many revisions are included?',
       'a' => 'Each project includes defined revision rounds at the design and build stages — the exact number is set out in your proposal so expectations are clear from the start.'],
      ['q' => 'Who owns the final work?',
       'a' => 'You do. On full payment, ownership of the design files, code, and deliverables transfers to you, as set out in our Terms of Service. There is no lock-in.'],
      ['q' => 'Do you offer ongoing marketing retainers?',
       'a' => 'Yes. Digital marketing works best as a continuous program, so we offer flexible monthly retainers covering SEO, paid ads, social, email, and conversion optimization. You can scale up or down with notice.'],
    ],
  ],
  [
    'category' => 'Pricing & Payment',
    'slug'     => 'pricing',
    'icon'     => '💰',
    'items'    => [
      ['q' => 'How is your pricing structured?',
       'a' => 'We offer published monthly plans (see the Pricing page) as well as custom project quotes for larger or bespoke work. Plans span web, marketing, and ecommerce so you can pick the stage that fits your business.'],
      ['q' => 'Which currencies do you bill in?',
       'a' => 'You can be billed in USD or CAD — your choice. Prices are shown in both on the Pricing page, and invoices are issued in your selected currency. Applicable taxes are added where required.'],
      ['q' => 'Are there any hidden fees?',
       'a' => 'No. Your proposal lists exactly what is included and what it costs. Any optional add-ons or third-party costs (ad spend, premium apps, stock assets) are agreed in advance.'],
      ['q' => 'How do payments and deposits work?',
       'a' => 'Projects are typically billed with an upfront deposit and milestone payments; monthly plans are billed each cycle. Full terms — including deposits, milestones, and invoicing — are in our Terms of Service and Refund Policy.'],
      ['q' => 'Can I get a custom quote for a large project?',
       'a' => 'Absolutely. For enterprise platforms, multi-site builds, or full marketing programs, contact us for a tailored quote in USD or CAD.'],
    ],
  ],
  [
    'category' => 'Web Development',
    'slug'     => 'web-development',
    'icon'     => '💻',
    'items'    => [
      ['q' => 'What platforms do you build on?',
       'a' => 'We build custom sites with HTML/CSS/JavaScript and React/Next.js, and content-managed sites on WordPress (including headless setups). We recommend the best fit for your goals in your proposal.'],
      ['q' => 'Will my website be mobile-friendly and fast?',
       'a' => 'Yes — every site is mobile-first and optimized for speed, SEO, and Google Core Web Vitals. We test across browsers and devices before launch.'],
      ['q' => 'Can you redesign my existing website?',
       'a' => 'Yes. We can refresh or fully rebuild an existing site, preserving your content and SEO while modernizing the design, performance, and conversion paths.'],
      ['q' => 'Do you provide hosting?',
       'a' => 'We help you choose and deploy to a suitable host and can manage the launch, but Nexisco sells professional services rather than hosting packages. We will recommend reliable options for your stack.'],
    ],
  ],
  [
    'category' => 'Digital Marketing',
    'slug'     => 'digital-marketing',
    'icon'     => '📈',
    'items'    => [
      ['q' => 'Do you guarantee specific rankings or revenue?',
       'a' => 'No. Results depend on third-party platforms and competition, so we never guarantee specific rankings or revenue. We commit to sound strategy, transparent reporting, and continuous optimization toward your goals.'],
      ['q' => 'Which marketing channels do you cover?',
       'a' => 'SEO, Google Ads / PPC, paid social, social media management, email marketing and automation, content marketing, conversion-rate optimization, and video ads — chosen based on where your audience converts.'],
      ['q' => 'How do you report on performance?',
       'a' => 'You receive a live analytics dashboard plus a plain-English monthly report covering spend, results, and what we are changing next. No vanity metrics.'],
      ['q' => 'How quickly will I see marketing results?',
       'a' => 'Paid ads can drive traffic within days; SEO and content typically compound over 3–6 months. We set realistic, channel-specific expectations in your strategy.'],
    ],
  ],
  [
    'category' => 'Ecommerce',
    'slug'     => 'ecommerce',
    'icon'     => '🛒',
    'items'    => [
      ['q' => 'Do you build on Shopify or WooCommerce?',
       'a' => 'Both. Shopify is faster to launch and fully hosted; WooCommerce offers deeper customization on WordPress. We recommend the right platform based on your catalog, budget, and team.'],
      ['q' => 'Can my store accept USD and CAD?',
       'a' => 'Yes. We configure your store to accept payments in USD and CAD and set up the correct currencies, taxes, and payment gateways for the regions you sell to.'],
      ['q' => 'Can you migrate my existing store?',
       'a' => 'Yes — we migrate products, customers, and orders to Shopify or WooCommerce, with redirects to protect your existing SEO and rankings.'],
      ['q' => 'Do you optimize checkout and conversions?',
       'a' => 'Always. Checkout optimization, cart recovery, and product-page UX are core to every build, because the goal is more revenue from the traffic you already have.'],
    ],
  ],
];
