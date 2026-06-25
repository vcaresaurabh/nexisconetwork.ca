<?php
declare(strict_types=1);
/**
 * Nexisco Network — Pricing Plans
 * Five monthly tiers spanning web, marketing & ecommerce.
 * Dual-currency: USD and CAD. By default CAD mirrors USD — the owner can
 * set different CAD values here if desired (see OWNER TO-DO).
 * No security / monitoring / backup / IT-support line items.
 */

$PRICING_PLANS = [
  [
    'id'       => 'starter',
    'name'     => 'Starter',
    'tagline'  => 'Launch a professional presence.',
    'featured' => false,
    'price'    => ['usd' => 99, 'cad' => 99],
    'features' => [
      'Responsive Website (5 Pages)',
      'Basic SEO Setup',
      'Contact Form Integration',
      'Mobile Optimization',
      'Custom UI/UX Design',
    ],
  ],
  [
    'id'       => 'basic',
    'name'     => 'Basic',
    'tagline'  => 'Grow with more pages & reach.',
    'featured' => false,
    'price'    => ['usd' => 149, 'cad' => 149],
    'features' => [
      'Responsive Website (10 Pages)',
      'SEO Optimization',
      'Custom UI Sections',
      'Speed Optimization',
      'Google Analytics Setup',
      'Starter Ecommerce Store',
    ],
  ],
  [
    'id'       => 'pro',
    'name'     => 'Pro',
    'tagline'  => 'Our most popular growth plan.',
    'featured' => true,
    'badge'    => 'Most Popular',
    'price'    => ['usd' => 549, 'cad' => 549],
    'features' => [
      'Custom Website Design',
      'Advanced SEO',
      'Ecommerce (up to 50 Products)',
      'Conversion Optimization',
      'Performance Analytics',
      'Email Marketing Setup',
      'Dedicated Manager',
    ],
  ],
  [
    'id'       => 'advanced',
    'name'     => 'Advanced',
    'tagline'  => 'Full-funnel marketing & store.',
    'featured' => false,
    'price'    => ['usd' => 999, 'cad' => 999],
    'features' => [
      'Premium Website Design',
      'Full SEO Strategy',
      'Ecommerce (Unlimited Products)',
      'Paid Ads Setup',
      'Conversion Funnels',
      'Advanced Analytics',
      'Monthly Reports',
      'Dedicated Manager',
    ],
  ],
  [
    'id'       => 'enterprise',
    'name'     => 'Enterprise',
    'tagline'  => 'A complete digital growth engine.',
    'featured' => false,
    'price'    => ['usd' => 1299, 'cad' => 1299],
    'features' => [
      'Custom Enterprise Platform',
      'Dedicated Project Manager',
      'Full Digital Marketing',
      'Paid Ads Management',
      'Advanced Conversion Strategy',
      'Custom Analytics Dashboard',
      'Performance Optimization',
      'Priority Support',
    ],
  ],
];
