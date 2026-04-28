<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title   = 'Software Uninstall Instructions | Nexisco Network Inc.';
$page_canonical = 'https://nexisconetwork.ca/uninstall';
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>
<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Support</div>
    <h1 class="text-h1 mb-2">Uninstall Instructions</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">Remove remote-access tools installed during your service session.</p>
  </div>
</section>
<section class="relative py-16" style="background:var(--bg-primary)">
  <div class="container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">
      <p>During a remote support session, we may have used <strong>AnyDesk</strong> or <strong>TeamViewer</strong> to connect to your device. These are industry-standard tools used by IT professionals worldwide. Here's how to confirm the software is removed after your session.</p>

      <h2>AnyDesk</h2>
      <h3>Windows</h3>
      <ol>
        <li>Open <strong>Settings → Apps → Installed Apps</strong></li>
        <li>Search for "AnyDesk"</li>
        <li>Click the three-dot menu → Uninstall</li>
      </ol>
      <h3>macOS</h3>
      <ol>
        <li>Open <strong>Finder → Applications</strong></li>
        <li>Drag AnyDesk to Trash</li>
        <li>Empty Trash</li>
      </ol>

      <h2>TeamViewer</h2>
      <h3>Windows</h3>
      <ol>
        <li>Open <strong>Control Panel → Programs → Uninstall a Program</strong></li>
        <li>Find TeamViewer → Uninstall</li>
      </ol>
      <h3>macOS</h3>
      <ol>
        <li>Open TeamViewer → Help → Uninstall TeamViewer</li>
      </ol>

      <h2>Verifying No Unauthorized Access</h2>
      <p>After a legitimate remote session:</p>
      <ul>
        <li>Your session password changes automatically — old connections cannot reconnect</li>
        <li>Check <strong>AnyDesk → Security</strong> for session history</li>
        <li>Run a full antivirus scan if you have any doubts</li>
      </ul>

      <p>If you have any concerns about a session, contact us immediately: <a href="mailto:support@nexisconetwork.ca">support@nexisconetwork.ca</a> or <a href="tel:+18257717727">+1 (825) 771-7727</a>.</p>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
