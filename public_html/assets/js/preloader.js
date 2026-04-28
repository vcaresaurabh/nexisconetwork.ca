/**
 * Nexisco Network — Branded Preloader
 * SVG logo path draw animation + progress counter + curtain-wipe exit
 * Preloads hero video poster + critical images during loading phase
 */

(function () {
  'use strict';

  const REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const MIN_DURATION   = 250;  // ms — minimum time to show preloader (brand feel)
  const MAX_DURATION   = 1500; // ms — fail-safe max

  const preloader  = document.getElementById('preloader');
  const barFill    = document.getElementById('preloader-bar-fill');
  const counter    = document.getElementById('preloader-counter');
  const logoEl     = document.getElementById('preloader-logo');
  const logoPath   = document.getElementById('preloader-logo-path');
  const curtain    = document.getElementById('preloader-curtain');

  if (!preloader) return;

  let progress  = 0;
  let startTime = performance.now();
  let finished  = false;

  /* ── Set progress (0–100) ──────────────────────────────────────── */
  function setProgress(pct) {
    progress = Math.min(100, Math.max(0, pct));

    if (barFill)  barFill.style.width   = progress + '%';
    if (counter)  counter.textContent    = Math.round(progress) + '%';
  }

  /* ── Logo SVG path draw animation ─────────────────────────────── */
  function animateLogo() {
    if (!logoEl) return;

    // Fade in logo
    if (REDUCED_MOTION) {
      logoEl.style.opacity = '1';
      return;
    }

    if (typeof gsap !== 'undefined') {
      gsap.to(logoEl, { opacity: 1, duration: 0.4, ease: 'power2.out' });

      if (logoPath) {
        const length = logoPath.getTotalLength ? logoPath.getTotalLength() : 300;
        gsap.set(logoPath, { strokeDasharray: length, strokeDashoffset: length });
        gsap.to(logoPath, {
          strokeDashoffset: 0,
          duration: 1.2,
          ease: 'power2.inOut',
        });
      }
    } else {
      logoEl.style.opacity = '1';
      logoEl.style.transition = 'opacity 0.4s ease';
    }
  }

  /* ── Exit: curtain wipe up ──────────────────────────────────────── */
  function exit() {
    if (finished) return;
    finished = true;

    setProgress(100);

    const finish = () => {
      preloader.style.display = 'none';
      document.body.style.overflow = '';
      window.dispatchEvent(new CustomEvent('preloader:done'));
    };

    if (REDUCED_MOTION) {
      preloader.style.opacity = '0';
      preloader.style.transition = 'opacity 0.18s ease';
      setTimeout(finish, 180);
      return;
    }

    if (typeof gsap !== 'undefined') {
      gsap.to(preloader, {
        opacity: 0,
        duration: 0.28,
        ease: 'power2.out',
        onComplete: finish,
      });
    } else {
      preloader.style.transition = 'opacity 0.25s ease';
      preloader.style.opacity = '0';
      setTimeout(finish, 260);
    }
  }

  /* ── Preload images ─────────────────────────────────────────────── */
  function preloadImages(urls) {
    return Promise.all(
      urls.map((url) => {
        return new Promise((resolve) => {
          const img   = new Image();
          img.onload  = resolve;
          img.onerror = resolve; // don't block on missing images
          img.src     = url;
        });
      })
    );
  }

  /* ── Collect critical assets to preload ────────────────────────── */
  function getCriticalAssets() {
    const assets = [];

    // Hero video poster
    const heroPoster = document.querySelector('#hero video[poster]');
    if (heroPoster?.poster) assets.push(heroPoster.poster);

    // First visible above-fold images
    document.querySelectorAll('img[data-preload]').forEach((img) => {
      if (img.src) assets.push(img.src);
    });

    return assets;
  }

  /* ── Simulated progress (fills smoothly to 80% while assets load) ─ */
  function simulateProgress(targetPct, durationMs) {
    return new Promise((resolve) => {
      const start    = progress;
      const range    = targetPct - start;
      const startTs  = performance.now();

      function tick() {
        const elapsed = performance.now() - startTs;
        const t       = Math.min(elapsed / durationMs, 1);
        // Ease out cubic
        const eased   = 1 - Math.pow(1 - t, 3);
        setProgress(start + range * eased);

        if (t < 1) {
          requestAnimationFrame(tick);
        } else {
          resolve();
        }
      }

      requestAnimationFrame(tick);
    });
  }

  /* ── Main preloader flow ──────────────────────────────────────────── */
  async function run() {
    document.body.style.overflow = 'hidden';
    animateLogo();

    setProgress(0);

    // Race: assets vs. hard cap, so a slow image never blocks
    const assets    = getCriticalAssets();
    const preloaded = Promise.race([
      preloadImages(assets),
      new Promise((res) => setTimeout(res, 600)),
    ]);

    // Quick fill to 70%
    const fill = simulateProgress(70, 200);
    await Promise.all([fill, preloaded]);

    // Snap to 100%
    await simulateProgress(100, 120);

    const elapsed   = performance.now() - startTime;
    const remaining = MIN_DURATION - elapsed;
    if (remaining > 0) await new Promise((r) => setTimeout(r, remaining));

    exit();
  }

  /* ── Safety timeout ──────────────────────────────────────────────── */
  const safetyTimer = setTimeout(() => {
    if (!finished) exit();
  }, MAX_DURATION);

  window.addEventListener('preloader:done', () => clearTimeout(safetyTimer), { once: true });

  /* ── Start ───────────────────────────────────────────────────────── */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', run);
  } else {
    run();
  }

  /* Expose for manual control */
  window.Preloader = { exit };
})();
