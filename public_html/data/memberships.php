<?php
declare(strict_types=1);
/**
 * Nexisco Network — Membership Plans
 * 3 plans × 4 billing periods — all prices in CAD
 */

$MEMBERSHIP_PLANS = [
  [
    'id'       => 'basic',
    'name'     => 'Basic',
    'tagline'  => 'For individuals who want peace of mind.',
    'color'    => 'cyan',
    'featured' => false,
    'features' => [
      '2 remote support sessions/month',
      'Monthly PC tune-up',
      'Antivirus management',
      'Priority email support',
      '10% off in-person repairs',
      'Security tips newsletter',
    ],
    'not_included' => [
      'On-site visits',
      'Business network support',
      'Data backup management',
    ],
    'pricing' => [
      '6mo'  => ['price' => 29,  'per_month' => 29,  'total' => 174,  'savings' => null],
      '1yr'  => ['price' => 24,  'per_month' => 24,  'total' => 288,  'savings' => 'Save $60/yr'],
      '2yr'  => ['price' => 20,  'per_month' => 20,  'total' => 480,  'savings' => 'Save $216'],
      '3yr'  => ['price' => 17,  'per_month' => 17,  'total' => 612,  'savings' => 'Save $396'],
    ],
  ],
  [
    'id'       => 'pro',
    'name'     => 'Pro',
    'tagline'  => 'The complete personal IT solution.',
    'color'    => 'gradient',
    'featured' => true,
    'badge'    => 'Most Popular',
    'features' => [
      '5 remote support sessions/month',
      'Bi-weekly PC tune-up',
      'Antivirus + firewall management',
      'Priority phone & email support (same-day response)',
      '20% off in-person repairs',
      '1 on-site visit/year included',
      'Automated cloud backup setup',
      'Hardware health monitoring',
      'Family coverage (up to 3 devices)',
    ],
    'not_included' => [
      'Business network support',
      'Server management',
    ],
    'pricing' => [
      '6mo'  => ['price' => 59,  'per_month' => 59,  'total' => 354,  'savings' => null],
      '1yr'  => ['price' => 49,  'per_month' => 49,  'total' => 588,  'savings' => 'Save $120/yr'],
      '2yr'  => ['price' => 42,  'per_month' => 42,  'total' => 1008, 'savings' => 'Save $408'],
      '3yr'  => ['price' => 37,  'per_month' => 37,  'total' => 1332, 'savings' => 'Save $792'],
    ],
  ],
  [
    'id'       => 'enterprise',
    'name'     => 'Business',
    'tagline'  => 'Managed IT for growing teams.',
    'color'    => 'indigo',
    'featured' => false,
    'features' => [
      'Unlimited remote support sessions',
      'Dedicated account manager',
      'Priority 2-hour response SLA',
      '4 on-site visits/year',
      'Business network monitoring',
      'Server management (up to 2 servers)',
      'Endpoint protection for 10 devices',
      'Monthly security report',
      'Staff IT training sessions (quarterly)',
      '25% off all additional services',
      'PIPEDA compliance guidance',
    ],
    'not_included' => [],
    'pricing' => [
      '6mo'  => ['price' => 199, 'per_month' => 199, 'total' => 1194, 'savings' => null],
      '1yr'  => ['price' => 169, 'per_month' => 169, 'total' => 2028, 'savings' => 'Save $360/yr'],
      '2yr'  => ['price' => 149, 'per_month' => 149, 'total' => 3576, 'savings' => 'Save $1200'],
      '3yr'  => ['price' => 129, 'per_month' => 129, 'total' => 4644, 'savings' => 'Save $2520'],
    ],
  ],
];
