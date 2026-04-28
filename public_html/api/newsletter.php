<?php
declare(strict_types=1);
/**
 * POST /api/newsletter
 * CASL-compliant newsletter subscription.
 */
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Rate limit: 3 per IP per hour
if (!rate_limit('newsletter_' . client_ip(), 3, 3600)) {
    json_response(['success' => false, 'message' => 'Too many attempts. Please try again later.'], 429);
}

// Honeypot
if (!empty($_POST['website'])) {
    json_response(['success' => true, 'message' => 'Thanks for subscribing!']);
}

// Validate email
$email = sanitize_email($_POST['email'] ?? '');
if (!$email) {
    json_response(['success' => false, 'message' => 'Please enter a valid email address.'], 422);
}

// CASL consent — must be explicitly provided
$casl_consent = (int)($_POST['casl_consent'] ?? 0);
if ($casl_consent !== 1) {
    json_response(['success' => false, 'message' => 'Consent is required to subscribe.'], 422);
}

$consent_method    = 'web_footer_form';
$consent_timestamp = date('Y-m-d H:i:s');
$consent_ip        = client_ip();

// TODO: Insert into DB — example query:
// $pdo->prepare("INSERT INTO newsletter (email, casl_consent, consent_timestamp, consent_method, consent_ip)
//                VALUES (?, 1, ?, ?, ?) ON DUPLICATE KEY UPDATE
//                casl_consent=1, consent_timestamp=?, consent_method=?, consent_ip=?")
//     ->execute([$email, $consent_timestamp, $consent_method, $consent_ip,
//                $consent_timestamp, $consent_method, $consent_ip]);

// Send welcome email (stub)
$welcome = mail_template([
    'title'    => 'Welcome to Nexisco Network Updates',
    'body'     => "<p>Thanks for subscribing! You'll receive IT tips, security alerts, and exclusive offers from Nexisco Network.</p>
    <p>As promised — no spam. You can unsubscribe any time via the link below.</p>",
    'cta_text' => 'Unsubscribe',
    'cta_url'  => APP_URL . '/opt-in-opt-out',
]);
// TODO: send_mail($email, '', 'Welcome to Nexisco Network', $welcome);

if (defined('APP_DEBUG') && APP_DEBUG) {
    $log = date('Y-m-d H:i:s') . " | NEWSLETTER | {$email} | CONSENT=1\n";
    file_put_contents(sys_get_temp_dir() . '/nxn_newsletter.log', $log, FILE_APPEND | LOCK_EX);
}

json_response([
    'success' => true,
    'message' => 'Subscribed! Check your inbox for a welcome email.',
]);
