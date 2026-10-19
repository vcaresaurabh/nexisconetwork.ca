<?php
declare(strict_types=1);
/**
 * Nexisco Network — SEO & JSON-LD Schema helpers
 */

class Seo {

    /* ── Organization schema ──────────────────────────────────────
     * The site's ONLY organization block, emitted once per page by
     * partials/head.php. Every value comes from config/business.php.
     * Never add aggregateRating / review here.
     */
    public static function organization(): string {
        $url    = business('url');
        $office = business('registered_office');
        $hours  = business('hours_spec');
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'ProfessionalService',
            '@id'         => $url . '/#organization',
            'name'        => business('brand_name'),
            'legalName'   => business('legal_name'),
            'description' => business('brand_name') . ' is an ' . business('positioning')
                           . ', delivering web development, digital marketing, and ecommerce development.',
            'url'         => $url,
            'logo'        => $url . '/assets/img/logo.png',
            'image'       => $url . '/assets/img/og-image.png',
            'telephone'   => business('phone_e164'),
            'email'       => business('email'),
            'foundingDate' => business('founding_date'),
            'identifier'  => [
                '@type'      => 'PropertyValue',
                'propertyID' => business('jurisdiction_short') . ' Corporate Access Number',
                'value'      => business('corporate_access_no'),
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => $office['street'],
                'addressLocality' => $office['city'],
                'addressRegion'   => $office['region'],
                'postalCode'      => $office['postal_code'],
                'addressCountry'  => $office['country_code'],
            ],
            'openingHoursSpecification' => [[
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => $hours['days'],
                'opens'     => $hours['opens'],
                'closes'    => $hours['closes'],
            ]],
            'areaServed'         => self::area_served(),
            'currenciesAccepted' => 'USD, CAD',
            'paymentAccepted'    => 'Credit Card, Debit Card, Online Payment, Bank Transfer',
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name'  => 'Digital Services',
                'itemListElement' => [
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Web Development',       'url' => $url . '/services/web-development']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Digital Marketing',     'url' => $url . '/services/digital-marketing']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Ecommerce Development', 'url' => $url . '/services/ecommerce-development']],
                ],
            ],
        ];
        $social = array_values(business('social_profiles') ?? []);
        if ($social) $schema['sameAs'] = $social;
        return self::tag($schema);
    }

    /* ── WebSite schema ───────────────────────────────────────── */
    public static function website(): string {
        $url = business('url');
        $schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'WebSite',
            '@id'        => $url . '/#website',
            'url'        => $url,
            'name'       => business('brand_name'),
            'publisher'  => ['@id' => $url . '/#organization'],
            'inLanguage' => 'en-CA',
        ];
        return self::tag($schema);
    }

    /* ── Service schema ───────────────────────────────────────── */
    public static function service(array $service): string {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => $service['name'],
            'serviceType' => $service['name'],
            'description' => $service['description'] ?? $service['tagline'] ?? '',
            'provider'    => ['@id' => business('url') . '/#organization'],
            'areaServed'  => self::area_served(),
            'url'         => business('url') . '/services/' . ($service['slug'] ?? ''),
        ];
        return self::tag($schema);
    }

    /* ── FAQPage schema ───────────────────────────────────────── */
    public static function faq_page(array $faqs): string {
        $entities = [];
        foreach ($faqs as $faq) {
            $entities[] = [
                '@type'          => 'Question',
                'name'           => $faq['q'] ?? $faq['question'] ?? '',
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a'] ?? $faq['answer'] ?? ''],
            ];
        }
        $schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $entities,
        ];
        return self::tag($schema);
    }

    /* ── BreadcrumbList schema ────────────────────────────────── */
    public static function breadcrumbs(array $crumbs): string {
        $items = [];
        foreach ($crumbs as $i => $crumb) {
            $item = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $crumb['name'],
            ];
            if (!empty($crumb['url'])) $item['item'] = $crumb['url'];
            $items[] = $item;
        }
        $schema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
        return self::tag($schema);
    }

    /** ISO country codes from config/business.php → schema.org Country objects. */
    private static function area_served(): array {
        $names = ['CA' => 'Canada', 'US' => 'United States'];
        return array_map(
            fn(string $code) => ['@type' => 'Country', 'name' => $names[$code] ?? $code],
            business('area_served')
        );
    }

    private static function tag(array $schema): string {
        return '<script type="application/ld+json">'
             . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
             . '</script>';
    }
}
