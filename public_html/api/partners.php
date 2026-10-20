<?php
declare(strict_types=1);
/**
 * POST /api/partners
 * Partner program application form.
 */
// Only reachable through index.php (/api/partners). A direct /api/partners.php hit skips the bootstrap.
if (!defined('APP_URL')) { http_response_code(404); exit; }

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/mailer.php';
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// CSRF
if (!csrf_verify($_POST['_token'] ?? '')) {
    json_response(['success' => false, 'message' => 'Security token invalid. Please refresh and try again.'], 403);
}

// Honeypot
if (!empty($_POST['website_hp'])) {
    json_response(['success' => true, 'message' => 'Application received. We\'ll review it within 1 business day.']);
}

// Validate. Single-line fields go through sanitize_line() (no CR/LF) because they
// end up in the email subject and the debug log.
$name       = sanitize_line($_POST['name']          ?? '', 100);
$business   = sanitize_line($_POST['business']      ?? '', 150);
$email      = sanitize_email($_POST['email']        ?? '');
$phone      = sanitize_phone($_POST['phone']        ?? '');
$biz_type   = sanitize_line($_POST['business_type'] ?? '', 80);
$model      = sanitize_line($_POST['monthly_referrals'] ?? '', 10); // "Preferred partnership model" select
$audience   = sanitize_string($_POST['audience']    ?? '', 1000);

if (!$name)     json_response(['success' => false, 'message' => 'Please enter your name.'], 422);
if (!$business) json_response(['success' => false, 'message' => 'Please enter your business name.'], 422);
if (!$email)    json_response(['success' => false, 'message' => 'Please enter a valid business email.'], 422);
if (!$phone)    json_response(['success' => false, 'message' => 'Please enter a phone number.'], 422);
if (!$biz_type) json_response(['success' => false, 'message' => 'Please select your business type.'], 422);

// Block free email domains for partner applications
if (is_free_email_domain($email)) {
    json_response(['success' => false, 'message' => 'Please use a business email address (not Gmail, Yahoo, etc.).'], 422);
}

// Rate limit: 2 accepted applications per IP per hour. Checked only now, so rejected
// attempts (bad token, honeypot, validation errors) don't use up a real applicant's quota.
if (!rate_limit('partners_' . client_ip(), 2, 3600)) {
    json_response([
        'success' => false,
        'message' => sprintf(
            "You've reached this form's limit for now. Please email %s or call %s (%s).",
            business('email'), business('phone'), business('hours')
        ),
    ], 429);
}

// Email the application to the business and store it (when a database is configured).
$body = mail_template([
    'title' => 'New Partner Application',
    'body'  => "
    <p><strong>Name:</strong> " . e($name) . "</p>
    <p><strong>Business:</strong> " . e($business) . "</p>
    <p><strong>Email:</strong> <a href='mailto:" . e($email) . "'>" . e($email) . "</a></p>
    <p><strong>Phone:</strong> " . e($phone) . "</p>
    <p><strong>Business Type:</strong> " . e($biz_type) . "</p>
    <p><strong>Preferred Model:</strong> " . e($model ?: '—') . "</p>
    <hr style='border-color:#1e2736;margin:20px 0'>
    <p><strong>Audience:</strong><br>" . nl2br(e($audience)) . "</p>
    ",
]);

// Plain-text part built from the raw values (strip_tags() of the HTML would show &#039; etc.).
$text = "New Partner Application\n\n"
      . "Name: {$name}\n"
      . "Business: {$business}\n"
      . "Email: {$email}\n"
      . "Phone: {$phone}\n"
      . "Business Type: {$biz_type}\n"
      . 'Preferred Model: ' . ($model ?: '—') . "\n\n"
      . "Audience:\n" . ($audience ?: '—') . "\n";

$sent = send_mail([
    'to'       => business('email'),
    'to_name'  => business('brand_name'),
    'subject'  => "Partner Application: {$business}",
    'html'     => $body,
    'text'     => $text,
    'reply_to' => $email,
]);

$stored = db_run(
    'INSERT INTO partners (business_name, contact_name, email, phone, partner_type, message, ip_address)
     VALUES (?, ?, ?, ?, ?, ?, ?)',
    [$business, $name, $email, $phone, $biz_type, trim(($model ? "Preferred model: {$model}\n\n" : '') . $audience), client_ip()]
) !== null;

// Debug log (APP_DEBUG only). Every value here is single-line: name/business via
// sanitize_line(), email validated by sanitize_email() — one entry per line.
if (defined('APP_DEBUG') && APP_DEBUG) {
    $log = date('Y-m-d H:i:s') . " | PARTNER | {$name} | {$business} | {$email} | sent=" . (int)$sent . " stored=" . (int)$stored . "\n";
    file_put_contents(sys_get_temp_dir() . '/nxn_partners.log', $log, FILE_APPEND | LOCK_EX);
}

if (!$sent && !$stored) {
    json_response(['success' => false, 'message' => form_unavailable_message()], 503);
}

if (!$sent) {
    // Saved to the database but the notification email didn't go out, so nobody has
    // been alerted yet — don't promise a review time; give the applicant a way to follow up.
    json_response([
        'success' => true,
        'message' => "Thanks {$name} — we've saved your application. If you haven't heard from us within 1 business day, "
                   . 'please email ' . business('email') . ' or call ' . business('phone') . '.',
    ]);
}

json_response([
    'success' => true,
    'message' => "Thanks {$name}! We'll review your application and be in touch within 1 business day.",
]);
