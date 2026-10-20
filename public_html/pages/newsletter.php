<?php
declare(strict_types=1);
/**
 * /newsletter/confirm?token=…      — double opt-in: the link in the confirmation email
 * /newsletter/unsubscribe?token=…  — the unsubscribe link in every newsletter email
 *
 * Opening a link (GET) only shows a button; nothing changes until the button is
 * pressed (POST + CSRF), so email scanners that prefetch links can't confirm or
 * unsubscribe anyone.
 */
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/mailer.php';

$nl_path = isset($uri) && is_string($uri)
    ? $uri
    : '/' . trim((string)(parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?? '/'), '/');
$nl_action = match ($nl_path) {
    '/newsletter/confirm'     => 'confirm',
    '/newsletter/unsubscribe' => 'unsubscribe',
    default                   => null,
};
if ($nl_action === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}

$nl_is_post = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
$nl_raw     = $nl_is_post ? ($_POST['token'] ?? '') : ($_GET['token'] ?? '');
// Tokens are bin2hex() output; accept a link whose case was changed on the way
$nl_token   = is_string($nl_raw) && preg_match('/\A[0-9a-f]{64}\z/i', $nl_raw) ? strtolower($nl_raw) : null;
$nl_now     = date('Y-m-d H:i:s');

/*
 * $nl_state: 'ask' (show the button), 'confirmed', 'unsubscribed',
 *            'invalid' (404), 'unavailable' (503), 'expired' (403 — bad/missing CSRF token)
 */
if ($nl_is_post && !csrf_verify($_POST['_token'] ?? null)) {
    $nl_state = 'expired';
} elseif ($nl_token === null) {
    $nl_state = 'invalid';
} elseif (!db_configured()) {
    $nl_state = 'unavailable';
} elseif (!$nl_is_post) {
    // Read-only check so a used or unknown link says so straight away
    $nl_column = $nl_action === 'confirm' ? 'confirm_token' : 'unsub_token';
    $nl_found  = db_run("SELECT id FROM newsletter WHERE {$nl_column} = ?", [$nl_token]);
    $nl_state  = $nl_found === null ? 'unavailable' : ($nl_found->fetch() ? 'ask' : 'invalid');
} elseif ($nl_action === 'confirm') {
    $nl_row = db_run('SELECT id, email, unsub_token FROM newsletter WHERE confirm_token = ?', [$nl_token]);
    $nl_sub = $nl_row?->fetch();
    if ($nl_row === null) {
        $nl_state = 'unavailable';
    } elseif (!$nl_sub) {
        $nl_state = 'invalid';
    } else {
        $nl_unsub = is_string($nl_sub['unsub_token']) && $nl_sub['unsub_token'] !== ''
            ? $nl_sub['unsub_token']
            : bin2hex(random_bytes(32));
        // The consent record: what (this list), when, how and from where. Clearing
        // confirm_token in the same statement makes the link single-use.
        $nl_done = db_run(
            'UPDATE newsletter SET subscribed = 1, casl_consent = 1, consent_timestamp = ?, consent_method = ?,
                    ip_address = ?, unsubscribed_at = NULL, confirm_token = NULL, unsub_token = ?
             WHERE id = ? AND confirm_token = ?',
            [$nl_now, 'footer form + email confirmation', client_ip(), $nl_unsub, $nl_sub['id'], $nl_token]
        );
        if ($nl_done === null) {
            $nl_state = 'unavailable';
        } elseif ($nl_done->rowCount() !== 1) {
            $nl_state = 'invalid';
        } else {
            $nl_state = 'confirmed';

            // Welcome email — best effort; the page doesn't mention it
            $nl_unsub_url = url('/newsletter/unsubscribe?token=' . $nl_unsub);
            // mail_template()'s footer "Unsubscribe" link goes to the policy page; point it at the real link
            $nl_welcome = str_replace(
                'href="https://nexisconetwork.ca/opt-in-opt-out" style="color:#0891B2;text-decoration:none">Unsubscribe</a>',
                'href="' . e($nl_unsub_url) . '" style="color:#0891B2;text-decoration:none">Unsubscribe</a>',
                mail_template([
                    'title' => "You're subscribed",
                    'body'  => '<p>Thanks for confirming — you\'re now on the ' . e(business('legal_name'))
                             . ' email list for web, marketing and ecommerce insights and occasional offers.</p>'
                             . '<p>Every newsletter email we send includes an unsubscribe link. To stop at any time, <a href="' . e($nl_unsub_url)
                             . '" style="color:#0891B2">unsubscribe here</a>, or write to ' . e(business('email')) . ' with “Unsubscribe” in the subject.</p>',
                ])
            );
            send_mail([
                'to'       => (string)$nl_sub['email'],
                'subject'  => "You're subscribed to " . business('brand_name') . ' updates',
                'html'     => $nl_welcome,
                'text'     => "Hello,\n\nThanks for confirming — you're now on the " . business('legal_name')
                            . " email list for web, marketing and ecommerce insights and occasional offers.\n\nEvery newsletter email we send includes an unsubscribe link. To stop at any time, unsubscribe here:\n"
                            . $nl_unsub_url . "\nor write to " . business('email') . " with “Unsubscribe” in the subject.\n\n"
                            . business('legal_name') . "\n" . business_address(true) . "\n" . business('phone') . ' · ' . business('email') . "\n",
                'reply_to' => business('email'),
            ]);
        }
    }
} else {
    // Unsubscribe. The link stays valid (CASL: at least 60 days), so pressing it again is harmless.
    $nl_done = db_run(
        'UPDATE newsletter SET subscribed = 0, unsubscribed_at = ?, confirm_token = NULL WHERE unsub_token = ?',
        [$nl_now, $nl_token]
    );
    $nl_state = $nl_done === null ? 'unavailable' : ($nl_done->rowCount() > 0 ? 'unsubscribed' : 'invalid');
}

http_response_code(match ($nl_state) {
    'invalid'     => 404,
    'unavailable' => 503,
    'expired'     => 403,
    default       => 200,
});
header('Cache-Control: no-store');
header('X-Robots-Tag: noindex, nofollow'); // also covers crawlers that read head.php's bingbot meta

// Once subscribed, the address people may need next is the unsubscribe one
$nl_keyword = $nl_action === 'confirm' && $nl_state !== 'confirmed' ? 'Subscribe' : 'Unsubscribe';
$nl_mailto  = business_mailto() . '?subject=' . rawurlencode($nl_keyword);
$nl_email   = '<a href="' . e($nl_mailto) . '" class="underline">' . e(business('email')) . '</a>';
$nl_button  = $nl_action === 'confirm' ? 'Confirm subscription' : 'Unsubscribe';
// Show the button again after an expired session if the link itself looks right
$nl_show_form = $nl_state === 'ask' || ($nl_state === 'expired' && $nl_token !== null);

[$nl_heading, $nl_text] = match ($nl_state) {
    'ask' => $nl_action === 'confirm'
        ? ['Confirm your subscription',
           'Press the button to confirm that you want ' . e(business('legal_name'))
           . " to send you web, marketing and ecommerce insights and occasional offers by email. If you didn't ask for this, close this page — you won't be subscribed."]
        : ['Unsubscribe',
           'Press the button to stop receiving ' . e(business('brand_name')) . ' newsletter emails at this address.'],
    'confirmed' => ["You're subscribed.",
           'Thanks for confirming. Every newsletter email we send includes an unsubscribe link. '
           . "You can also unsubscribe at any time by writing to {$nl_email} with “Unsubscribe” in the subject."],
    'unsubscribed' => ["You've been unsubscribed.",
           'This address has been removed from the ' . e(business('brand_name')) . ' newsletter list. '
           . 'You can sign up again at any time.'],
    'expired' => ['Please try again',
           "We couldn't verify that request — your session may have expired."
           . ($nl_token !== null ? ' Press the button again below.' : '')
           . " If it keeps happening, write to {$nl_email} with “{$nl_keyword}” in the subject."],
    'unavailable' => ["This isn't available right now",
           "We couldn't process this link just now. Please try again later, or write to {$nl_email} with “{$nl_keyword}” in the subject."],
    default => ["This link isn't valid or has already been used.",
           ($nl_action === 'confirm'
               ? 'If you were trying to confirm a newsletter subscription'
               : 'If you were trying to unsubscribe from our newsletter')
           . ", write to {$nl_email} with “{$nl_keyword}” in the subject."],
};

$page_title       = ($nl_action === 'confirm' ? 'Confirm Subscription' : 'Unsubscribe') . ' | Nexisco Network';
$page_description = 'Manage your ' . business('brand_name') . ' newsletter subscription.';
$page_robots      = 'noindex, nofollow';
$page_canonical   = false;
require_once __DIR__ . '/../partials/head.php';
require_once __DIR__ . '/../partials/navbar.php';
?>

<section class="relative min-h-screen flex items-center justify-center overflow-hidden grain"
         style="background:var(--bg-primary)">

  <div class="glow-orb glow-orb-cyan" style="width:400px;height:400px;top:10%;left:20%;opacity:0.25" aria-hidden="true"></div>
  <div class="glow-orb glow-orb-indigo" style="width:300px;height:300px;bottom:10%;right:15%;opacity:0.2;animation-delay:2s" aria-hidden="true"></div>

  <div class="relative z-10 text-center container-narrow py-32">
    <div class="label-tag mb-4">Newsletter</div>
    <h1 class="text-h2 mb-4"><?= e($nl_heading) ?></h1>
    <p class="text-lg mb-10" style="color:var(--text-secondary)"><?= $nl_text /* built above; dynamic parts escaped */ ?></p>

    <?php if ($nl_show_form): ?>
    <form method="post" action="<?= e($nl_path) ?>" class="flex flex-wrap gap-4 justify-center">
      <?= csrf_field() ?>
      <input type="hidden" name="token" value="<?= e($nl_token) ?>">
      <button type="submit" class="btn btn-primary"><?= e($nl_button) ?></button>
      <a href="/" class="btn btn-secondary">Back to Home</a>
    </form>
    <?php else: ?>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="/" class="btn btn-secondary" data-magnetic>Back to Home</a>
      <a href="/opt-in-opt-out" class="btn btn-secondary" data-magnetic>Opt-In / Opt-Out Policy</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
<?php require_once __DIR__ . '/../partials/scripts.php'; ?>
