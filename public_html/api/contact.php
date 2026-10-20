<?php
declare(strict_types=1);
/**
 * POST /api/contact
 * Validates and stores/emails a contact form submission.
 */
// Only reachable through index.php (/api/contact). A direct /api/contact.php hit skips the bootstrap.
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
if (!empty($_POST['website'])) {
    json_response(['success' => true, 'message' => 'Thanks! We\'ll be in touch soon.']); // silent pass
}

// Validate inputs. Single-line fields go through sanitize_line() (no CR/LF) because
// they end up in the email subject and the debug log.
$name     = sanitize_line($_POST['name']       ?? '', 100);
$email    = sanitize_email($_POST['email']     ?? '');
$phone    = sanitize_phone($_POST['phone']     ?? '');
$service  = sanitize_line($_POST['service']    ?? '', 60);
$message  = sanitize_string($_POST['message']  ?? '', 2000);
// Optional "Start a Project" quote fields
$company  = sanitize_line($_POST['company']    ?? '', 120);
$country  = sanitize_line($_POST['country']    ?? '', 80);
$budget   = sanitize_line($_POST['budget']     ?? '', 60);
$currency = sanitize_line($_POST['currency']   ?? '', 8);

if (!$name || strlen($name) < 2) {
    json_response(['success' => false, 'message' => 'Please enter your full name.'], 422);
}
if (!$email) {
    json_response(['success' => false, 'message' => 'Please enter a valid email address.'], 422);
}
if (!$message || strlen($message) < 10) {
    json_response(['success' => false, 'message' => 'Message must be at least 10 characters.'], 422);
}

// Rate limit: 5 accepted submissions per IP per 15 min. Checked only now, so rejected
// attempts (bad token, honeypot, validation errors) don't use up a real visitor's quota.
if (!rate_limit('contact_' . client_ip(), 5, 900)) {
    json_response([
        'success' => false,
        'message' => sprintf(
            "You've reached this form's limit for now. Please email %s or call %s (%s).",
            business('email'), business('phone'), business('hours')
        ),
    ], 429);
}

// Email the enquiry to the business and store it (when a database is configured).
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
    <p><strong>From:</strong> " . e($name) . " (<a href='mailto:" . e($email) . "'>" . e($email) . "</a>)</p>
    <p><strong>Phone:</strong> " . e($phone ?: '—') . "</p>
    <p><strong>Company:</strong> " . e($company ?: '—') . "</p>
    <p><strong>Country:</strong> " . e($country ?: '—') . "</p>
    <p><strong>Service interest:</strong> " . e($service ?: '—') . "</p>
    <p><strong>Budget:</strong> " . e($budget_line) . "</p>
    <hr style='border-color:#1e2736;margin:20px 0'>
    <p>" . nl2br(e($message)) . "</p>
    ",
]);

// Plain-text part built from the raw values (strip_tags() of the HTML would show &#039; etc.).
$text = ($is_quote ? 'New Project Quote Request' : 'New Contact Message') . "\n\n"
      . "From: {$name} <{$email}>\n"
      . 'Phone: ' . ($phone ?: '—') . "\n"
      . 'Company: ' . ($company ?: '—') . "\n"
      . 'Country: ' . ($country ?: '—') . "\n"
      . 'Service interest: ' . ($service ?: '—') . "\n"
      . "Budget: {$budget_line}\n\n"
      . $message . "\n";

$sent = send_mail([
    'to'       => business('email'),
    'to_name'  => business('brand_name'),
    'subject'  => $subject,
    'html'     => $body,
    'text'     => $text,
    'reply_to' => $email,
]);

$details = array_filter([
    $company ? "Company: {$company}" : '',
    $country ? "Country: {$country}" : '',
    $budget  ? "Budget: {$budget_line}" : '',
]);
$stored = db_run(
    'INSERT INTO contacts (name, email, phone, subject, message, ip_address) VALUES (?, ?, ?, ?, ?, ?)',
    [$name, $email, $phone ?: null, $subject, ($details ? implode("\n", $details) . "\n\n" : '') . $message, client_ip()]
) !== null;

// Debug log (APP_DEBUG only). Every value here is single-line: name/service via
// sanitize_line(), email validated by sanitize_email() — one entry per line.
if (defined('APP_DEBUG') && APP_DEBUG) {
    $log = date('Y-m-d H:i:s') . " | CONTACT | {$name} | {$email} | {$service} | sent=" . (int)$sent . " stored=" . (int)$stored . "\n";
    file_put_contents(sys_get_temp_dir() . '/nxn_contact.log', $log, FILE_APPEND | LOCK_EX);
}

if (!$sent && !$stored) {
    json_response(['success' => false, 'message' => form_unavailable_message()], 503);
}

if (!$sent) {
    // Saved to the database but the notification email didn't go out, so nobody has
    // been alerted yet — don't promise a reply time; give the visitor a way to follow up.
    json_response([
        'success' => true,
        'message' => "Thanks {$name} — we've saved your message. If you haven't heard from us "
                   . business('response_time') . ' during business hours (' . business('hours') . '), please email '
                   . business('email') . ' or call ' . business('phone') . '.',
    ]);
}

json_response([
    'success' => true,
    'message' => "Thanks {$name}! We received your message and will reply " . business('response_time')
               . ' during business hours (' . business('hours') . ').',
]);
