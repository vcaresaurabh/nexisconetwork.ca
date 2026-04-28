<?php
require_once __DIR__ . '/../includes/helpers.php';

// Only accessible with a ref in the query string
$ref = sanitize_string($_GET['ref'] ?? '', 20);
if (!preg_match('/^NXN-\d{6}-[A-Z0-9]{4}$/', $ref)) {
    header('Location: /book');
    exit;
}

$page_title       = 'Booking Confirmed | Nexisco Network';
$page_description = 'Your IT repair booking has been confirmed. Reference: ' . $ref;
$page_canonical   = 'https://nexisconetwork.ca/book/confirmation';

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative min-h-screen flex items-center justify-center overflow-hidden grain"
         style="background:var(--bg-primary)">
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=1920&q=50"
         alt="" style="opacity:0.08;width:100%;height:100%;object-fit:cover">
  </div>
  <div style="position:absolute;inset:0;background:rgba(7,10,15,0.85)" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-cyan"   style="width:400px;height:400px;top:10%;left:15%;opacity:0.20" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:350px;height:350px;bottom:10%;right:10%;opacity:0.15;animation-delay:1.5s" aria-hidden="true"></div>

  <div class="relative z-10 container-narrow text-center py-32">
    <!-- Checkmark -->
    <div class="w-20 h-20 rounded-full mx-auto mb-8 flex items-center justify-center"
         style="background:linear-gradient(135deg,rgba(6,182,212,0.2),rgba(99,102,241,0.2));border:1px solid rgba(6,182,212,0.4)">
      <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2.5"
           stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <polyline points="20 6 9 17 4 12"/>
      </svg>
    </div>

    <div class="label-tag mb-4 mx-auto">Booking Confirmed</div>
    <h1 class="text-h1 mb-4">You're all set!</h1>
    <p class="text-lg mb-3" style="color:var(--text-secondary)">
      A confirmation has been sent to your email address.
    </p>
    <div class="inline-block px-6 py-3 rounded-2xl mb-8 font-mono text-lg"
         style="background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.3);color:var(--accent)">
      Reference: <?= e($ref) ?>
    </div>

    <div class="glass rounded-2xl p-6 text-left mb-8 max-w-md mx-auto">
      <h2 class="text-base font-semibold mb-3">What happens next?</h2>
      <ol class="space-y-2 text-sm" style="color:var(--text-secondary)">
        <li class="flex gap-2"><span style="color:var(--accent)" class="font-mono font-bold">1.</span> We'll review your request and confirm availability within 2 hours.</li>
        <li class="flex gap-2"><span style="color:var(--accent)" class="font-mono font-bold">2.</span> You'll receive a confirmation email with technician details.</li>
        <li class="flex gap-2"><span style="color:var(--accent)" class="font-mono font-bold">3.</span> We'll diagnose for free before any charges apply.</li>
      </ol>
    </div>

    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/" class="btn btn-gradient" data-magnetic>Back to Home</a>
      <a href="/services" class="btn btn-secondary" data-magnetic>Browse Services</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
