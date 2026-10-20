# Phase 0 inventory — nexisconetwork.ca (read-only, 19–20 October 2026)

Read-only inventory of the site **before** the pre-appeal fixes. Every `file:line` reference points into `main` at `94dd99e`, not into the current branch; rendered-page results come from a local `php -S` server running that snapshot. What was changed as a result is in [pre-appeal-changes-2026-10-20.md](pre-appeal-changes-2026-10-20.md).

Sections: 1) site structure and business-detail locations, 2) metadata, JSON-LD, sitemap, robots, redirects, scripts and social links, 3) keyword sweep, 4) rules that could vary content by visitor, live crawler probe and route list.



---

<!-- structure -->

## 1. Site chrome

### Header / nav: `public_html/partials/navbar.php`
| Block | Lines | Content / hrefs |
|---|---|---|
| Docblock + `$SERVICES` include | 1-10 | `require_once data/services.php` (8) |
| `<header id="navbar">` / `<nav>` | 12-105 | |
| Logo link → `/` | 16-24 | img 17-23 `/assets/img/logo.png?v=2` (+@2x/@3x srcset), alt "Nexisco Network" |
| Desktop link list | 27-82 | Home `/` 29 · Portfolio `/portfolio` 77 · Pricing `/pricing` 78 · About `/about` 79 · FAQ `/faq` 80 · Contact `/contact` 81 |
| Services mega-dropdown | 32-75 | trigger button 33-39 · panel 42-74 · loop over `$SERVICES` 47-67 → `/services/{slug}` (name + tagline) · "View all services →" `/services` 69-73 |
| Desktop CTAs | 85-94 | phone link 86-92 (`tel:+18889099466`, text "+1 (888) 909-9466" at 91) · "Get a Free Quote" → `/start-project` 93 |
| Hamburger `#menu-btn` | 97-103 | |
| Mobile drawer `#mobile-nav` | 108-159 | drawer header + logo 114-130 (img 116-122, alt "Nexisco Network") · close `#menu-close` 124-129 |
| Drawer links | 132-151 | Home 133 · Services 134 · Portfolio `/portfolio` 135 · Pricing 136 · About 137 · FAQ 138 · Contact 139 · "Services" sub-list loop 141-150 |
| Drawer CTAs | 153-158 | "Call +1 (888) 909-9466" `tel:+18889099466` 154-156 · "Get a Free Quote" → `/start-project` 157 |
| Inline drawer open/close JS | 161-185 | |
| Other global chrome (head.php) | `public_html/partials/head.php` 251-252, 272-273, 275-277 | scroll-progress bar · custom cursor · page-transition overlay |

### Footer: `public_html/partials/footer.php`
| Block | Lines | Content |
|---|---|---|
| Docblock | 1-6 | "Newsletter (CASL consent) + business block + trust badges + link columns" |
| `<footer id="footer">` | 18-188 | |
| Background layer | 21-28 | Unsplash img 23-25 (owner note at 22: "replace with final footer background image") · gradient 26 · bg-grid 28 |
| Newsletter strip | 32-68 | H3 "Grow with us" 37 · blurb 38-40 ("Web, marketing, and ecommerce insights … (CASL compliant.)") · `form[data-newsletter-form]` 43-65 · honeypot 45 · **hidden `casl_consent` value="1"** 46 (no checkbox) · email input 50-54 · "Subscribe" 56 · consent text 59-63 (Privacy link 62) · message slot 64 · JS `public_html/assets/js/app.js:912-946` → `/api/newsletter` |
| Main grid | 71-151 | |
| Brand column | 75-112 | logo link 76-84 (img 77-83) |
| Brand tagline | 85-87 | 86: "Web. Marketing. Ecommerce. Growth, engineered. A global digital agency for businesses in the US, Canada, and worldwide." |
| Contact `<address>` | 89-111 | phone 90-94 · email 95-99 · street address 100-103 · hours 104-107 · time-zones note 108-110 |
| Services column | 114-123 | Web Development 118 · Digital Marketing 119 · Ecommerce Development 120 · All Services 121 |
| Company column | 125-136 | About Us 129 · Portfolio `/portfolio` 130 · Pricing 131 · Partner Program 132 · FAQ 133 · Contact 134 |
| Legal column | 138-150 | Privacy 142 · Terms 143 · Refund 144 · Cancellation 145 · Cookie 146 · Disclaimer 147 · Opt-In/Opt-Out 148 |
| Trust & payment badges | 153-178 | badge array 160-165 (SSL Secured · PIPEDA Compliant · CASL Compliant · Payments in USD & CAD) · loop 166-172 · owner note 174 · 176: "We accept major credit & debit cards, PayPal, and bank/wire transfer." |
| Copyright | 180-183 | 181: `© <?= date('Y') ?> Nexisco Network All rights reserved.` · 182: "Serving clients in the US, Canada & worldwide. Payments in USD & CAD; applicable taxes added where required." |

### Floating widget + preloader
| Component | Location | Notes |
|---|---|---|
| Floating quote widget markup | `public_html/partials/footer.php:8-16` | `#booking-widget` → `a.widget-btn href="/start-project"` (10), aria-label "Get a free quote", chat-bubble SVG 11-14 |
| Widget show/hide JS | `public_html/assets/js/app.js:105-118` | ScrollTrigger `start: '300px top'` toggles `.visible` |
| Widget CSS | `src/input.css:1579-1622`, `1740-1743` (mobile) | fixed bottom-right 56px gradient circle with pulse |
| Preloader critical CSS | `public_html/partials/head.php:144-159` | `#preloader` fixed overlay; `body{overflow:hidden}` |
| Preloader markup | `public_html/partials/head.php:254-270` | role=status, aria-label "Loading Nexisco Network" · logo img 256-260 `/assets/img/logo-mark.png` alt "Nexisco Network" · bar 262-264 · counter 266 · curtain 269 |
| Preloader script tag | `public_html/partials/scripts.php:12` | blocking, before GSAP |
| Preloader logic | `public_html/assets/js/preloader.js:1-196` | MIN 250 ms / MAX 1500 ms (11-12) · preloads `#hero video[poster]` + `img[data-preload]` (112-125) · exit 64-95 |
| Preloader CSS (compiled) | `src/input.css:1015-1063` | |
| Hero typewriter phrases | `public_html/assets/js/app.js:698-719` | 702: 'web development', 'digital marketing', 'SEO & paid ads', 'ecommerce stores', 'conversion design' |

## 2. Hard-coded business details

| File:line | Detail type | Exact text |
|---|---|---|
| public_html/partials/head.php:70 | Region (geo meta) | `<meta name="geo.region" content="CA-AB">` |
| public_html/partials/head.php:72 | City (geo meta) | `content="Edmonton, Alberta"` |
| public_html/partials/head.php:73 | Geo coords | `content="53.5461;-113.4938"` |
| public_html/partials/head.php:74 | Geo coords (ICBM) | `content="53.5461, -113.4938"` |
| public_html/partials/head.php:167 | Name (JSON-LD ProfessionalService) | `"name": "Nexisco Network",` |
| public_html/partials/head.php:168 | Legal name (JSON-LD) | `"legalName": "Nexisco Network",` |
| public_html/partials/head.php:174 | Phone (JSON-LD) | `"telephone": "+1-888-909-9466",` |
| public_html/partials/head.php:175 | Email support@ (JSON-LD) | `"email": "support@nexisconetwork.ca",` |
| public_html/partials/head.php:182 | Street (JSON-LD) | `"streetAddress": "1404, 49A Street NW",` |
| public_html/partials/head.php:183-186 | City/region/postal/country | `"Edmonton"` · `"AB"` · `"T6L 6H6"` · `"CA"` |
| public_html/partials/head.php:190-191 | Geo coords (JSON-LD) | `53.5461` / `-113.4938` |
| public_html/partials/head.php:195 | Phone (contactPoint) | `"telephone": "+1-888-909-9466",` |
| public_html/partials/head.php:197 | Email support@ (contactPoint) | `"email": "support@nexisconetwork.ca",` |
| public_html/partials/navbar.php:86 | Phone tel: | `href="tel:+18889099466"` |
| public_html/partials/navbar.php:91 | Phone display | `+1 (888) 909-9466` |
| public_html/partials/navbar.php:154 | Phone tel: | `href="tel:+18889099466"` |
| public_html/partials/navbar.php:155 | Phone display | `Call +1 (888) 909-9466` |
| public_html/partials/footer.php:60-61 | Name (CASL consent) | "By subscribing you expressly consent to receive commercial electronic messages from / Nexisco Network. You may unsubscribe at any time." |
| public_html/partials/footer.php:91 | Phone tel: | `href="tel:+18889099466"` |
| public_html/partials/footer.php:92 | Phone display | `📞 +1 (888) 909-9466` |
| public_html/partials/footer.php:96 | Email mailto | `href="mailto:support@nexisconetwork.ca"` |
| public_html/partials/footer.php:97 | Email display | `✉️ support@nexisconetwork.ca` |
| public_html/partials/footer.php:101 | Street | `📍 1404, 49A Street NW<br>` |
| public_html/partials/footer.php:102 | City/postal | `Edmonton, Alberta T6L 6H6, Canada` |
| public_html/partials/footer.php:105 | Hours | `🕑 Mon–Fri 8am–7pm PT · Sat 9am–5pm PT<br>` |
| public_html/partials/footer.php:106 | Hours (support) | `Support: 9am–8pm, 7 days` |
| public_html/partials/footer.php:181 | Name (copyright) | `© <?= date('Y') ?> Nexisco Network All rights reserved.` |
| public_html/includes/seo.php:14 | Name (Organization schema) | `'name' => 'Nexisco Network',` |
| public_html/includes/seo.php:15 | Legal name (Organization) | `'legalName' => 'Nexisco Network',` |
| public_html/includes/seo.php:21-25 | Address (Organization) | `'1404, 49A Street NW'` · `'Edmonton'` · `'AB'` · `'T6L 6H6'` · `'CA'` |
| public_html/includes/seo.php:29 | Phone | `'telephone' => '+1-888-909-9466',` |
| public_html/includes/seo.php:31 | Email support@ | `'email' => 'support@nexisconetwork.ca',` |
| public_html/includes/seo.php:45 | Name (ProfessionalService) | `'name' => 'Nexisco Network',` |
| public_html/includes/seo.php:46 | Legal name (ProfessionalService) | `'legalName' => 'Nexisco Network',` |
| public_html/includes/seo.php:49 | Phone | `'telephone' => '+1-888-909-9466',` |
| public_html/includes/seo.php:50 | Email support@ | `'email' => 'support@nexisconetwork.ca',` |
| public_html/includes/seo.php:59-63 | Address (ProfessionalService) | `'1404, 49A Street NW'` · `'Edmonton'` · `'AB'` · `'T6L 6H6'` · `'CA'` |
| public_html/includes/seo.php:91 | Name (Service.provider) | `'provider' => ['@type' => 'Organization', 'name' => 'Nexisco Network'],` |
| public_html/includes/mailer.php:37 | From email/name fallback | `'noreply@nexisconetwork.ca'`, `'Nexisco Network'` |
| public_html/includes/mailer.php:126 | Name (CASL email footer) | "You're receiving this email from Nexisco Network because you requested a service or opted in…" |
| public_html/includes/mailer.php:127 | Name | `<strong style="color:#475569">Nexisco Network</strong><br>` |
| public_html/includes/mailer.php:128 | Address | `1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada<br>` |
| public_html/includes/mailer.php:129 | Phone + email (plain text) | `Phone: +1 (888) 909-9466 · Email: support@nexisconetwork.ca<br><br>` |
| public_html/includes/mailer.php:133 | Name (copyright) | `© {$year} Nexisco Network All rights reserved.` |
| public_html/api/contact.php:76 | Email (commented recipient) | `// send_mail('support@nexisconetwork.ca', 'Nexisco Network', $subject, $body);` |
| public_html/api/contact.php:86 | Response time | "…will reply within 2 business hours." |
| public_html/api/partners.php:21 | Response time | "We'll review it within 1 business day." |
| public_html/api/partners.php:58 | Email partners@ (commented) | `// NOTE (owner): send_mail('partners@nexisconetwork.ca', 'Nexisco Network', …` |
| public_html/api/partners.php:67 | Response time | "…be in touch within 1 business day." |
| public_html/config/config.php:18 | Email (SMTP user) | `'user' => 'noreply@nexisconetwork.ca',` |
| public_html/config/config.php:20 | Email (from) | `'from_address' => 'noreply@nexisconetwork.ca',` |
| public_html/config/config.php:21 | Name (from) | `'from_name' => 'Nexisco Network',` |
| public_html/config/config.php:22 | Email admin@ | `'admin_email' => 'admin@nexisconetwork.ca',` |
| public_html/config/config.php:27 | Timezone | `'timezone' => 'America/Edmonton',` |
| public_html/config/config.sample.php:18,20,21,22,27 | Same as config.php | identical values |
| .env.example:34 | Email (SMTP) | `SMTP_USER=noreply@nexisconetwork.ca` |
| public_html/site.webmanifest:2 | Name, the only "Inc." anywhere | `"name": "Nexisco Network Inc.",` |
| public_html/site.webmanifest:4 | City (stale IT copy) | `"Smart IT. Seamless Support. Professional IT services across Canada — headquartered in Edmonton, Alberta."` |
| public_html/pages/about.php:290 | City / founding | "Nexisco Network was established in 2026 and is headquartered in Edmonton, Alberta, Canada." |
| public_html/pages/about.php:309 | Legal entity | `['k' => 'Legal entity', 'v' => 'Nexisco Network'],` |
| public_html/pages/about.php:310 | Established | `['k' => 'Established', 'v' => '2026'],` |
| public_html/pages/about.php:311 | Address | `'1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada'` |
| public_html/pages/about.php:314 | Governing law | `'Province of Alberta, Canada'` |
| public_html/pages/about.php:327 | Phone tel: + display | `href="tel:+18889099466"` … `+1 (888) 909-9466` |
| public_html/pages/about.php:331 | Email mailto + display | `href="mailto:support@nexisconetwork.ca"` … `support@nexisconetwork.ca` |
| public_html/pages/about.php:333 | Hours | `Hours: Mon–Fri 8am–7pm PT · Sat 9am–5pm PT` |
| public_html/pages/contact.php:28 | Response time | "we respond within 2 business hours." |
| public_html/pages/contact.php:46 | Phone display + tel: | `'value' => '+1 (888) 909-9466', 'href' => 'tel:+18889099466'` |
| public_html/pages/contact.php:48 | Email + mailto | `'value' => 'support@nexisconetwork.ca', 'href' => 'mailto:support@nexisconetwork.ca'` |
| public_html/pages/contact.php:50 | Hours | `'Mon–Fri 8am–7pm PT · Sat 9am–5pm PT'` |
| public_html/pages/contact.php:52 | Address ("Head Office", uses "AB") | `'1404, 49A Street NW, Edmonton, AB T6L 6H6, Canada'` |
| public_html/pages/contact.php:90 | Response time | "We'll get back to you within 2 business hours." |
| public_html/pages/start-project.php:67 | Response time | "usually within 1–2 business days." |
| public_html/pages/start-project.php:84 | Phone tel: + display | `Call <a href="tel:+18889099466" …>+1 (888) 909-9466</a>` |
| public_html/pages/start-project.php:85 | Email mailto + display | `email <a href="mailto:support@nexisconetwork.ca" …>support@nexisconetwork.ca</a>.` |
| public_html/pages/partners.php:156 | Response time | "reply within 1 business day." |
| public_html/pages/partners.php:184 | Phone used as form placeholder | `placeholder="+1 (888) 909-9466"` |
| public_html/pages/partners.php:228 | Email mailto + display | `Questions? Email <a href="mailto:support@nexisconetwork.ca" …>support@nexisconetwork.ca</a>.` |
| public_html/pages/faq.php:124 | Hours | "Our team replies during business hours, Mon–Fri 8am–7pm PT." |
| public_html/data/faqs.php:18 | City | "We are headquartered in Edmonton, Alberta, Canada, and we work with clients…" |
| public_html/pages/privacy.php:28 | Name + address (entity intro) | "Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada) ("Nexisco Network", "we", "our", "us")" |
| public_html/pages/privacy.php:53 | Email privacy@ | `<a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>` |
| public_html/pages/privacy.php:78 | Email privacy@ | `Email <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>` |
| public_html/pages/privacy.php:92 | Name | `<strong>Privacy Officer — Nexisco Network</strong>` |
| public_html/pages/privacy.php:93-95 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/privacy.php:96 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/privacy.php:97 | Email privacy@ | `Email: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>` |
| public_html/pages/terms.php:25 | Name + "registered office" address | "…between you … and Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada ("Nexisco Network", "Company", …)" |
| public_html/pages/terms.php:28 | Name | "Nexisco Network provides three categories of professional services" |
| public_html/pages/terms.php:54 | Name | "…remain the property of Nexisco Network." |
| public_html/pages/terms.php:81 | Name (×2) | "the total aggregate liability of Nexisco Network…" · "In no event shall Nexisco Network be liable…" |
| public_html/pages/terms.php:93 | Name + venue | "…Judicial District of Edmonton, save that Nexisco Network may seek injunctive…" |
| public_html/pages/terms.php:101 | Phone tel: + support@ | `contact us at <a href="tel:+18889099466">+1 (888) 909-9466</a> or <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>` |
| public_html/pages/terms.php:109 | Name | `<strong>Nexisco Network</strong>` |
| public_html/pages/terms.php:110-112 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/terms.php:113 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/terms.php:114 | Email support@ | `Email: <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>` |
| public_html/pages/refund-policy.php:28 | Name + registered office | "…issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada…" |
| public_html/pages/refund-policy.php:74 | Email support@ | `email <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>` |
| public_html/pages/refund-policy.php:94 | Name | `<strong>Nexisco Network</strong>` |
| public_html/pages/refund-policy.php:95-97 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/refund-policy.php:98 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/refund-policy.php:99 | Email support@ | `Email: <a href="mailto:support@nexisconetwork.ca">…</a>` |
| public_html/pages/refund-policy.php:100 | Hours | `Hours: Mon–Fri 8am–7pm PT · Sat 9am–5pm PT.` |
| public_html/pages/cancellation-policy.php:27 | Name + registered office | "…issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada…" |
| public_html/pages/cancellation-policy.php:38 | Email support@ | `written notice to <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>` |
| public_html/pages/cancellation-policy.php:74 | Name | `<strong>Nexisco Network</strong>` |
| public_html/pages/cancellation-policy.php:75-77 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/cancellation-policy.php:78 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/cancellation-policy.php:79 | Email support@ | `Email: <a href="mailto:support@nexisconetwork.ca">…</a>` |
| public_html/pages/cookie-policy.php:27 | Name + registered office | "This Cookie Policy is issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada…" |
| public_html/pages/cookie-policy.php:117 | Name | `<strong>Privacy Officer — Nexisco Network</strong>` |
| public_html/pages/cookie-policy.php:118-120 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/cookie-policy.php:121 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/cookie-policy.php:122 | Email privacy@ | `Email: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>` |
| public_html/pages/disclaimer.php:27 | Name (×2) + registered office | "This Disclaimer is issued by Nexisco Network, a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada (…). Nexisco Network is a global digital agency…" |
| public_html/pages/disclaimer.php:43 | Name | "…endorsement between Nexisco Network and those third parties…" |
| public_html/pages/disclaimer.php:46 | Name | "…not owned or controlled by Nexisco Network." |
| public_html/pages/disclaimer.php:49 | Name | "…relationship between you and Nexisco Network." |
| public_html/pages/disclaimer.php:52 | Name | "To the fullest extent permitted by applicable law, Nexisco Network, its directors…" |
| public_html/pages/disclaimer.php:59 | Name | `<strong>Nexisco Network</strong>` |
| public_html/pages/disclaimer.php:60-62 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/disclaimer.php:63 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/disclaimer.php:64 | Email support@ | `Email: <a href="mailto:support@nexisconetwork.ca">…</a>` |
| public_html/pages/opt-in-opt-out.php:28 | Name + "headquartered at" address | "Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada) ("Nexisco Network", …)" |
| public_html/pages/opt-in-opt-out.php:51 | Email support@ | `email us at <a href="mailto:support@nexisconetwork.ca">…</a> with "Unsubscribe"` |
| public_html/pages/opt-in-opt-out.php:56 | Email support@ | `or by emailing <a href="mailto:support@nexisconetwork.ca">…</a>` |
| public_html/pages/opt-in-opt-out.php:59 | Email support@ | `or email <a href="mailto:support@nexisconetwork.ca">…</a>` |
| public_html/pages/opt-in-opt-out.php:70 | Name | `<strong>Nexisco Network — Communications &amp; CASL Compliance</strong>` |
| public_html/pages/opt-in-opt-out.php:71-73 | Address | `1404, 49A Street NW` / `Edmonton, Alberta T6L 6H6` / `Canada` |
| public_html/pages/opt-in-opt-out.php:74 | Phone tel: + display | `Phone: <a href="tel:+18889099466">+1 (888) 909-9466</a>` |
| public_html/pages/opt-in-opt-out.php:75 | Email support@ | `Email: <a href="mailto:support@nexisconetwork.ca">…</a>` |
| public_html/pages/opt-in-opt-out.php:76 | Email privacy@ | `Privacy matters: <a href="mailto:privacy@nexisconetwork.ca">privacy@nexisconetwork.ca</a>` |
| public_html/500.html:39 | Email support@ | `email <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a>` |

## 3. Homepage sections: `public_html/pages/home.php`

| # | Section id / name | Lines | Eyebrow / headline | Notable content (CTAs → href; images + alt) |
|---|---|---|---|---|
| 0 | Setup | 1-43 | title 16 "Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency" | `$home_faqs` = first 5 General FAQs 21 · portfolio preview = first 2 per web/marketing/ecommerce 24-30 · plans starter/pro/advanced 33-34 · JSON-LD Organization + ProfessionalService + FAQPage 36-39 |
| 1 | `#hero` | 48-177 | pill 115 "Global digital agency · Serving the US, Canada & worldwide" · H1 119-125 "We build, / market & scale." | sub 128-135 "Expert [typewriter] for ambitious brands. High-performing websites, data-driven marketing, and ecommerce stores that sell — in the US, Canada & worldwide." · CTAs 139 "Get a Free Quote" → `/start-project`, 140 "View Our Work →" → `/portfolio` · trust chips 146-151 (Serving the US & Canada / Billed in USD & CAD / Results-Focused / Global Delivery) · floating chips 163-170 "Conversion-focused", "Senior-level talent" · `<video>` 52-56 poster `/assets/img/hero/hero-poster.jpg` (no sources; owner note 55) · img 58-62 Unsplash `1559028012-481c04fa702d`, alt "", `data-preload` · orbit SVG icons 74-103 · canvas 106 |
| 2 | Trust marquee (aria "What we do") | 182-203 | none | items 189-194: Web Development, UI/UX, SEO, Google Ads, Social Media, Shopify, WooCommerce, Conversion Optimization, Email Marketing, Branding, Global Clients, USD & CAD (×2) |
| 3 | `#stats` | 208-247 | "Our Track Record" 224 · H2 "Results that compound" 225 | sub 226 "Measurable outcomes for brands, startups, and growing businesses worldwide." · value tiles 233-238 (US · CA · Worldwide / 3 Core Services / USD & CAD / Senior Specialists) · bg img 212-215 Unsplash `1451187580459-43490279c0fa` alt "" (owner note 211) · no CTA |
| 4 | `#services` (What We Do) | 252-301 | "What We Do" 258 · H2 "Three pillars. One partner." 259 | sub 260 · cards loop 264-294 → `/services/{slug}` (265), CSS bg `card_image` (270, no alt), "Learn more →" 289 · CTA "View All Services" → `/services` 298 |
| 5 | `#why-us` | 306-380 | "Why Nexisco" 339 · H2 "The growth team your brand actually needs." 340-342 | **img 315-318 Unsplash `1522071820081-009f0129c71c`, alt "The Nexisco Network team collaborating on a digital project"** (owner note 314 "replace with a real team / studio photo") · badges 321-334 ("Global delivery across time zones"; "USD & CAD / Transparent, results-driven pricing") · para 343-346 · benefits 349-356 (Senior-Level Talent, Conversion-Focused Design, Data-Driven Marketing, Transparent Reporting, Global Delivery, Dedicated Project Manager) · CTA "About Nexisco →" → `/about` 375 |
| 6 | How it works intro | 385-393 | "The Process" 388 · H2 "From idea to launch in 4 steps" 389 | sub 390 "A clear, collaborative engagement — you approve every stage." |
| 7 | How it works horizontal scroll | 395-440 | step H3s 419-422 | steps 399-404: 01 Discovery & Quote (img `1517245386807-bb43f82c33c4`), 02 Strategy & Proposal (`1454165804606-c3d57bc86b40`), 03 Design & Build (`1531403009284-440f080d1e12`), 04 Launch & Optimize (`1460925895917-afdab827c52f`) · rendered img 408-409 alt "" |
| 8 | `#work` Portfolio preview | 445-480 | "Featured Work" 449 · H2 "A look at what we build" 450 | sub 451 + "See the full portfolio →" → `/portfolio` · 6 cards 455-473, each `<a href="/portfolio">` 456 · img 459-463 alt "{title} — {tag}" (rendered: Corporate Website — Web Design; Agency Platform — Web Design; SEO Campaign — Digital Marketing; Analytics Dashboard — Digital Marketing; Online Store — Ecommerce; Product Page — Ecommerce) · onerror fallback 460 `1559028012-481c04fa702d` · CTA "View Full Portfolio" → `/portfolio` 477 · no "illustrative" disclaimer here |
| 9 | `#pricing-preview` | 485-539 | "Pricing" 490 · H2 "Plans for every growth stage" 491 | sub 492 · cards 496-531 (Starter $99, Pro $549 "Most Popular", Advanced $999; "/mo · USD / CAD" 511; first 5 features) · "View Plan" → `/pricing` 527 · note 534-537 + "See all 5 plans →" → `/pricing` 536 |
| 10 | `#why-clients` | 545-586 | "Why Nexisco" 556 · H2 "Why clients choose Nexisco" 557 | comment 541-544 (reviews carousel removed until genuine testimonials exist) · bg img 548-550 Unsplash `1497366754035-f200968a6e72` alt "" · cards 563-568 (Senior-level talent / Conversion-focused builds / Transparent reporting / Global, on-time delivery) · CTA "Be our next success story →" → `/start-project` 583 |
| 11 | `#faq-teaser` | 591-619 | "Got Questions?" 597 · H2 "Frequently Asked Questions" 598 | loop 602-612 over `public_html/data/faqs.php:15-24` · CTA "View All FAQs →" → `/faq` 616 |
| 12 | `#cta` | 624-665 | "Ready to grow?" 643 · H2 "Let's build something / that performs." 644-646 | para 647-650 · `<video>` poster `/assets/img/backgrounds/cta-poster.jpg` 627-629 · img 631-633 Unsplash `1531403009284-440f080d1e12` alt "" (owner note 630) · CTAs 653 "Get a Free Quote" → `/start-project`, 654 "View Our Work" → `/portfolio` · ticks 659-661 |
| 13 | Footer + scripts | 667-668 | | |

## 4. Other pages

### About: `public_html/pages/about.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-19 | title 12 "About Nexisco Network — Building Digital Experiences That Drive Growth" | Seo::organization 15 |
| Hero | 24-44 | "About Us" 35 · H1 "Building digital experiences / that drive growth." 36-38 | para 39-42 · bg img 26-28 |
| Business model & payments | 49-108 | "How We Work" 55 · H2 "Our business model & payments." 56 | paras 58-72 · "Get a Free Quote" → `/start-project` 75 · "See Pricing" → `/pricing` 76 · "At a glance" card 81-105 (items 85-91) |
| Mission | 113-142 | "Our Mission" 117 · H2 "Helping brands grow online" 118 | sub 119 · 4 cards 124-129 |
| What we do | 147-217 | "What We Do" 151 · H2 "Three pillars. One partner." 152 | pillars 158-180 → `/services/{slug}` 182 ("Explore {name} →" 207) · "View All Services" → `/services` 214 |
| Value band | 222-239 | none | "Global Delivery" / "Full-Service Team" 227-230 |
| Why choose | 244-275 | "Why Nexisco" 248 · H2 "The growth team your brand actually needs." 249 | sub 250 · reasons 255-262 (Proven Expertise, Strategic & Creative Thinking, Client-Centered Approach, Results That Matter, Scalable Solutions, Global Delivery) |
| Company details | 280-339 | "Company Details" 286 · H2 "A global agency, / rooted in Canada." 287 | paras 289-296 · "Get in Touch" → `/contact` 299 · **"View Our Work" → `/portfolio` 300** · details list 308-315 · phone/email/hours 324-335 |
| Team | 344-373 | "Our Team" 348 · H2 "A full-service team on your side" 349 | sub 350 · disciplines 355-360 (emoji icons, no photos) |
| CTA | 378-393 | H2 "Ready to grow with us?" 383 | para 384-387 · "Get a Free Quote" → `/start-project` 389 · "Contact Us" → `/contact` 390 |

### Contact: `public_html/pages/contact.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-12 | title 5 "Contact Us \| Nexisco Network" | Seo::professional_service 8 |
| Hero | 15-32 | "Contact" 25 · H1 "Let's talk growth." 26 | para 27-30 · bg img 17-19 |
| Info column | 41-84 | none | channels array 44-53 (Phone/Email/Hours/Head Office), loop 54-74 · Payments card 77-83 |
| Form column | 87-142 | H2 "Send us a message" 89 | 90 "within 2 business hours" · `#contact-form` 92-140 (service select 115-122) · "Send Message" 134-136 · PIPEDA note 137-139 |
| Form JS | 147-175 | | POST `/api/contact` |
| /portfolio CTAs | none | | |

### Pricing: `public_html/pages/pricing.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-18 | title 5 "Pricing — Web, Marketing & Ecommerce Plans (USD & CAD) \| Nexisco Network" | price map 10-14 |
| Hero | 21-39 | "Pricing" 32 · H1 "Find the right plan / for your business." 33 | para 34-37 · bg img 23-25 |
| Tiers | 42-114 | none | USD/CAD toggle 49-62 · plan grid loop 65-107 · "Get Started" → `/start-project?plan={id}` 99-103 · note 109-112 |
| Pricing FAQ | 117-161 | "Pricing FAQ" 120 · H2 "Questions about plans" 121 | Q&As 126-137 · note 157-159 |
| CTA | 164-174 | H2 "Not sure which plan?" 168 | "Get a Free Quote" → `/start-project` 172 |
| /portfolio CTAs | none | | |

### Portfolio: `public_html/pages/portfolio.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-16 | title 6 "Portfolio — Web, Marketing, Ecommerce & Branding \| Nexisco Network" | description 7 "A selection of projects we craft for brands, startups, and growing businesses worldwide…" · breadcrumbs 9-12 |
| Hero | 19-35 | "Our Work" 29 · H1 "Our Portfolio" 30 | 31-33 "A selection of projects we've crafted for brands, startups, and growing businesses worldwide." · bg img 21-23 |
| Filterable grid | 38-94 | none | tabs 45-56 (categories `public_html/data/portfolio.php:12-18`) · owner note 58-59 · disclaimer 60-62 "A selection of the kinds of projects we deliver. Real client case studies are on the way." · cards 65-92 (img 75-80, H2 title 87, desc 88) |
| CTA | 97-107 | H2 "Like what you see?" 101 | para 102-104 · "Start Your Project" → `/start-project` 105 |

### Partners: `public_html/pages/partners.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-10 | title 4 "Partner Program — White-Label Web, Marketing & Ecommerce \| Nexisco Network" | |
| Hero | 13-35 | "Partner Program" 24 · H1 "Your brand. / Our delivery." 25 | para 26-29 · "Become a Partner" → `#apply` 31 · "How It Works" → `#how` 32 · bg img 15-17 |
| `#how` | 38-104 | "How It Works" 42 · H2 "Three ways to partner." 43 | para 44-47 · models 52-74 (Refer / White-Label "Most Popular" / Reseller) · note 99-102 |
| Benefits | 107-146 | "Why Partner With Us" 110 · H2 "Extend your team, / not your overhead." 111 | benefits 116-125 · note 141-144 |
| `#apply` | 149-233 | "Apply Now" 153 · H2 "Apply to the partner program." 154 | para 155-157 · `#partner-form` 161-230 (phone placeholder 184; model select named `monthly_referrals` 205-211) · consent/terms/privacy/support@ 225-229 |
| Form JS | 235-262 | | POST `/api/partners` |
| /portfolio CTAs | none | | |

### Start a Project: `public_html/pages/start-project.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-27 | title 5 "Start a Project — Get a Free Quote \| Nexisco Network" | `?service=` preselect 10-18 · `?plan=` message prefill 20-23 |
| Hero | 30-47 | "Start a Project" 40 · H1 "Get a free quote." 41 | para 42-45 · bg img 32-34 |
| "What happens next" column | 57-87 | H2 "What happens next" 59 | steps 65-69 · call/email box 83-86 |
| Form column | 90-170 | H2 "Project details" 92 | note 93 · `#project-form` 95-168 (service* 122-130, budget 132-144 with no currency in labels, currency 145-151, message 154-158) · "Get My Free Quote" 162-164 · PIPEDA note 165-167 |
| Form JS | 175-203 | | POST `/api/contact` |
| /portfolio CTAs | none | | |

### Services index: `public_html/pages/services-index.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-11 | title 5 "Services — Web Development, Digital Marketing & Ecommerce \| Nexisco Network" | |
| Hero | 14-34 | "Our Services" 25 · H1 "Three pillars. / One growth partner." 26-28 | para 29-32 · bg img 16-18 |
| Services grid | 37-103 | card H2 = service name 73 | loop 42-100 · card img 49-54 · price label 56-59 · tagline 74 · description 77-79 · top 3 capabilities 82-92 · "Learn More" → `/services/{slug}` 95 · "Get a Quote" → `/start-project?service={slug}` 96 |
| CTA band | 106-116 | H2 "Not sure where to start?" 110 | "Get a Free Quote" → `/start-project` 114 |
| /portfolio CTAs | none | | |

### Service detail template: `public_html/pages/service-detail.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup | 1-26 | title 13 "{name} \| Nexisco Network" | slug lookup 7-11 · JSON-LD Service + FAQPage + Breadcrumbs 16-22 |
| Hero | 29-76 | price_label tag 63 · H1 `{name}` 65 | bg img 31-34 · breadcrumbs 40-52 · description 66-68 · "Get a Free Quote" → `/start-project?service={slug}` 70-72 · "View Pricing" → `/pricing` 73 |
| What's included | 79-105 | "What's included" 83 · H2 "Everything you need to grow" 84 | sub 85-87 · capabilities loop 91-102 |
| Process | 108-129 | "Process" 112 · H2 "How we deliver" 113 | steps loop 117-126 |
| Deliverables + tech | 132-177 | "Deliverables" 138 · H2 "What you'll receive" 139 · "Tech & tools" 155 · H2 "What we work with" 156 | deliverables 140-150 · tech chips 157-164 · "Start your project →" → `/start-project?service={slug}` 170-171 |
| FAQ | 180-207 | "FAQ" 183 · H2 "Common questions" 184 | loop 188-204 |
| CTA | 210-225 | H2 "Ready to grow?" 214 | para 215-217 · "Get a Free Quote" → `/start-project?service={slug}` 219-221 · "All Services" → `/services` 222 |
| /portfolio CTAs | none | | |

### Services data: `public_html/data/services.php`
| Block | Lines | Key content |
|---|---|---|
| Docblock + owner note | 1-11 | 9-10 "hero_image / card_image use representative Unsplash stock. Swap in real brand/portfolio photography before launch." |
| `web-development` | 14-52 | tagline 17 "Fast, beautiful, conversion-ready websites." · description 18 · images 20-21 `1547658719-da2b51169166` · price_label 22 "Project & monthly plans" · capabilities 23-30 · process 31-36 · deliverables 37-43 · tech 44 · faqs 45-51 |
| `digital-marketing` | 53-91 | tagline 56 "Traffic, leads, and measurable ROI." · description 57 · images 59-60 `1460925895917-afdab827c52f` · price_label 61 "Monthly retainers" · capabilities 62-69 · process 70-75 · deliverables 76-82 · tech 83 · faqs 84-90 |
| `ecommerce-development` | 92-130 | tagline 95 "Online stores built to sell." · description 96 · images 98-99 `1556742502-ec7c0e9f34b1` · price_label 100 · capabilities 101-108 · process 109-114 · deliverables 115-121 · tech 122 · faqs 123-129 |

### FAQ: `public_html/pages/faq.php` + `public_html/data/faqs.php`
| Section | Lines | Eyebrow / headline | Notes / CTAs |
|---|---|---|---|
| Setup (faq.php) | 1-21 | title 14 "FAQ \| Nexisco Network — Digital Agency Questions Answered" | flatten 7-12 · FAQPage JSON-LD 17 |
| Hero | 24-41 | "FAQ" 31 · H1 "Answers, the / agency way." 32 | para 33-39 · "Reach out" → `/contact` 37 · "get a free quote" → `/start-project` 38 · no image |
| Accordion | 44-114 | category H2 81 | sidebar 52-71 · items 74-111 (first open, 85) |
| Still have questions | 117-131 | H2 "Still have questions?" 121 | para 122-125 · "Get a Free Quote" → `/start-project` 127 · "Contact Us" → `/contact` 128 |
| data: General | faqs.php 10-26 | items 15-24 | first 5 also on the homepage: services 15-16, location 17-18, payments 19-20, how projects start 21-22, timelines 23-24 |
| data: Projects & Process | faqs.php 27-43 | items 32-41 | |
| data: Pricing & Payment | faqs.php 44-60 | items 49-58 | |
| data: Web Development | faqs.php 61-75 | items 66-73 | |
| data: Digital Marketing | faqs.php 76-90 | items 81-88 | |
| data: Ecommerce | faqs.php 91-105 | items 96-103 | |
| /portfolio CTAs | none | | |

### Legal pages: `public_html/pages/*.php`
Every legal page shares the same layout: `$last_updated = 'June 18, 2026'` at line 6, a header section at 11-18 (label "Legal" at 14, H1 at 15, "Last updated" at 16), then a body section that starts at 20. None of them has a /portfolio CTA.

| Page | Body section | Intro notes | H2 sections (line) | Contact block | Other links |
|---|---|---|---|---|---|
| privacy.php (H1 "Privacy Policy") | 20-102 | 25 | 1 Our Commitment to Privacy 27 · 2 What Personal Information We Collect 30 · 3 How We Use… 41 · 4 Consent 52 · 5 Data Retention 56 · 6 Cross-Border Processing… 59 · 7 Disclosure… 63 · 8 Cookies and Tracking 71 · 9 Your Privacy Rights 74 · 10 Security 80 · 11 Children's Privacy 83 · 12 Changes 86 · 13 Contact Our Privacy Officer 89 | 91-99 | cookie-policy 38, 72 · opt-in 54 · priv.gc.ca / oipc.ab.ca 75 |
| terms.php (H1 "Terms of Service") | 20-121 | preamble 25 · template note 118 | 1 Scope of Services 27 · 2 Engagements, Quotes & Proposals 30 · 3 Payment Terms 39 · 4 Revisions 50 · 5 IP & Ownership 53 (portfolio rights 58) · 6 Client Responsibilities 61 · 7 Timelines & Delays 71 · 8 Third-Party Platforms 74 · 9 Marketing Results Disclaimer 77 · 10 Limitation of Liability 80 · 11 Termination 83 · 12 Governing Law & Dispute Resolution 92 · 13 Communications & CASL Consent 95 · 14 Changes 104 · 15 Contact 107 | 108-116 | "Get a Free Quote" → `/start-project` 115 |
| refund-policy.php (H1 "Refund Policy") | 20-106 | 25 | 1 About This Policy 27 · 2 Digital Professional Services — No Physical Returns 30 · 3 Deposits 33 · 4 Milestone Payments and WIP 36 · 5 What Is and Isn't Refundable 45 · 6 Monthly Plans and Retainers 62 · 7 Currency of Refunds 70 · 8 How to Request a Refund 73 · 9 Processing Time 76 · 10 Chargebacks 79 · 11 Statutory Consumer Rights 82 · 12 Governing Law 85 · 13 Changes 88 · 14 Contact Us 91 | 93-101 | Related 103: `/terms`, `/cancellation-policy`, `/start-project` |
| cancellation-policy.php (H1 "Cancellation Policy") | 20-83 | 25, 27 | 1 Scope 29 · 2 How to Cancel 37 · 3 Cancelling a Project Engagement 40 · 4 Cancelling a Monthly Retainer 48 · 5 Fees, Deposits, and Currency 56 · 6 How Cancellation Relates to Refunds 59 · 7 Cancellation by Us 62 · 8 Pausing Instead of Cancelling 65 · 9 Governing Law 68 · 10 Questions and Notices 71 | 73-80 | |
| cookie-policy.php (H1 "Cookie Policy") | 20-126 | 25, 27 | 1 What Are Cookies? 29 · 2 Why We Use Cookies 33 · 3 Types… 42 (3.1 44, 3.2 47, 3.3 50) · 4 Cookies We Currently Use 53 (table 55-90; owner note 91) · 5 Advertising and Cross-Site Tracking 94 · 6 Consent and the Cookie Banner 97 · 7 How to Manage or Disable Cookies 101 · 8 Changes 111 · 9 More Information and Contact 114 | 116-123 | browser help links 104-107 |
| disclaimer.php (H1 "Disclaimer") | 20-68 | 25, 27 | 1 General Information Only 29 · 2 No Professional (Legal or Financial) Advice 32 · 3 Marketing & SEO Results Vary 35 · 4 Dependence on Third-Party Platforms 39 · 5 No Partnership or Endorsement Implied 42 · 6 External Links 45 · 7 No Professional Relationship Until Engaged 48 · 8 Limitation of Liability 51 · 9 Governing Law 54 · 10 Contact 57 | 58-65 | |
| opt-in-opt-out.php (H1 "Opt-In / Opt-Out") | 20-80 | 25 | 1 About This Policy 27 · 2 Express Opt-In Consent Under CASL 30 · 3 What Subscribers Receive 34 (38 "Case studies and recent project highlights from our work") · 4 Transactional Messages Are Separate 44 · 5 How to Opt Out / Unsubscribe 47 · 6 SMS / Text-Message Consent 55 · 7 Re-Subscribing 58 · 8 How We Handle Your Data 61 · 9 Changes 64 · 10 Contact Us 67 | 69-77 | |

### 404 and 500
| Page | Lines | Headline | Notes / CTAs |
|---|---|---|---|
| `public_html/pages/404.php` setup | 1-8 | title 4 "404 — Page Not Found \| Nexisco Network" | description 5 |
| 404 section | 10-41 | "404" glitch text 25-28 · H1 "This Page Took a Wrong Turn" 29 | para 30-33 · bg img 15-16 · CTAs 35 "Get a Free Quote" → `/start-project`, 36 "Back to Home" → `/`, 37 "Our Services" → `/services`, **38 "View Portfolio" → `/portfolio`** |
| `public_html/500.html` | 1-46 | `<title>` 7 "Something went wrong — Nexisco Network" · "500" 36 · H1 "Something went wrong on our end" 37 | standalone page (no navbar/footer), noindex 6, inline CSS 8-32 · para 38-39 (support@) · CTAs 41 "Back to Home" → `/`, 42 "Get a Free Quote" → `/start-project` · wired via `public_html/.htaccess:107` |

### Every CTA/link to /portfolio
| File:line | Text | Context |
|---|---|---|
| public_html/partials/navbar.php:77 | Portfolio | desktop nav (every page) |
| public_html/partials/navbar.php:135 | Portfolio | mobile drawer (every page) |
| public_html/partials/footer.php:130 | Portfolio | footer Company column (every page) |
| public_html/pages/home.php:140 | View Our Work → | hero |
| public_html/pages/home.php:451 | See the full portfolio → | Featured Work subhead |
| public_html/pages/home.php:456 | (whole card ×6) | Featured Work cards |
| public_html/pages/home.php:477 | View Full Portfolio | Featured Work footer |
| public_html/pages/home.php:654 | View Our Work | final CTA |
| public_html/pages/about.php:300 | View Our Work | Company Details |
| public_html/pages/404.php:38 | View Portfolio | 404 buttons |

## 5. Images

| File:line | src (shortened) | alt | Stock (Unsplash)? | Presented as team / staff / office / client work? |
|---|---|---|---|---|
| public_html/partials/navbar.php:17-23 | /assets/img/logo.png?v=2 (+@2x, @3x) | "Nexisco Network" | No | No (logo) |
| public_html/partials/navbar.php:116-122 | /assets/img/logo.png?v=2 (+@2x, @3x) | "Nexisco Network" | No | No (logo) |
| public_html/partials/footer.php:23-25 | unsplash 1522071820081-009f0129c71c w=1920 | "" | Yes | Not captioned; same photo ID that home.php:316 labels as the Nexisco team (20% opacity bg) |
| public_html/partials/footer.php:77-83 | /assets/img/logo.png?v=2 | "Nexisco Network" | No | No |
| public_html/partials/head.php:256-260 | /assets/img/logo-mark.png | "Nexisco Network" | No | No (preloader) |
| public_html/partials/head.php:9, 52-57, 66-67 | /assets/img/og-image.png (og/twitter meta) | og:image:alt "Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency" (57, 67) | No | No |
| public_html/partials/head.php:172-173 | JSON-LD logo.png / og-image.png | n/a | No | No |
| public_html/pages/home.php:53 | /assets/img/hero/hero-poster.jpg (video poster) | n/a | No (local, **404 / missing**) | No |
| public_html/pages/home.php:58-62 | unsplash 1559028012-481c04fa702d w=1920 | "" | Yes | No (hero bg; same ID as the "Agency Platform" portfolio item) |
| public_html/pages/home.php:212-215 | unsplash 1451187580459-43490279c0fa | "" | Yes | No (stats bg) |
| public_html/pages/home.php:270 | CSS `background-image` = service `card_image` | none (CSS bg) | Yes | No (service cards) |
| public_html/pages/home.php:315-318 | unsplash 1522071820081-009f0129c71c w=1200 | "The Nexisco Network team collaborating on a digital project" | Yes | **Yes, presented as the team** (owner note 314) |
| public_html/pages/home.php:400 → 408 | unsplash 1517245386807-bb43f82c33c4 | "" | Yes | No (step 01 bg) |
| public_html/pages/home.php:401 → 408 | unsplash 1454165804606-c3d57bc86b40 | "" | Yes | No (step 02 bg) |
| public_html/pages/home.php:402 → 408 | unsplash 1531403009284-440f080d1e12 | "" | Yes | No (step 03 bg) |
| public_html/pages/home.php:403 → 408 | unsplash 1460925895917-afdab827c52f | "" | Yes | No (step 04 bg) |
| public_html/pages/home.php:459-463 | `$p['image']` (6 portfolio items) | "{title} — {tag}" | Yes | **Yes, presented as client work** ("Featured Work", "what we build"; no disclaimer) |
| public_html/pages/home.php:460 | onerror unsplash 1559028012-481c04fa702d w=900 | (same) | Yes | same as above |
| public_html/pages/home.php:548-550 | unsplash 1497366754035-f200968a6e72 | "" | Yes | No (blurred bg behind "Why clients choose Nexisco") |
| public_html/pages/home.php:628 | /assets/img/backgrounds/cta-poster.jpg (video poster) | n/a | No (local, **404 / missing**) | No |
| public_html/pages/home.php:631-633 | unsplash 1531403009284-440f080d1e12 w=1920 | "" | Yes | No (CTA bg) |
| public_html/pages/about.php:26-28 | unsplash 1522071820081-009f0129c71c | "" | Yes | Implied: hero of "About Us", same photo home.php:316 calls the team |
| public_html/pages/contact.php:17-19 | unsplash 1423666639041-f56000c27a9a | "" | Yes | No |
| public_html/pages/pricing.php:23-25 | unsplash 1554224155-6726b3ff858f | "" | Yes | No |
| public_html/pages/portfolio.php:21-23 | unsplash 1531403009284-440f080d1e12 | "" | Yes | No (hero bg) |
| public_html/pages/portfolio.php:75-80 | `$p['image']` (all 18 items) | "{title} — {tag}" | Yes | **Yes, presented as client work** ("projects we've crafted", 31-33), softened by disclaimer 60-62 |
| public_html/pages/portfolio.php:76 | onerror unsplash 1559028012-481c04fa702d w=900 | (same) | Yes | same |
| public_html/pages/partners.php:15-17 | unsplash 1521737711867-e3b97375f902 | "" | Yes | No (decorative) |
| public_html/pages/start-project.php:32-34 | unsplash 1522071820081-009f0129c71c | "" | Yes | Implied (same "team" photo) |
| public_html/pages/services-index.php:16-18 | unsplash 1531403009284-440f080d1e12 | "" | Yes | No |
| public_html/pages/services-index.php:49-54 | `$svc['card_image']` | "{name} — {tagline}" (e.g. "Web Development — Fast, beautiful, conversion-ready websites.") | Yes | No (service illustration) |
| public_html/pages/services-index.php:50 | onerror unsplash 1460925895917-afdab827c52f w=800 | (same) | Yes | No |
| public_html/pages/service-detail.php:31-34 | `$service['hero_image']` | "" | Yes | No |
| public_html/pages/service-detail.php:32 | onerror unsplash 1460925895917-afdab827c52f w=1920 | "" | Yes | No |
| public_html/pages/404.php:15-16 | unsplash 1614741118887-7a4ee193a5fa | "" | Yes | No |
| public_html/500.html | none | | | |
| faq.php, all legal pages | none (no images) | | | |
| public_html/data/services.php:20 / :21 | unsplash 1547658719-da2b51169166 (hero w=1600 / card w=800) | used with "" (detail) and "Web Development — …" (index) | Yes | No |
| public_html/data/services.php:59 / :60 | unsplash 1460925895917-afdab827c52f | "" / "Digital Marketing — Traffic, leads, and measurable ROI." | Yes | No (also home step 04 and the fallbacks) |
| public_html/data/services.php:98 / :99 | unsplash 1556742502-ec7c0e9f34b1 | "" / "Ecommerce Development — Online stores built to sell." | Yes | No (same ID as the "Online Store" portfolio item) |
| public_html/data/portfolio.php:22 | unsplash 1467232004584-a241de8bcf5d | "Corporate Website — Web Design" | Yes | Yes, client work (on homepage) |
| public_html/data/portfolio.php:23 | unsplash 1559028012-481c04fa702d | "Agency Platform — Web Design" | Yes | Yes (on homepage) |
| public_html/data/portfolio.php:24 | unsplash 1486312338219-ce68d2c6f44d | "Landing Page — Web Design" | Yes | Yes |
| public_html/data/portfolio.php:25 | unsplash 1517292987719-0369a794ec0f | "Portfolio Site — Web Design" | Yes | Yes |
| public_html/data/portfolio.php:26 | unsplash 1551434678-e076c223a692 | "Enterprise Platform — Web Design" | Yes | Yes |
| public_html/data/portfolio.php:29 | unsplash 1432888498266-38ffec3eaf0a | "SEO Campaign — Digital Marketing" | Yes | Yes (on homepage) |
| public_html/data/portfolio.php:30 | unsplash 1551288049-bebda4e38f71 | "Analytics Dashboard — Digital Marketing" | Yes | Yes (on homepage) |
| public_html/data/portfolio.php:31 | unsplash 1533750349088-cd871a92f312 | "Paid Advertising — Digital Marketing" | Yes | Yes |
| public_html/data/portfolio.php:32 | unsplash 1611162617474-5b21e879e113 | "Social Media Campaign — Digital Marketing" | Yes | Yes |
| public_html/data/portfolio.php:33 | unsplash 1596526131083-e8c633c948d2 | "Email Marketing — Digital Marketing" | Yes | Yes |
| public_html/data/portfolio.php:36 | unsplash 1556742502-ec7c0e9f34b1 | "Online Store — Ecommerce" | Yes | Yes (on homepage) |
| public_html/data/portfolio.php:37 | unsplash 1483985988355-763728e1935b | "Product Page — Ecommerce" | Yes | Yes (on homepage) |
| public_html/data/portfolio.php:38 | unsplash 1556742393-d75f468bfcb0 | "Checkout Flow — Ecommerce" | Yes | Yes |
| public_html/data/portfolio.php:39 | unsplash 1441986300917-64674bd600d8 | "Retail Platform — Ecommerce" | Yes | Yes |
| public_html/data/portfolio.php:40 | unsplash 1472851294608-062f824d29cc | "Storefront Design — Ecommerce" | Yes | Yes |
| public_html/data/portfolio.php:43 | unsplash 1545235617-9465d2a55698 | "UI Design — Branding" | Yes | Yes |
| public_html/data/portfolio.php:44 | unsplash 1626785774573-4b799315345d | "Graphic System — Branding" | Yes | Yes |
| public_html/data/portfolio.php:45 | unsplash 1611532736597-de2d4265fba3 | "Logo Design — Branding" | Yes | Yes |
| public_html/data/portfolio.php:7-9 | docblock | "ILLUSTRATIVE showcase items with representative stock imagery. Replace each with a real client case study…" | | |
| src/input.css:497, 612 | inline SVG data-URIs (noise, grid) | n/a | No | No |

## Inconsistencies found

| Ref | Observation |
|---|---|
| public_html/site.webmanifest:2 vs public_html/partials/head.php:168, public_html/includes/seo.php:15,46, public_html/pages/about.php:309 | "Nexisco Network Inc." appears only in the manifest. Every legalName and "Legal entity" field says "Nexisco Network". |
| public_html/site.webmanifest:4, public_html/api/newsletter.php:50 | Stale IT copy: "Smart IT. Seamless Support. Professional IT services…" and "IT tips, security alerts". |
| public_html/partials/footer.php:105-106 | "Support: 9am–8pm, 7 days" appears only here. Every hours string uses PT, but HQ is Edmonton (MT) and the timezone is `America/Edmonton` (public_html/config/config.php:27). No openingHours in any schema. |
| public_html/pages/contact.php:52 | Uses "Edmonton, AB" where every other page says "Edmonton, Alberta". |
| terms.php:25, refund-policy.php:28, cancellation-policy.php:27, cookie-policy.php:27, disclaimer.php:27 vs privacy.php:28, opt-in-opt-out.php:28 | Some legal pages say "registered office at"; privacy and opt-in say "headquartered at". |
| public_html/partials/footer.php:181, public_html/includes/mailer.php:133 | "Nexisco Network All rights reserved." has no punctuation between "Network" and "All". |
| public_html/partials/footer.php:46 | Newsletter sends `casl_consent=1` as a hidden field. There is no checkbox. |
| public_html/partials/head.php:166, 225 | `#agency` ProfessionalService is emitted globally and again by `Seo::professional_service()` on home.php:36 and contact.php:8. The WebSite `publisher` points at `#business`, which is never defined. The `sameAs` socials (head.php:210-214) don't match `'sameAs' => []` in seo.php:18. |
| public_html/pages/home.php:53, 628 | The video posters `hero-poster.jpg` and `cta-poster.jpg` return 404 on the dev server. `/assets/css/app.css` is not in the snapshot (also 404). |
| public_html/data/portfolio.php `featured` key | Never read. The homepage takes the first 2 items per category (home.php:24-30). |
| public_html/config/site-stats.php | Never included. It is only mentioned in comments (home.php:206, 232; about.php:220). |
| Reused stock IDs | `1522071820081` is captioned as the team at home:315 and is also the background at footer:23, about:26 and start-project:32. `1559028012` is the home hero, the "Agency Platform" item and the onerror fallback. `1556742502` is the Ecommerce service image and the "Online Store" item. `1460925895917` is the Marketing service image, home step 04 and a fallback. `1531403009284` is home step 03, the home CTA and the portfolio and services heroes. |


---

<!-- meta -->

## 1. Per-route metadata

All values come from `curl http://127.0.0.1:8099<route>`. Every HTML page renders `og:description` and `twitter:description` from the same `$page_description` as the meta description (partials/head.php:29, :50, :65), so they always match it. Every HTML page also emits `twitter:site` = `twitter:creator` = `@NexiscoNetwork` (partials/head.php:62-63). "Org/PS/LB" counts top-level Organization, ProfessionalService and LocalBusiness blocks. ProfessionalService is a schema.org subtype of LocalBusiness. No page emits a block typed `LocalBusiness` itself.

| Route | HTTP | `<title>` (chars) | meta description (chars) | og:description | twitter:site / creator | JSON-LD n: @types | Org/PS/LB | JSON-LD source (file:line) | title/desc set at |
|---|---|---|---|---|---|---|---|---|---|
| / | 200 | Nexisco Network — Web Development, Digital Marketing & Ecommerce Agency (71) | Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce solutions for businesses in the US, Canada, and worldwide. (162) | identical | @NexiscoNetwork / @NexiscoNetwork | 5: ProfessionalService, WebSite, Organization, ProfessionalService, FAQPage (5 Q) | 1/2/0 | partials/head.php:162-216 (PS #agency); partials/head.php:218-233 (WebSite); public_html/pages/home.php:36 → includes/seo.php:10-37 (Organization); public_html/pages/home.php:36 → includes/seo.php:40-76 (PS #agency, 2nd copy); public_html/pages/home.php:38 → includes/seo.php:99-114 (FAQPage, first 5 of data/faqs.php:14); extras echoed at partials/head.php:236 | public_html/pages/home.php:16-17 |
| /services | 200 | Services — Web Development, Digital Marketing & Ecommerce \| Nexisco Network (75) | Three things, done exceptionally well: web development, digital marketing, and ecommerce development. A global digital agency serving the US, Canada, and worldwide. (164) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; partials/head.php:218-233 | public_html/pages/services-index.php:5-6 |
| /portfolio | 200 | Portfolio — Web, Marketing, Ecommerce & Branding \| Nexisco Network (66) | A selection of projects we craft for brands, startups, and growing businesses worldwide — across web design, digital marketing, ecommerce, and branding. (152) | identical | same | 3: ProfessionalService, WebSite, BreadcrumbList (Home > Portfolio) | 0/1/0 | partials/head.php:162-216; :218-233; public_html/pages/portfolio.php:9-12 → includes/seo.php:117-134 | public_html/pages/portfolio.php:6-7 |
| /pricing | 200 | Pricing — Web, Marketing & Ecommerce Plans (USD & CAD) \| Nexisco Network (72) | Transparent monthly plans for web development, digital marketing, and ecommerce — billed in USD or CAD. Find the right plan for your growth stage, or request a custom quote. (173) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/pricing.php:5-6 |
| /start-project | 200 | Start a Project — Get a Free Quote \| Nexisco Network (52) | Tell us about your project and get a free quote in USD or CAD. Web development, digital marketing, and ecommerce for clients in the US, Canada, and worldwide. (158) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/start-project.php:5-6 |
| /about | 200 | About Nexisco Network — Building Digital Experiences That Drive Growth (70) | Nexisco Network is a global digital agency delivering web development, digital marketing, and ecommerce development for clients in the US, Canada, and worldwide — billed in USD or CAD. (184) | identical | same | 3: ProfessionalService, WebSite, Organization | 1/1/0 | partials/head.php:162-216; :218-233; public_html/pages/about.php:15 → includes/seo.php:10-37 | public_html/pages/about.php:12-13 |
| /faq | 200 | FAQ \| Nexisco Network — Digital Agency Questions Answered (57) | Answers about Nexisco Network's web development, digital marketing, and ecommerce services — process, timelines, USD/CAD pricing, ownership, and working with clients worldwide. (176) | identical | same | 3: ProfessionalService, WebSite, FAQPage (27 Q) | 0/1/0 | partials/head.php:162-216; :218-233; public_html/pages/faq.php:17 → includes/seo.php:99-114 | public_html/pages/faq.php:14-15 |
| /contact | 200 | Contact Us \| Nexisco Network (28) | Get in touch with Nexisco Network — a global digital agency for web, marketing & ecommerce. We work with clients in the US, Canada, and worldwide. Payments in USD & CAD. (169) | identical | same | 3: ProfessionalService, WebSite, ProfessionalService | 0/2/0 | partials/head.php:162-216; :218-233; public_html/pages/contact.php:8 → includes/seo.php:40-76 (2nd #agency) | public_html/pages/contact.php:5-6 |
| /partners | 200 | Partner Program — White-Label Web, Marketing & Ecommerce \| Nexisco Network (74) | Resell or white-label Nexisco Network's web development, digital marketing, and ecommerce services under your own brand. For agencies, freelancers, and consultants worldwide — billed in USD or CAD. (197) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/partners.php:4-5 |
| /privacy | 200 | Privacy Policy \| Nexisco Network (32) | Nexisco Network privacy policy. How our global digital agency collects, uses, and protects your personal information under Canada's PIPEDA and Alberta PIPA, with GDPR-style rights for international visitors. (207) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/privacy.php:3-4 |
| /terms | 200 | Terms of Service \| Nexisco Network (34) | Terms of Service for Nexisco Network — a global digital agency offering web development, digital marketing, and ecommerce development. Governing law: Province of Alberta, Canada. (178) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/terms.php:3-4 |
| /refund-policy | 200 | Refund Policy \| Nexisco Network (31) | Nexisco Network refund policy for digital professional services. How deposits, milestone payments, work-in-progress, and monthly retainers are handled, with refunds issued in the original currency (USD or CAD). (210) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/refund-policy.php:3-4 |
| /cookie-policy | 200 | Cookie Policy \| Nexisco Network (31) | How Nexisco Network, a global digital agency, uses cookies and similar technologies on nexisconetwork.ca — strictly necessary, functional, and analytics cookies, plus your choices. (180) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/cookie-policy.php:3-4 |
| /disclaimer | 200 | Disclaimer \| Nexisco Network (28) | Legal disclaimer for Nexisco Network, a global digital agency. Marketing and SEO results vary and are not guaranteed; performance depends on third-party platforms; website content is general information, not professional advice. (228) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/disclaimer.php:3-4 |
| /cancellation-policy | 200 | Cancellation Policy \| Nexisco Network (37) | How to cancel a project engagement or monthly retainer with Nexisco Network, our global digital agency. Notice periods, fees for work in progress, deposits, and how cancellation relates to refunds. (197) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/cancellation-policy.php:3-4 |
| /opt-in-opt-out | 200 | Opt-In / Opt-Out \| Nexisco Network (34) | How Nexisco Network handles email and SMS marketing consent under Canada's CASL. What subscribers receive, and how to unsubscribe or opt out at any time. (153) | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/opt-in-opt-out.php:3-4 |
| /robots.txt | 200 (text/plain; X-Robots-Tag: noindex) | — | — | — | — | 0 | 0/0/0 | — (public_html/robots.php) | — |
| /sitemap.xml | 200 (application/xml; X-Robots-Tag: noindex) | — | — | — | — | 0 | 0/0/0 | — (public_html/sitemap.php) | — |
| /services/web-development | 200 | Web Development \| Nexisco Network (33) | We design and build custom, mobile-first websites that load fast, rank well, and turn visitors into customers. From marketing sites and landing pages to full CMS and headless builds — engineered for performance and growth. (222) | identical | same | 5: ProfessionalService, WebSite, Service, FAQPage (5 Q), BreadcrumbList | 0/1/0 (plus a nested `provider` Organization inside Service, includes/seo.php:91) | partials/head.php:162-216; :218-233; public_html/pages/service-detail.php:16 → includes/seo.php:84-96; :17 → includes/seo.php:99-114 (data/services.php:45); :18-22 → includes/seo.php:117-134 | public_html/pages/service-detail.php:13-14 (data/services.php:16, :18) |
| /services/digital-marketing | 200 | Digital Marketing \| Nexisco Network (35) | Data-driven marketing that grows your pipeline — SEO, Google Ads, paid social, email automation, content, and conversion-rate optimization. Every campaign is tracked, reported, and tuned for return on investment. (212) | identical | same | 5: ProfessionalService, WebSite, Service, FAQPage (5 Q), BreadcrumbList | 0/1/0 (+ nested provider) | same as above (FAQ data/services.php:84) | public_html/pages/service-detail.php:13-14 (data/services.php:55, :57) |
| /services/ecommerce-development | 200 | Ecommerce Development \| Nexisco Network (39) | We design, build, and optimize high-converting online stores on Shopify and WooCommerce — with smooth checkout, secure payments in USD and CAD, and product experiences that maximize average order value and lifetime revenue. (223) | identical | same | 5: ProfessionalService, WebSite, Service, FAQPage (5 Q), BreadcrumbList | 0/1/0 (+ nested provider) | same as above (FAQ data/services.php:123) | public_html/pages/service-detail.php:13-14 (data/services.php:94, :96) |
| (extra) any unknown URL, e.g. /does-not-exist | 404 | 404 — Page Not Found \| Nexisco Network | This page has moved or no longer exists. Explore our services, portfolio, or start a project with Nexisco Network. | identical | same | 2: ProfessionalService, WebSite | 0/1/0 | partials/head.php:162-216; :218-233 | public_html/pages/404.php:4-5. Canonical falls back to the request URL (partials/head.php:8). Meta robots stays index,follow. |
| (extra) /admin | 200 | Admin — Nexisco Network | none | none | none | 0 | 0/0/0 | — | public_html/admin/index.php:53. Meta robots noindex,nofollow at public_html/admin/index.php:54. |

## 1a. Shared head values (all HTML pages)

| Item | Value | file:line |
|---|---|---|
| Canonical | Hardcoded per page as `https://nexisconetwork.ca/...` (non-www, https, no trailing slash except `/`). Falls back to the request path. | partials/head.php:8, :31 |
| og:type | Always `website` because no page sets `$page_type` | partials/head.php:12, :47 |
| og:image / twitter:image | https://nexisconetwork.ca/assets/img/og-image.png. The file exists, 1200x630, HTTP 200. | partials/head.php:9, :52-57, :66 |
| og:locale / html lang | en_CA / en-CA | partials/head.php:58, :21 |
| robots / googlebot / bingbot | index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1. Also emitted on the 404 page. | partials/head.php:34-36 |
| keywords | One global list for every page | partials/head.php:11, :30 |
| Geo meta | geo.region CA-AB; geo.placename Edmonton, Alberta; geo.position/ICBM 53.5461,-113.4938. These are Edmonton city-centre coordinates, not the T6L 6H6 address. | partials/head.php:70-74 |
| Description length | Every page except /portfolio (152), /start-project (158) and /opt-in-opt-out (153) is over 160 chars. The 3 service pages and the policy pages run 197-228. | see table 1 |
| Double escaping (latent) | Service title, description and canonical are passed through `e()` and then `htmlspecialchars` again. Current service data has no `&`, `<` or `'` in these fields, so nothing shows yet. | public_html/pages/service-detail.php:13-15; partials/head.php:28-31 |

## 2. Organization / ProfessionalService JSON-LD

| Field | A: ProfessionalService (inline) | B: Organization | C: ProfessionalService (helper) | D: Service.provider (nested) |
|---|---|---|---|---|
| Emitted by | partials/head.php:162-216 | includes/seo.php:10-37 (`Seo::organization()`) | includes/seo.php:40-76 (`Seo::professional_service()`, alias `local_business()` at includes/seo.php:79-81 is unused) | includes/seo.php:91 |
| Appears on | Every HTML page, including the 404 page | / (public_html/pages/home.php:36), /about (public_html/pages/about.php:15) | / (public_html/pages/home.php:36), /contact (public_html/pages/contact.php:8) | 3 service-detail pages |
| @id | https://nexisconetwork.ca/#agency (:166) | none | https://nexisconetwork.ca/#agency (:44), the same @id as A | none |
| name | Nexisco Network (:167) | Nexisco Network (:14) | Nexisco Network (:45) | Nexisco Network |
| legalName | Nexisco Network (:168). Missing "Inc.". | Nexisco Network (:15) | Nexisco Network (:46) | — |
| alternateName | Nexisco (:169) | — | — | — |
| description | "...web development, digital marketing, and ecommerce development for businesses in the US, Canada, and worldwide." (:170) | — | "...and ecommerce solutions for businesses..." (:47). Wording differs from A. | — |
| url / logo / image | https://nexisconetwork.ca; /assets/img/logo.png (360x166); /assets/img/og-image.png (:171-173) | url + logo (:16-17) | url, image, logo (:48, :51-52) | — |
| address | PostalAddress: 1404, 49A Street NW, Edmonton, AB, T6L 6H6, CA (:180-187) | same (:19-26) | same (:57-64) | — |
| geo | GeoCoordinates 53.5461 / -113.4938, Edmonton city centre (:188-192) | — | — | — |
| telephone | +1-888-909-9466 (:174) | only inside contactPoint (:29) | +1-888-909-9466 (:49) | — |
| email | support@nexisconetwork.ca (:175) | only inside contactPoint (:31) | support@nexisconetwork.ca (:50) | — |
| contactPoint | customer service, same phone/email, areaServed US/CA/Worldwide, availableLanguage ["en"] (:193-200) | customer service, same, availableLanguage ["English"] (:27-34) | — | — |
| areaServed | ["US","CA","Worldwide"] (:179) | contactPoint only (:32) | ["US","CA","Worldwide"] (:56) | Service.areaServed same (includes/seo.php:92) |
| sameAs | facebook.com/NexiscoNetwork, linkedin.com/company/nexisco-network, twitter.com/NexiscoNetwork (:210-214) | [] empty (:18) | absent | — |
| priceRange / currencies / payment | $$; USD, CAD; Credit Card, Debit Card, Online Payment, Bank Transfer (:176-178) | — | same (:53-55) | — |
| hasOfferCatalog | 3 Offers: Web Development, Digital Marketing, Ecommerce Development with /services/* URLs (:201-209) | — | same (:65-73) | — |
| foundingDate | absent (public_html/pages/about.php:290 says "established in 2026") | absent | absent | — |
| openingHours / openingHoursSpecification | absent (hours shown in partials/footer.php:105-106 and public_html/pages/contact.php:50) | absent | absent | — |
| aggregateRating / review | none anywhere in the codebase. Testimonials are disabled (public_html/pages/home.php:542-544). | none | none | none |

## 2a. JSON-LD issues

| Issue | Evidence |
|---|---|
| Two different nodes share @id `#agency` on / and /contact | partials/head.php:166 and includes/seo.php:44. Block C has no sameAs, geo, contactPoint or alternateName, and its description differs. |
| WebSite.publisher points to an @id that nothing defines (`#business`) | partials/head.php:225 |
| SearchAction target `/services?q={search_term_string}` is never handled; no `$_GET` is read anywhere in public_html/pages/*.php | partials/head.php:227-231 |
| Organization sameAs is empty while block A lists 3 profiles | includes/seo.php:18 vs partials/head.php:210-214 |
| legalName "Nexisco Network" differs from the manifest's "Nexisco Network Inc." | partials/head.php:168; includes/seo.php:15, :46; public_html/site.webmanifest:2 |
| availableLanguage differs ("en" vs "English") | partials/head.php:199; includes/seo.php:33 |
| Schema paymentAccepted does not match the footer (footer says PayPal and wire transfer) | partials/head.php:178; includes/seo.php:55; partials/footer.php:176 |
| Service.provider is an anonymous Organization with no @id link to #agency | includes/seo.php:91 |
| Organization appears on / and /about in addition to PS #agency, so / carries 3 business-entity blocks | public_html/pages/home.php:36; public_html/pages/about.php:15 |

## 3. Sitemap

Generated by public_html/sitemap.php. There is no `?>` whitespace leak: the XML declaration is at byte 0 and the file is well-formed. `X-Robots-Tag: noindex` is set at public_html/sitemap.php:6. `lastmod` is always the request date, `date('Y-m-d')` at public_html/sitemap.php:9, :37, :46, not a real modification date. All 19 public routes are listed and every one returns 200.

| # | loc | lastmod | changefreq / priority | generated at | fetch status |
|---|---|---|---|---|---|
| 1 | https://nexisconetwork.ca/ | 2026-10-19 (today) | weekly / 1.0 | public_html/sitemap.php:12 (loop :34-41) | 200 |
| 2 | https://nexisconetwork.ca/services | 2026-10-19 | weekly / 0.9 | public_html/sitemap.php:13 | 200 |
| 3 | https://nexisconetwork.ca/portfolio | 2026-10-19 | weekly / 0.8 | public_html/sitemap.php:14 | 200 |
| 4 | https://nexisconetwork.ca/pricing | 2026-10-19 | monthly / 0.8 | public_html/sitemap.php:15 | 200 |
| 5 | https://nexisconetwork.ca/about | 2026-10-19 | monthly / 0.8 | public_html/sitemap.php:16 | 200 |
| 6 | https://nexisconetwork.ca/contact | 2026-10-19 | monthly / 0.8 | public_html/sitemap.php:17 | 200 |
| 7 | https://nexisconetwork.ca/start-project | 2026-10-19 | weekly / 0.9 | public_html/sitemap.php:18 | 200 |
| 8 | https://nexisconetwork.ca/faq | 2026-10-19 | monthly / 0.7 | public_html/sitemap.php:19 | 200 |
| 9 | https://nexisconetwork.ca/partners | 2026-10-19 | monthly / 0.6 | public_html/sitemap.php:20 | 200 |
| 10 | https://nexisconetwork.ca/privacy | 2026-10-19 | yearly / 0.3 | public_html/sitemap.php:21 | 200 |
| 11 | https://nexisconetwork.ca/terms | 2026-10-19 | yearly / 0.3 | public_html/sitemap.php:22 | 200 |
| 12 | https://nexisconetwork.ca/refund-policy | 2026-10-19 | yearly / 0.2 | public_html/sitemap.php:23 | 200 |
| 13 | https://nexisconetwork.ca/cookie-policy | 2026-10-19 | yearly / 0.2 | public_html/sitemap.php:24 | 200 |
| 14 | https://nexisconetwork.ca/cancellation-policy | 2026-10-19 | yearly / 0.2 | public_html/sitemap.php:25 | 200 |
| 15 | https://nexisconetwork.ca/disclaimer | 2026-10-19 | yearly / 0.2 | public_html/sitemap.php:26 | 200 |
| 16 | https://nexisconetwork.ca/opt-in-opt-out | 2026-10-19 | yearly / 0.2 | public_html/sitemap.php:27 | 200 |
| 17 | https://nexisconetwork.ca/services/web-development | 2026-10-19 | monthly / 0.8 | public_html/sitemap.php:43-50 from data/services.php:15 | 200 |
| 18 | https://nexisconetwork.ca/services/digital-marketing | 2026-10-19 | monthly / 0.8 | public_html/sitemap.php:43-50 from data/services.php:54 | 200 |
| 19 | https://nexisconetwork.ca/services/ecommerce-development | 2026-10-19 | monthly / 0.8 | public_html/sitemap.php:43-50 from data/services.php:93 | 200 |

## 4. robots.txt

Served by public_html/robots.php through the route map at public_html/index.php:109. There is no static robots.txt file. Response: 200 `text/plain; charset=utf-8`, `X-Robots-Tag: noindex` (public_html/robots.php:3).

| Line (full content) | Source | Effect |
|---|---|---|
| `User-agent: *` | public_html/robots.php:5 | Only one group; no Googlebot-specific rules |
| `Allow: /` | public_html/robots.php:6 | — |
| `Disallow: /admin/` | public_html/robots.php:8 | Does not match `/admin`, the login page (200, meta noindex,nofollow). Only `/admin/...` is blocked. |
| `Disallow: /api/` | public_html/robots.php:9 | Form endpoints only; no public page affected |
| `Disallow: /config/` | public_html/robots.php:10 | Already 403 via public_html/.htaccess:49 |
| `Disallow: /includes/` | public_html/robots.php:11 | Already 403 via public_html/.htaccess:50 |
| `Disallow: /data/` | public_html/robots.php:12 | Already 403 via public_html/.htaccess:52 |
| `Disallow: /lib/` | public_html/robots.php:13 | Already 403 via public_html/.htaccess:51 |
| `Sitemap: https://nexisconetwork.ca/sitemap.xml` | public_html/robots.php:15 | Absolute https URL |

| Check | Result |
|---|---|
| Any Disallow on public pages, /assets/ or Google crawlers | None. /assets/ (CSS and JS needed for rendering) is crawlable. |
| X-Robots-Tag on robots.txt | `noindex` (public_html/robots.php:3). Harmless for crawling but unnecessary. |
| X-Robots-Tag on sitemap.xml | `noindex` (public_html/sitemap.php:6). Harmless for crawling but unnecessary. |
| X-Robots-Tag on HTML pages | none (only meta robots, partials/head.php:34-36) |

## 5. Redirects

The PHP dev server does not apply .htaccess, so .htaccess rules are listed from source only. Every PHP redirect sends a relative Location header and drops the query string. Under Apache, a plain-HTTP request to a retired path makes two hops: first to https, then to the new path.

| From | To | Status | Condition | file:line | Actual (curl) |
|---|---|---|---|---|---|
| http://{host}{uri} | https://{host}{uri} | 301 | HTTPS off, host not starting with "localhost", REMOTE_ADDR not 127.* | public_html/.htaccess:7-10 | n/a on php -S |
| www ↔ non-www | — | — | No rule exists. The www host is kept as-is and only upgraded to https. Canonicals point to non-www. HSTS includeSubDomains;preload is set at public_html/.htaccess:33. | public_html/.htaccess (absent) | n/a |
| any non-file, non-dir path | index.php (internal rewrite, not a redirect) | — | `!-f`, `!-d`, [L,QSA] | public_html/.htaccess:19-23 | — |
| config/ includes/ lib/ data/ *.php | — | 403 | direct access | public_html/.htaccess:49-52 | — |
| 404 / 403 errors | /index.php (internal) | — | ErrorDocument | public_html/.htaccess:105-106 | — |
| 500 errors | /500.html | — | ErrorDocument | public_html/.htaccess:107 | — |
| /membership | /pricing | 301 | Exact path after trim. Trailing slash also matches; case-sensitive; any method. | public_html/index.php:68 (sent at :84-86) | 301, Location: /pricing (`/membership/` and `/membership?x=1` behave the same) |
| /book | /start-project | 301 | same | public_html/index.php:69 | 301 → /start-project (`/book/` also) |
| /book/confirmation | /start-project | 301 | same | public_html/index.php:70 | 301 → /start-project |
| /eula | /terms | 301 | same | public_html/index.php:71 | 301 → /terms |
| /uninstall | /terms | 301 | same | public_html/index.php:72 | 301 → /terms |
| /services/virus-malware-removal | /services | 301 | same | public_html/index.php:74 | 301 → /services |
| /services/pc-laptop-repair | /services | 301 | same | public_html/index.php:75 | 301 → /services |
| /services/data-recovery | /services | 301 | same | public_html/index.php:76 | 301 → /services |
| /services/network-wifi-setup | /services | 301 | same | public_html/index.php:77 | 301 → /services |
| /services/software-installation | /services | 301 | same | public_html/index.php:78 | 301 → /services |
| /services/remote-support | /services | 301 | same | public_html/index.php:79 | 301 → /services |
| /services/business-it-support | /services | 301 | same | public_html/index.php:80 | 301 → /services |
| /services/hardware-upgrades | /services | 301 | same | public_html/index.php:81 | 301 → /services |
| /services/smart-home-iot | /services | 301 | same | public_html/index.php:82 | 301 → /services |
| /about/ (any trailing slash) | — | no redirect | Path normalised by trim; served 200 with a slash-less canonical | public_html/index.php:30-31 | /about/ 200, /services/web-development/ 200 |
| /admin (POST, correct password) | /admin | 302 | Password check uses `hash_equals`. `admin_pass` is `''` in public_html/config/config.php:28 and `''` is not null, so the `?? '[hard-coded password redacted]'` fallback never applies and an empty password passes. Security flag. | public_html/admin/index.php:13-21 | not POSTed |
| /admin?logout | /admin | 302 | GET `logout` param | public_html/admin/index.php:26-30 | 302, Location: /admin |
| any same-tab `<a href>` click | link href via `window.location.href` | JS | Runs after a 0.5 s overlay wipe. Skipped when reduced motion is on, for `target=_blank`, for `data-no-transition`, and for `#`, `mailto:` and `tel:` links. External absolute URLs are intercepted too. | public_html/assets/js/app.js:724-747 (redirect at :743) | — |
| bookingWizard submit success | /book-confirmation?ref=… | JS | Dead code: no page uses `x-data="bookingWizard"`. The fetch target /api/book returns 404, and so does /book-confirmation. | public_html/assets/js/app.js:785-892 (fetch :867, redirect :879) | /book-confirmation 404; /api/book 404 |
| /index.php | — | 404 | Request URI "/index.php" is not in the route map | public_html/index.php:131-133 | 404 |

## 6. Third-party scripts and connections

| Resource | Type | file:line | Used? | Needed? / notes |
|---|---|---|---|---|
| fonts.googleapis.com css2 (Inter, Bricolage Grotesque, Playfair Display, Outfit, JetBrains Mono) | stylesheet: preload, then print→onload swap, plus noscript | partials/head.php:114-124 | Yes, all 5 families referenced in src/input.css | Needed, or self-host |
| fonts.gstatic.com | font files | via the css2 file | Yes | Needed while Google Fonts is used |
| dns-prefetch fonts.googleapis.com / fonts.gstatic.com / cdn.jsdelivr.net / images.unsplash.com | resource hint | partials/head.php:95-98 | Yes | OK |
| preconnect fonts.googleapis.com; fonts.gstatic.com (crossorigin); cdn.jsdelivr.net (crossorigin) | resource hint | partials/head.php:99-101 | Yes | The jsdelivr preconnect uses `crossorigin` but the scripts load without CORS, so that socket is not reused |
| GSAP 3.12.5 | script (defer), no SRI | partials/scripts.php:15 | Yes, throughout app.js and the preloader | Needed |
| GSAP ScrollTrigger 3.12.5 | script (defer), no SRI | partials/scripts.php:16 | Yes | Needed |
| Lenis 1.1.13 | script (defer), no SRI | partials/scripts.php:19 | Yes (public_html/assets/js/app.js:16) | Optional (smooth scroll) |
| SplitType 0.3.4 | script (defer), no SRI | partials/scripts.php:22 | Yes, 31 `data-split` attributes (public_html/assets/js/app.js:123-160) | Optional; a fallback exists at public_html/assets/js/app.js:127 |
| VanillaTilt 1.8.1 | script (defer), no SRI | partials/scripts.php:25 | Only on home, about and services-index (`data-tilt`) but loaded on every page | Optional |
| @alpinejs/collapse@3.x.x | script (defer), unpinned range, no SRI | partials/scripts.php:35 | Yes: public_html/pages/pricing.php:150, public_html/pages/service-detail.php:200, public_html/pages/faq.php:101 | Needed; should be pinned |
| alpinejs@3.x.x | script (defer), unpinned range, no SRI | partials/scripts.php:36 | Yes: x-data at public_html/pages/portfolio.php:39, public_html/pages/pricing.php:43/139, public_html/pages/faq.php:45/85, public_html/pages/service-detail.php:189, partials/navbar.php:112 | Needed. The standard build needs `'unsafe-eval'`, which the CSP lacks. |
| Google Analytics 4 (googletagmanager.com/gtag/js) | script + inline config | partials/head.php:239-247; public_html/index.php:13 | Not emitted: the `analytics_id` key is missing from public_html/config/config.php, so ANALYTICS_ID is '' | Inactive. No consent gating exists. |
| images.unsplash.com (hotlinked) | img | partials/footer.php:23 (every page); public_html/pages/home.php:58, :212, :315, :400-403, :460, :548, :631; public_html/pages/about.php:26; public_html/pages/contact.php:17; public_html/pages/partners.php:15; public_html/pages/portfolio.php:21, :76; public_html/pages/pricing.php:23; public_html/pages/services-index.php:16, :50; public_html/pages/service-detail.php:32; public_html/pages/start-project.php:32; public_html/pages/404.php:15; data/services.php:20-21, :59-60, :98-99; data/portfolio.php:22-45 (18 images) | Yes | Stock placeholders (several "NOTE (owner): replace") |
| Video posters /assets/img/hero/hero-poster.jpg, /assets/img/backgrounds/cta-poster.jpg | first-party media | public_html/pages/home.php:53, :628 | Referenced, but both 404. The `<video>` tags have no sources (public_html/pages/home.php:55). | Broken; the preloader also requests the hero poster (public_html/assets/js/preloader.js:116-117) |
| particles.js (first-party) | script (defer) | partials/scripts.php:28 | Only home has `#hero-canvas` (public_html/pages/home.php:106); returns early elsewhere (public_html/assets/js/particles.js:32-33) | Loaded on every page |
| assets/fonts/Inter-Regular.woff2, Inter-Medium.woff2, JetBrainsMono-Regular.woff2 | self-hosted fonts | public_html/assets/fonts/ | Unused: no @font-face anywhere | Dead files |
| /assets/css/app.css | first-party stylesheet | partials/head.php:104, :137 | Gitignored build output; 404 in this snapshot | Must be built and deployed |
| Tag manager container, chat widget, call tracking, Meta pixel, reCAPTCHA, map embeds, iframes | — | none found | No | `tel:` links are plain (partials/navbar.php:86, :154; partials/footer.php:91; public_html/pages/contact.php:46; etc.) |

## 6a. CSP and security headers (Apache only; php -S sends none)

| Header / directive | Value | file:line | Assessment |
|---|---|---|---|
| default-src | 'self' | public_html/.htaccess:37 | OK |
| script-src | 'self' 'unsafe-inline' cdn.jsdelivr.net www.googletagmanager.com www.google-analytics.com | public_html/.htaccess:37 | Covers the CDN scripts and inline scripts. Missing `'unsafe-eval'`, so standard Alpine 3 expressions (x-data, x-show, x-collapse) will be blocked in production. |
| style-src | 'self' 'unsafe-inline' fonts.googleapis.com | public_html/.htaccess:37 | OK |
| font-src | 'self' fonts.gstatic.com data: | public_html/.htaccess:37 | OK |
| img-src | 'self' data: images.unsplash.com www.google-analytics.com | public_html/.htaccess:37 | OK for current use. GA4 may also need *.googletagmanager.com. |
| media-src | 'self' images.unsplash.com | public_html/.htaccess:37 | Unsplash media is unused |
| connect-src | 'self' www.google-analytics.com region1.google-analytics.com | public_html/.htaccess:37 | /api/* fetches are fine. GA4 also uses *.analytics.google.com. |
| frame-ancestors / base-uri / form-action / object-src / upgrade-insecure-requests | 'self' / 'self' / 'self' / 'none' / on | public_html/.htaccess:37 | OK |
| X-Frame-Options SAMEORIGIN; nosniff; X-XSS-Protection; Referrer-Policy; Permissions-Policy (camera, microphone, geolocation off) | — | public_html/.htaccess:28-32 | OK |
| Strict-Transport-Security | max-age=31536000; includeSubDomains; preload | public_html/.htaccess:33 | Commits all subdomains to HTTPS |

## 6b. Overlays and popups on load

| Element | Behaviour | file:line |
|---|---|---|
| Preloader (full-screen, z-index 10000, body scroll locked) | Shown on every page load. Removed after at least 250 ms, with a 1.5 s safety exit. With JS off it never hides and scroll stays locked: there is no `<noscript>` fallback. | partials/head.php:145-159 (CSS; overflow lock :158), :254-270 (markup); public_html/assets/js/preloader.js:11-12, :64-95, :153-178, :181-183; duplicate CSS at src/input.css:1016-1062 |
| Page-transition overlay (z-index 9997) | Starts at scaleY(0) and is animated to 0 again on load (no visible effect). Covers the screen for 0.5 s on link clicks. | partials/head.php:276-277; public_html/assets/js/app.js:724-759 |
| Floating "Get a free quote" button | Appears after 300 px of scroll, not on load; links to /start-project | partials/footer.php:9-16; public_html/assets/js/app.js:108-119 |
| Custom cursor | Desktop, non-touch only | partials/head.php:273; public_html/assets/js/app.js:354 |
| Mobile nav drawer | Opens on click only | partials/navbar.php:108, :161-185 |
| Cookie-consent banner | Does not exist, although the Cookie Policy describes one | public_html/pages/cookie-policy.php:48, :74, :98 |
| Newsletter, exit-intent or modal popups | none | — |
| Duplicate contact handler (first-party) | The inline handler and app.js both bind submit on #contact-form, so each submit sends 2 POSTs to /api/contact | public_html/pages/contact.php:92, :147-175; public_html/assets/js/app.js:951-985 |
| Dead Alpine components | `membership` and `bookingWizard` are registered but no page uses them | public_html/assets/js/app.js:765-780, :785-892, :899-901 |

## 7. Social links and handles

None of these profiles are linked visibly anywhere on the site, and I did not check whether the accounts exist.

| Item | Value | file:line | Notes |
|---|---|---|---|
| twitter:site | @NexiscoNetwork | partials/head.php:62 | Every HTML page |
| twitter:creator | @NexiscoNetwork | partials/head.php:63 | Every HTML page |
| sameAs (block A) | https://www.facebook.com/NexiscoNetwork | partials/head.php:211 | Not linked in the visible UI |
| sameAs (block A) | https://www.linkedin.com/company/nexisco-network | partials/head.php:212 | Not linked in the visible UI |
| sameAs (block A) | https://twitter.com/NexiscoNetwork | partials/head.php:213 | Not linked in the visible UI; uses the twitter.com domain |
| sameAs (Organization) | [] | includes/seo.php:18 | Empty |
| sameAs (ProfessionalService helper) | absent | includes/seo.php:40-76 | — |
| Footer and navbar social icons | none | partials/footer.php, partials/navbar.php | No social links in the visible UI |
| Share links (sharer, intent, mailto share) | none | — | — |
| Platform mentions (not profiles) | Meta, Instagram, LinkedIn, TikTok, YouTube | data/services.php:65, :89 | Service copy only |

## 8. Static files and business descriptors

| File | Content | file:line | Notes |
|---|---|---|---|
| site.webmanifest | name "Nexisco Network Inc." | public_html/site.webmanifest:2 | Only place "Inc." appears |
| site.webmanifest | short_name "Nexisco" | public_html/site.webmanifest:3 | — |
| site.webmanifest | description "Smart IT. Seamless Support. Professional IT services across Canada — headquartered in Edmonton, Alberta." | public_html/site.webmanifest:4 | Stale IT-business copy |
| site.webmanifest | start_url "/", display standalone, background_color #FAFBFC, theme_color #0891B2 | public_html/site.webmanifest:5-8 | Theme colour matches partials/head.php:10 |
| site.webmanifest | icons: favicon-32, favicon-96, logo-mark-128, icon-192, logo-mark-256, icon-512 (any), icon-512 (maskable) | public_html/site.webmanifest:9-17 | All return 200. Served as application/manifest+json and linked at partials/head.php:87. |
| package.json | name "nexisconetwork", version 1.0.0, description "Nexisco Network — Smart IT. Seamless Support." | package.json:2-4 | Stale IT copy |
| start.sh | Banner "NEXISCO NETWORK — Smart IT. Seamless Support" | start.sh:26 | Stale IT copy |
| README.md | "# nexisconetwork.ca" only | README.md:1 | — |
| CLAUDE.md / setup.sh | Next.js, R3F and 3D project brief and scaffold script | CLAUDE.md; setup.sh:1-15 | Does not describe this PHP site |
| public_html/pages/about.php | "established in 2026 and is headquartered in Edmonton, Alberta, Canada" | public_html/pages/about.php:290 | No foundingDate in schema |
| data/faqs.php | "headquartered in Edmonton, Alberta, Canada... US, Canada, and worldwide" | data/faqs.php:18 | Feeds the FAQPage JSON-LD |
| privacy / opt-in policy | "headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6" | public_html/pages/privacy.php:28; public_html/pages/opt-in-opt-out.php:28 | — |
| Footer brand | "Web. Marketing. Ecommerce. Growth, engineered. A global digital agency..." | partials/footer.php:85-87 | — |
| Footer contact | +1 (888) 909-9466; support@nexisconetwork.ca; 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada | partials/footer.php:91-103 | — |
| Hours | "Mon–Fri 8am–7pm PT · Sat 9am–5pm PT"; "Support: 9am–8pm, 7 days" | partials/footer.php:105-106; public_html/pages/contact.php:50; public_html/pages/about.php:333; public_html/pages/refund-policy.php:100; public_html/pages/faq.php:124 (weekdays only) | Hours are in PT although HQ is in Edmonton (MT). No openingHours in schema. |
| Payments | "major credit & debit cards, PayPal, and bank/wire transfer" | partials/footer.php:176 | Differs from schema paymentAccepted |
| Copyright | "© {Y} Nexisco Network All rights reserved." | partials/footer.php:181; includes/mailer.php:133 | Missing period; no "Inc." |
| Email footer (CASL) | Name, address, phone, email | includes/mailer.php:126-129 | — |
| 500.html | title "Something went wrong — Nexisco Network" | public_html/500.html:7 | — |
| Emails in code | support@ (everywhere), privacy@ (public_html/pages/privacy.php:53/78/97, public_html/pages/cookie-policy.php:122, public_html/pages/opt-in-opt-out.php:76), partners@ (commented, public_html/api/partners.php:58), noreply@ / admin@ (public_html/config/config.sample.php:18-22) | — | — |
| Config | timezone America/Edmonton; SMTP smtp.hostinger.com; no analytics_id | public_html/config/config.php:16, :27; public_html/config/config.sample.php | .env.example:9, :32 reference GoDaddy (`id_godaddy`, smtpout.secureserver.net), which conflicts with Hostinger |
| site-stats | projects_delivered, client_satisfaction, countries_served and years_experience are all null | public_html/config/site-stats.php:14-18 | No invented stats |


---

<!-- keywords -->

## Scope

| item | value |
|---|---|
| Source swept | 58 text files under the snapshot root. Excluded: node_modules, .git, public_html/lib/PHPMailer, package-lock.json, binaries. There is no compiled CSS in the snapshot (no public_html/assets/css/), so src/input.css was swept as the CSS source. |
| Rendered swept | 18 `$route_map` routes, the 3 `/services/<slug>` pages, and `/nonexistent-xyz` (404 page, extra). The CSRF token was stripped (64-hex replaced). All returned 200 except the 404 page. `/site.webmanifest` was also fetched. |
| Shipped definition | **yes** = anything under public_html/ (served or executed), sql/schema.sql and src/input.css (compiled into served CSS). **no** = CLAUDE.md, setup.sh, start.sh, package.json, .env.example. "(not visible)" = a PHP comment or server-side code that never reaches HTML. |
| Rendered-only hits | None. Every rendered hit traces to a source line, shown as `→ URL (file.html:line)`. |

## 1. Old-business remnants

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| Smart IT / Seamless Support / IT services | public_html/site.webmanifest:4. Served at /site.webmanifest and linked from every page via public_html/partials/head.php:87 | `"description": "Smart IT. Seamless Support. Professional IT services across Canada — headquartered in Edmonton, Alberta."` | yes | **Real problem (high).** Old IT tagline in a public file that every page links to. "across Canada" also contradicts the US/worldwide positioning. |
| Smart IT / Seamless Support | package.json:4 | `"description": "Nexisco Network — Smart IT. Seamless Support.",` | no (repo root; .htaccess:56 blocks package.json) | Stale metadata, not public. Clean up. |
| Smart IT / Seamless Support | start.sh:26 | `║   NEXISCO NETWORK  —  Smart IT. Seamless Support  ║` | no | Dev banner, stale. |
| IT (tips) | public_html/api/newsletter.php:50 | `You'll receive IT tips, security alerts, and exclusive offers from Nexisco Network.` | yes | **Real problem (latent).** IT-era welcome-email body. It is only unsent because `send_mail` is commented out at :55. |
| IT-support, computer-repair | public_html/data/faqs.php:16 → / (home.html:300 JSON-LD, :1607 visible), /faq (faq.html:210 JSON-LD, :776 visible) | `We are not an IT-support or computer-repair provider — our work is designing and building websites and online stores` | yes | Deliberate disclaimer, not a leftover. But it is FAQ #1 and appears in FAQPage JSON-LD on 2 pages, so it keeps the old-business keywords tied to the brand. Consider removing. |
| IT-support | public_html/data/pricing.php:8 | `* No security / monitoring / backup / IT-support line items.` | yes (not visible) | False positive: internal PHP comment. |
| IT | public_html/index.php:65 | `/* ── 301 Redirects (retired IT routes → new agency routes) ───────── */` | yes (not visible) | False positive: PHP comment. |
| IT | public_html/index.php:73 | `// Retired IT service detail routes → consolidated /services` | yes (not visible) | False positive: PHP comment. |
| virus | public_html/index.php:74 | `'/services/virus-malware-removal' => '/services',` | yes (not visible) | False positive: deliberate 301 (checked: 301 → /services). |
| IT support | public_html/index.php:80 | `'/services/business-it-support'   => '/services',` | yes (not visible) | False positive: deliberate 301 (checked). |
| other retired IT slugs | public_html/index.php:75-79, 81-82 | `pc-laptop-repair`, `data-recovery`, `network-wifi-setup`, `software-installation`, `remote-support`, `hardware-upgrades`, `smart-home-iot` | yes (not visible) | False positive: 301 map. |
| membership / book / eula / uninstall | public_html/index.php:68-72 | `'/membership' => '/pricing'`, `'/book' => '/start-project'`, `'/eula' => '/terms'`, `'/uninstall' => '/terms'` | yes (not visible) | False positive: deliberate 301s (all 5 checked). These are the only eula/uninstall hits. |
| virus / book / membership | start.sh:120, 121, 126 | `"/book"` `"/membership"` `"/services/virus-malware-removal"` | no | Stale dev smoke test (these are now 301s). |
| booking (wizard) | public_html/assets/js/app.js:783-786 | `BOOKING WIZARD (Alpine.js)` … `function registerBookingWizard() { Alpine.data('bookingWizard', () => ({` | yes (public JS) | **Real problem.** Dead IT-repair booking flow shipped to every visitor. No page uses `x-data="bookingWizard"`. |
| booking (device/issue/remote) | public_html/assets/js/app.js:792-794 | `deviceType:    '',` `issue:         '',` `serviceType:   'Remote (Online)',` | yes | **Real problem.** Repair-desk fields readable in public JS. |
| booking | public_html/assets/js/app.js:827, 829 | `'Select your device type.'` / `'Please describe the issue (at least 10 characters).'` | yes | **Real problem.** Same dead flow. |
| booking | public_html/assets/js/app.js:849, 855-856 | `async submitBooking() {` … `deviceType: this.deviceType, issue: this.issue,` | yes | **Real problem.** Same dead flow. |
| book | public_html/assets/js/app.js:867 | `const res = await fetch('/api/book', {` | yes | **Real problem.** POST /api/book returns 404 `{"success":false,"message":"Endpoint not found."}`. |
| book | public_html/assets/js/app.js:879 | `window.location.href = '/book-confirmation?ref=' + encodeURIComponent(this.bookingRef);` | yes | **Real problem.** /book-confirmation returns 404; the redirect map only covers `/book/confirmation`. |
| booking / membership | public_html/assets/js/app.js:900-901 | `registerBookingWizard();` `registerMembership();` | yes | **Real problem.** Dead registrations run on every page. |
| membership | public_html/assets/js/app.js:762-768 | `ALPINE.JS MEMBERSHIP BILLING TOGGLE` … `plans: window.MEMBERSHIP_PLANS ?? [],` | yes | Real (low). Dead code; `MEMBERSHIP_PLANS` is never defined. |
| membership / booking | public_html/assets/js/app.js:780, 892, 993, 998 | `function initMembershipToggle() { /* registered via alpine:init */ }` / `initBookingWizard` in the init list | yes | Real (low). Dead stubs. |
| booking (widget) | public_html/assets/js/app.js:105-109 | `BOOKING WIDGET (floating CTA — appears after scroll)` … `getElementById('booking-widget')` | yes | False positive (naming only). It drives the live floating "Get a free quote" button. |
| booking (widget) | public_html/partials/footer.php:9 → all 20 pages (e.g. home.html:1702) | `<div id="booking-widget">` | yes (visible in page source) | Naming only. Links to /start-project, aria-label "Get a free quote". Rename optional. |
| membership | public_html/pages/home.php:497 → / (home.html:1365, 1416, 1469) | `<div class="membership-card <?= !empty($plan['featured']) ? 'featured' : '' ?> relative">` | yes (class in source) | Cosmetic class name, low. |
| membership | public_html/pages/pricing.php:67 → /pricing (pricing.html:611) | `'membership-card featured ring-1 ring-[var(--accent)]'` | yes | Cosmetic class name, low. |
| membership / booking CSS | src/input.css:1327-1365, 1430-1440, 1579-1615, 1727, 1740 | `/* ── Membership Cards ── */ .membership-card {` / `/* ── Booking Wizard ── */ .wizard-step {` / `#booking-widget {` | yes (compiled) | The wizard styles (1430-1440) are dead. The membership-card and #booking-widget styles are in use (naming only). |
| booking | public_html/includes/helpers.php:91-92 | `/* ── Booking reference generator ── */ function generate_booking_ref(): string {` | yes (not visible) | Dead code, low. |
| booking | public_html/admin/index.php:121, 129, 146 | `$bookings = read_log('nxn_bookings.log');` / `'Bookings'` / `'Recent Bookings'` | yes (admin, behind login) | Stale admin tile for a removed flow, low. |
| booking | sql/schema.sql:11-31 | `-- ── Bookings ──` `CREATE TABLE IF NOT EXISTS bookings (` `booking_ref …` `preferred_date …` | yes (per scope) | Real (low). The schema still creates the retired bookings table. |
| booking | sql/schema.sql:54 | `consent_method VARCHAR(100), -- 'website_footer', 'booking_form', etc.` | yes | Stale comment. |
| "issue" (help-desk wording) | public_html/pages/contact.php:129 → /contact (contact.html:634) | `placeholder="Describe your issue or question…"` | yes (visible) | Real (low). Support-desk phrasing; use project wording. |
| printer, tech support, technical support, computer repair (apart from faqs.php:16), IT repair, remote access, AnyDesk, TeamViewer, Geek Squad, HP, Epson, Brother, Norton, McAfee | — | no hits in source or in any rendered page | — | Clean. |
| Canon | 25 hits, e.g. public_html/partials/head.php:31 | `<link rel="canonical" …` | yes | False positive: substring of "canonical". No whole-word "Canon". |

## 2. Claims

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| track record | public_html/pages/home.php:224 → / (home.html:812) | `<p class="eyebrow">Our Track Record</p>` | yes | **Real problem.** The company was established in 2026 (about.php:290), there are no case studies, and every stat in config/site-stats.php:14-17 is null. |
| results that compound | public_html/pages/home.php:225 → / (home.html:813) | `<h2>Results that <span class="text-gradient">compound</span></h2>` | yes | **Real problem.** Implies a proven history of results. |
| (same section) | public_html/pages/home.php:226 | `Measurable outcomes for brands, startups, and growing businesses worldwide.` | yes | **Real problem.** Implies outcomes already delivered. |
| clients served / worldwide | public_html/pages/home.php:234 → / (home.html:820) | `['big' => 'US · CA · Worldwide', 'sub' => 'Clients served across borders'],` | yes | **Real problem.** Client claim that can't be verified. |
| team (one team) | public_html/pages/home.php:235 → / (home.html:824) | `['big' => '3 Core Services', 'sub' => 'Web, marketing &amp; ecommerce, one team'],` | yes | Real if there is no staff. |
| senior / specialists | public_html/pages/home.php:237 → / (home.html:831) | `['big' => 'Senior Specialists', 'sub' => 'Design, development &amp; marketing experts'],` | yes | **Real problem.** |
| senior | public_html/pages/home.php:169 → / (home.html:698) | `Senior-level talent` (hero chip, next to a ★ icon at :168) | yes | **Real problem.** |
| results-focused | public_html/pages/home.php:149 → / (home.html:683) | `['🎯', 'Results-Focused'],` | yes | Soft marketing, low. |
| results-driven | public_html/pages/home.php:333 → / (home.html:975) | `Transparent, results-driven pricing` | yes | Soft marketing, low. |
| senior / dedicated project manager | public_html/pages/home.php:344-345 → / (home.html:986-987) | `We're a senior-level agency … and a dedicated project manager on every engagement.` | yes | **Real problem.** A promise "on every engagement". |
| senior | public_html/pages/home.php:350 → / (home.html:997) | `'Senior-Level Talent', 'desc' => 'Experienced designers, developers & marketers — no juniors learning on your dime.'` | yes | **Real problem.** |
| compound | public_html/pages/home.php:352 → / (home.html:1018) | `'We test, measure, and optimize so your budget compounds over time.'` | yes | Soft promise. Soften. |
| dedicated project manager | public_html/pages/home.php:355 → / (home.html:1047) | `'Dedicated Project Manager', 'desc' => 'One point of contact who keeps your project on time and on scope.'` | yes | Real if the business is one person. |
| compound | public_html/pages/home.php:403 → / (home.html:1206) | `We go live, then measure and optimize — compounding your results with transparent monthly reporting.` | yes | Soft promise. Soften. |
| senior | public_html/pages/home.php:558 → / (home.html:1546) | `Senior talent, conversion-focused work, and transparent delivery — across the US, Canada, and worldwide.` | yes | **Real problem.** |
| senior / specialists | public_html/pages/home.php:564 → / (home.html:1554-1555) | `'Senior-level talent', 'desc' => 'Your work is handled by specialists — not juniors learning on the job.'` | yes | **Real problem.** |
| global (on-time) | public_html/pages/home.php:567 → / | `'Global, on-time delivery', 'desc' => 'Remote-friendly delivery across time zones, on schedule.'` | yes | "on-time" is a promise. Low. |
| success story | public_html/pages/home.php:583 → / (home.html:1582) | `Be our next success story →` | yes | **Real problem.** Implies existing success stories; the site has none. |
| global (clients) | public_html/pages/home.php:191, 193 → / | `'Branding', 'Global Clients', 'USD & CAD',` (marquee) | yes | **Real problem.** Implies existing international clients. |
| global (hero) | public_html/pages/home.php:115 → / | `Global digital agency · Serving the US, Canada &amp; worldwide` | yes | Positioning claim for a single-location startup. Medium. |
| worldwide | public_html/pages/home.php:134 → / | `High-performing websites, data-driven marketing, and ecommerce stores that sell — in the US, Canada &amp; worldwide.` | yes | Positioning. Low. |
| global delivery | public_html/pages/home.php:150, 324, 354, 660 → / | `['🌍', 'Global Delivery']` / `Global delivery<br>across time zones` / `✓ Global delivery` | yes | Acceptable if remote delivery is real. Low. |
| results-driven | public_html/pages/about.php:125 → /about (about.html:603) | `'Results-Driven Strategy', 'desc' => 'Every decision ties back to a measurable business outcome — not vanity metrics.'` | yes | Soft marketing. Low. |
| full-service team / specialists / under one roof | public_html/pages/about.php:229 → /about (about.html:790-791) | `['big' => 'Full-Service Team', 'sub' => 'Web, marketing &amp; ecommerce specialists under one roof'],` | yes | **Real problem.** |
| senior | public_html/pages/about.php:250 → /about (about.html:806) | `A senior-level partner that thinks strategically, builds creatively, and reports honestly.` | yes | **Real problem.** |
| proven expertise | public_html/pages/about.php:256 → /about (about.html:814) | `'Proven Expertise', 'desc' => 'Experienced designers, developers, and marketers across all three pillars — no juniors…'` | yes | **Real problem.** |
| dedicated (point of contact) | public_html/pages/about.php:258 → /about (about.html:829) | `'A dedicated point of contact, clear communication, and your goals at the center of every decision.'` | yes | False positive: true even for a sole operator. |
| results that matter | public_html/pages/about.php:259 → /about (about.html:835) | `'Results That Matter', 'desc' => 'We measure what counts and report it in plain English…'` | yes | Soft marketing. Low. |
| global | public_html/pages/about.php:40, 287 → /about | `Nexisco Network is a global digital agency.` / `A global agency,<br>rooted in Canada.` | yes | Positioning. Medium. |
| implied history | public_html/pages/about.php:291 → /about | `From day one, we built for the web — partnering with clients far beyond our home city.` | yes | **Real problem.** Implied client history for a 2026 company. |
| senior / around the world | public_html/pages/about.php:294-295 → /about (about.html:874) | `Today we serve businesses in the United States, Canada, and around the world … the same senior-level craft` | yes | **Real problem.** |
| worldwide / global | public_html/pages/about.php:69, 88, 228, 261, 312 → /about | `We serve clients in the United States, Canada, and worldwide` / `'Global Delivery'` / `'Reach' … 'US, Canada &amp; worldwide'` | yes | Positioning. Low to medium. |
| full-service team / specialists | public_html/pages/about.php:349-350 → /about (about.html:942-943) | `<h2>A full-service team <span …>on your side</span></h2>` `Specialists across design, development, and marketing — collaborating as one team` | yes | **Real problem.** |
| senior team | public_html/pages/partners.php:46 → /partners (partners.html:474) | `every tier is delivered by the same senior team across web, marketing, and ecommerce.` | yes | **Real problem.** |
| senior | public_html/pages/partners.php:63 → /partners (partners.html:512) | `Your client never sees Nexisco — just your name on senior-level web, marketing, and ecommerce output.` | yes | **Real problem.** |
| senior | public_html/pages/partners.php:118 → /partners (partners.html:591) | `'Senior Delivery, Your Brand', 'desc' => 'Experienced designers, developers, and marketers ship the work…'` | yes | **Real problem.** |
| dedicated project manager | public_html/pages/partners.php:124 → /partners (partners.html:624) | `'Dedicated Project Manager', 'desc' => 'One point of contact who keeps every engagement on time, on scope…'` | yes | Real if there is no project manager. |
| global / worldwide | public_html/pages/partners.php:5, 28, 120 → /partners | `For agencies, freelancers, and consultants worldwide` / `'Global & Remote-Friendly'` | yes | Positioning. Low. |
| senior | public_html/pages/service-detail.php:86 → all 3 /services/&lt;slug&gt; (line 579) | `Senior-level delivery, built around your goals — for clients in the US, Canada &amp; worldwide.` | yes | **Real problem.** |
| global delivery | public_html/pages/service-detail.php:216 → all 3 /services/&lt;slug&gt; | `free consultation, global delivery, USD &amp; CAD.` | yes | Low. |
| dedicated manager | public_html/data/pricing.php:55 (Pro plan) → /pricing (pricing.html:676) | `'Dedicated Manager',` | yes | **Real problem.** A paid plan feature that must actually be delivered. |
| dedicated manager | public_html/data/pricing.php:72 (Advanced plan) → /pricing (pricing.html:756) | `'Dedicated Manager',` | yes | **Real problem.** |
| dedicated project manager | public_html/data/pricing.php:83 (Enterprise plan) → /pricing (pricing.html:794) | `'Dedicated Project Manager',` | yes | **Real problem.** |
| compound | public_html/data/services.php:74 → /services/digital-marketing (line 684) | `'Transparent monthly reporting and continuous testing to compound results.'` | yes | Borderline. Soften. |
| compound | public_html/data/services.php:86 → /services/digital-marketing (:234 JSON-LD, :812) | `SEO and content typically compound over 3–6 months. We set realistic expectations per channel` | yes | False positive: hedged description of how the channel behaves. |
| compound | public_html/data/faqs.php:88 → /faq (:386 JSON-LD, :1300) | `SEO and content typically compound over 3–6 months.` | yes | False positive: hedged. |
| 2 business hours | public_html/pages/contact.php:28 → /contact (contact.html:512) | `Questions, quotes, or advice on web, marketing, or ecommerce — we respond within 2 business hours.` | yes | **Real problem.** A response-time promise (see the next row). |
| 2 business hours | public_html/pages/contact.php:90 → /contact (contact.html:596) | `We'll get back to you within 2 business hours.` | yes | **Real problem.** |
| 2 business hours | public_html/api/contact.php:86 (JSON shown after submitting /contact and /start-project) | `"Thanks {$name}! We received your message and will reply within 2 business hours."` | yes | **Real problem (high).** The promise follows a submission that is never emailed (`send_mail` commented out at :76) and only logged when `APP_DEBUG` is on. |
| 1 business day | public_html/pages/partners.php:156; public_html/api/partners.php:21, 67 | `We review every application and reply within 1 business day.` | yes | Real. Partner applications are also never emailed (api/partners.php:58 commented out). |
| 1–2 business days | public_html/pages/start-project.php:67 | `'A clear proposal and quote in USD or CAD, usually within 1–2 business days.'` | yes | Low. Hedged with "usually". |
| 7 days | public_html/partials/footer.php:106 → all 20 pages (e.g. home.html:1799) | `Support: 9am–8pm, 7 days` | yes | **Real problem.** Contradicts footer.php:105 (Mon–Fri 8–7, Sat 9–5 PT, no Sunday) and faq.php:124 (Mon–Fri only). No time zone. |
| 7 days | public_html/partials/head.php:39 → all pages (line 20) | `<meta name="revisit-after" content="7 days">` | yes | False positive: crawler meta tag. |
| global (meta) | public_html/partials/head.php:38 | `<meta name="distribution" content="global">` | yes | False positive: meta tag. |
| global (JSON-LD and meta descriptions) | public_html/partials/head.php:7, 170; public_html/includes/seo.php:47; public_html/pages/home.php:17; about.php:13; contact.php:6; services-index.php:6; terms.php:4; privacy.php:4; cookie-policy.php:4; disclaimer.php:4; cancellation-policy.php:4 | `Nexisco Network is a global digital agency delivering web development, digital marketing…` | yes | Positioning. Appears in every page's JSON-LD (head.php:170). Medium. |
| global (legal identification) | privacy.php:28, 60; cookie-policy.php:27; disclaimer.php:27; cancellation-policy.php:27; refund-policy.php:28; opt-in-opt-out.php:28 | `We are a global digital agency serving clients across the United States, Canada, and worldwide.` | yes | Real (low). A marketing claim inside legal identification text. |
| global / worldwide (footer) | public_html/partials/footer.php:86, 109, 182 → all pages | `A global digital agency for businesses in the US, Canada, and worldwide.` | yes | Positioning. Low. |
| worldwide (areaServed) | public_html/partials/head.php:179, 198; public_html/includes/seo.php:32, 56, 92 | `"areaServed": ["US", "CA", "Worldwide"]` | yes | Low. "Worldwide" is not an ISO area code. |
| worldwide (portfolio) | public_html/pages/portfolio.php:7, 32 → /portfolio | `A selection of projects we've crafted for brands, startups, and growing businesses worldwide.` | yes | **Real problem.** Contradicts portfolio.php:58-61 (the items are illustrative; "Real client case studies are on the way"). |
| worldwide (misc.) | 404.php:32; faq.php:15, 36; services-index.php:30; start-project.php:6, 44; contact.php:29; data/faqs.php:18 | `… for clients in the US, Canada, and worldwide.` | yes | Positioning. Low. |
| priority support | public_html/data/pricing.php:89 → /pricing | `'Priority Support',` | yes | Low. Must be deliverable. |
| team (staff) | public_html/pages/about.php:249 → /about (about.html:805); home.php:341 → / (home.html:983) | `<h2>The growth team your brand <span …>actually needs.</span></h2>` | yes | **Real problem** if there is no staff (see §7). |
| team (staff) | public_html/pages/about.php:348 → /about (about.html:941) | `<p class="eyebrow">Our Team</p>` | yes | **Real problem.** The section shows only icons, no people. |
| team (staff) | public_html/pages/faq.php:124 → /faq (faq.html:1417) | `Our team replies during business hours, Mon–Fri 8am–7pm PT.` | yes | Real (low). Also uses PT. |
| team (staff) | public_html/pages/cancellation-policy.php:43, 63, 66; refund-policy.php:65 | `Deposits reserve our team's time` / `abusive conduct toward our team` / `team availability` / `the team, time, and budget` | yes | Low. Fine if contractors exist; otherwise say "our". |
| team (comments) | public_html/pages/about.php:6 (PHP docblock); about.php:342 (HTML comment, visible in source) | `Stats band \| Why Nexisco \| Company Details \| Team \| CTA` / `OUR TEAM / EXPERTISE` | yes | False positive (internal). |
| team (not staff) | public_html/pages/partners.php:111; data/faqs.php:97; data/services.php:27, 124 | `Extend your team,<br>not your overhead.` / `based on your catalog, budget, and team.` | yes | False positive: refers to the partner's or client's team. |
| senior / global (dev tooling) | CLAUDE.md:8, 56, 84, 120, 149; setup.sh:189, 190, 654 | `You are a **senior UI/UX designer…**` / `globals.css` | no | False positive. |
| global (code) | public_html/assets/js/app.js:8, 36; includes/seo.php:39; config/site-stats.php:7; partials/head.php:161 (HTML comment) | `GLOBAL STATE` / `ProfessionalService schema (global digital agency)` | yes | False positive. |

## 3. Template text

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| general template / qualified lawyer | public_html/pages/terms.php:118 → /terms (terms.html:547) | `This page is a general template and not legal advice. We recommend you have a qualified lawyer review these Terms before relying on them.` | yes (visible) | **Real problem (high).** Tells clients the binding Terms are a template, and the note is addressed to the site owner. |
| legal counsel | public_html/pages/privacy.php:25 → /privacy (privacy.html:454) | `This Privacy Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel before relying on it` | yes (visible) | **Real problem.** A note to the owner, published to visitors. |
| legal counsel | public_html/pages/refund-policy.php:25 → /refund-policy (:454) | `This Refund Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel…` | yes | **Real problem.** |
| legal counsel | public_html/pages/cookie-policy.php:25 → /cookie-policy (:454) | `…forms part of our Privacy Policy. We recommend you have it reviewed by qualified legal counsel before relying on it…` | yes | **Real problem.** |
| legal counsel | public_html/pages/disclaimer.php:25 → /disclaimer (:454) | `This Disclaimer is provided for general information. We recommend you have it reviewed by qualified legal counsel…` | yes | **Real problem.** |
| legal counsel | public_html/pages/cancellation-policy.php:25 → /cancellation-policy (:454) | `This Cancellation Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel…` | yes | **Real problem.** |
| legal counsel | public_html/pages/opt-in-opt-out.php:25 → /opt-in-opt-out (:454) | `This Opt-In / Opt-Out Policy is provided for general information. We recommend you have it reviewed by qualified legal counsel…` | yes | **Real problem.** |
| legal advisor | public_html/pages/terms.php:25 → /terms (terms.html:454) | `We recommend you have your own legal advisor review any agreement before signing; nothing on this page is legal advice.` | yes | Borderline. It is addressed to the client, which is acceptable, but "nothing on this page is legal advice" is odd inside a binding agreement. |
| placeholder (admin hash) | sql/schema.sql:88, 91 | `-- Default admin user (password: 'change_me' — UPDATE IMMEDIATELY)` / `VALUES ('admin', '$2y$12$placeholder_replace_with_real_hash_IMMEDIATELY');` | yes | **Real problem.** Seeds a placeholder admin row and documents a default password. |
| OWNER TO-DO | public_html/data/pricing.php:7 | `* set different CAD values here if desired (see OWNER TO-DO).` | yes (not visible) | False positive (internal). It points to a TO-DO section that doesn't exist. |
| "Config Sample" header | public_html/config/config.php:3 | `* Nexisco Network — Config Sample` | yes (not visible) | False positive: the live config still carries the sample header. |
| Replace (auth) | public_html/admin/index.php:5 | `* Basic password-protected dashboard. Replace with full auth in production.` | yes (not visible) | Not a visitor-facing text issue, but flags weak admin auth. |
| "on the way" | public_html/pages/portfolio.php:61 → /portfolio (portfolio.html:524) | `A selection of the kinds of projects we deliver. Real client case studies are on the way.` | yes (visible) | Honest disclosure. Contradicts portfolio.php:32 "projects we've crafted". |
| NOTE (owner), **HTML comment, visible in source** | public_html/partials/footer.php:22 → all 20 pages (e.g. home.html:1715) | `<!-- NOTE (owner): replace with final footer background image -->` | yes | **Real problem (low).** Visible in view-source on every page. |
| NOTE (owner), HTML | public_html/partials/footer.php:174 → all 20 pages (e.g. home.html:1869) | `<!-- NOTE (owner): swap in real card-network / processor logos when confirmed. -->` | yes | **Real problem.** Says the payment processors aren't confirmed. |
| NOTE (owner), HTML | public_html/pages/home.php:55 → / (home.html:585) | `<!-- NOTE (owner): add agency video sources (hero-bg.webm + hero-bg.mp4) -->` | yes | **Real problem (low).** |
| NOTE (owner), HTML | public_html/pages/home.php:211 → / (home.html:799) | `<!-- NOTE (owner): replace with final stats background image -->` | yes | **Real problem (low).** |
| NOTE (owner), HTML | public_html/pages/home.php:314 → / (home.html:956) | `<!-- NOTE (owner): replace with a real team / studio photo -->` | yes | **Real problem (high).** Shows the "team" photo is stock (see §7). |
| NOTE (owner), HTML | public_html/pages/home.php:630 → / (home.html:1663) | `<!-- NOTE (owner): replace with final CTA background image -->` | yes | **Real problem (low).** |
| NOTE (owner), HTML | public_html/pages/cookie-policy.php:91 → /cookie-policy (:520) | `<!-- NOTE (owner): if you enable a different analytics provider, update the cookie names / retention above; if you use no analytics, remove this row. -->` | yes | **Real problem.** Shows the cookie table may not match reality. |
| NOTE (owner), HTML | public_html/pages/portfolio.php:58-59 → /portfolio (portfolio.html:521) | `<!-- NOTE (owner): these are illustrative showcase items. Replace each with a real client case study … before running paid traffic. -->` | yes | **Real problem.** |
| internal HTML comment (not "NOTE (owner)") | public_html/pages/home.php:542-543 → / (home.html:1530-1531) | `WHY CLIENTS CHOOSE NEXISCO (value section — the reviews carousel can be re-enabled once genuine client testimonials are supplied)` | yes | **Real problem.** Admits in view-source that there are no genuine testimonials. |
| internal HTML comment | public_html/pages/home.php:206 → / (home.html:794); about.php:220 → /about (about.html:779) | `VALUE-STATS SECTION (factual; real figures optional via config/site-stats.php)` / `see config/site-stats.php for real figures` | yes | Real (low). Signals that the stats aren't real figures. |
| NOTE (owner), **PHP comment, not visible** | public_html/api/contact.php:75 | `// NOTE (owner): Uncomment when real PHPMailer is installed` | yes (not visible) | Not a visibility issue, but **functional: contact and quote form submissions are not emailed.** |
| NOTE (owner), PHP | public_html/api/newsletter.php:40, 55 | `// NOTE (owner): Insert into DB — example query:` / `// NOTE (owner): send_mail($email, '', 'Welcome to Nexisco Network', $welcome);` | yes (not visible) | Functional: subscribers are neither stored nor emailed, and the CASL consent record isn't persisted. |
| NOTE (owner), PHP | public_html/api/partners.php:58 | `// NOTE (owner): send_mail('partners@nexisconetwork.ca', 'Nexisco Network', "Partner Application: {$business}", $body);` | yes (not visible) | Functional: partner applications are not emailed. |
| NOTE (owner), PHP | public_html/data/portfolio.php:7 | `* NOTE (owner): these are ILLUSTRATIVE showcase items with representative stock` | yes (not visible) | Internal only. Content issue is covered at portfolio.php:58. |
| NOTE (owner), PHP | public_html/data/services.php:9 | `* NOTE (owner): hero_image / card_image use representative Unsplash stock.` | yes (not visible) | Internal only. |
| placeholder= (form hints) | contact.php:100, 104, 111; partners.php:168, 172, 179, 217; start-project.php:103, 107, 114, 118, 157; footer.php:53 | `placeholder="Jane Smith"` / `placeholder="(416) 555-0100"` / `placeholder="you@company.com"` | yes | False positive: input hints. |
| placeholder= (own number) | public_html/pages/partners.php:184 → /partners (partners.html:671) | `placeholder="+1 (888) 909-9466"` | yes | Low. Uses the company's real number as the example, so it looks pre-filled. |
| placeholder (CSS) | src/input.css:1465-1466 | `.form-input::placeholder,` | yes | False positive. |
| template (other) | includes/mailer.php:59, 63; api/*.php `mail_template(`; data/services.php:7, 24; admin/index.php:126, 143; .env.example:1 | `no cookie-cutter templates` / `grid-template-columns` / `Deployment Credentials TEMPLATE` | mixed | False positive. |
| lorem, TODO, FIXME, example.com | — | no hits in source or rendered | — | Clean. |

## 4. Time zones

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| PT | public_html/partials/footer.php:105 → all 20 pages (e.g. home.html:1798) | `🕑 Mon–Fri 8am–7pm PT · Sat 9am–5pm PT<br>` | yes | **Real problem.** The business is in Edmonton (Mountain Time), and the app time zone is `'America/Edmonton'` (config/config.php:27). The next line (:106) says "9am–8pm, 7 days". |
| PT | public_html/pages/about.php:333 → /about (about.html:926) | `<span …>Hours:</span> Mon–Fri 8am–7pm PT · Sat 9am–5pm PT</p>` | yes | **Real problem.** |
| PT | public_html/pages/contact.php:50 → /contact (contact.html:565) | `'label' => 'Hours', 'value' => 'Mon–Fri 8am–7pm PT · Sat 9am–5pm PT', 'href' => null],` | yes | **Real problem.** |
| PT | public_html/pages/faq.php:124 → /faq (faq.html:1417) | `Our team replies during business hours, Mon–Fri 8am–7pm PT.` | yes | **Real problem.** Also omits Saturday, which conflicts with the other hours. |
| PT | public_html/pages/refund-policy.php:100 → /refund-policy (refund-policy.html:529) | `Hours: Mon–Fri 8am–7pm PT · Sat 9am–5pm PT.` | yes | **Real problem.** Inside a legal contact block. |
| PST | public_html/pages/terms.php:45 → /terms (terms.html:474) | `(such as GST/HST/PST in Canada, or sales tax and similar charges in other jurisdictions)` | yes | False positive: provincial sales tax. |
| $pt | public_html/pages/partners.php:85, 91 | `<?php foreach ($m['points'] as $pt): ?>` / `<?= e($pt) ?>` | yes | False positive: PHP variable. |
| pt-* | 23 lines, e.g. public_html/pages/home.php:110, public_html/partials/footer.php:104 | `pt-36 pb-24 md:pt-44` / `leading-relaxed pt-1` | yes | False positive: Tailwind classes. |
| Pacific, PDT, PST (as a time zone) | — | no hits | — | Clean. |
| openingHours (JSON-LD) | — | none in head.php or seo.php | — | No machine-readable hours to fix. |

## 5. Legal name (no "Inc.")

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| footer © | public_html/partials/footer.php:181 → all 20 pages (e.g. home.html:1876, which renders `© 2026 Nexisco Network All rights reserved.`) | `<p>© <?= date('Y') ?> Nexisco Network All rights reserved.</p>` | yes | **Real problem.** Missing "Inc." and the period before "All". |
| CASL consent | public_html/partials/footer.php:60-61 → all pages (home.html:1753-1754) | `By subscribing you expressly consent to receive commercial electronic messages from Nexisco Network.` | yes | **Real problem.** CASL consent should name the legal entity. |
| About "Legal entity" | public_html/pages/about.php:309 → /about (about.html:888-889) | `['k' => 'Legal entity', 'v' => 'Nexisco Network'],` | yes | **Real problem (high).** Labelled "Legal entity" but omits Inc. |
| JSON-LD legalName (every page) | public_html/partials/head.php:167-168 → all pages (line 133-134) | `"name": "Nexisco Network",` `"legalName": "Nexisco Network",` | yes | **Real problem.** legalName should be "Nexisco Network Inc."; name is fine as the brand. |
| JSON-LD legalName (Organization) | public_html/includes/seo.php:14-15 → /, /about | `'name' => 'Nexisco Network', 'legalName' => 'Nexisco Network',` | yes | **Real problem.** |
| JSON-LD legalName (ProfessionalService) | public_html/includes/seo.php:44-45 → /, /contact | `'name' => 'Nexisco Network', 'legalName' => 'Nexisco Network',` | yes | **Real problem.** |
| JSON-LD provider | public_html/includes/seo.php:90 → /services/* (line 207) | `'provider' => ['@type' => 'Organization', 'name' => 'Nexisco Network'],` | yes | Low. This is name, not legalName. |
| JSON-LD WebSite name | public_html/partials/head.php:224 | `"name": "Nexisco Network",` | yes | False positive: brand name. |
| Privacy identification | public_html/pages/privacy.php:28 → /privacy (privacy.html:457) | `Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, … ("Nexisco Network", "we", "our", "us")` | yes | **Real problem.** |
| Terms party | public_html/pages/terms.php:25 → /terms (terms.html:454) | `binding agreement between you … and Nexisco Network, a digital agency based in Canada with its registered office at …("Company"` | yes | **Real problem (high).** The contracting party must be the legal entity. |
| Refund identification | public_html/pages/refund-policy.php:28 → /refund-policy (:457) | `This Refund Policy ("Policy") is issued by Nexisco Network, a digital agency based in Canada with its registered office at` | yes | **Real problem.** |
| Cookie identification | public_html/pages/cookie-policy.php:27 → /cookie-policy (:456) | `This Cookie Policy is issued by Nexisco Network, a digital agency based in Canada with its registered office at` | yes | **Real problem.** |
| Disclaimer identification | public_html/pages/disclaimer.php:27 → /disclaimer (:456) | `This Disclaimer is issued by Nexisco Network, a digital agency based in Canada with its registered office at` | yes | **Real problem.** |
| Cancellation identification | public_html/pages/cancellation-policy.php:27 → /cancellation-policy (:456) | `This Cancellation Policy ("Policy") is issued by Nexisco Network, a digital agency based in Canada with its registered office` | yes | **Real problem.** |
| Opt-in identification | public_html/pages/opt-in-opt-out.php:28 → /opt-in-opt-out (:457) | `Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, … ("Nexisco Network", "we", "our", "us")` | yes | **Real problem.** |
| Privacy Officer block | public_html/pages/privacy.php:92 → /privacy (privacy.html:521) | `<strong>Privacy Officer — Nexisco Network</strong><br>` | yes | **Real problem.** |
| Privacy Officer block | public_html/pages/cookie-policy.php:117 → /cookie-policy (:546) | `<strong>Privacy Officer — Nexisco Network</strong><br>` | yes | **Real problem.** |
| CASL contact block | public_html/pages/opt-in-opt-out.php:70 → /opt-in-opt-out (:499) | `<strong>Nexisco Network — Communications &amp; CASL Compliance</strong><br>` | yes | **Real problem.** |
| Legal contact / notice blocks | terms.php:109 (terms.html:538); refund-policy.php:94 (:523); disclaimer.php:59 (:488); cancellation-policy.php:74 (:503) | `<strong>Nexisco Network</strong><br>` | yes | **Real problem.** |
| Operative clauses | public_html/pages/terms.php:28, 54, 81 (twice), 93 | `remain the property of Nexisco Network.` / `total aggregate liability of Nexisco Network, its directors, officers` | yes | Lower. These are defined-term uses once :25 is fixed. "directors, officers" assumes a corporation, which supports using "Inc.". |
| Operative clauses | public_html/pages/disclaimer.php:43, 46, 49, 52 | `between Nexisco Network and those third parties` / `Nexisco Network, its directors, officers, employees` | yes | Lower. Defined-term uses once :27 is fixed. |
| Mailer CASL footer | public_html/includes/mailer.php:126 | `You're receiving this email from Nexisco Network because you requested a service or opted in to commercial communications.` | yes | **Real problem.** CASL sender identification. |
| Mailer sender block | public_html/includes/mailer.php:127 | `<strong style="color:#475569">Nexisco Network</strong><br>` | yes | **Real problem.** |
| Mailer © | public_html/includes/mailer.php:133 | `© {$year} Nexisco Network All rights reserved.` | yes | **Real problem.** Also missing the period. |
| Mail From name | public_html/includes/mailer.php:37; config/config.php:21; config/config.sample.php:21 | `$smtp['from_name'] ?? 'Nexisco Network'` / `'from_name' => 'Nexisco Network',` | yes | Low. A display name; the brand is fine. |
| The only "Inc." | public_html/site.webmanifest:2 | `"name": "Nexisco Network Inc.",` | yes | Inconsistent with every other legal mention. The same file carries the old IT tagline (§1). |
| Titles and metas | e.g. privacy.php:3; head.php:32-33, 43, 48 | `'Privacy Policy \| Nexisco Network'` / `<meta name="author" content="Nexisco Network">` | yes | False positive: brand usage. |

## 6. Ratings markup

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| aggregateRating, ratingValue, reviewCount, bestRating, `"@type": "Review"` | — | no hits in source or any rendered page | — | Clean. |
| testimonial (JS) | public_html/assets/js/app.js:592-596 | `TESTIMONIALS AUTO-CAROUSEL` `function initTestimonialsCarousel() { const carousel = document.querySelector('.testimonials-carousel');` | yes | Dead code. No page has `.testimonials-carousel`. Harmless; remove. |
| testimonial (JS) | public_html/assets/js/app.js:997 | `initKenBurns, initClipReveals, initTestimonialsCarousel, initHeroTypewriter,` | yes | Dead init. |
| testimonial / star-rating (CSS) | src/input.css:1285-1300, 1314, 1320, 1732 | `/* ── Testimonials Carousel ── */ .testimonials-carousel {` / `.testimonial-card {` / `.star-rating {` | yes (compiled) | Dead styles; no markup uses them. |
| testimonial (HTML comment) | public_html/pages/home.php:542-543 → / (home.html:1530-1531) | `the reviews carousel can be re-enabled once genuine client testimonials are supplied)` | yes (visible in source) | **Real problem (low).** Admits there are no genuine testimonials. Strip the comment. |
| Testimonials (PHP docblock) | public_html/pages/home.php:6 | `* How It Works \| Portfolio preview \| Pricing preview \| Testimonials \| FAQ \| CTA` | yes (not visible) | False positive: stale comment. |
| rating (meta) | public_html/partials/head.php:37 → all pages (line 18) | `<meta name="rating"      content="general">` | yes | False positive: content-rating meta, not review markup. |
| ★ | public_html/pages/home.php:168 → / (home.html:697) | `…color:#EC4899">★</span>` (chip icon before "Senior-level talent") | yes | False positive: decorative glyph with no rating value. |
| review (verb) | terms.php:66; cookie-policy.php:112; refund-policy.php:74; partners.php:156; api/partners.php:21, 67; legal "reviewed by qualified legal counsel" lines (§3) | `Prompt reviews, approvals, and feedback` / `We review every application` | yes | False positive. |
| Testimonials / Review | CLAUDE.md:100, 385 | `TestimonialsSection.tsx` / `### Step 5: Review` | no | False positive. |

## 7. "team" near images

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| team (alt text) | public_html/pages/home.php:315-316 → / (home.html:958) | `<img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80" alt="The Nexisco Network team collaborating on a digital project"` | yes | **Real problem (high).** An Unsplash stock photo presented as the company's own team. |
| team (comment beside the image) | public_html/pages/home.php:314 → / (home.html:956) | `<!-- NOTE (owner): replace with a real team / studio photo -->` | yes (visible in source) | **Real problem.** Confirms in view-source that the photo is stock. |
| team (heading beside the image) | public_html/pages/home.php:341 → / (home.html:983) | `The growth team your brand <span class="text-gradient-electric">actually needs.</span>` | yes | **Real problem.** Reinforces the team claim next to a stock people photo. |
| overlay badges on the same image | public_html/pages/home.php:324, 333 | `Global delivery<br>across time zones` / `Transparent, results-driven pricing` | yes | Claims overlaid on the stock photo (see §2). |
| same stock photo, /about hero | public_html/pages/about.php:26-27 → /about | `photo-1522071820081-009f0129c71c … alt="" loading="eager"` (wrapper is aria-hidden) | yes | False positive for alt text. The nearby h1 "Building digital experiences that drive growth." has no team wording, but this is the same "team" stock image. |
| same stock photo, /start-project hero | public_html/pages/start-project.php:32-33 | `photo-1522071820081-009f0129c71c … alt="" loading="eager"` | yes | False positive. h1 is "Get a free quote." |
| same stock photo, footer background | public_html/partials/footer.php:23-24 → all pages | `photo-1522071820081-009f0129c71c?w=1920&q=60 … alt=""` (opacity 0.20) | yes | False positive. Nearby h3 is "Grow with us". |
| /partners hero image | public_html/pages/partners.php:15-16 | `photo-1521737711867-e3b97375f902 … alt=""` | yes | False positive. h1 "Your brand.<br>Our delivery."; "Extend your team" (:111) means the partner's team. Image content not checked offline. |
| How-it-works step images | public_html/pages/home.php:400-403, 408 → / | `'img' => '…photo-1517245386807-bb43f82c33c4…'` → `<img src="<?= e($step['img']) ?>" alt=""` | yes | False positive. h3 is the step title ("Discovery & Quote"). Image content not checked offline. |
| other people-type backgrounds | public_html/pages/home.php:631; portfolio.php:21; services-index.php:16 | `photo-1531403009284-440f080d1e12 … alt=""` | yes | False positive. No team wording nearby. |
| "Our Team" section with no photos | public_html/pages/about.php:348-350 → /about (about.html:941-943) | `Our Team` / `A full-service team on your side` / `Specialists across design, development, and marketing` | yes | No images (emoji icons only). The team claim is covered in §2. |
| stock images labelled as projects | public_html/pages/home.php:461 → /; public_html/pages/portfolio.php:77 → /portfolio | `alt="<?= e($p['title']) ?> — <?= e($p['tag']) ?>"` (e.g. "Corporate Website — Web Design" on Unsplash stock) | yes | Not "team". Stock images are presented as projects; disclosed at portfolio.php:61 but not on the home preview. |
| figcaption / figure / caption | — | no hits (CLAUDE.md:201 "Captions, labels" only) | — | Clean. |

## 8. Head office wording

| term | file:line | exact snippet | shipped? | verdict |
|---|---|---|---|---|
| Head Office | public_html/pages/contact.php:52 → /contact (contact.html:577) | `'label' => 'Head Office', 'value' => '1404, 49A Street NW, Edmonton, AB T6L 6H6, Canada', 'href' => null],` | yes | **Real problem.** Implies more than one office. Use "Address" or "Registered office". |
| Headquarters | public_html/pages/about.php:311 → /about (about.html:898) | `['k' => 'Headquarters',  'v' => '1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada'],` | yes | **Real problem.** Same reason. |
| headquartered | public_html/pages/about.php:290 → /about (about.html:869) | `Nexisco Network was established in 2026 and is headquartered in Edmonton, Alberta, Canada.` | yes | Real (low). Say "based in". |
| headquartered | public_html/data/faqs.php:18 → / (home.html:308 JSON-LD, :1616), /faq (faq.html:218 JSON-LD, :798) | `We are headquartered in Edmonton, Alberta, Canada, and we work with clients in the United States, Canada, and worldwide.` | yes | Real (low). Also in FAQPage JSON-LD. |
| headquartered at (legal) | public_html/pages/privacy.php:28 → /privacy (:457); public_html/pages/opt-in-opt-out.php:28 → /opt-in-opt-out (:457) | `Nexisco Network (based in Canada and headquartered at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada)` | yes | **Real problem.** Legal identification text that is inconsistent with the "registered office" wording on the other 5 legal pages. |
| registered office (for comparison) | terms.php:25; refund-policy.php:28; cookie-policy.php:27; disclaimer.php:27; cancellation-policy.php:27 | `a digital agency based in Canada with its registered office at 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada` | yes | Acceptable if the address matches the Inc.'s registered office in the Alberta corporate registry. Pick one term for all 7 legal pages. |
| headquartered | public_html/site.webmanifest:4 | `Professional IT services across Canada — headquartered in Edmonton, Alberta.` | yes | **Real problem.** Part of the old IT tagline (§1). |
| HQ | — | no hits | — | Clean. |


---

<!-- visitors -->

## 1. Static review: rules that could block visitors or vary content

| file:line | Rule | Affects page views? | Verdict |
|---|---|---|---|
| public_html/.htaccess:5-11 | Sends HTTP to HTTPS with a 301, except when HTTP_HOST starts with `localhost` or REMOTE_ADDR is `127.*`. Nothing checks `X-Forwarded-Proto` or `CF-Visitor`. | Yes. Applies to every HTTP request the same way. | Not discriminatory. Risk: behind Cloudflare "Flexible" SSL the origin always sees `HTTPS=off`, so every visitor gets an endless 301 loop. Behind a reverse proxy on 127.0.0.1 the redirect never fires. |
| public_html/.htaccess:14-24 | Any path that is not a real file or directory is rewritten to index.php. | Yes | Same for everyone. |
| public_html/.htaccess:28 | `X-Frame-Options: SAMEORIGIN` | Only when another site embeds the page in a frame | Same for everyone. |
| public_html/.htaccess:33 | HSTS for one year with `includeSubDomains; preload` | Yes, on subdomains | Same for everyone. Any subdomain that only works over HTTP (cPanel, webmail) becomes unreachable once the browser has seen this header. |
| public_html/.htaccess:37 | CSP `script-src` allows `'unsafe-inline'` and jsDelivr but not `'unsafe-eval'` | Yes, on Apache only. The php -S dev server sends no CSP. | Same for everyone. The standard Alpine v3 build loaded at public_html/partials/scripts.php:35-36 likely cannot evaluate `x-show`, `x-text` or `:class`. That would break the currency toggle (public_html/pages/pricing.php:43,82), the portfolio filter (public_html/pages/portfolio.php:39,67) and the FAQ tabs and accordions (public_html/pages/faq.php:45,76,101). The server-rendered USD price still shows. This is a functional bug, not visitor targeting. |
| public_html/.htaccess:41-45 | `.php` files get `Require all granted` | No | No effect. |
| public_html/.htaccess:48-53 | 403 for `config/`, `includes/`, `lib/` and `data/` `*.php` | No, these are not page URLs | Correct. `pages/`, `partials/`, `admin/`, `api/`, `dev-router.php`, `robots.php` and `sitemap.php` stay directly reachable. |
| public_html/.htaccess:56-58 | Denies `.env*`, `*.git*`, `composer.*` and `package.json` | No | Correct. |
| public_html/.htaccess:61-90 | Gzip, Expires and Cache-Control for CSS/JS | No content change | Same for everyone. |
| public_html/.htaccess:93-102 | `php_value` for session cookies (`secure`, `SameSite=Strict`) | No | Applies only under mod_php. PHP-FPM or LiteSpeed ignores it. |
| public_html/.htaccess:105-107 | 404 and 403 go to `/index.php`; 500 goes to `/500.html` | No | A 403 shows the 404 page. |
| public_html/.htaccess (whole file) | IP, ASN, country, Tor, user-agent or referrer rules | — | None present. |
| public_html/index.php:9-18 | Loads config and sets the timezone (`America/Edmonton`, public_html/config/config.php:27) | Only affects `date()` output | Same for everyone. |
| public_html/index.php:20-25 | Error display controlled by `APP_DEBUG` (false) | No | Same for everyone. |
| public_html/index.php:30-31 | Parses the path and trims slashes. `//about` is parsed as a host, so the path becomes `/` and the home page is served. | Yes, duplicate URL | Quirk only. `/services/` and `/services` both return 200; the canonical tag is set explicitly. |
| public_html/index.php:35-52 | API whitelist: contact, newsletter, partners | No (POST endpoints) | Same for everyone. |
| public_html/index.php:55-63 | `/admin*` loads `ltrim($uri,'/').'.php'` with no sanitising | Admin only | Path traversal. `/admin/../pages/home` (curl `--path-as-is`) returns 200, so any `.php` under the docroot can be included. |
| public_html/index.php:66-87 | 301 map for retired IT routes | Yes, same for everyone | See section 3. |
| public_html/index.php:90-133 | Exact route map, slug whitelist, then 404 | Yes | Same for everyone. No branching on user-agent, IP, geo, referrer, cookie or query string. |
| public_html/dev-router.php:3-7 | Under `php -S`, real files are served directly and everything else goes to index.php | Dev only | On Apache, `/dev-router.php` is reachable and returns an empty 200. |
| public_html/includes/helpers.php:24-40 | CSRF token in the session (`session_start`) and its check | No, the token is per session only | Not content. |
| public_html/includes/helpers.php:43-64 | `rate_limit()`: sliding window stored in `sys_get_temp_dir()/nxn_rl/` | **No.** Only called from public_html/api/contact.php:15 (5 per 900 s), public_html/api/newsletter.php:15 (3 per 3600 s) and public_html/api/partners.php:15 (2 per 3600 s). Never called on a page route. | Limits form submissions only. |
| public_html/includes/helpers.php:67-75 | `client_ip()` trusts `CF-Connecting-IP`, then the first `X-Forwarded-For` entry, then `REMOTE_ADDR`, without checking the proxy | No. Used only as the rate-limit key and for newsletter `consent_ip` (public_html/api/newsletter.php:38). | This is the only Cloudflare header anywhere in the code. It is easy to spoof, so the form limits can be bypassed. If a proxy adds no XFF, all visitors share one rate-limit bucket (forms only). |
| public_html/includes/helpers.php:92-97 | `generate_booking_ref()` | No | Unused leftover. |
| public_html/includes/helpers.php:109-116 | Service slug whitelist (3 slugs) | Yes | Same for everyone. |
| public_html/includes/helpers.php:119-124 | `is_free_email_domain()` blocks gmail, yahoo, hotmail, outlook, icloud, protonmail, aol and live | **No.** Partner-form validation only (public_html/api/partners.php:40-42 returns 422). | Form validation, not page content. |
| public_html/includes/helpers.php:127-133 | `dd()` | No | Debug helper only. |
| public_html/includes/seo.php:7-141 | Static JSON-LD | No | Uses no request input. |
| public_html/includes/db.php:7-30 | PDO singleton | No | Never called. |
| public_html/includes/mailer.php:21-56,68 | `send_mail()` (never called; calls are commented out at public_html/api/contact.php:76, public_html/api/newsletter.php:55, public_html/api/partners.php:58) and `date('Y')` | No | No email is actually sent. |
| public_html/config/config.sample.php:27-28 | Timezone; `admin_pass` is `''` | Admin only | See the admin rows. |
| public_html/config/config.php:28 (snapshot) | `admin_pass` is `''`; there is no `analytics_id` key | No | The GA block (public_html/partials/head.php:239-247) is not output. |
| public_html/config/site-stats.php:14-19 | All values `null`, so a static fallback is shown | No | Same for everyone. |
| public_html/api/contact.php:10-49 | 405 for non-POST, 429 rate limit, 403 on CSRF failure, silent honeypot "success", 422 on validation failure | Forms only | The form submits twice: both public_html/assets/js/app.js:951-986 and the inline script at public_html/pages/contact.php:147-175 listen on `#contact-form`. Each submit uses 2 of the 5 slots, so the 3rd submit hits 429. |
| public_html/api/newsletter.php:10-34 | 405, 429, honeypot, `casl_consent` required. No CSRF check. | Forms only | Consent is a hidden field preset to 1 (public_html/partials/footer.php:46), not a checkbox. |
| public_html/api/partners.php:10-42 | 405, 429, honeypot, required fields, free-email block. No CSRF check, although public_html/pages/partners.php:162 renders a token. | Forms only | Form validation. |
| public_html/admin/index.php:7,13 | `require_once config.php` is never assigned. A direct hit (`/admin/` via DirectoryIndex on Apache, or `/admin/index.php`) falls back to the hard-coded password a hard-coded password (see `admin/index.php`). Through the front controller, `admin_pass` is `''`, so an empty password is accepted. | Admin only | **Security issue.** Empty password POSTed to `/admin` returns 302 (logged in); a hard-coded password (see `admin/index.php`) POSTed to `/admin/index.php` returns 302 (logged in). The login has no CSRF check (`csrf_field` at :86 is never verified) and no lockout. |
| public_html/admin/index.php:11,34-38,54 | Session login with a 2-hour timeout; `noindex` | Admin only | Same for everyone. |
| public_html/partials/head.php:8 | Canonical tag falls back to REQUEST_URI with the query string removed. Only public_html/pages/404.php has no explicit canonical. | No | `?gclid` is stripped. |
| public_html/partials/head.php:15-18 | `session_start()` on every page | Yes, every view | Sends `Set-Cookie: PHPSESSID`, `Cache-Control: no-store, no-cache`, `Expires: 1981` and `Pragma: no-cache`, so HTML cannot be cached by a CDN or browser. Content is identical apart from the token. |
| public_html/partials/head.php:34-36 | `robots`, `googlebot` and `bingbot` meta all say `index, follow` | Same for every bot | No bot-specific content. |
| public_html/partials/head.php:145-159,255-270 | Opaque fixed `#preloader` (z-index 10000) plus `body{overflow:hidden}`, removed only by JS (public_html/assets/js/preloader.js:64-95; failsafe at :181-183, 1.5 s). No `<noscript>` fallback. | Yes, for clients without JS | Same rule for everyone, but clients that do not run JS see only the loader and cannot scroll. Depends on capability, not identity. |
| public_html/partials/footer.php:181; public_html/sitemap.php:9,37,46 | `date('Y')`; every sitemap `lastmod` is today's date | Time-dependent | Same for everyone. |
| public_html/sitemap.php:6; public_html/robots.php:3 | `X-Robots-Tag: noindex` on the sitemap and robots.txt | Crawlers only | Harmless. |
| public_html/pages/start-project.php:16-22 | `?service=` and `?plan=` pre-fill the form | Query-dependent (pre-fill only) | Harmless. |
| public_html/pages/pricing.php:43 | Currency defaults to `usd` | No | No geo detection. |
| public_html/partials/scripts.php:15-36 | GSAP, Lenis, SplitType, VanillaTilt and Alpine from jsDelivr. Alpine uses the unpinned `@3.x.x`. | Networks that block jsDelivr | Same for everyone. |
| public_html/assets/js/app.js:10-11,478-484,491 | `pointer:coarse` and `prefers-reduced-motion` hide background videos and turn off horizontal scroll (also at ≤768 px) | Presentation only | Same text for everyone. |
| public_html/assets/js/app.js:123-221 | `gsap.from` sets opacity to 0 until ScrollTrigger fires | Content is hidden until scrolled into view | Same for everyone. Low risk for renderers that do not scroll. |
| public_html/assets/js/app.js:698-719 | Hero typewriter rotates its phrase every 3.5 s | Time-based, cosmetic | Same for everyone. |
| public_html/assets/js/app.js:724-759 | Clicks on links are intercepted, then `location.href = href` after the transition | Navigation only | Not a redirect. |
| public_html/assets/js/app.js:861-879 | Booking wizard: POST to `/api/book` (404), then `location.href='/book-confirmation?ref=…'` (404) | No, nothing uses `x-data="bookingWizard"` | Dead code. |
| public_html/assets/js/particles.js:12-13 | Turned off for touch and reduced-motion | Cosmetic | Same for everyone. |
| public_html/assets/js/*.js (all) | `navigator.userAgent`, `language`, `Intl`, timezone, `document.referrer`, cookies, localStorage | — | None present. |
| start.sh:96 | `php -S localhost:PORT -t public_html` (no router) | Dev only | — |
| start.sh:115-129 | Smoke test expects 200 for `/book`, `/membership` and `/services/virus-malware-removal` | Dev only | Out of date: these now return 301, so the test reports them as failures. |
| setup.sh:1-899 | Generic Next.js/R3F scaffold (`npx create-next-app@latest .`, writes `src/`, appends to `.gitignore`) | No | Does not touch public_html. No cron, firewall or geo logic. |
| sql/schema.sql:24,41,56,73,84 | `ip_address` and `login_ip` columns | No | No blocklist tables. |
| .env.example:1-39 | Deploy credentials template (cPanel, DB, SMTP) | No | No IP or geo settings. |
| .gitignore:28-29,58-60 | `/tmp/nxn_rl/` (rate-limit directory); `aegisitsolutions` duplicate-project export | No | — |
| Whole repo | Cron jobs, geo-redirects, Tor/ASN lists, user-agent or referrer cloaking, blocklist files | — | **None found.** The free-email array is the only "blocklist". |

## 2. Live probe (http://127.0.0.1:8099, main snapshot)

Variants: (a) default curl; (b) Googlebot; (c) AdsBot-Google; (d) Google-InspectionTool; (e) Chrome desktop; (f) Referer google.com plus `?gclid=test`; (g) `CF-IPCountry: US` plus `X-Forwarded-For: 66.249.66.1`; (h) `CF-IPCountry: IN`.

| Route | a | b | c | d | e | f | g | h | sha256 of normalized body (same for a–h) | Bytes |
|---|---|---|---|---|---|---|---|---|---|---|
| / | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 551014b1e5526b75a0f930f3dec10826175bf1e7c4c14c4e64e76b3a0a6705f8 | 112848 |
| /about | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 200 | f318b7bd15dc132610876ed45e987ae9440d14f44c13ccf5cd8bc22cf27b87fd | 74405 |
| /pricing | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 200 | e7399fc9ac79ae2d9f386f9788b477b1f5568ac46c3dc95797f5a87e0a80fe0b | 70833 |
| /contact | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 28621a6bda0d40eb9c05441b68fe553c5c11bf1b26add4699bf2c95979f5e969 | 51073 |
| /services | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 0d1783340dd867f78b3a2a58cf8029cd72e09a6a2c8f6d8b1664c46d0615d4a4 | 54434 |
| /faq | 200 | 200 | 200 | 200 | 200 | 200 | 200 | 200 | c8b0bccadfbc678158ae7be6bba90ad182cfb6740efcac18ebcf0e58cfa1cc0c | 96757 |

| Check | Result |
|---|---|
| Normalization | Replaced the hex value of `meta[name=csrf-token]` (public_html/partials/head.php:140; one per page) and `input[name=_token]` (public_html/pages/contact.php:93; `/contact` has two values in total). |
| Body diff across a–h | **No differences.** Every route is byte-identical after normalization. |
| Header diff | Identical apart from `Date` and a new `Set-Cookie: PHPSESSID` on each request. All responses send `Cache-Control: no-store, no-cache, must-revalidate`, `Pragma: no-cache` and `Expires: Thu, 19 Nov 1981`. |
| Canonical with `?gclid=test` | `https://nexisconetwork.ca/pricing` (query string stripped). |
| Extra variants on `/` | UA `x`, iPhone UA, `Accept-Language: fr-CA`, `CF-Connecting-IP: 185.220.101.1` (a Tor exit), `bingbot/2.0` and `X-Forwarded-Proto: http` all gave the same hash, 551014b1…705f8. |
| Probe limitation | The `php -S` server ignores .htaccess, so the HTTPS redirect, CSP, HSTS and the 403 rules were not exercised. `/assets/css/app.css` is missing from the snapshot (it is gitignored build output) and returns 404. |

## 3. Route list

| Route | Handler | Status | Notes |
|---|---|---|---|
| / | public_html/index.php:91 → public_html/pages/home.php | 200 | |
| /services (also /services/) | public_html/index.php:92 → public_html/pages/services-index.php | 200 | Trailing slash is trimmed (public_html/index.php:31). |
| /portfolio | public_html/index.php:93 → public_html/pages/portfolio.php | 200 | See section 4. |
| /pricing | public_html/index.php:94 | 200 | |
| /start-project (plus `?service=`, `?plan=`) | public_html/index.php:95 | 200 | Query string pre-fills the form. |
| /about, /faq, /contact, /partners | public_html/index.php:96-99 | 200 | |
| /privacy, /terms, /refund-policy, /cookie-policy, /disclaimer, /cancellation-policy, /opt-in-opt-out | public_html/index.php:101-107 | 200 | |
| /robots.txt | public_html/index.php:109 → public_html/robots.php | 200 | Disallows `/admin/`, `/api/`, `/config/`, `/includes/`, `/data/`, `/lib/`. Plain `/admin` is not disallowed. |
| /sitemap.xml | public_html/index.php:110 → public_html/sitemap.php | 200 | 19 URLs, including /portfolio and the 3 services. No retired URLs. |
| /services/web-development, /services/digital-marketing, /services/ecommerce-development | public_html/index.php:123-128; public_html/includes/helpers.php:110-114 | 200 | |
| /services/{any other slug} | public_html/index.php:132 | 404 | |
| /api/contact, /api/newsletter, /api/partners | public_html/index.php:38-47 | 405 on GET | POST only. |
| /api/{other}, including /api/book | public_html/index.php:49 | 404 | JSON `Endpoint not found.` |
| /api, /api/ | public_html/index.php:132 | 404 | HTML 404 page. |
| /admin, /admin/, /admin/index, /admin/index.php | public_html/index.php:55-63 → public_html/admin/index.php | 200 | Login form, `noindex`. The login can be bypassed (section 1). |
| /admin/{x} | public_html/index.php:60 | 404 | `/admin/../pages/home` returns 200 (traversal). |
| /site.webmanifest | static file | 200 | Description is leftover IT copy (see the leftovers table). |
| /favicon.ico, /assets/img/*, /assets/js/* | static files | 200 | |
| /500.html | static file | 200 | `noindex` |
| /pages/*.php (e.g. /pages/home.php, /pages/about.php) | direct file | 200 | Duplicate copies of the pages. Not blocked on Apache either. |
| /pages/service-detail.php, /pages/404.php | direct file | 404 | |
| /partials/head.php, /partials/navbar.php, /partials/footer.php, /partials/scripts.php | direct file | 200 | Page fragments. head.php emits canonical `/partials/head.php` with `index,follow`. |
| /robots.php, /sitemap.php, /api/*.php | direct file | 200 / 405 | |
| /dev-router.php | direct file | 200 (empty) | |
| /index.php | front controller | 404 | |
| /config/*.php, /includes/*.php, /data/*.php, /lib/**/*.php | direct file | 200 empty on the dev server | 403 on Apache (public_html/.htaccess:49-52). |
| /.htaccess | direct file | 200 on the dev server | Apache denies `.ht*` by default. |
| //about | public_html/index.php:30 | 200 | Serves the home page. |
| /About, /home, /index.html, /blog, /careers, /team, /support, /login, /.env | public_html/index.php:132 | 404 | |

### Retired IT-repair, booking and membership routes

| Route | Defined at | Status | Current behaviour |
|---|---|---|---|
| /membership | public_html/index.php:68 | 301 | → /pricing |
| /book | public_html/index.php:69 | 301 | → /start-project |
| /book/confirmation | public_html/index.php:70 | 301 | → /start-project |
| /book-confirmation (with or without `?ref=`) | not mapped | 404 | Still the redirect target in public_html/assets/js/app.js:879 (dead code). |
| /eula | public_html/index.php:71 | 301 | → /terms |
| /uninstall | public_html/index.php:72 | 301 | → /terms |
| /services/virus-malware-removal | public_html/index.php:74 | 301 | → /services |
| /services/pc-laptop-repair | public_html/index.php:75 | 301 | → /services |
| /services/data-recovery | public_html/index.php:76 | 301 | → /services |
| /services/network-wifi-setup | public_html/index.php:77 | 301 | → /services |
| /services/software-installation | public_html/index.php:78 | 301 | → /services |
| /services/remote-support | public_html/index.php:79 | 301 | → /services |
| /services/business-it-support | public_html/index.php:80 | 301 | → /services |
| /services/hardware-upgrades | public_html/index.php:81 | 301 | → /services |
| /services/smart-home-iot | public_html/index.php:82 | 301 | → /services |
| /api/book | not in public_html/index.php:38-42 | 404 | JSON response. Still POSTed to by public_html/assets/js/app.js:867 (dead code). |

### Leftover IT-repair assets and code

| Path:line | Item | Current effect |
|---|---|---|
| public_html/site.webmanifest:4 | "Smart IT. Seamless Support. Professional IT services across Canada…" | **Public.** Served at /site.webmanifest and linked from public_html/partials/head.php:87. |
| package.json:4 | Description "Smart IT. Seamless Support." | Repo metadata only. |
| start.sh:26 | Banner "Smart IT. Seamless Support" | Dev only. |
| start.sh:120-126 | Smoke test for /book, /membership, /services/virus-malware-removal | Dev only; out of date. |
| public_html/api/newsletter.php:50 | Welcome email promises "IT tips, security alerts" | Not sent (stub). |
| public_html/assets/js/app.js:105-118 | `initBookingWidget()` / `#booking-widget` | Active, but now reused as the "Get a free quote" button (public_html/partials/footer.php:9-16). |
| public_html/assets/js/app.js:761-780 | `registerMembership()`, `window.MEMBERSHIP_PLANS` | Dead code; nothing uses it. |
| public_html/assets/js/app.js:782-892 | `registerBookingWizard()` (deviceType, issue, `/api/book`, `/book-confirmation`) | Dead code. |
| public_html/assets/js/app.js:899-902,993,998 | Registration and init calls for the code above | Run on every page, but do nothing. |
| public_html/includes/helpers.php:91-97 | `generate_booking_ref()` | Unused. |
| public_html/admin/index.php:121,129,146 | "Bookings" stat and "Recent Bookings" log (`nxn_bookings.log`) | Admin screen still shows it. |
| sql/schema.sql:11-30 | `bookings` table (service_slug, preferred_date and time) | Leftover schema. |
| sql/schema.sql:54 | Comment `'booking_form'` | Leftover. |
| src/input.css:1327-1368,1727 | `.membership-card` | Still used for styling (public_html/pages/home.php:497, public_html/pages/pricing.php:67). |
| src/input.css:1430-1446 | `.wizard-step`, `.wizard-progress-fill` (booking wizard) | Unused. |
| src/input.css:1579-1623,1740 | `#booking-widget` | Used by the quote button. |
| public_html/index.php:65 | Comment "retired IT routes" | — |
| public_html/pages/home.php:53 | Poster `/assets/img/hero/hero-poster.jpg` | File missing (404). |
| public_html/pages/home.php:628 | Poster `/assets/img/backgrounds/cta-poster.jpg` | File missing (404). |
| public_html/assets/fonts/JetBrainsMono-Regular.woff2 | Actually a saved Google "Error 404" HTML page | Not referenced. All of `assets/fonts/` is unused. |
| .gitignore:58-60 | `aegisitsolutions` duplicate-project export | Ignored. |
| public_html/assets/img/* | Only logos, favicons and the og-image | No IT-repair images. Unsplash photo subjects could not be checked offline. |
| public_html/data/faqs.php:16 | "We are not an IT-support or computer-repair provider" | Intentional disclaimer. |

## 4. /portfolio

| Item | Detail |
|---|---|
| Status | **200**, 72,878 bytes. Canonical `https://nexisconetwork.ca/portfolio`; robots `index, follow`. |
| Route and data | public_html/index.php:93 → public_html/pages/portfolio.php. Data comes from public_html/data/portfolio.php:20-46: 18 items with stock Unsplash images. The owner note at public_html/data/portfolio.php:7-9 says they are "ILLUSTRATIVE". |
| On-page disclosure | public_html/pages/portfolio.php:60-62: "A selection of the kinds of projects we deliver. Real client case studies are on the way." The HTML comment at public_html/pages/portfolio.php:58-59 ("…before running paid traffic") ships in the page source. |
| Home preview | public_html/pages/home.php:23-30 picks 6 items; public_html/pages/home.php:445-480 shows them as "Featured Work" **without** the disclosure. |
| Links to /portfolio | public_html/partials/navbar.php:77 (desktop) |
| | public_html/partials/navbar.php:135 (mobile) |
| | public_html/partials/footer.php:130 |
| | public_html/pages/home.php:140 |
| | public_html/pages/home.php:451 |
| | public_html/pages/home.php:456 (once per preview card, 6 times) |
| | public_html/pages/home.php:477 |
| | public_html/pages/home.php:654 |
| | public_html/pages/about.php:300 |
| | public_html/pages/404.php:38 |
| | public_html/sitemap.php:14 (priority 0.8) |
| Rendered link counts | `/` has 13; `/about` has 4; `/portfolio`, `/services`, `/contact` and `/services/web-development` have 3 each (two in the navbar, one in the footer). |