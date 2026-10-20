#!/usr/bin/env node
/**
 * Nexisco Network — Google Ads compliance check
 *
 * Fetches every URL in the sitemap from a local server and fails (exit 1) if any
 * page misrepresents the business. Cross-platform (Node 18+, no dependencies).
 *
 *   node scripts/compliance-check.mjs                 # starts `php -S` on a free port
 *   node scripts/compliance-check.mjs http://localhost:8000
 *   BASE_URL=http://localhost:8000 node scripts/compliance-check.mjs
 *
 * Checks (see CLAUDE.md → "Google Ads compliance rules"):
 *   1. Every sitemap URL returns 200.
 *   2. Every page footer shows the legal name, Corporate Access Number,
 *      "Registered office" and an hours line in Mountain Time.
 *   3. Visible text, alt/title text, meta tags and JSON-LD contain no banned
 *      pattern (old IT-repair business, unprovable claims, template text,
 *      Pacific Time, "global / worldwide / headquarters" positioning), and no
 *      internal link points at /portfolio or a retired IT-repair URL.
 *   4. No rating markup (aggregateRating / ratingValue / reviewCount).
 *   5. /portfolio is a 301 to /services; old IT-repair URLs return 410 Gone.
 *   6. Same page for every visitor: the homepage is identical for a browser,
 *      Googlebot, AdsBot-Google and Google-InspectionTool, with or without an
 *      ad-click referrer or country header.
 *   7. robots.txt never blocks Google's crawlers and references the sitemap.
 */
import { spawn } from 'node:child_process';
import { existsSync } from 'node:fs';
import { createServer } from 'node:net';
import { fileURLToPath } from 'node:url';
import path from 'node:path';

const ROOT = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const DOCROOT = path.join(ROOT, 'public_html');

/* ── Rules ─────────────────────────────────────────────────────────── */

const FOOTER_REQUIRED = [
  { label: 'legal name', test: (t) => t.includes('Nexisco Network Inc.') },
  { label: 'Corporate Access Number', test: (t) => t.includes('2028114540') },
  { label: '"Registered office"', test: (t) => t.includes('Registered office') },
  {
    label: 'hours line in Mountain Time',
    test: (t) => /\d{1,2}(:\d{2})?\s*(am|pm)[^\n]{0,60}\b(MT|Mountain)\b/i.test(t),
  },
];

const BANNED = {
  'old business': [
    'printer', 'tech support', 'technical support', 'computer repair', 'IT repair',
    'remote access', 'AnyDesk', 'TeamViewer', 'Geek Squad', 'HP', 'Canon', 'Epson',
    'Norton', 'McAfee',
  ],
  claims: [
    'track record', 'results that compound', 'clients served', 'success story',
    'proven expertise', 'senior-level', 'senior specialists', 'senior team',
    'senior talent', 'under one roof', 'full-service team',
  ],
  'template text': ['general template', 'qualified legal counsel', 'qualified lawyer', 'lorem ipsum'],
  'time zones': ['PT', 'PST', 'PDT', 'Pacific'],
  // Phase 1 positioning: an Edmonton-based agency serving Canada and the US.
  positioning: [
    'worldwide', 'global agency', 'global digital agency', 'around the world', 'across time zones',
    'headquartered', 'headquarters', 'head office', 'HQ',
  ],
};

/**
 * Exact sentences that may contain a banned term. Each entry needs a reason.
 * Keep this list as short as possible — every entry is an exception to the rules.
 */
const ALLOWLIST = [
  {
    // FAQ "What services do you offer?" (public_html/data/faqs.php, shown on /
    // and /faq). It tells visitors — and Google's reviewers — that this domain
    // no longer offers the previous site's IT-support / computer-repair
    // services. It has to name those services to deny them, so
    // "computer-repair" is intentional here and nowhere else.
    text: 'We are not an IT-support or computer-repair provider — our work is designing and building websites and online stores, and growing them with data-driven marketing.',
  },
];

const RATING_MARKUP = /aggregateRating|ratingValue|reviewCount/i;

const PORTFOLIO = { path: '/portfolio', status: 301, location: '/services' };

// URLs left over from the previous IT-repair / booking site: must be 410 Gone.
const GONE = [
  '/membership', '/book', '/book/confirmation', '/book-confirmation', '/eula', '/uninstall',
  '/services/virus-malware-removal', '/services/pc-laptop-repair', '/services/data-recovery',
  '/services/network-wifi-setup', '/services/software-installation', '/services/remote-support',
  '/services/business-it-support', '/services/hardware-upgrades', '/services/smart-home-iot',
];

const GOOGLE_CRAWLERS = ['Googlebot', 'AdsBot-Google', 'Google-InspectionTool'];

const VISITOR_VARIANTS = [
  { label: 'browser', headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0 Safari/537.36' } },
  { label: 'Googlebot', headers: { 'User-Agent': 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)' } },
  { label: 'AdsBot-Google', headers: { 'User-Agent': 'AdsBot-Google (+http://www.google.com/adsbot.html)' } },
  { label: 'Google-InspectionTool', headers: { 'User-Agent': 'Mozilla/5.0 (compatible; Google-InspectionTool/1.0;)' } },
  { label: 'ad click', query: '?gclid=compliance-check', headers: { Referer: 'https://www.google.com/' } },
  { label: 'country US', headers: { 'CF-IPCountry': 'US', 'X-Forwarded-For': '66.249.66.1' } },
  { label: 'country IN', headers: { 'CF-IPCountry': 'IN', 'X-Forwarded-For': '103.21.244.1' } },
];

/* ── HTML helpers ──────────────────────────────────────────────────── */

const ENTITIES = { amp: '&', lt: '<', gt: '>', quot: '"', apos: "'", nbsp: ' ', ndash: '–', mdash: '—', middot: '·', copy: '©', rsquo: '’', lsquo: '‘', rdquo: '”', ldquo: '“', hellip: '…' };

function decode(s) {
  return s
    .replace(/&#(\d+);/g, (_, n) => String.fromCodePoint(Number(n)))
    .replace(/&#x([0-9a-f]+);/gi, (_, n) => String.fromCodePoint(parseInt(n, 16)))
    .replace(/&([a-z]+);/gi, (m, name) => ENTITIES[name.toLowerCase()] ?? m);
}

function visibleText(html) {
  return decode(
    html
      .replace(/<!--[\s\S]*?-->/g, ' ')
      .replace(/<(script|style|template)\b[\s\S]*?<\/\1>/gi, ' ')
      .replace(/<br\s*\/?>/gi, '\n')
      .replace(/<\/(p|div|li|h[1-6]|dt|dd|address|tr)>/gi, '\n')
      .replace(/<[^>]+>/g, ' '),
  )
    .replace(/[ \t\r\f\v]+/g, ' ')
    .replace(/\s*\n\s*/g, '\n');
}

function attrValues(html, attr) {
  const re = new RegExp(`\\s${attr}\\s*=\\s*("([^"]*)"|'([^']*)')`, 'gi');
  return [...html.matchAll(re)].map((m) => decode(m[2] ?? m[3] ?? ''));
}

function metaText(html) {
  const title = html.match(/<title[^>]*>([\s\S]*?)<\/title>/i)?.[1] ?? '';
  const metas = [...html.matchAll(/<meta\b[^>]*>/gi)].flatMap((m) => attrValues(m[0], 'content'));
  return [decode(title), ...metas].join('\n');
}

/** Every string value inside the page's JSON-LD blocks (FAQ answers, descriptions…). */
function jsonLdText(html, fail) {
  const out = [];
  const walk = (v) => {
    if (typeof v === 'string') out.push(v);
    else if (v && typeof v === 'object') Object.values(v).forEach(walk);
  };
  for (const m of html.matchAll(/<script[^>]+type="application\/ld\+json"[^>]*>([\s\S]*?)<\/script>/gi)) {
    try { walk(JSON.parse(m[1])); } catch { fail('invalid JSON-LD block'); }
  }
  return out.join('\n');
}

/** Same-site paths of every <a href>. */
function internalLinks(html, base) {
  const paths = new Set();
  for (const href of attrValues(html, 'href')) {
    if (!href || /^(mailto:|tel:|#|javascript:)/i.test(href)) continue;
    try {
      const u = new URL(href, base);
      if (u.origin === new URL(base).origin || u.hostname.replace(/^www\./, '') === 'nexisconetwork.ca') {
        paths.add(u.pathname.replace(/\/+$/, '') || '/');
      }
    } catch { /* ignore malformed */ }
  }
  return paths;
}

function footerText(html) {
  const m = html.match(/<footer\b[\s\S]*?<\/footer>/i);
  return m ? visibleText(m[0]) : '';
}

function escapeRe(s) {
  return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

// Word-boundary, case-insensitive; a space in a term also matches a hyphen
// ("computer repair" catches "computer-repair").
const BANNED_RES = Object.entries(BANNED).flatMap(([group, terms]) =>
  terms.map((term) => ({
    group,
    term,
    re: new RegExp(`\\b${term.split(/[\s-]+/).map(escapeRe).join('[\\s-]+')}\\b`, 'i'),
  })),
);

const allowlistUsed = new Set();

function bannedHits(text) {
  let t = text.replace(/\s+/g, ' ');
  for (const { text: allowed } of ALLOWLIST) {
    if (t.includes(allowed)) allowlistUsed.add(allowed);
    t = t.split(allowed).join(' ');
  }
  const hits = [];
  for (const { group, term, re } of BANNED_RES) {
    const m = t.match(re);
    if (m) {
      const i = m.index ?? 0;
      hits.push(`${group}: "${term}" in "…${t.slice(Math.max(0, i - 50), i + term.length + 50).trim()}…"`);
    }
  }
  return hits;
}

function normalise(html) {
  // The CSRF token is the only per-request value; everything else must match.
  return html
    .replace(/(name="csrf-token" content=")[^"]*"/g, '$1"')
    .replace(/(name="_token" value=")[^"]*"/g, '$1"');
}

/* ── Server ────────────────────────────────────────────────────────── */

function freePort() {
  return new Promise((resolve, reject) => {
    const srv = createServer();
    srv.unref();
    srv.on('error', reject);
    srv.listen(0, '127.0.0.1', () => {
      const { port } = srv.address();
      srv.close(() => resolve(port));
    });
  });
}

async function startPhpServer() {
  if (!existsSync(path.join(DOCROOT, 'config', 'config.php'))) {
    throw new Error('public_html/config/config.php is missing — copy config.sample.php to config.php first (or pass a BASE_URL).');
  }
  const port = await freePort();
  const child = spawn('php', ['-S', `127.0.0.1:${port}`, '-t', DOCROOT, path.join(DOCROOT, 'dev-router.php')], {
    stdio: 'ignore',
    windowsHide: true,
  });
  let failed = null;
  child.on('error', (err) => { failed = err; });
  const base = `http://127.0.0.1:${port}`;
  for (let i = 0; i < 100; i++) {
    if (failed) throw new Error(`could not start "php -S" (${failed.message}). Install PHP or pass a BASE_URL.`);
    try {
      const res = await fetch(`${base}/robots.txt`);
      if (res.ok) return { base, stop: () => child.kill() };
    } catch { /* not up yet */ }
    await new Promise((r) => setTimeout(r, 150));
  }
  child.kill();
  throw new Error('php -S did not start within 15 seconds');
}

/* ── Main ──────────────────────────────────────────────────────────── */

async function main() {
  const given = process.argv[2] || process.env.BASE_URL;
  const server = given ? { base: given.replace(/\/+$/, ''), stop: () => {} } : await startPhpServer();
  const { base } = server;
  const failures = [];
  const fail = (where, msg) => failures.push(`${where}: ${msg}`);
  // Always read the body: an unread body on a closed php -S socket crashes undici.
  const get = async (p, init = {}) => {
    const res = await fetch(base + p, { redirect: 'manual', ...init });
    const body = await res.text();
    return { status: res.status, headers: res.headers, text: async () => body };
  };

  console.log(`Compliance check against ${base}\n`);

  try {
    // Sitemap
    const sm = await get('/sitemap.xml');
    if (sm.status !== 200) fail('/sitemap.xml', `status ${sm.status}`);
    const paths = [...(await sm.text()).matchAll(/<loc>\s*([^<\s]+)\s*<\/loc>/g)].map((m) => new URL(m[1]).pathname);
    if (!paths.length) fail('/sitemap.xml', 'no <loc> entries');
    if (paths.includes(PORTFOLIO.path)) fail('/sitemap.xml', 'lists /portfolio');

    // Pages
    for (const p of paths) {
      const res = await get(p);
      const before = failures.length;
      if (res.status !== 200) {
        fail(p, `status ${res.status} (sitemap URLs must be 200)`);
      } else {
        const html = await res.text();
        const footer = footerText(html);
        if (!footer) fail(p, 'no <footer> found');
        for (const req of FOOTER_REQUIRED) if (footer && !req.test(footer)) fail(p, `footer lacks ${req.label}`);

        const text = [
          visibleText(html), ...attrValues(html, 'alt'), ...attrValues(html, 'title'), metaText(html),
          jsonLdText(html, (msg) => fail(p, msg)),
        ].join('\n');
        for (const hit of bannedHits(text)) fail(p, `banned ${hit}`);

        for (const link of internalLinks(html, base)) {
          if (link === PORTFOLIO.path || GONE.includes(link)) fail(p, `links to retired URL ${link}`);
        }

        const rating = html.match(RATING_MARKUP);
        if (rating) fail(p, `rating markup "${rating[0]}"`);
        if (/(Fatal error|Warning|Notice|Deprecated)<\/b>:/.test(html)) fail(p, 'PHP error output in page');
      }
      console.log(`${failures.length === before ? 'PASS' : 'FAIL'}  ${p}`);
    }

    // Portfolio redirect
    const pf = await get(PORTFOLIO.path);
    const loc = pf.headers.get('location') ?? '';
    const pfOk = pf.status === PORTFOLIO.status && new URL(loc, base).pathname === PORTFOLIO.location;
    if (!pfOk) fail(PORTFOLIO.path, `expected ${PORTFOLIO.status} → ${PORTFOLIO.location}, got ${pf.status} → ${loc || '(none)'}`);
    console.log(`${pfOk ? 'PASS' : 'FAIL'}  ${PORTFOLIO.path} → ${PORTFOLIO.status} ${PORTFOLIO.location}`);

    // Old IT-repair URLs
    for (const p of GONE) {
      const res = await get(p);
      if (res.status !== 410) fail(p, `expected 410 Gone, got ${res.status}${res.headers.get('location') ? ' → ' + res.headers.get('location') : ''}`);
      console.log(`${res.status === 410 ? 'PASS' : 'FAIL'}  ${p} → 410`);
    }

    // Same page for every visitor
    const bodies = [];
    for (const v of VISITOR_VARIANTS) {
      const res = await get('/' + (v.query ?? ''), { headers: v.headers });
      bodies.push({ label: v.label, status: res.status, body: normalise(await res.text()) });
    }
    const [ref, ...rest] = bodies;
    const differ = rest.filter((b) => b.status !== ref.status || b.body !== ref.body).map((b) => b.label);
    if (differ.length) fail('/', `content differs for: ${differ.join(', ')}`);
    console.log(`${differ.length ? 'FAIL' : 'PASS'}  same homepage for ${bodies.map((b) => b.label).join(', ')}`);

    // robots.txt
    const robots = await get('/robots.txt');
    const rtxt = robots.status === 200 ? await robots.text() : '';
    if (robots.status !== 200) fail('/robots.txt', `status ${robots.status}`);
    if (!/^\s*Sitemap:\s*\S+/im.test(rtxt)) fail('/robots.txt', 'no Sitemap: line');
    let agents = [];
    let lastWasAgent = false;
    for (const raw of rtxt.split(/\r?\n/)) {
      const line = raw.replace(/#.*/, '').trim();
      const [k, ...v] = line.split(':');
      const key = (k ?? '').trim().toLowerCase();
      const val = v.join(':').trim();
      if (key === 'user-agent') { agents = lastWasAgent ? [...agents, val] : [val]; lastWasAgent = true; continue; }
      lastWasAgent = false;
      if (key === 'disallow' && /^\/\*?\$?$/.test(val)) {
        const blocked = agents.filter((a) => a === '*' || GOOGLE_CRAWLERS.some((g) => g.toLowerCase().startsWith(a.toLowerCase())));
        if (blocked.length) fail('/robots.txt', `Disallow: / for ${blocked.join(', ')}`);
      }
    }
    console.log(`${failures.some((f) => f.startsWith('/robots.txt')) ? 'FAIL' : 'PASS'}  robots.txt`);
  } finally {
    server.stop();
  }

  console.log('');
  for (const { text } of ALLOWLIST) {
    if (!allowlistUsed.has(text)) console.log(`! Allowlist entry never matched (stale? remove it): "${text.slice(0, 80)}…"`);
  }
  if (failures.length) {
    console.log(`✗ ${failures.length} compliance problem(s):`);
    for (const f of failures) console.log(`  - ${f}`);
    process.exitCode = 1;
  } else {
    console.log('✓ All compliance checks passed.');
  }
}

main().catch((err) => {
  console.error(`compliance-check: ${err.message}`);
  process.exitCode = 2;
});
