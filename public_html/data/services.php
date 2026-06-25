<?php
declare(strict_types=1);
/**
 * Nexisco Network — Services Data
 * Three service pillars: Web Development, Digital Marketing, Ecommerce Development.
 * This single array drives the nav dropdown, footer, /services index,
 * the generic /services/{slug} detail template, the home grid, and form selects.
 *
 * NOTE (owner): hero_image / card_image use representative Unsplash stock.
 * Swap in real brand/portfolio photography before launch.
 */

$SERVICES = [
  [
    'slug'        => 'web-development',
    'name'        => 'Web Development',
    'tagline'     => 'Fast, beautiful, conversion-ready websites.',
    'description' => 'We design and build custom, mobile-first websites that load fast, rank well, and turn visitors into customers. From marketing sites and landing pages to full CMS and headless builds — engineered for performance and growth.',
    'icon_path'   => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
    'hero_image'  => 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=1600&q=75',
    'card_image'  => 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=800&q=70',
    'price_label' => 'Project & monthly plans',
    'capabilities' => [
      ['name' => 'Custom Website Design',        'desc' => 'Bespoke, on-brand interfaces designed to convert — no cookie-cutter templates.'],
      ['name' => 'Responsive & Mobile-First',    'desc' => 'Pixel-perfect from 375px phones to ultrawide desktops, tested across browsers.'],
      ['name' => 'Landing Pages',                'desc' => 'High-conversion campaign pages built for paid traffic and lead capture.'],
      ['name' => 'CMS & Headless Builds',        'desc' => 'WordPress and modern headless stacks so your team can edit content with ease.'],
      ['name' => 'Performance & Core Web Vitals','desc' => 'Optimized for speed, SEO, and Google\'s Core Web Vitals out of the box.'],
      ['name' => 'UI/UX & Branding',             'desc' => 'User research, wireframes, design systems, and brand-aligned visual identity.'],
    ],
    'process' => [
      ['step' => '1', 'title' => 'Discovery & Quote',   'desc' => 'We learn your goals, audience, and scope, then send a clear fixed quote.'],
      ['step' => '2', 'title' => 'Design & Prototype',  'desc' => 'Wireframes and high-fidelity designs you approve before a line of code.'],
      ['step' => '3', 'title' => 'Build & Integrate',   'desc' => 'We develop a fast, accessible, SEO-ready site and wire up your tools.'],
      ['step' => '4', 'title' => 'Launch & Optimize',   'desc' => 'We deploy, QA across devices, and fine-tune for speed and conversions.'],
    ],
    'deliverables' => [
      'Fully responsive, production-ready website',
      'SEO-ready markup, sitemap & analytics setup',
      'CMS access and editor training (where applicable)',
      'Performance-optimized assets & Core Web Vitals pass',
      'Source files and full ownership on final payment',
    ],
    'tech' => ['HTML / CSS / JavaScript', 'React / Next.js', 'WordPress', 'Tailwind CSS', 'Headless CMS'],
    'faqs' => [
      ['q' => 'How long does a website take to build?',        'a' => 'Most marketing sites launch in 3–6 weeks; landing pages can be days. Larger custom or headless builds run 6–12 weeks. We confirm a timeline in your proposal.'],
      ['q' => 'Do I own the website when it\'s done?',          'a' => 'Yes. On full payment, all design files, code, and intellectual property transfer to you. There is no lock-in.'],
      ['q' => 'Can you work with my existing brand?',          'a' => 'Absolutely. We can build around your existing brand guidelines or create a new visual identity as part of the project.'],
      ['q' => 'Do you build on WordPress or custom code?',     'a' => 'Both. We recommend the right platform for your needs — WordPress for content-heavy sites, or React/Next.js for custom, app-like experiences.'],
      ['q' => 'Will my site be fast and SEO-friendly?',        'a' => 'Yes — performance and on-page SEO are built in. We optimize for Core Web Vitals, semantic markup, and clean, crawlable structure.'],
    ],
  ],
  [
    'slug'        => 'digital-marketing',
    'name'        => 'Digital Marketing',
    'tagline'     => 'Traffic, leads, and measurable ROI.',
    'description' => 'Data-driven marketing that grows your pipeline — SEO, Google Ads, paid social, email automation, content, and conversion-rate optimization. Every campaign is tracked, reported, and tuned for return on investment.',
    'icon_path'   => '<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>',
    'hero_image'  => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1600&q=75',
    'card_image'  => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=70',
    'price_label' => 'Monthly retainers',
    'capabilities' => [
      ['name' => 'Search Engine Optimization', 'desc' => 'Technical SEO, content, and on-page work that grows organic traffic that lasts.'],
      ['name' => 'Google Ads & PPC',           'desc' => 'Profitable search and display campaigns managed to a target cost per result.'],
      ['name' => 'Social Media Marketing',     'desc' => 'Paid social and organic management across Meta, Instagram, LinkedIn, and TikTok.'],
      ['name' => 'Email Marketing & Automation','desc' => 'Lifecycle flows and broadcasts that nurture leads and drive repeat revenue.'],
      ['name' => 'Content Marketing',          'desc' => 'Strategy, copy, and assets that build authority and feed every other channel.'],
      ['name' => 'Conversion Rate Optimization','desc' => 'A/B testing and funnel work that turns more of your existing traffic into sales.'],
    ],
    'process' => [
      ['step' => '1', 'title' => 'Audit & Strategy',    'desc' => 'We analyze your funnel, channels, and competitors to find the biggest wins.'],
      ['step' => '2', 'title' => 'Plan & Proposal',     'desc' => 'A prioritized roadmap with clear targets, channels, and reporting cadence.'],
      ['step' => '3', 'title' => 'Launch Campaigns',    'desc' => 'We build, launch, and manage campaigns across your highest-ROI channels.'],
      ['step' => '4', 'title' => 'Measure & Optimize',  'desc' => 'Transparent monthly reporting and continuous testing to compound results.'],
    ],
    'deliverables' => [
      'Channel strategy and 90-day roadmap',
      'Campaign setup, creative, and management',
      'Conversion tracking & analytics dashboard',
      'Transparent monthly performance reports',
      'Clear recommendations and next-step priorities',
    ],
    'tech' => ['Google Ads', 'Google Analytics 4', 'Meta Ads', 'Search Console', 'Email Platforms', 'SEO Tooling'],
    'faqs' => [
      ['q' => 'Do you guarantee #1 rankings or specific results?', 'a' => 'No reputable agency can guarantee specific rankings or revenue — they depend on third-party platforms and competition. We commit to a sound strategy, transparent reporting, and continuous optimization toward your goals.'],
      ['q' => 'How soon will I see results?',                      'a' => 'Paid ads can drive traffic within days. SEO and content typically compound over 3–6 months. We set realistic expectations per channel in your strategy.'],
      ['q' => 'Do you offer month-to-month retainers?',           'a' => 'Yes. Marketing works best as an ongoing program, so we offer flexible monthly retainers. You can scale up, down, or pause with notice.'],
      ['q' => 'Will I get to see what\'s working?',                'a' => 'Always. You receive a live analytics dashboard and a plain-English monthly report covering spend, results, and what we\'re changing next.'],
      ['q' => 'Which platforms do you advertise on?',             'a' => 'Primarily Google Ads, Meta (Facebook/Instagram), LinkedIn, YouTube, and TikTok — chosen based on where your audience actually converts.'],
    ],
  ],
  [
    'slug'        => 'ecommerce-development',
    'name'        => 'Ecommerce Development',
    'tagline'     => 'Online stores built to sell.',
    'description' => 'We design, build, and optimize high-converting online stores on Shopify and WooCommerce — with smooth checkout, secure payments in USD and CAD, and product experiences that maximize average order value and lifetime revenue.',
    'icon_path'   => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>',
    'hero_image'  => 'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=1600&q=75',
    'card_image'  => 'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=800&q=70',
    'price_label' => 'Project & monthly plans',
    'capabilities' => [
      ['name' => 'Store Design & Build',        'desc' => 'Conversion-focused storefronts designed around your products and brand.'],
      ['name' => 'Shopify & WooCommerce',       'desc' => 'Expert builds and theme customization on the world\'s leading platforms.'],
      ['name' => 'Checkout Optimization',       'desc' => 'Frictionless, trust-building checkout flows that recover carts and lift sales.'],
      ['name' => 'Payment Gateway Integration', 'desc' => 'Secure card, wallet, and online payments — with USD and CAD support.'],
      ['name' => 'Product & Catalog UX',        'desc' => 'Merchandising, filtering, and product pages designed to raise order value.'],
      ['name' => 'Migrations & Replatforming',  'desc' => 'Move from a legacy store to Shopify or WooCommerce with no lost data or SEO.'],
    ],
    'process' => [
      ['step' => '1', 'title' => 'Discovery & Quote',   'desc' => 'We map your catalog, customers, and goals, then scope the right platform.'],
      ['step' => '2', 'title' => 'Design & Plan',       'desc' => 'Storefront and checkout designs plus a clear build and migration plan.'],
      ['step' => '3', 'title' => 'Build & Integrate',   'desc' => 'We build the store, connect payments, shipping, and your apps, and test it hard.'],
      ['step' => '4', 'title' => 'Launch & Optimize',   'desc' => 'We go live, then optimize product pages and checkout to grow revenue.'],
    ],
    'deliverables' => [
      'Fully built Shopify or WooCommerce store',
      'Optimized product, cart & checkout flows',
      'Payment, tax & shipping configuration (USD & CAD)',
      'Analytics and conversion tracking',
      'Store handover, training, and full ownership',
    ],
    'tech' => ['Shopify', 'WooCommerce', 'Liquid', 'WordPress', 'Stripe / PayPal', 'Tailwind CSS'],
    'faqs' => [
      ['q' => 'Should I use Shopify or WooCommerce?',          'a' => 'It depends on your catalog, budget, and team. Shopify is faster to launch and fully hosted; WooCommerce offers deeper customization on WordPress. We recommend the best fit in your quote.'],
      ['q' => 'Can customers pay in both USD and CAD?',        'a' => 'Yes. We configure your store to accept payments in USD and CAD and set up the right currencies, taxes, and gateways for the regions you sell to.'],
      ['q' => 'Can you migrate my existing store?',            'a' => 'Yes — we handle product, customer, and order migrations to Shopify or WooCommerce, with redirects in place to protect your existing SEO.'],
      ['q' => 'Do you optimize checkout and conversions?',     'a' => 'Absolutely. Checkout optimization, cart recovery, and product-page UX are core to every ecommerce build — the goal is more revenue from the traffic you already have.'],
      ['q' => 'Do you also handle the marketing?',             'a' => 'Yes. Many clients pair an ecommerce build with our digital marketing services for paid ads, email flows, and SEO that drive store traffic and sales.'],
    ],
  ],
];
