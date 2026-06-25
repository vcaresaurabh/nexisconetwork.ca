/**
 * Nexisco Network — Main Application JS
 * GSAP 3.12 + ScrollTrigger + Lenis smooth scroll
 * SplitType text reveals + VanillaTilt + magnetic buttons
 */

/* ================================================================
   GLOBAL STATE
   ================================================================ */
const IS_TOUCH = window.matchMedia('(pointer: coarse)').matches;
const REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ================================================================
   LENIS SMOOTH SCROLL
   ================================================================ */
function initLenis() {
  if (REDUCED_MOTION) return null;

  const lenis = new Lenis({
    lerp: 0.075,
    duration: 1.35,
    smoothWheel: true,
    wheelMultiplier: 0.9,
    touchMultiplier: 1.8,
    infinite: false,
    syncTouch: false,
  });

  // Integrate Lenis with GSAP ticker
  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });

  gsap.ticker.lagSmoothing(0);

  // Expose globally for use in other scripts
  window.lenisInstance = lenis;

  return lenis;
}

/* ================================================================
   GSAP + SCROLLTRIGGER INIT
   ================================================================ */
function initGSAP() {
  gsap.registerPlugin(ScrollTrigger);

  // Sync ScrollTrigger with Lenis
  if (window.lenisInstance) {
    window.lenisInstance.on('scroll', ScrollTrigger.update);
  }
}

/* ================================================================
   SCROLL PROGRESS BAR
   ================================================================ */
function initScrollProgress() {
  const bar = document.getElementById('scroll-progress');
  if (!bar) return;

  ScrollTrigger.create({
    start: 'top top',
    end: 'max',
    onUpdate: (self) => {
      const pct = (self.progress * 100).toFixed(2) + '%';
      document.documentElement.style.setProperty('--scroll-progress', pct);
    },
  });
}

/* ================================================================
   NAVBAR SCROLL BEHAVIOUR
   ================================================================ */
function initNavbar() {
  const navbar = document.getElementById('navbar');
  if (!navbar) return;

  ScrollTrigger.create({
    start: 'top -80',
    onToggle: (self) => {
      navbar.classList.toggle('scrolled', self.isActive);
    },
  });

  // Mobile drawer
  const menuBtn   = document.getElementById('menu-btn');
  const menuClose = document.getElementById('menu-close');
  const mobileNav = document.getElementById('mobile-nav');

  if (menuBtn && mobileNav) {
    menuBtn.addEventListener('click', () => {
      mobileNav.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  }

  if (menuClose && mobileNav) {
    menuClose.addEventListener('click', () => {
      mobileNav.classList.remove('open');
      document.body.style.overflow = '';
    });
  }
}

/* ================================================================
   BOOKING WIDGET (floating CTA — appears after scroll)
   ================================================================ */
function initBookingWidget() {
  const widget = document.getElementById('booking-widget');
  if (!widget) return;

  ScrollTrigger.create({
    start: '300px top',
    onToggle: (self) => {
      widget.classList.toggle('visible', self.isActive);
    },
  });
}

/* ================================================================
   SPLIT TEXT REVEALS (SplitType)
   ================================================================ */
function initTextReveals() {
  if (REDUCED_MOTION) return;

  // Fallback: if SplitType failed to load, just fade the whole heading in
  if (typeof SplitType === 'undefined') {
    document.querySelectorAll('[data-split]').forEach((el) => {
      gsap.from(el, {
        y: 24, opacity: 0, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 92%', toggleActions: 'play none none none' },
      });
    });
    return;
  }

  // Word-by-word reveal (section headings)
  document.querySelectorAll('[data-split="words"]').forEach((el) => {
    const split = new SplitType(el, { types: 'words' });

    gsap.from(split.words, {
      y: '110%',
      opacity: 0,
      duration: 0.85,
      stagger: 0.05,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 92%',
        toggleActions: 'play none none none',
        once: true,
      },
      onComplete: () => gsap.set(split.words, { clearProps: 'transform,opacity' }),
    });
  });

  // Char-by-char reveal (hero headline only)
  document.querySelectorAll('[data-split="chars"]').forEach((el) => {
    const split = new SplitType(el, { types: 'chars,words' });

    gsap.from(split.chars, {
      y: '85%',
      opacity: 0,
      rotateX: -35,
      duration: 0.6,
      stagger: 0.02,
      ease: 'power3.out',
      delay: 0.2,
      scrollTrigger: {
        trigger: el,
        start: 'top 95%',
        toggleActions: 'play none none none',
        once: true,
      },
      onComplete: () => gsap.set(split.chars, { clearProps: 'transform,opacity,rotateX' }),
    });
  });

  // Fade-up paragraphs / labels
  document.querySelectorAll('[data-anim="fade-up"]').forEach((el) => {
    gsap.from(el, {
      y: 28,
      opacity: 0,
      duration: 0.9,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 92%',
        toggleActions: 'play none none none',
        once: true,
      },
      onComplete: () => gsap.set(el, { clearProps: 'transform,opacity' }),
    });
  });
}

/* ================================================================
   STAGGER GRID REVEAL
   ================================================================ */
function initStaggerGrids() {
  if (REDUCED_MOTION) return;

  document.querySelectorAll('[data-stagger]').forEach((container) => {
    const children = container.children;
    if (!children.length) return;
    const delay    = parseFloat(container.dataset.staggerDelay ?? '0.08');

    gsap.from(children, {
      y: 36,
      opacity: 0,
      scale: 0.96,
      duration: 0.75,
      stagger: delay,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: container,
        start: 'top 90%',
        toggleActions: 'play none none none',
        once: true,
      },
      onComplete: () => gsap.set(children, { clearProps: 'transform,opacity,scale' }),
    });
  });
}

/* ================================================================
   PARALLAX IMAGES
   ================================================================ */
function initParallax() {
  if (REDUCED_MOTION) return;

  const intensity = IS_TOUCH ? -8 : -20;

  document.querySelectorAll('[data-parallax]').forEach((el) => {
    const yPercent = parseFloat(el.dataset.parallax ?? intensity);

    gsap.to(el, {
      yPercent,
      ease: 'none',
      scrollTrigger: {
        trigger: el.parentElement ?? el,
        start: 'top bottom',
        end: 'bottom top',
        scrub: 1,
      },
    });
  });
}

/* ================================================================
   STATS COUNTER ANIMATION
   ================================================================ */
function initCounters() {
  document.querySelectorAll('[data-counter]').forEach((el) => {
    const target  = parseFloat(el.dataset.counter ?? '0');
    const suffix  = el.dataset.suffix ?? '';
    const decimals = el.dataset.decimals ? parseInt(el.dataset.decimals) : 0;
    const obj     = { value: 0 };

    ScrollTrigger.create({
      trigger: el,
      start: 'top 85%',
      once: true,
      onEnter: () => {
        gsap.to(obj, {
          value: target,
          duration: 1.8,
          ease: 'power2.out',
          onUpdate: () => {
            el.textContent = obj.value.toFixed(decimals) + suffix;
          },
        });
      },
    });
  });
}

/* ================================================================
   FLOATING GLOW ORBS
   ================================================================ */
function initGlowOrbs() {
  if (REDUCED_MOTION) return;

  document.querySelectorAll('.glow-orb').forEach((orb, i) => {
    const duration = 6 + i * 2;
    const xRange   = 10 + i * 5;
    const yRange   = 15 + i * 8;

    gsap.to(orb, {
      xPercent: xRange,
      yPercent: -yRange,
      duration,
      ease: 'sine.inOut',
      repeat: -1,
      yoyo: true,
      delay: i * 1.5,
    });
  });
}

/* ================================================================
   VANILLATILT — 3D card hover (desktop only)
   ================================================================ */
function initVanillaTilt() {
  if (IS_TOUCH) return;
  if (typeof VanillaTilt === 'undefined') return;

  VanillaTilt.init(document.querySelectorAll('[data-tilt]'), {
    max: 8,
    speed: 400,
    glare: true,
    'max-glare': 0.15,
    scale: 1.02,
  });
}

/* ================================================================
   MAGNETIC BUTTONS (cursor-follow within radius)
   ================================================================ */
function initMagneticButtons() {
  if (IS_TOUCH || REDUCED_MOTION) return;

  document.querySelectorAll('[data-magnetic]').forEach((btn) => {
    const radius   = 40;
    const strength = 0.35;

    btn.addEventListener('mousemove', (e) => {
      const rect   = btn.getBoundingClientRect();
      const cx     = rect.left + rect.width  / 2;
      const cy     = rect.top  + rect.height / 2;
      const dx     = e.clientX - cx;
      const dy     = e.clientY - cy;
      const dist   = Math.sqrt(dx * dx + dy * dy);

      if (dist < radius * 2) {
        gsap.to(btn, {
          x: dx * strength,
          y: dy * strength,
          duration: 0.3,
          ease: 'power3.out',
        });
      }
    });

    btn.addEventListener('mouseleave', () => {
      gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.4)' });
    });
  });
}

/* ================================================================
   CUSTOM CURSOR (desktop only)
   ================================================================ */
function initCustomCursor() {
  if (IS_TOUCH) return;

  const cursor = document.getElementById('cursor');
  if (!cursor) return;

  let mouseX = 0;
  let mouseY = 0;

  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    gsap.to(cursor, {
      x: mouseX,
      y: mouseY,
      duration: 0.15,
      ease: 'power2.out',
    });
  });

  // Enlarge on hoverable elements
  document.querySelectorAll('a, button, [data-cursor]').forEach((el) => {
    el.addEventListener('mouseenter', () => cursor.classList.add('hovering'));
    el.addEventListener('mouseleave', () => cursor.classList.remove('hovering'));
  });

  document.addEventListener('mouseleave', () => gsap.set(cursor, { opacity: 0 }));
  document.addEventListener('mouseenter', () => gsap.set(cursor, { opacity: 1 }));
}

/* ================================================================
   BUTTON RIPPLE
   ================================================================ */
function initButtonRipple() {
  document.querySelectorAll('.btn').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      const rect   = btn.getBoundingClientRect();
      const ripple = document.createElement('span');
      ripple.classList.add('ripple');

      const size = Math.max(rect.width, rect.height);
      ripple.style.cssText = `
        width: ${size}px;
        height: ${size}px;
        left: ${e.clientX - rect.left - size / 2}px;
        top: ${e.clientY - rect.top - size / 2}px;
      `;

      btn.appendChild(ripple);
      ripple.addEventListener('animationend', () => ripple.remove());
    });
  });
}

/* ================================================================
   FAQ ACCORDION
   ================================================================ */
function initFaqAccordion() {
  document.querySelectorAll('.faq-trigger').forEach((trigger) => {
    trigger.addEventListener('click', () => {
      const item = trigger.closest('.faq-item');
      const body = item.querySelector('.faq-body');

      const isOpen = item.classList.contains('open');

      // Close all open items in the same group
      const group = item.closest('[data-faq-group]');
      if (group) {
        group.querySelectorAll('.faq-item.open').forEach((openItem) => {
          if (openItem !== item) {
            openItem.classList.remove('open');
            openItem.querySelector('.faq-body').style.maxHeight = '0';
          }
        });
      }

      if (isOpen) {
        item.classList.remove('open');
        body.style.maxHeight = '0';
      } else {
        item.classList.add('open');
        body.style.maxHeight = body.scrollHeight + 'px';
      }
    });
  });
}

/* ================================================================
   LAZY LOAD BELOW-FOLD VIDEOS
   Inject src only when section enters viewport
   ================================================================ */
function initLazyVideos() {
  const lazyVideos = document.querySelectorAll('video[data-src]');
  if (!lazyVideos.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const video   = entry.target;
        const sources = video.querySelectorAll('source[data-src]');

        sources.forEach((source) => {
          source.src = source.dataset.src;
          source.removeAttribute('data-src');
        });

        if (sources.length === 0 && video.dataset.src) {
          video.src = video.dataset.src;
        }

        video.load();
        video.play().catch(() => {}); // Autoplay may be blocked
        observer.unobserve(video);
      }
    });
  }, { rootMargin: '200px' });

  lazyVideos.forEach((v) => observer.observe(v));
}

/* ================================================================
   MOBILE VIDEO FALLBACK
   Hide video on touch devices, show poster
   ================================================================ */
function handleMobileVideos() {
  if (!IS_TOUCH) return;

  document.querySelectorAll('.bg-video').forEach((video) => {
    video.style.display = 'none';
  });
}

/* ================================================================
   HORIZONTAL SCROLL — HOW IT WORKS
   ================================================================ */
function initHorizontalScroll() {
  // Mobile / narrow viewport: stacked layout (CSS handles it)
  if (IS_TOUCH || window.innerWidth <= 768) return;

  const section    = document.querySelector('.how-it-works-h-scroll');
  const container  = document.querySelector('.horizontal-scroll-container');
  if (!section || !container) return;

  const panels     = gsap.utils.toArray('.horizontal-scroll-panel');
  const getDistance = () => (panels.length - 1) * window.innerWidth;

  const mainTween = gsap.to(container, {
    x: () => -getDistance(),
    ease: 'none',
    scrollTrigger: {
      id: 'horizontal-scroll',
      trigger: section,
      start: 'top top',
      end: () => `+=${getDistance()}`,
      pin: true,
      pinSpacing: true,
      anticipatePin: 1,
      scrub: 1,
      invalidateOnRefresh: true,
    },
  });

  // Crossfade background images per panel
  panels.forEach((panel, i) => {
    if (i === 0) return;
    const bg = panel.querySelector('.panel-bg');
    if (!bg) return;

    const opts = {
      opacity: 0,
      scrollTrigger: {
        trigger: section,
        start: () => `+=${(i - 0.3) * window.innerWidth}`,
        end:   () => `+=${i * window.innerWidth}`,
        scrub: true,
      },
    };
    if (mainTween) opts.scrollTrigger.containerAnimation = mainTween;
    gsap.from(bg, opts);
  });
}

/* ================================================================
   KEN BURNS ZOOM ON IMAGES
   ================================================================ */
function initKenBurns() {
  if (REDUCED_MOTION) return;

  document.querySelectorAll('[data-ken-burns]').forEach((img) => {
    gsap.to(img, {
      scale: 1.12,
      ease: 'none',
      scrollTrigger: {
        trigger: img.parentElement ?? img,
        start: 'top bottom',
        end: 'bottom top',
        scrub: 1.5,
      },
    });
  });
}

/* ================================================================
   CLIP-PATH REVEALS
   ================================================================ */
function initClipReveals() {
  if (REDUCED_MOTION) return;

  // Circle expand
  document.querySelectorAll('[data-reveal="circle"]').forEach((el) => {
    gsap.from(el, {
      clipPath: 'circle(0% at 50% 50%)',
      duration: 1.2,
      ease: 'power3.inOut',
      scrollTrigger: {
        trigger: el,
        start: 'top 80%',
        toggleActions: 'play none none reverse',
      },
    });
  });

  // Diagonal wipe (left to right)
  document.querySelectorAll('[data-reveal="wipe"]').forEach((el) => {
    gsap.from(el, {
      clipPath: 'polygon(0 0, 0 0, 0 100%, 0 100%)',
      duration: 1,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 82%',
        toggleActions: 'play none none reverse',
      },
    });
  });
}

/* ================================================================
   TESTIMONIALS AUTO-CAROUSEL
   ================================================================ */
function initTestimonialsCarousel() {
  const carousel = document.querySelector('.testimonials-carousel');
  if (!carousel) return;

  const track    = carousel.querySelector('.carousel-track');
  const cards    = track ? Array.from(track.children) : [];
  if (cards.length < 2) return;

  let current   = 0;
  let autoTimer = null;

  function goTo(index) {
    track.style.transform = `translateX(-${index * 100}%)`;

    // Update dots — pill effect
    carousel.querySelectorAll('.carousel-dot').forEach((d, i) => {
      const active = i === index;
      d.classList.toggle('active', active);
      d.style.background = active ? 'var(--accent)' : 'rgba(15,23,42,0.2)';
      d.style.width      = active ? '24px' : '8px';
    });

    current = index;
  }

  function next() {
    goTo((current + 1) % cards.length);
  }

  function startAuto() {
    autoTimer = setInterval(next, 5000);
  }

  function stopAuto() {
    clearInterval(autoTimer);
  }

  // Init
  goTo(0);
  startAuto();

  // Prev/Next buttons
  carousel.querySelector('[data-carousel-prev]')?.addEventListener('click', () => {
    stopAuto();
    goTo((current - 1 + cards.length) % cards.length);
    startAuto();
  });

  carousel.querySelector('[data-carousel-next]')?.addEventListener('click', () => {
    stopAuto();
    next();
    startAuto();
  });

  // Dot navigation
  carousel.querySelectorAll('.carousel-dot').forEach((dot, i) => {
    dot.addEventListener('click', () => {
      stopAuto();
      goTo(i);
      startAuto();
    });
  });

  // Pause on hover
  carousel.addEventListener('mouseenter', stopAuto);
  carousel.addEventListener('mouseleave', startAuto);
}

/* ================================================================
   HERO BLOBS — mouse-reactive lerp follow
   ================================================================ */
function initHeroBlobs() {
  if (REDUCED_MOTION) return;
  const hero = document.getElementById('hero');
  if (!hero) return;
  const blob1 = document.getElementById('hero-blob-1');
  const blob2 = document.getElementById('hero-blob-2');
  if (!blob1 && !blob2) return;

  let mouseX = 0, mouseY = 0;
  let b1x = 0, b1y = 0, b2x = 0, b2y = 0;

  hero.addEventListener('mousemove', (e) => {
    const r = hero.getBoundingClientRect();
    mouseX = (e.clientX - r.left) / r.width  - 0.5; // -0.5..0.5
    mouseY = (e.clientY - r.top)  / r.height - 0.5;
  });

  function tick() {
    // lerp toward mouse with different intensity per blob (parallax)
    b1x += (mouseX *  60 - b1x) * 0.04;
    b1y += (mouseY *  60 - b1y) * 0.04;
    b2x += (mouseX * -90 - b2x) * 0.05;
    b2y += (mouseY * -90 - b2y) * 0.05;
    if (blob1) blob1.style.transform = `translate3d(${b1x}px, ${b1y}px, 0)`;
    if (blob2) blob2.style.transform = `translate3d(${b2x}px, ${b2y}px, 0)`;
    requestAnimationFrame(tick);
  }
  tick();
}

/* ================================================================
   HERO TYPEWRITER
   ================================================================ */
function initHeroTypewriter() {
  const el = document.getElementById('hero-typewriter');
  if (!el) return;

  const phrases = ['web development', 'digital marketing', 'SEO & paid ads', 'ecommerce stores', 'conversion design'];
  let idx = 0;

  function cycle() {
    idx = (idx + 1) % phrases.length;
    el.style.opacity = '0';
    el.style.transform = 'translateY(6px)';
    setTimeout(() => {
      el.textContent = phrases[idx];
      el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
      el.style.opacity = '1';
      el.style.transform = 'translateY(0)';
    }, 400);
  }

  el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
  setInterval(cycle, 3500);
}

/* ================================================================
   PAGE TRANSITION OVERLAY
   ================================================================ */
function initPageTransitions() {
  if (REDUCED_MOTION) return;

  const overlay = document.getElementById('page-transition');
  if (!overlay) return;

  document.querySelectorAll('a[href]:not([target="_blank"]):not([data-no-transition])').forEach((link) => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return;

      e.preventDefault();

      gsap.to(overlay, {
        scaleY: 1,
        transformOrigin: 'bottom',
        duration: 0.5,
        ease: 'power4.inOut',
        onComplete: () => {
          window.location.href = href;
        },
      });
    });
  });

  // Reveal on page load (reverse the overlay)
  window.addEventListener('load', () => {
    gsap.to(overlay, {
      scaleY: 0,
      transformOrigin: 'top',
      duration: 0.6,
      ease: 'power4.inOut',
      delay: 0.1,
    });
  });
}

/* ================================================================
   ALPINE.JS MEMBERSHIP BILLING TOGGLE
   (Registered as Alpine component if Alpine is available)
   ================================================================ */
function registerMembership() {
  Alpine.data('membership', () => ({
    period: '1yr',
    plans: window.MEMBERSHIP_PLANS ?? [],

    price(plan) {
      return plan.pricing?.[this.period]?.price ?? '—';
    },

    savings(plan) {
      return plan.pricing?.[this.period]?.savings ?? null;
    },
  }));
}

function initMembershipToggle() { /* registered via alpine:init */ }

/* ================================================================
   BOOKING WIZARD (Alpine.js)
   ================================================================ */
function registerBookingWizard() {
  Alpine.data('bookingWizard', () => ({
    step: 1,
    totalSteps: 4,

    // Form fields (flat — referenced directly by markup)
    service:       '',
    deviceType:    '',
    issue:         '',
    serviceType:   'Remote (Online)',
    firstName:     '',
    lastName:      '',
    email:         '',
    phone:         '',
    preferredDate: '',

    errors:        {},
    submitting:    false,
    submitError:   '',
    submitted:     false,
    bookingRef:    '',

    init(preselect) {
      if (preselect) this.service = preselect;
    },

    progress() {
      return ((this.step - 1) / (this.totalSteps - 1)) * 100;
    },

    step1Next() {
      this.errors = {};
      if (!this.service) {
        this.errors.service = 'Please choose a service to continue.';
        return;
      }
      this.step = 2;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    step2Next() {
      this.errors = {};
      if (!this.deviceType) this.errors.deviceType = 'Select your device type.';
      if (!this.issue || this.issue.trim().length < 10) {
        this.errors.issue = 'Please describe the issue (at least 10 characters).';
      }
      if (Object.keys(this.errors).length) return;
      this.step = 3;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    step3Next() {
      this.errors = {};
      if (!this.firstName.trim()) this.errors.firstName = 'First name required.';
      if (!this.lastName.trim())  this.errors.lastName  = 'Last name required.';
      const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!this.email || !emailRe.test(this.email)) {
        this.errors.email = 'Enter a valid email address.';
      }
      if (Object.keys(this.errors).length) return;
      this.step = 4;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    async submitBooking() {
      this.submitting = true;
      this.submitError = '';

      const payload = {
        service:       this.service,
        deviceType:    this.deviceType,
        issue:         this.issue,
        serviceType:   this.serviceType,
        firstName:     this.firstName,
        lastName:      this.lastName,
        email:         this.email,
        phone:         this.phone,
        preferredDate: this.preferredDate,
        _token:        document.querySelector('meta[name="csrf-token"]')?.content ?? '',
      };

      try {
        const res = await fetch('/api/book', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload),
        });

        let json = {};
        try { json = await res.json(); } catch { /* ignore */ }

        if (res.ok && json.success) {
          this.submitted  = true;
          this.bookingRef = json.booking_ref ?? '';
          window.location.href = '/book-confirmation?ref=' + encodeURIComponent(this.bookingRef);
        } else {
          this.submitError = json.message ?? 'Something went wrong. Please try again.';
        }
      } catch {
        this.submitError = 'Network error. Please try again.';
      } finally {
        this.submitting = false;
      }
    },
  }));
}

function initBookingWizard() { /* registered via alpine:init */ }

/* ================================================================
   ALPINE COMPONENT REGISTRATION
   Must run BEFORE Alpine starts evaluating the DOM.
   alpine:init fires once, before Alpine processes any x-data attributes.
   ================================================================ */
function registerAlpineComponents() {
  registerBookingWizard();
  registerMembership();
}

if (typeof window.Alpine !== 'undefined') {
  // Alpine already loaded — register immediately
  registerAlpineComponents();
} else {
  // Alpine not yet loaded — wait for its init event
  document.addEventListener('alpine:init', registerAlpineComponents);
}

/* ================================================================
   NEWSLETTER FORM
   ================================================================ */
function initNewsletterForm() {
  document.querySelectorAll('[data-newsletter-form]').forEach((form) => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const emailInput  = form.querySelector('[name="email"]');
      const submitBtn   = form.querySelector('[type="submit"]');
      const msg         = form.querySelector('[data-form-msg]');

      if (!emailInput || !submitBtn) return;

      submitBtn.disabled   = true;
      submitBtn.textContent = 'Subscribing…';

      try {
        const body = new FormData(form);
        const res  = await fetch('/api/newsletter', { method: 'POST', body });
        const json = await res.json();

        if (msg) {
          msg.textContent = json.message ?? (json.success ? 'Thanks! Check your inbox.' : 'Something went wrong.');
          msg.className   = 'data-form-msg ' + (json.success ? 'text-success' : 'text-error');
        }
      } catch {
        if (msg) { msg.textContent = 'Network error. Try again.'; }
      } finally {
        submitBtn.disabled   = false;
        submitBtn.textContent = 'Subscribe';
      }
    });
  });
}

/* ================================================================
   CONTACT FORM
   ================================================================ */
function initContactForm() {
  const form = document.getElementById('contact-form');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const submitBtn = form.querySelector('[type="submit"]');
    const msg       = form.querySelector('[data-form-msg]');

    if (submitBtn) {
      submitBtn.disabled   = true;
      submitBtn.textContent = 'Sending…';
    }

    try {
      const body = new FormData(form);
      const res  = await fetch('/api/contact', { method: 'POST', body });
      const json = await res.json();

      if (msg) {
        msg.textContent = json.message ?? (json.success ? 'Message sent! We\'ll be in touch.' : 'Something went wrong.');
        msg.className   = json.success ? 'text-success mt-2' : 'text-error mt-2';
      }

      if (json.success) form.reset();
    } catch {
      if (msg) { msg.textContent = 'Network error. Try again.'; }
    } finally {
      if (submitBtn) {
        submitBtn.disabled   = false;
        submitBtn.textContent = 'Send Message';
      }
    }
  });
}

/* ================================================================
   INIT — run after DOM + preloader finish
   ================================================================ */
function initAll() {
  const steps = [
    initLenis, initGSAP, initScrollProgress, initNavbar, initBookingWidget,
    initTextReveals, initStaggerGrids, initParallax, initCounters, initGlowOrbs,
    initVanillaTilt, initMagneticButtons, initCustomCursor, initButtonRipple,
    initFaqAccordion, initLazyVideos, handleMobileVideos, initHorizontalScroll,
    initKenBurns, initClipReveals, initTestimonialsCarousel, initHeroTypewriter,
    initHeroBlobs, initPageTransitions, initMembershipToggle, initBookingWizard,
    initNewsletterForm, initContactForm,
  ];
  steps.forEach((fn) => {
    try { fn(); } catch (err) { console.error('[init error]', fn.name, err); }
  });
}

// Run on DOMContentLoaded so animations are wired up early
let _initDone = false;
function _runInit() {
  if (_initDone) return;
  _initDone = true;
  initAll();
}
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', _runInit);
} else {
  _runInit();
}

// Refresh ScrollTrigger after preloader done (Lenis sync) and on full load
window.addEventListener('preloader:done', () => {
  if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
});
window.addEventListener('load', () => {
  if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
});
