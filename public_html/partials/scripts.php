<?php
/**
 * Nexisco Network — scripts.php
 * Loaded at bottom of <body> on every page.
 * CDN loads: GSAP, ScrollTrigger, Lenis, SplitType, VanillaTilt
 * Then our own: preloader.js → particles.js → app.js
 */
?>

<?php $v = defined('ASSET_VERSION') ? ASSET_VERSION : '1'; ?>
  <!-- ── Preloader (inline-blocking, runs immediately) ─────────── -->
  <script src="/assets/js/preloader.js?v=<?= $v ?>"></script>

  <!-- ── GSAP + ScrollTrigger (deferred — non-blocking) ────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

  <!-- ── Lenis Smooth Scroll (deferred) ────────────────────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js"></script>

  <!-- ── SplitType (deferred) ──────────────────────────────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>

  <!-- ── VanillaTilt (deferred — desktop only) ─────────────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.8.1/dist/vanilla-tilt.min.js"></script>

  <!-- ── Hero Particle Network (deferred) ──────────────────────── -->
  <script defer src="/assets/js/particles.js?v=<?= $v ?>"></script>

  <!-- ── Main Application JS (deferred — runs after CDN libs) ──── -->
  <script defer src="/assets/js/app.js?v=<?= $v ?>"></script>

  <!-- ── Alpine.js + Collapse plugin (MUST load AFTER app.js so
        Alpine.data() registrations are queued before Alpine.start()) ── -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <?php if (!empty($extra_scripts)) echo $extra_scripts; ?>

</body>
</html>
