<?php
declare(strict_types=1);
/**
 * POST /api/partners
 * Partner program application form.
 */
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Rate limit: 2 per IP per hour
if (!rate_limit('partners_' . client_ip(), 2, 3600)) {
    json_response(['success' => false, 'message' => 'Too many applications from this IP.'], 429);
}

// Honeypot
if (!empty($_POST['website_hp'])) {
    json_response(['success' => true, 'message' => 'Application received. We\'ll review it within 1 business day.']);
}

// Validate
$name       = sanitize_string($_POST['name']        ?? '', 100);
$business   = sanitize_string($_POST['business']    ?? '', 150);
$email      = sanitize_email($_POST['email']        ?? '');
$phone      = sanitize_phone($_POST['phone']        ?? '');
$biz_type   = sanitize_string($_POST['business_type'] ?? '', 80);
$referrals  = sanitize_string($_POST['monthly_referrals'] ?? '', 10);
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

// Send internal notification
$body = mail_template([
    'title' => 'New Partner Application',
    'body'  => "
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Business:</strong> {$business}</p>
    <p><strong>Email:</strong> <a href='mailto:{$email}'>{$email}</a></p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Business Type:</strong> {$biz_type}</p>
    <p><strong>Est. Monthly Referrals:</strong> " . ($referrals ?: '—') . "</p>
    <hr style='border-color:#1e2736;margin:20px 0'>
    <p><strong>Audience:</strong><br>" . nl2br(htmlspecialchars($audience, ENT_QUOTES, 'UTF-8')) . "</p>
    ",
]);
// TODO: send_mail('partners@nexisconetwork.ca', 'Nexisco Network', "Partner Application: {$business}", $body);

if (defined('APP_DEBUG') && APP_DEBUG) {
    $log = date('Y-m-d H:i:s') . " | PARTNER | {$name} | {$business} | {$email}\n";
    file_put_contents(sys_get_temp_dir() . '/nxn_partners.log', $log, FILE_APPEND | LOCK_EX);
}

json_response([
    'success' => true,
    'message' => "Thanks {$name}! We'll review your application and be in touch within 1 business day.",
]);
