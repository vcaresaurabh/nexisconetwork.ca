<?php
declare(strict_types=1);
/**
 * Nexisco Network — SEO & JSON-LD Schema helpers
 */

class Seo {

    /* ── Organization schema ──────────────────────────────────── */
    public static function organization(): string {
        $schema = [
            '@context'  => 'https://schema.org',
            '@type'     => 'Organization',
            'name'      => 'Nexisco Network Inc.',
            'legalName' => 'Nexisco Network Inc.',
            'url'       => 'https://nexisconetwork.ca',
            'logo'      => 'https://nexisconetwork.ca/assets/img/og-image.png',
            'sameAs'    => [],
            'address'   => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '1404, 49A Street NW',
                'addressLocality' => 'Edmonton',
                'addressRegion'   => 'AB',
                'postalCode'      => 'T6L 6H6',
                'addressCountry'  => 'CA',
            ],
            'contactPoint' => [[
                '@type'             => 'ContactPoint',
                'telephone'         => '+1-825-771-7727',
                'contactType'       => 'customer service',
                'email'             => 'support@nexisconetwork.ca',
                'areaServed'        => 'CA',
                'availableLanguage' => ['English'],
            ]],
        ];
        return self::tag($schema);
    }

    /* ── LocalBusiness schema ─────────────────────────────────── */
    public static function local_business(): string {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => ['LocalBusiness', 'ComputerStore'],
            'name'        => 'Nexisco Network Inc.',
            'legalName'   => 'Nexisco Network Inc.',
            'description' => 'Professional IT services in Canada. Virus removal, PC repair, data recovery, network setup, remote support, and business IT solutions. Headquartered in Edmonton, Alberta.',
            'url'         => 'https://nexisconetwork.ca',
            'telephone'   => '+1-825-771-7727',
            'email'       => 'support@nexisconetwork.ca',
            'image'       => 'https://nexisconetwork.ca/assets/img/og-image.png',
            'priceRange'  => '$$',
            'currenciesAccepted' => 'CAD',
            'paymentAccepted'    => 'Cash, Credit Card, Debit, Interac e-Transfer',
            'areaServed'         => 'Canada',
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '1404, 49A Street NW',
                'addressLocality' => 'Edmonton',
                'addressRegion'   => 'AB',
                'postalCode'      => 'T6L 6H6',
                'addressCountry'  => 'CA',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => 53.5461,
                'longitude' => -113.4938,
            ],
            'openingHoursSpecification' => [
                ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '09:00', 'closes' => '18:00'],
                ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Saturday', 'opens' => '10:00', 'closes' => '16:00'],
            ],
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => '247',
            ],
        ];
        return self::tag($schema);
    }

    /* ── Service schema ───────────────────────────────────────── */
    public static function service(array $service): string {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => $service['name'],
            'description' => $service['description'] ?? $service['tagline'] ?? '',
            'provider'    => ['@type' => 'Organization', 'name' => 'Nexisco Network Inc.'],
            'areaServed'  => 'Canada',
            'url'         => 'https://nexisconetwork.ca/services/' . ($service['slug'] ?? ''),
        ];
        if (!empty($service['price_from'])) {
            $schema['offers'] = [
                '@type'         => 'Offer',
                'price'         => $service['price_from'],
                'priceCurrency' => 'CAD',
            ];
        }
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

    private static function tag(array $schema): string {
        return '<script type="application/ld+json">'
             . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
             . '</script>';
    }
}
