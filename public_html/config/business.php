<?php
declare(strict_types=1);
/**
 * Nexisco Network — Business details (single source of truth)
 *
 * Every business fact the site shows — legal name, corporate registration,
 * registered office, phone, email, hours, plan terms — lives here and nowhere
 * else. Templates read it through business() and the business_*() helpers in
 * includes/helpers.php; the JSON-LD in includes/seo.php reads it too.
 *
 * Only enter facts you can prove (corporate registry, signed policies).
 * Do not add clients, statistics, ratings, awards or staff here.
 */
return [
    /* ── Identity ─────────────────────────────────────────────── */
    'brand_name'          => 'Nexisco Network',
    'legal_name'          => 'Nexisco Network Inc.',
    'jurisdiction'        => 'Alberta, Canada',
    'jurisdiction_short'  => 'Alberta',
    'corporate_access_no' => '2028114540',
    'incorporated'        => 'April 24, 2026',   // display form
    'founding_date'       => '2026-04-24',       // ISO form for JSON-LD
    'url'                 => 'https://nexisconetwork.ca',
    'positioning'         => 'Edmonton-based digital agency serving businesses in Canada and the US',

    /* ── Registered office ───────────────────────────────────── */
    'registered_office' => [
        'street'       => '1404, 49A Street NW',
        'city'         => 'Edmonton',
        'region'       => 'AB',
        'region_name'  => 'Alberta',
        'postal_code'  => 'T6L 6H6',
        'country'      => 'Canada',
        'country_code' => 'CA',
    ],

    /* ── People ──────────────────────────────────────────────── */
    'director'          => 'Aman Deshwal',
    'director_title'    => 'Director',
    'director_linkedin' => null, // no public profile — leave null so no link renders

    /* ── Contact ─────────────────────────────────────────────── */
    'phone'         => '+1 (888) 909-9466',
    'phone_e164'    => '+18889099466',
    'email'         => 'support@nexisconetwork.ca',
    'response_time' => 'within 1 hour',

    /* ── Hours (Mountain Time) ───────────────────────────────── */
    'hours'           => 'Mon–Sat 9:00 am – 6:00 pm MT',
    'time_zone'       => 'America/Edmonton',
    'time_zone_label' => 'Mountain Time',
    'hours_spec'      => [ // machine-readable form of 'hours' for JSON-LD
        'days'   => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'opens'  => '09:00',
        'closes' => '18:00',
    ],

    /* ── Market ──────────────────────────────────────────────── */
    'service_area' => 'businesses in Canada and the US',
    'area_served'  => ['CA', 'US'],

    /* ── Monthly plan terms (shown on /pricing; Terms & policies must agree) ── */
    'min_term'            => '1 month',
    'cancellation_notice' => '14 days',
    'site_ownership'      => 'owned by nexisconetwork.ca, with all content and code licensed to the client on completion',
    'setup_fee'           => 'none',

    /* ── Privacy (PIPEDA accountability) ─────────────────────── */
    // OWNER: confirm who is accountable for privacy requests. Defaults to the
    // director at the main support address until a dedicated contact is named.
    'privacy_contact' => [
        'name'  => 'Aman Deshwal',
        'title' => 'Director',
        'email' => 'support@nexisconetwork.ca',
    ],

    /* ── Social profiles ─────────────────────────────────────── */
    // Real, active accounts only — e.g. ['linkedin' => 'https://…'].
    'social_profiles' => [],
];
