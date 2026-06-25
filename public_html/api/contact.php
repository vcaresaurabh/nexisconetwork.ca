<?php
declare(strict_types=1);
/**
 * POST /api/contact
 * Validates and stores/emails a contact form submission.
 */
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Rate limit: 5 submissions per IP per 15 min
if (!rate_limit('contact_' . client_ip(), 5, 900)) {
    json_response(['success' => false, 'message' => 'Too many requests. Please wait a few minutes.'], 429);
}

// CSRF
if (!csrf_verify($_POST['_token'] ?? '')) {
    json_response(['success' => false, 'message' => 'Security token invalid. Please refresh and try again.'], 403);
}

// Honeypot
if (!empty($_POST['website'])) {
    json_response(['success' => true, 'message' => 'Thanks! We\'ll be in touch soon.']); // silent pass
}

// Validate inputs
$name     = sanitize_string($_POST['name']     ?? '', 100);
$email    = sanitize_email($_POST['email']    ?? '');
$phone    = sanitize_phone($_POST['phone']    ?? '');
$service  = sanitize_string($_POST['service']  ?? '', 60);
$message  = sanitize_string($_POST['message']  ?? '', 2000);
// Optional "Start a Project" quote fields
$company  = sanitize_string($_POST['company']  ?? '', 120);
$country  = sanitize_string($_POST['country']  ?? '', 80);
$budget   = sanitize_string($_POST['budget']   ?? '', 60);
$currency = sanitize_string($_POST['currency'] ?? '', 8);

if (!$name || strlen($name) < 2) {
    json_response(['success' => false, 'message' => 'Please enter your full name.'], 422);
}
if (!$email) {
    json_response(['success' => false, 'message' => 'Please enter a valid email address.'], 422);
}
if (!$message || strlen($message) < 10) {
    json_response(['success' => false, 'message' => 'Message must be at least 10 characters.'], 422);
}

// Send email (stub — replace PHPMailer stubs with real files for production)
$is_quote = $company !== '' || $country !== '' || $budget !== '';
$subject  = $is_quote
    ? "Project Quote Request: {$name}" . ($service ? " — {$service}" : '')
    : ($service ? "Contact Form: {$name} — {$service}" : "Contact Form: {$name}");

$budget_line = $budget
    ? trim($budget . ' ' . ($currency ?: ''))
    : '—';

$body = mail_template([
    'title' => $is_quote ? 'New Project Quote Request' : 'New Contact Message',
    'body'  => "
    <p><strong>From:</strong> {$name} (<a href='mailto:{$email}'>{$email}</a>)</p>
    <p><strong>Phone:</strong> " . ($phone ?: '—') . "</p>
    <p><strong>Company:</strong> " . ($company ?: '—') . "</p>
    <p><strong>Country:</strong> " . ($country ?: '—') . "</p>
    <p><strong>Service interest:</strong> " . ($service ?: '—') . "</p>
    <p><strong>Budget:</strong> " . htmlspecialchars($budget_line, ENT_QUOTES, 'UTF-8') . "</p>
    <hr style='border-color:#1e2736;margin:20px 0'>
    <p>" . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . "</p>
    ",
]);

// NOTE (owner): Uncomment when real PHPMailer is installed
// send_mail('support@nexisconetwork.ca', 'Nexisco Network', $subject, $body);

// Log to file in dev (remove in production)
if (defined('APP_DEBUG') && APP_DEBUG) {
    $log = date('Y-m-d H:i:s') . " | CONTACT | {$name} | {$email} | {$service}\n";
    file_put_contents(sys_get_temp_dir() . '/nxn_contact.log', $log, FILE_APPEND | LOCK_EX);
}

json_response([
    'success' => true,
    'message' => "Thanks {$name}! We received your message and will reply within 2 business hours.",
]);
