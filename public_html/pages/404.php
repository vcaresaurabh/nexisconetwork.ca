<?php
require_once __DIR__ . '/../includes/helpers.php';
http_response_code(404);
$page_title       = '404 — Page Not Found | Nexisco Network';
$page_description = 'This page has moved or no longer exists. Explore our services, portfolio, or start a project with Nexisco Network.';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative min-h-screen flex items-center justify-center overflow-hidden grain"
         style="background:var(--bg-primary)">

  <!-- Abstract dark background -->
  <div class="bg-media-wrapper" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1614741118887-7a4ee193a5fa?w=1920&q=50"
         alt="" style="opacity:0.30;width:100%;height:100%;object-fit:cover">
  </div>
  <div class="bg-overlay-full" style="background:rgba(250,251,252,0.85)" aria-hidden="true"></div>

  <!-- Glow orbs -->
  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:10%;left:20%;opacity:0.25" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:300px;height:300px;bottom:10%;right:15%;opacity:0.2;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 text-center container-narrow py-32">
    <div class="font-mono text-[8rem] md:text-[12rem] font-bold leading-none mb-4 glitch-text"
         data-text="404" style="color:var(--accent);opacity:0.9" aria-label="404 — Page not found">
      404
    </div>
    <h1 class="text-h2 mb-4">This Page Took a Wrong Turn</h1>
    <p class="text-lg mb-10" style="color:var(--text-secondary)">
      The page you're after has moved or no longer exists. Let's get you back on track —
      explore what we build for clients across the USA, Canada, and worldwide.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/start-project" class="btn btn-gradient"  data-magnetic>Get a Free Quote</a>
      <a href="/"              class="btn btn-secondary" data-magnetic>Back to Home</a>
      <a href="/services"      class="btn btn-secondary" data-magnetic>Our Services</a>
      <a href="/portfolio"     class="btn btn-secondary" data-magnetic>View Portfolio</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
