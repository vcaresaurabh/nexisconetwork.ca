<?php
declare(strict_types=1);
/**
 * POST /api/newsletter
 * Newsletter sign-up with double opt-in (CASL). The form only records a pending
 * address and emails a confirmation link; nobody is subscribed — and no consent
 * is recorded — until they click it (pages/newsletter.php). The reply is the same
 * whether or not the address is already on the list.
 */
if (!defined('APP_URL')) { http_response_code(404); exit; } // only via index.php (/api/newsletter)

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/mailer.php';
require_once __DIR__ . '/../includes/db.php';

/** "…write to support@… with “Subscribe” in the subject." — the way in when the form can't help. */
function newsletter_email_alternative(): string {
    return 'To get updates by email, write to ' . business('email') . ' with “Subscribe” in the subject.';
}

function newsletter_unavailable(): never {
    json_response([
        'success' => false,
        'message' => "Newsletter sign-up isn't available right now. " . newsletter_email_alternative(),
    ], 503);
}

/** The address's row (id, subscribed, unsub_token), false if there is none, null if the query failed. */
function newsletter_row(string $email): array|false|null {
    $stmt = db_run('SELECT id, subscribed, unsub_token FROM newsletter WHERE email = ?', [$email]);
    return $stmt === null ? null : $stmt->fetch();
}

/**
 * mail_template()'s footer "Unsubscribe" link goes to the policy page, which unsubscribes
 * nobody. In newsletter emails, point it at this address's real unsubscribe link.
 */
function newsletter_footer_unsubscribe(string $html, string $unsub_url): string {
    return str_replace(
        'href="https://nexisconetwork.ca/opt-in-opt-out" style="color:#0891B2;text-decoration:none">Unsubscribe</a>',
        'href="' . e($unsub_url) . '" style="color:#0891B2;text-decoration:none">Unsubscribe</a>',
        $html
    );
}

const NEWSLETTER_CHECK_INBOX = 'Thanks! Check your inbox and click the link to confirm your subscription.';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// CSRF
if (!csrf_verify($_POST['_token'] ?? '')) {
    json_response(['success' => false, 'message' => 'Security token invalid. Please refresh and try again.'], 403);
}

// Honeypot — bots get the same reply as everyone else, and nothing is stored or sent
if (!empty($_POST['website'])) {
    json_response(['success' => true, 'message' => NEWSLETTER_CHECK_INBOX]);
}

// Validate email (the column holds 254 characters)
$email = sanitize_email((string)($_POST['email'] ?? ''));
if (!$email || strlen($email) > 254) {
    json_response(['success' => false, 'message' => 'Please enter a valid email address.'], 422);
}

// CASL consent — must be explicitly provided
if ((string)($_POST['casl_consent'] ?? '') !== '1') {
    json_response(['success' => false, 'message' => 'Consent is required to subscribe.'], 422);
}

// Rate limit: 3 valid sign-ups per IP per hour (rejected attempts above don't count)
if (!rate_limit('newsletter_' . client_ip(), 3, 3600)) {
    json_response([
        'success' => false,
        'message' => 'Too many sign-up attempts. Please try again in an hour. ' . newsletter_email_alternative(),
    ], 429);
}

// Double opt-in needs both a database (pending record + consent) and email (the confirmation link)
if (!newsletter_available()) {
    newsletter_unavailable();
}

// At most 3 sign-up requests per address per day, from any IP, so the form can't be
// used to flood someone else's inbox with confirmation emails.
if (!rate_limit('newsletter_to_' . $email, 3, 86400)) {
    json_response([
        'success' => false,
        'message' => "We've had several sign-up requests for this address in the last day, so we won't email it again for now. "
                   . newsletter_email_alternative(),
    ], 429);
}

$row = newsletter_row($email);
if ($row === null) {
    newsletter_unavailable();
}

$confirm_token = bin2hex(random_bytes(32));

if (!$row) {
    // New address: a pending row with no consent recorded until the link is clicked
    $unsub_token = bin2hex(random_bytes(32));
    $saved = db_run(
        'INSERT INTO newsletter (email, subscribed, casl_consent, consent_method, confirm_token, unsub_token, ip_address)
         VALUES (?, 0, 0, NULL, ?, ?, ?)',
        [$email, $confirm_token, $unsub_token, client_ip()]
    );
    if ($saved === null) {
        // Most likely a concurrent request for the same address inserted it first
        // (email is UNIQUE): carry on with that row below.
        $row = newsletter_row($email);
        if (!$row) {
            newsletter_unavailable();
        }
    }
}

if ($row) {
    if ((int)$row['subscribed'] === 1) {
        // Already confirmed: change nothing, send nothing, and say the same as for a new address
        json_response(['success' => true, 'message' => NEWSLETTER_CHECK_INBOX]);
    }

    // Pending or previously unsubscribed: a fresh confirmation link only. The stored
    // consent record and unsubscribed_at stay as they are until the link is clicked.
    $unsub_token = is_string($row['unsub_token']) && $row['unsub_token'] !== ''
        ? $row['unsub_token']
        : bin2hex(random_bytes(32));
    $saved = db_run(
        'UPDATE newsletter SET confirm_token = ?, unsub_token = ? WHERE id = ? AND subscribed = 0',
        [$confirm_token, $unsub_token, $row['id']]
    );
    if ($saved === null) {
        newsletter_unavailable();
    }
    if ($saved->rowCount() !== 1) {
        // Confirmed (or removed) between the lookup and the update
        $now = newsletter_row($email);
        if ($now && (int)$now['subscribed'] === 1) {
            json_response(['success' => true, 'message' => NEWSLETTER_CHECK_INBOX]);
        }
        newsletter_unavailable();
    }
}

// Confirmation email
$confirm_url = url('/newsletter/confirm?token=' . $confirm_token);
$unsub_url   = url('/newsletter/unsubscribe?token=' . $unsub_token);
$legal_name  = business('legal_name');
$support     = business('email');

$html = newsletter_footer_unsubscribe(mail_template([
    'title'     => 'Confirm your subscription',
    'preheader' => 'One click to confirm — until you do, you are not subscribed.',
    'body'      => '<p>You asked ' . e($legal_name) . ' to send you web, marketing and ecommerce insights and occasional offers by email. '
                 . 'To confirm, click the button below.</p>'
                 . "<p>If you didn't ask for this, ignore this email — you won't be subscribed.</p>"
                 . '<p style="font-size:13px;color:#64748B">Don\'t want to hear from us? <a href="' . e($unsub_url)
                 . '" style="color:#0891B2">Unsubscribe</a> — this also cancels this request.</p>',
    'cta_url'   => $confirm_url,
    'cta_text'  => 'Confirm subscription',
]), $unsub_url);
$text = "Hello,\n\n"
      . "You asked {$legal_name} to send you web, marketing and ecommerce insights and occasional offers by email.\n\n"
      . "Confirm your subscription:\n{$confirm_url}\n\n"
      . "If you didn't ask for this, ignore this email — you won't be subscribed.\n\n"
      . "Don't want to hear from us? Unsubscribe (this also cancels this request):\n{$unsub_url}\n\n"
      . "{$legal_name}\n" . business_address(true) . "\n" . business('phone') . " · {$support}\n";

$sent = send_mail([
    'to'       => $email,
    'subject'  => 'Confirm your subscription to ' . business('brand_name') . ' updates',
    'html'     => $html,
    'text'     => $text,
    'reply_to' => $support,
]);

if (!$sent) {
    json_response([
        'success' => false,
        'message' => "Sorry — we couldn't send the confirmation email just now. " . newsletter_email_alternative(),
    ], 503);
}

json_response(['success' => true, 'message' => NEWSLETTER_CHECK_INBOX]);
