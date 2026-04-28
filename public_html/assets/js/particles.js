/**
 * Nexisco Network — Hero Canvas Particle Network
 * Vanilla Canvas 2D API — no external libraries
 * 80-120 particles, connecting lines, mouse repel, 60fps
 * Disabled on touch devices and prefers-reduced-motion
 */

(function () {
  'use strict';

  /* ── Guards ──────────────────────────────────────────────────── */
  if (window.matchMedia('(pointer: coarse)').matches) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  /* ── Config ──────────────────────────────────────────────────── */
  const CONFIG = {
    count:           100,          // particle count
    dotRadius:       1.5,          // particle dot radius (px)
    connectDist:     150,          // max px to draw a connecting line
    mouseRepelDist:  100,          // px radius of mouse repel force
    repelStrength:   0.04,         // how strongly particles run from cursor
    dotOpacityMin:   0.15,
    dotOpacityMax:   0.45,
    lineOpacityMax:  0.07,
    colorDot:        '100, 220, 240',   // RGB for particles (cyan-ish)
    colorLine:       '99, 102, 241',    // RGB for lines (indigo)
    speedMin:        0.12,
    speedMax:        0.35,
  };

  /* ── Canvas setup ────────────────────────────────────────────── */
  const canvas = document.getElementById('hero-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let W = 0, H = 0;
  let raf = null;
  let mouse = { x: -9999, y: -9999 };
  let particles = [];

  function resize() {
    const hero = canvas.parentElement;
    W = canvas.width  = hero ? hero.offsetWidth  : window.innerWidth;
    H = canvas.height = hero ? hero.offsetHeight : window.innerHeight;
  }

  /* ── Particle class ──────────────────────────────────────────── */
  class Particle {
    constructor() {
      this.reset(true);
    }

    reset(init) {
      this.x    = Math.random() * W;
      this.y    = init ? Math.random() * H : (Math.random() < 0.5 ? -5 : H + 5);
      const speed = CONFIG.speedMin + Math.random() * (CONFIG.speedMax - CONFIG.speedMin);
      const angle = Math.random() * Math.PI * 2;
      this.vx   = Math.cos(angle) * speed;
      this.vy   = Math.sin(angle) * speed;
      this.r    = CONFIG.dotRadius * (0.6 + Math.random() * 0.8);
      this.baseOpacity = CONFIG.dotOpacityMin + Math.random() * (CONFIG.dotOpacityMax - CONFIG.dotOpacityMin);
      this.opacity = this.baseOpacity;
    }

    update() {
      /* Mouse repel */
      const dx   = this.x - mouse.x;
      const dy   = this.y - mouse.y;
      const dist = Math.sqrt(dx * dx + dy * dy);

      if (dist < CONFIG.mouseRepelDist && dist > 0) {
        const force = (1 - dist / CONFIG.mouseRepelDist) * CONFIG.repelStrength;
        this.vx += (dx / dist) * force;
        this.vy += (dy / dist) * force;
      }

      /* Dampen velocity to prevent runaway */
      this.vx *= 0.995;
      this.vy *= 0.995;

      /* Clamp speed */
      const speed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
      if (speed > CONFIG.speedMax * 2) {
        this.vx = (this.vx / speed) * CONFIG.speedMax * 2;
        this.vy = (this.vy / speed) * CONFIG.speedMax * 2;
      }

      this.x += this.vx;
      this.y += this.vy;

      /* Wrap / reset at edges */
      if (this.x < -10 || this.x > W + 10 || this.y < -10 || this.y > H + 10) {
        this.reset(false);
      }
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${CONFIG.colorDot}, ${this.opacity})`;
      ctx.fill();
    }
  }

  /* ── Build particle pool ─────────────────────────────────────── */
  function buildParticles() {
    particles = [];
    for (let i = 0; i < CONFIG.count; i++) {
      particles.push(new Particle());
    }
  }

  /* ── Draw connecting lines ───────────────────────────────────── */
  function drawLines() {
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx   = particles[i].x - particles[j].x;
        const dy   = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < CONFIG.connectDist) {
          const opacity = (1 - dist / CONFIG.connectDist) * CONFIG.lineOpacityMax;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(${CONFIG.colorLine}, ${opacity})`;
          ctx.lineWidth   = 0.8;
          ctx.stroke();
        }
      }
    }
  }

  /* ── Animation loop ──────────────────────────────────────────── */
  function animate() {
    raf = requestAnimationFrame(animate);
    ctx.clearRect(0, 0, W, H);

    drawLines();

    for (const p of particles) {
      p.update();
      p.draw();
    }
  }

  /* ── Mouse tracking ──────────────────────────────────────────── */
  function onMouseMove(e) {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
  }

  function onMouseLeave() {
    mouse.x = -9999;
    mouse.y = -9999;
  }

  /* ── Visibility API — pause when tab hidden ──────────────────── */
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      cancelAnimationFrame(raf);
    } else {
      animate();
    }
  });

  /* ── Init ────────────────────────────────────────────────────── */
  function init() {
    resize();
    buildParticles();
    animate();

    canvas.parentElement?.addEventListener('mousemove', onMouseMove);
    canvas.parentElement?.addEventListener('mouseleave', onMouseLeave);

    const ro = new ResizeObserver(() => {
      resize();
      buildParticles();
    });
    ro.observe(canvas.parentElement ?? document.body);
  }

  /* Wait for DOM */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  /* Expose for external control */
  window.ParticleNetwork = {
    pause:  () => cancelAnimationFrame(raf),
    resume: () => animate(),
    setCount: (n) => {
      CONFIG.count = n;
      buildParticles();
    },
  };
})();
