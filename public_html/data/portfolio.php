<?php
declare(strict_types=1);
/**
 * Nexisco Network — Portfolio Items
 * Filterable showcase across four categories: web, marketing, ecommerce, branding.
 *
 * NOTE (owner): these are ILLUSTRATIVE showcase items with representative stock
 * imagery. Replace each with a real client case study (swap title, descriptor,
 * image, and add a results summary) before running paid traffic to this page.
 */

$PORTFOLIO_CATEGORIES = [
  'all'       => 'All',
  'web'       => 'Web Design',
  'marketing' => 'Digital Marketing',
  'ecommerce' => 'Ecommerce',
  'branding'  => 'Branding',
];

$PORTFOLIO = [
  // ── Web Design ──────────────────────────────────────────────
  ['title' => 'Corporate Website',    'cat' => 'web',       'tag' => 'Web Design',        'desc' => 'Professional business website with a polished, trust-building design.', 'image' => 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=900&q=70', 'featured' => true],
  ['title' => 'Agency Platform',      'cat' => 'web',       'tag' => 'Web Design',        'desc' => 'Creative agency solution with bold motion and case-study storytelling.', 'image' => 'https://images.unsplash.com/photo-1559028012-481c04fa702d?w=900&q=70', 'featured' => false],
  ['title' => 'Landing Page',         'cat' => 'web',       'tag' => 'Web Design',        'desc' => 'High-conversion campaign page engineered for paid traffic.',            'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=900&q=70', 'featured' => true],
  ['title' => 'Portfolio Site',       'cat' => 'web',       'tag' => 'Web Design',        'desc' => 'Personal brand website with a clean, content-first layout.',            'image' => 'https://images.unsplash.com/photo-1517292987719-0369a794ec0f?w=900&q=70', 'featured' => false],
  ['title' => 'Enterprise Platform',  'cat' => 'web',       'tag' => 'Web Design',        'desc' => 'Scalable business platform with complex content and integrations.',     'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=900&q=70', 'featured' => false],

  // ── Digital Marketing ───────────────────────────────────────
  ['title' => 'SEO Campaign',         'cat' => 'marketing', 'tag' => 'Digital Marketing', 'desc' => 'Organic traffic growth through technical and content SEO.',             'image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=900&q=70', 'featured' => true],
  ['title' => 'Analytics Dashboard',  'cat' => 'marketing', 'tag' => 'Digital Marketing', 'desc' => 'Performance tracking dashboard for clear, reportable results.',          'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=900&q=70', 'featured' => false],
  ['title' => 'Paid Advertising',     'cat' => 'marketing', 'tag' => 'Digital Marketing', 'desc' => 'Conversion-focused Google and Meta ad campaigns.',                      'image' => 'https://images.unsplash.com/photo-1533750349088-cd871a92f312?w=900&q=70', 'featured' => false],
  ['title' => 'Social Media Campaign','cat' => 'marketing', 'tag' => 'Digital Marketing', 'desc' => 'Audience engagement and growth across social platforms.',               'image' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=900&q=70', 'featured' => false],
  ['title' => 'Email Marketing',      'cat' => 'marketing', 'tag' => 'Digital Marketing', 'desc' => 'Lead-nurturing automation that drives repeat revenue.',                 'image' => 'https://images.unsplash.com/photo-1596526131083-e8c633c948d2?w=900&q=70', 'featured' => false],

  // ── Ecommerce ───────────────────────────────────────────────
  ['title' => 'Online Store',         'cat' => 'ecommerce', 'tag' => 'Ecommerce',         'desc' => 'Custom ecommerce site built to convert browsers into buyers.',         'image' => 'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=900&q=70', 'featured' => true],
  ['title' => 'Product Page',         'cat' => 'ecommerce', 'tag' => 'Ecommerce',         'desc' => 'Optimized sales layout designed to raise average order value.',        'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=900&q=70', 'featured' => false],
  ['title' => 'Checkout Flow',        'cat' => 'ecommerce', 'tag' => 'Ecommerce',         'desc' => 'Smooth, trust-building checkout journey that recovers carts.',          'image' => 'https://images.unsplash.com/photo-1556742393-d75f468bfcb0?w=900&q=70', 'featured' => true],
  ['title' => 'Retail Platform',      'cat' => 'ecommerce', 'tag' => 'Ecommerce',         'desc' => 'Multi-product marketplace with rich merchandising.',                    'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=900&q=70', 'featured' => false],
  ['title' => 'Storefront Design',    'cat' => 'ecommerce', 'tag' => 'Ecommerce',         'desc' => 'Product-first storefront UI with a premium feel.',                      'image' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=900&q=70', 'featured' => false],

  // ── Branding ────────────────────────────────────────────────
  ['title' => 'UI Design',            'cat' => 'branding',  'tag' => 'Branding',          'desc' => 'Modern interface system with a cohesive component library.',           'image' => 'https://images.unsplash.com/photo-1545235617-9465d2a55698?w=900&q=70', 'featured' => false],
  ['title' => 'Graphic System',       'cat' => 'branding',  'tag' => 'Branding',          'desc' => 'Marketing visuals and a consistent graphic language.',                 'image' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=900&q=70', 'featured' => false],
  ['title' => 'Logo Design',          'cat' => 'branding',  'tag' => 'Branding',          'desc' => 'Distinctive logo and mark built for brand recognition.',               'image' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=900&q=70', 'featured' => false],
];
