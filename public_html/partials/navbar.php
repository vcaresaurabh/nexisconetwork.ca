<?php
/**
 * Nexisco Network — Glassmorphic Navbar
 * Transparent on top → frosted-glass on scroll (handled by app.js)
 * Desktop: horizontal nav with services mega-dropdown
 * Mobile: full-screen drawer
 */
require_once __DIR__ . '/../data/services.php';
$services = $SERVICES ?? [];
?>

<header id="navbar" role="banner">
  <nav class="flex items-center justify-between max-w-[1400px] mx-auto" aria-label="Main navigation">

    <!-- ── Logo ──────────────────────────────────────────────── -->
    <a href="/" class="flex items-center gap-3 group" aria-label="Nexisco Network — Home">
      <!-- Inline SVG logo mark -->
      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"
           class="transition-transform duration-300 group-hover:scale-110" aria-hidden="true">
        <path d="M4 30 L4 6 L18 18 L32 6 L32 30" stroke="#0891B2" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <circle cx="18" cy="18" r="2.5" fill="#4F46E5"/>
      </svg>
      <span class="font-semibold text-[1.125rem] tracking-tight" style="font-family:'General Sans',sans-serif">
        Nexisco <span style="color:var(--accent)">Network</span>
      </span>
    </a>

    <!-- ── Desktop Nav ───────────────────────────────────────── -->
    <ul class="hidden lg:flex items-center gap-8 list-none" role="list">

      <!-- Services Dropdown -->
      <li class="relative group">
        <button class="nav-link flex items-center gap-1.5 py-2" aria-haspopup="true" aria-expanded="false">
          Services
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true"
               class="transition-transform duration-200 group-hover:rotate-180">
            <path d="M2 4.5L6 8L10 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>

        <!-- Mega dropdown -->
        <div class="nav-megamenu absolute top-full left-1/2 -translate-x-1/2 mt-3 w-[640px] rounded-2xl p-4
                    opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0
                    transition-all duration-300 z-50"
             role="menu">
          <div class="grid grid-cols-3 gap-2">
            <?php foreach ($services as $s): ?>
            <a href="/services/<?= htmlspecialchars($s['slug'], ENT_QUOTES, 'UTF-8') ?>"
               class="nav-megamenu-item flex items-center gap-3 p-3 rounded-xl transition-colors duration-200 group/item"
               role="menuitem">
              <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                   style="background:rgba(8,145,178,0.10);border:1px solid rgba(8,145,178,0.25)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0891B2"
                     stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                  <?= $s['icon_path'] ?? '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>' ?>
                </svg>
              </div>
              <div class="min-w-0">
                <div class="text-sm font-semibold text-[#0F172A] group-hover/item:text-[#0891B2] transition-colors">
                  <?= htmlspecialchars($s['name'], ENT_QUOTES, 'UTF-8') ?>
                </div>
                <div class="text-xs mt-0.5" style="color:#64748B">
                  <?= htmlspecialchars($s['tagline'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </div>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
          <div class="border-t mt-3 pt-3" style="border-color:rgba(15,23,42,0.08)">
            <a href="/services" class="text-sm text-[var(--accent)] hover:underline flex items-center gap-1">
              View all 9 services →
            </a>
          </div>
        </div>
      </li>

      <li><a href="/membership" class="nav-link py-2">Membership</a></li>
      <li><a href="/about"      class="nav-link py-2">About</a></li>
      <li><a href="/faq"        class="nav-link py-2">FAQ</a></li>
      <li><a href="/contact"    class="nav-link py-2">Contact</a></li>
    </ul>

    <!-- ── Desktop CTAs ──────────────────────────────────────── -->
    <div class="hidden lg:flex items-center gap-3">
      <a href="tel:+18257717727" class="nav-link text-sm py-2" aria-label="Call us">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="1.5" stroke-linecap="round" aria-hidden="true" class="inline mr-1.5">
          <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.5h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
        </svg>
        (825) 771-7727
      </a>
      <a href="/book" class="btn btn-primary text-sm" data-magnetic>Book a Repair</a>
    </div>

    <!-- ── Mobile Hamburger ──────────────────────────────────── -->
    <button id="menu-btn"
            class="lg:hidden flex flex-col gap-[5px] p-2 rounded-lg hover:bg-slate-900/5 transition-colors"
            aria-label="Open navigation menu" aria-controls="mobile-nav" aria-expanded="false">
      <span class="block w-5 h-[1.5px] bg-current rounded-full transition-all duration-200"></span>
      <span class="block w-5 h-[1.5px] bg-current rounded-full transition-all duration-200"></span>
      <span class="block w-3.5 h-[1.5px] bg-current rounded-full transition-all duration-200"></span>
    </button>
  </nav>
</header>

<!-- ── Mobile Nav Drawer ─────────────────────────────────────── -->
<div id="mobile-nav"
     class="fixed inset-0 z-[999] flex flex-col"
     style="background:rgba(255,255,255,0.98);backdrop-filter:blur(20px) saturate(160%);transform:translateX(100%);transition:transform 0.4s cubic-bezier(0.16,1,0.3,1);color:var(--text-primary)"
     aria-label="Mobile navigation" role="dialog" aria-modal="true"
     x-data>

  <div class="flex items-center justify-between p-6 border-b" style="border-color:var(--border-subtle)">
    <a href="/" class="flex items-center gap-2" aria-label="Home">
      <svg width="28" height="28" viewBox="0 0 36 36" fill="none">
        <path d="M4 30 L4 6 L18 18 L32 6 L32 30" stroke="#0891B2" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <circle cx="18" cy="18" r="2.5" fill="#4F46E5"/>
      </svg>
      <span class="font-semibold" style="font-family:'General Sans',sans-serif">
        Nexisco <span style="color:var(--accent)">Network</span>
      </span>
    </a>
    <button id="menu-close" class="p-2 rounded-lg hover:bg-slate-900/5"
            aria-label="Close navigation menu">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
  </div>

  <nav class="flex-1 overflow-y-auto p-6 space-y-1" aria-label="Mobile navigation links">
    <a href="/"          class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-900/5 text-lg font-medium transition-colors">Home</a>
    <a href="/services"  class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-900/5 text-lg font-medium transition-colors">Services</a>
    <a href="/membership"class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-900/5 text-lg font-medium transition-colors">Membership</a>
    <a href="/about"     class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-900/5 text-lg font-medium transition-colors">About</a>
    <a href="/faq"       class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-900/5 text-lg font-medium transition-colors">FAQ</a>
    <a href="/contact"   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-900/5 text-lg font-medium transition-colors">Contact</a>

    <div class="pt-4 border-t" style="border-color:var(--border-subtle)">
      <p class="text-xs uppercase tracking-widest mb-3" style="color:var(--text-tertiary)">Services</p>
      <?php foreach ($services as $s): ?>
      <a href="/services/<?= htmlspecialchars($s['slug'], ENT_QUOTES, 'UTF-8') ?>"
         class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-slate-900/5 text-sm transition-colors"
         style="color:var(--text-secondary)">
        <?= htmlspecialchars($s['name'], ENT_QUOTES, 'UTF-8') ?>
      </a>
      <?php endforeach; ?>
    </div>
  </nav>

  <div class="p-6 border-t space-y-3" style="border-color:var(--border-subtle)">
    <a href="tel:+18257717727" class="btn btn-secondary w-full text-center">
      Call (825) 771-7727
    </a>
    <a href="/book" class="btn btn-gradient w-full text-center">Book a Repair</a>
  </div>
</div>

<script>
// Mobile nav open/close (handled by app.js — but also inline for reliability)
(function () {
  var nav     = document.getElementById('mobile-nav');
  var open    = document.getElementById('menu-btn');
  var close   = document.getElementById('menu-close');
  if (!nav) return;

  function openNav()  { nav.style.transform = 'translateX(0)'; document.body.style.overflow = 'hidden'; }
  function closeNav() { nav.style.transform = 'translateX(100%)'; document.body.style.overflow = ''; }

  open?.addEventListener('click', openNav);
  close?.addEventListener('click', closeNav);

  // Close on outside click
  nav.addEventListener('click', function (e) {
    if (e.target === nav) closeNav();
  });

  // Close on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeNav();
  });
})();
</script>
