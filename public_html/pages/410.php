<?php
require_once __DIR__ . '/../includes/helpers.php';
http_response_code(410);
$page_title       = '410 — Page Removed | Nexisco Network';
$page_description = 'This page has been permanently removed.';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative min-h-screen flex items-center justify-center overflow-hidden grain"
         style="background:var(--bg-primary)">

  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:10%;left:20%;opacity:0.25" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:300px;height:300px;bottom:10%;right:15%;opacity:0.2;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 text-center container-narrow py-32">
    <div class="font-mono text-[8rem] md:text-[12rem] font-bold leading-none mb-4"
         style="color:var(--accent);opacity:0.9" aria-label="410 — Page removed">
      410
    </div>
    <h1 class="text-h2 mb-4">This Page Has Been Removed</h1>
    <p class="text-lg mb-10" style="color:var(--text-secondary)">
      This page belonged to an earlier version of this website and has been permanently removed.
      <?= e(business('brand_name')) ?> is an <?= e(business('positioning')) ?>.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/"         class="btn btn-secondary" data-magnetic>Back to Home</a>
      <a href="/services" class="btn btn-secondary" data-magnetic>Our Services</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
