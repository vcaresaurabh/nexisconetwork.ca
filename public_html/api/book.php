<?php
declare(strict_types=1);
/**
 * POST /api/book
 * Validates booking wizard submission and returns a booking reference.
 * Accepts both JSON (from Alpine.js fetch) and form-encoded data.
 */
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Rate limit: 3 bookings per IP per hour
if (!rate_limit('book_' . client_ip(), 3, 3600)) {
    json_response(['success' => false, 'message' => 'Too many bookings from this IP. Please contact us directly.'], 429);
}

// Parse body — Alpine sends JSON, fallback to POST
$content_type = $_SERVER['CONTENT_TYPE'] ?? '';
if (str_contains($content_type, 'application/json')) {
    $raw  = file_get_contents('php://input');
    $body = json_decode($raw, true) ?? [];
} else {
    $body = $_POST;
}

// CSRF — header or body
$token = $_SERVER['HTTP_X_CSRF_TOKEN']
      ?? $body['_token']
      ?? '';
if (!csrf_verify($token)) {
    json_response(['success' => false, 'message' => 'Security token invalid. Please refresh and try again.'], 403);
}

// Honeypot
if (!empty($body['website'])) {
    json_response(['success' => true, 'message' => 'Booking confirmed.', 'booking_ref' => generate_booking_ref()]);
}

// Validate
$service     = sanitize_string($body['service']      ?? '', 60);
$device_type = sanitize_string($body['deviceType']   ?? '', 80);
$issue       = sanitize_string($body['issue']        ?? '', 2000);
$first_name  = sanitize_string($body['firstName']    ?? '', 50);
$last_name   = sanitize_string($body['lastName']     ?? '', 50);
$email       = sanitize_email($body['email']         ?? '');
$phone       = sanitize_phone($body['phone']         ?? '');
$pref_date   = sanitize_string($body['preferredDate']?? '', 12);
$svc_type    = sanitize_string($body['serviceType']  ?? '', 60);

if (!$service)    json_response(['success' => false, 'message' => 'Please select a service.'], 422);
if (!$issue)      json_response(['success' => false, 'message' => 'Please describe your issue.'], 422);
if (!$first_name) json_response(['success' => false, 'message' => 'Please enter your first name.'], 422);
if (!$last_name)  json_response(['success' => false, 'message' => 'Please enter your last name.'], 422);
if (!$email)      json_response(['success' => false, 'message' => 'Please enter a valid email address.'], 422);

// Validate service slug
if (!valid_service_slug($service)) {
    json_response(['success' => false, 'message' => 'Invalid service selected.'], 422);
}

// Generate booking reference
$ref = generate_booking_ref();

// Send confirmation email to client (stub)
$client_body = mail_template([
    'title'    => "Booking Confirmed — {$ref}",
    'body'     => "
    <p>Hi {$first_name},</p>
    <p>We've received your booking request and will confirm your appointment within 2 business hours.</p>
    <p><strong>Reference:</strong> {$ref}</p>
    <p><strong>Service:</strong> {$service}</p>
    <p><strong>Device:</strong> {$device_type}</p>
    <p><strong>Type:</strong> {$svc_type}</p>
    <p><strong>Preferred date:</strong> " . ($pref_date ?: 'Flexible') . "</p>
    <hr style='border-color:#1e2736;margin:20px 0'>
    <p>Keep your reference number handy. To modify or cancel, contact us with reference <strong>{$ref}</strong>.</p>
    ",
    'cta_text' => 'View Cancellation Policy',
    'cta_url'  => APP_URL . '/cancellation-policy',
]);

// TODO: Uncomment when real PHPMailer is installed
// send_mail($email, "{$first_name} {$last_name}", "Booking Confirmed — {$ref}", $client_body);

// Send internal notification (stub)
if (defined('APP_DEBUG') && APP_DEBUG) {
    $log = date('Y-m-d H:i:s') . " | BOOKING | {$ref} | {$service} | {$first_name} {$last_name} | {$email}\n";
    file_put_contents(sys_get_temp_dir() . '/nxn_bookings.log', $log, FILE_APPEND | LOCK_EX);
}

json_response([
    'success'     => true,
    'message'     => 'Booking confirmed!',
    'booking_ref' => $ref,
    'redirect'    => '/book/confirmation?ref=' . urlencode($ref),
]);
