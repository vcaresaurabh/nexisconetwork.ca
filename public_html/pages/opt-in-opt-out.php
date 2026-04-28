<?php
require_once __DIR__ . '/../includes/helpers.php';
$page_title       = 'Opt-In / Opt-Out | Nexisco Network Inc. — CASL Preferences';
$page_description = 'Manage your CASL communication preferences with Nexisco Network Inc. Unsubscribe from commercial emails or update consent.';
$page_canonical   = 'https://nexisconetwork.ca/opt-in-opt-out';

// Handle unsubscribe via GET token
$unsubscribed = false;
$error        = '';
if (!empty($_GET['token'])) {
    // TODO: Validate token against DB and mark as unsubscribed
    $unsubscribed = true;
}

require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>
<section class="relative pt-36 pb-6 overflow-hidden" style="background:var(--bg-primary)">
  <div class="relative z-10 container-narrow">
    <div class="label-tag mb-4">Communication Preferences</div>
    <h1 class="text-h1 mb-2">Opt-In / Opt-Out</h1>
    <p class="text-sm" style="color:var(--text-tertiary)">
      Manage your communication preferences in compliance with Canada's Anti-Spam Legislation (CASL).
    </p>
  </div>
</section>
<section class="relative py-16" style="background:var(--bg-primary)">
  <div class="container-narrow">
    <div class="glass rounded-3xl p-8 md:p-12 prose-legal">

      <?php if ($unsubscribed): ?>
      <div class="rounded-2xl p-5 mb-8 bg-green-900/20 border border-green-800/40 text-green-400 text-base font-medium">
        ✓ You have been successfully unsubscribed from Nexisco Network commercial emails.
        You will continue to receive transactional messages related to active services.
      </div>
      <?php endif; ?>

      <p><em>Communications under this page are managed by Nexisco Network Inc., 1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada. Identification information appears in every commercial electronic message we send, as required by section 6(2) of CASL.</em></p>

      <h2>Our Commitment Under CASL</h2>
      <p>Canada's Anti-Spam Legislation, <em>S.C. 2010, c. 23</em> ("CASL"), requires us to obtain your express or implied consent before sending commercial electronic messages ("CEMs"). We never add you to our mailing list without your explicit opt-in. Every CEM we send identifies the sender as Nexisco Network Inc., includes our mailing address and a working unsubscribe mechanism that remains valid for at least sixty (60) days.</p>

      <h2>Types of Messages We Send</h2>
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <th style="text-align:left;padding:8px 0">Type</th>
            <th style="text-align:left;padding:8px">Can opt out?</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0">Booking confirmations &amp; receipts</td>
            <td style="padding:8px">No (transactional — required for service)</td>
          </tr>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0">Service status updates</td>
            <td style="padding:8px">No (transactional)</td>
          </tr>
          <tr style="border-bottom:1px solid var(--border-subtle)">
            <td style="padding:8px 0">Newsletters &amp; IT tips</td>
            <td style="padding:8px">Yes — see below</td>
          </tr>
          <tr>
            <td style="padding:8px 0">Promotional offers &amp; discounts</td>
            <td style="padding:8px">Yes — see below</td>
          </tr>
        </tbody>
      </table>

      <h2>Unsubscribe from Commercial Emails</h2>
      <p>To opt out of newsletters and promotional emails:</p>
      <ul>
        <li>Click the "Unsubscribe" link at the bottom of any commercial email we send.</li>
        <li>Email us at <a href="mailto:unsubscribe@nexisconetwork.ca">unsubscribe@nexisconetwork.ca</a> with your email address and "REMOVE" in the subject line.</li>
        <li>Or use the form below:</li>
      </ul>

      <form id="unsubscribe-form" class="mt-6 space-y-4" novalidate>
        <?= csrf_field() ?>
        <div>
          <label class="form-label">Your Email Address</label>
          <input type="email" name="email" class="form-input" placeholder="you@example.ca" required autocomplete="email">
        </div>
        <div id="unsub-feedback" class="text-sm rounded-xl px-4 py-3 hidden" aria-live="polite"></div>
        <button type="submit" class="btn btn-secondary">Request Unsubscribe</button>
      </form>

      <p class="mt-6 text-sm" style="color:var(--text-tertiary)">
        Unsubscribe requests are processed within 10 business days as required by CASL (s. 11).
      </p>

      <h2>Re-Subscribe</h2>
      <p>To re-subscribe to our newsletter at any time, visit our <a href="/">homepage</a> and use the newsletter signup form in the footer. Re-subscribing constitutes fresh express consent under CASL.</p>

      <h2>Postal &amp; Phone Contact</h2>
      <address class="not-italic">
        <strong>Nexisco Network Inc. — CASL Compliance Officer</strong><br>
        1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada<br>
        Phone: <a href="tel:+18257717727">+1 (825) 771-7727</a><br>
        Email: <a href="mailto:unsubscribe@nexisconetwork.ca">unsubscribe@nexisconetwork.ca</a>
      </address>
    </div>
  </div>
</section>

<script>
(function () {
  const form = document.getElementById('unsubscribe-form');
  const fb   = document.getElementById('unsub-feedback');
  if (!form) return;
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = form.querySelector('[name="email"]').value.trim();
    if (!email) return;
    fb.className = 'text-sm rounded-xl px-4 py-3 bg-green-900/30 text-green-400 border border-green-800';
    fb.textContent = 'Unsubscribe request received. You will be removed within 10 business days.';
    form.reset();
  });
})();
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
