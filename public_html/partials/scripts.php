<?php
/**
 * Nexisco Network — scripts.php
 * Loaded at bottom of <body> on every page.
 * CDN loads: GSAP, ScrollTrigger, Lenis, SplitType, VanillaTilt, Alpine
 * Then our own: preloader.js → particles.js → app.js
 *
 * Every CDN <script> is pinned to an exact version and carries a
 * Subresource Integrity hash, so the browser refuses to run it if the
 * bytes ever differ from the published npm package. Changing a version
 * means recomputing its hash, or that script will be blocked:
 *   curl -sL URL | openssl dgst -sha384 -binary | openssl base64 -A
 */
?>

<?php $v = defined('ASSET_VERSION') ? ASSET_VERSION : '1'; ?>
  <!-- ── Preloader (inline-blocking, runs immediately) ─────────── -->
  <script src="/assets/js/preloader.js?v=<?= $v ?>"></script>

  <!-- ── GSAP + ScrollTrigger (deferred — non-blocking) ────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"
          integrity="sha384-g4NTh/Iv5PPU4xPyhEWqPcwtNXOvdaDI8LLnyYfyNZOjKJeYQyjzQ9X5275eBjpt"
          crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"
          integrity="sha384-Z3REaz79l2IaAZqJsSABtTbhjgOUYyV3p90XNnAPCSHg3EMTz1fouunq9WZRtj3d"
          crossorigin="anonymous"></script>

  <!-- ── Lenis Smooth Scroll (deferred) ────────────────────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js"
          integrity="sha384-B2WBjDzEjJpYvhmi2UyEn7rektqkf5suS6sNoyyrf0EBAwBHdkiXxIlU0V5Ru2ed"
          crossorigin="anonymous"></script>

  <!-- ── SplitType (deferred) ──────────────────────────────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"
          integrity="sha384-wQImCCD/id1jPTwSloatzKlEpnEAQ5aH8H2Ud27FnNcJ1lf2+hB75ctoWnWxyD8X"
          crossorigin="anonymous"></script>

  <!-- ── VanillaTilt (deferred — desktop only) ─────────────────── -->
  <script defer src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.8.1/dist/vanilla-tilt.min.js"
          integrity="sha384-0k1dj5tm+KUH/4vkNk/i90XsjDA8Ltmt+ybcrFoH4t0dgv/WZsPpVBnkhcroX8UL"
          crossorigin="anonymous"></script>

  <!-- ── Hero Particle Network (deferred) ──────────────────────── -->
  <script defer src="/assets/js/particles.js?v=<?= $v ?>"></script>

  <!-- ── Main Application JS (deferred — runs after CDN libs) ──── -->
  <script defer src="/assets/js/app.js?v=<?= $v ?>"></script>

  <!-- ── Alpine.js + Collapse plugin (MUST load AFTER app.js so
        Alpine.data() registrations are queued before Alpine.start()).
        Pinned to one exact version — keep core and plugin on the same release. ── -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.17.4/dist/cdn.min.js"
          integrity="sha384-NArNwzWsUSF+kY2lgW4YriEkjLqi+J+za6HrENUn/3nZqkBnWbxV22kCJEK5Uu6n"
          crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.17.4/dist/cdn.min.js"
          integrity="sha384-5/joNqFnRyVWzXp99bHot6RHG+EksGp+USSgZwPar7T9SD9PKKER37n/8bXBAZGd"
          crossorigin="anonymous"></script>

  <?php if (!empty($extra_scripts)) echo $extra_scripts; ?>

</body>
</html>
