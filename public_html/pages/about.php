<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/seo.php';

$page_title       = 'About Us | Nexisco Network — Canadian IT Experts';
$page_description = 'Meet the Nexisco Network team. We\'re Canadian IT professionals dedicated to fast, reliable, honest tech support for homes and businesses nationwide.';
$page_canonical   = 'https://nexisconetwork.ca/about';
$extra_head       = Seo::organization();

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative min-h-[60vh] flex items-end overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=60"
         alt="" loading="eager"
         style="opacity:0.20;width:100%;height:100%;object-fit:cover" data-parallax="-20">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(7,10,15,0.5) 0%,rgba(7,10,15,0.96) 100%)"></div>
  </div>
  <div class="glow-orb glow-orb-cyan"  style="width:500px;height:500px;top:-5%;right:5%;opacity:0.15" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:5%;left:5%;opacity:0.12;animation-delay:2.5s" aria-hidden="true"></div>

  <div class="relative z-10 container-wide pb-16 pt-40">
    <div class="label-tag mb-4" data-anim="fade-up">About Us</div>
    <h1 class="text-display mb-5 max-w-3xl" data-split="words">Built on trust.<br>Driven by expertise.</h1>
    <p class="text-xl max-w-2xl" style="color:var(--text-secondary)" data-anim="fade-up">
      Nexisco Network was founded on a simple belief: Canadians deserve fast, honest, affordable IT support — without the jargon.
    </p>
  </div>
</section>

<!-- ── Story ──────────────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden" style="background:var(--bg-primary)">
  <div class="bg-grid absolute inset-0 z-0 opacity-25" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <!-- Image -->
      <div class="relative rounded-3xl overflow-hidden aspect-[4/3]" data-reveal="circle">
        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=900&q=70"
             alt="Nexisco Network team at work"
             loading="lazy" width="900" height="675"
             class="w-full h-full object-cover">
        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(6,182,212,0.08),rgba(99,102,241,0.08))"></div>
      </div>
      <!-- Text -->
      <div>
        <div class="label-tag mb-4" data-anim="fade-up">Our Story</div>
        <h2 class="text-h1 mb-5" data-split="words">We've been in your shoes.</h2>
        <div class="space-y-4 text-base leading-relaxed" style="color:var(--text-secondary)">
          <p data-anim="fade-up">
            We started Nexisco Network after years of watching friends and family get overcharged by repair shops
            that weren't transparent about their work. We knew there was a better way.
          </p>
          <p data-anim="fade-up">
            Today we're a team of certified IT professionals serving clients from Vancouver to Halifax — remotely
            and on-site. Every technician on our team has been vetted, trained, and shares our obsession with
            getting it right the first time.
          </p>
          <p data-anim="fade-up">
            We're proud to be a 100% Canadian company, PIPEDA-compliant, and CASL-certified.
            Your data never leaves Canada.
          </p>
        </div>
        <div class="flex flex-wrap gap-4 mt-8" data-anim="fade-up">
          <a href="/services" class="btn btn-gradient" data-magnetic>Explore Services</a>
          <a href="/contact"  class="btn btn-secondary" data-magnetic>Get in Touch</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── Stats ──────────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden" style="background:var(--bg-secondary);border-top:1px solid var(--border-subtle)">
  <div class="relative z-10 container-wide">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center" data-stagger>
      <?php
      $stats = [
        ['num' => '2,400+', 'label' => 'Repairs Completed'],
        ['num' => '4.9★',   'label' => 'Average Rating'],
        ['num' => '98%',    'label' => 'Client Satisfaction'],
        ['num' => '10+',    'label' => 'Years of Experience'],
      ];
      foreach ($stats as $s): ?>
      <div>
        <div class="text-5xl font-bold mb-2 font-mono" style="color:var(--accent)" data-counter><?= e($s['num']) ?></div>
        <div class="text-sm uppercase tracking-widest" style="color:var(--text-tertiary)"><?= e($s['label']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Values ─────────────────────────────────────────────────────── -->
<section class="relative py-24 overflow-hidden grain" style="background:var(--bg-primary)">
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:10%;right:-5%;opacity:0.10" aria-hidden="true"></div>
  <div class="relative z-10 container-wide">
    <div class="text-center mb-16">
      <div class="label-tag mb-3 mx-auto" data-anim="fade-up">Our Values</div>
      <h2 class="text-h1" data-split="words">What we stand for</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-stagger>
      <?php
      $values = [
        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
          'title' => 'Honesty First', 'desc' => 'We tell you the truth — even when it\'s not what you want to hear. No unnecessary upsells, no inflated labour times.'],
        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
          'title' => 'Speed Matters', 'desc' => 'Most repairs are same-day or next-day. We know your computer is your livelihood and we treat downtime seriously.'],
        ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
          'title' => 'Privacy Protected', 'desc' => 'PIPEDA-compliant. Your data stays in Canada. We never access personal files without your explicit permission.'],
      ];
      foreach ($values as $v): ?>
      <div class="glass rounded-2xl p-8 text-center">
        <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center"
             style="background:linear-gradient(135deg,rgba(6,182,212,0.15),rgba(99,102,241,0.15));border:1px solid var(--border-subtle)">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
               stroke="var(--accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="<?= e($v['icon']) ?>"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3"><?= e($v['title']) ?></h3>
        <p class="text-sm leading-relaxed" style="color:var(--text-secondary)"><?= e($v['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── CTA ────────────────────────────────────────────────────────── -->
<section class="relative py-20 overflow-hidden grain">
  <div class="gradient-mesh absolute inset-0 z-0 opacity-20" aria-hidden="true"></div>
  <div style="position:absolute;inset:0;background:rgba(7,10,15,0.75)" aria-hidden="true"></div>
  <div class="relative z-10 container-narrow text-center">
    <h2 class="text-h1 mb-4" data-split="words">Ready to work with us?</h2>
    <p class="text-lg mb-8" style="color:var(--text-secondary)">
      Book a repair, ask a question, or just say hello.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/book"    class="btn btn-gradient btn-lg" data-magnetic>Book a Repair</a>
      <a href="/contact" class="btn btn-secondary btn-lg" data-magnetic>Contact Us</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
