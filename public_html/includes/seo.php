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
            'name'      => 'Nexisco Network',
            'legalName' => 'Nexisco Network',
            'url'       => 'https://nexisconetwork.ca',
            'logo'      => 'https://nexisconetwork.ca/assets/img/logo.png',
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
                'telephone'         => '+1-888-909-9466',
                'contactType'       => 'customer service',
                'email'             => 'support@nexisconetwork.ca',
                'areaServed'        => ['US', 'CA', 'Worldwide'],
                'availableLanguage' => ['English'],
            ]],
        ];
        return self::tag($schema);
    }

    /* ── ProfessionalService schema (global digital agency) ───── */
    public static function professional_service(): string {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'ProfessionalService',
            '@id'         => 'https://nexisconetwork.ca/#agency',
            'name'        => 'Nexisco Network',
            'legalName'   => 'Nexisco Network',
            'description' => 'Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce solutions for businesses in the US, Canada, and worldwide.',
            'url'         => 'https://nexisconetwork.ca',
            'telephone'   => '+1-888-909-9466',
            'email'       => 'support@nexisconetwork.ca',
            'image'       => 'https://nexisconetwork.ca/assets/img/og-image.png',
            'logo'        => 'https://nexisconetwork.ca/assets/img/logo.png',
            'priceRange'  => '$$',
            'currenciesAccepted' => 'USD, CAD',
            'paymentAccepted'    => 'Credit Card, Debit Card, Online Payment, Bank Transfer',
            'areaServed'         => ['US', 'CA', 'Worldwide'],
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '1404, 49A Street NW',
                'addressLocality' => 'Edmonton',
                'addressRegion'   => 'AB',
                'postalCode'      => 'T6L 6H6',
                'addressCountry'  => 'CA',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name'  => 'Digital Services',
                'itemListElement' => [
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Web Development',        'url' => 'https://nexisconetwork.ca/services/web-development']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Digital Marketing',      'url' => 'https://nexisconetwork.ca/services/digital-marketing']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Ecommerce Development',  'url' => 'https://nexisconetwork.ca/services/ecommerce-development']],
                ],
            ],
        ];
        return self::tag($schema);
    }

    /* Backwards-compatible alias (some pages still call local_business()). */
    public static function local_business(): string {
        return self::professional_service();
    }

    /* ── Service schema ───────────────────────────────────────── */
    public static function service(array $service): string {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => $service['name'],
            'serviceType' => $service['name'],
            'description' => $service['description'] ?? $service['tagline'] ?? '',
            'provider'    => ['@type' => 'Organization', 'name' => 'Nexisco Network'],
            'areaServed'  => ['US', 'CA', 'Worldwide'],
            'url'         => 'https://nexisconetwork.ca/services/' . ($service['slug'] ?? ''),
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

    private static function tag(array $schema): string {
        return '<script type="application/ld+json">'
             . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
             . '</script>';
    }
}
