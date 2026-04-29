<?php
declare(strict_types=1);
/**
 * Nexisco Network — PHPMailer wrapper
 * Requires: public_html/lib/PHPMailer/ (real files from GitHub)
 */

require_once __DIR__ . '/../lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/SMTP.php';
require_once __DIR__ . '/../lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as MailerException;

/**
 * Send a transactional email.
 *
 * @param array{to: string, to_name?: string, subject: string, html: string, text?: string, reply_to?: string} $params
 */
function send_mail(array $params): bool {
    $config = require __DIR__ . '/../config/config.php';
    $smtp   = $config['smtp'] ?? [];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host        = $smtp['host']     ?? 'smtp.hostinger.com';
        $mail->SMTPAuth    = true;
        $mail->Username    = $smtp['user']     ?? '';
        $mail->Password    = $smtp['pass']     ?? '';
        $mail->SMTPSecure  = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port        = $smtp['port']     ?? 587;
        $mail->CharSet     = PHPMailer::CHARSET_UTF8;

        $mail->setFrom($smtp['from_address'] ?? 'noreply@nexisconetwork.ca', $smtp['from_name'] ?? 'Nexisco Network Inc.');
        $mail->addAddress($params['to'], $params['to_name'] ?? '');

        if (!empty($params['reply_to'])) {
            $mail->addReplyTo($params['reply_to']);
        }

        $mail->isHTML(true);
        $mail->Subject = $params['subject'];
        $mail->Body    = $params['html'];
        $mail->AltBody = $params['text'] ?? strip_tags($params['html']);

        $mail->send();
        return true;

    } catch (MailerException) {
        error_log('PHPMailer error: ' . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Generate a styled HTML email from a template.
 *
 * @param array{title: string, preheader?: string, greeting?: string, body: string, cta_url?: string, cta_text?: string} $data
 */
function mail_template(array $data): string {
    $title     = htmlspecialchars($data['title']     ?? '', ENT_QUOTES, 'UTF-8');
    $preheader = htmlspecialchars($data['preheader'] ?? $data['title'] ?? '', ENT_QUOTES, 'UTF-8');
    $greeting  = htmlspecialchars($data['greeting']  ?? 'Hello,', ENT_QUOTES, 'UTF-8');
    $body      = $data['body'] ?? ''; // Allow HTML in body
    $year      = date('Y');

    $cta = '';
    if (!empty($data['cta_url']) && !empty($data['cta_text'])) {
        $url  = htmlspecialchars($data['cta_url'],  ENT_QUOTES, 'UTF-8');
        $text = htmlspecialchars($data['cta_text'], ENT_QUOTES, 'UTF-8');
        $cta  = "<div style='text-align:center;margin:32px 0'>
                   <a href='{$url}' style='display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#0891B2,#4F46E5);color:#FFFFFF;text-decoration:none;border-radius:8px;font-weight:600;font-size:15px'>{$text}</a>
                 </div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>{$title}</title>
</head>
<body style="margin:0;padding:0;background:#F1F5F9;font-family:'Inter',sans-serif;color:#0F172A">
<!-- Preheader (hidden) -->
<div style="display:none;max-height:0;overflow:hidden;mso-hide:all">{$preheader}</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#F1F5F9;padding:40px 16px">
<tr><td align="center">
  <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#FFFFFF;border-radius:12px;border:1px solid rgba(15,23,42,0.08);overflow:hidden;box-shadow:0 4px 20px rgba(15,23,42,0.06)">

    <!-- Header -->
    <tr>
      <td style="background:linear-gradient(135deg,rgba(8,145,178,0.10),rgba(79,70,229,0.08));padding:32px 40px;border-bottom:1px solid rgba(15,23,42,0.08)">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
              <div style="display:inline-flex;align-items:center;gap:10px">
                <div style="width:36px;height:36px;background:rgba(8,145,178,0.10);border:1px solid rgba(8,145,178,0.3);border-radius:8px;display:flex;align-items:center;justify-content:center">
                  <span style="color:#0891B2;font-weight:700;font-size:16px">N</span>
                </div>
                <span style="font-size:18px;font-weight:700;color:#0F172A">Nexisco <span style="color:#0891B2">Network</span></span>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Body -->
    <tr>
      <td style="padding:40px">
        <p style="font-size:16px;color:#475569;margin:0 0 20px 0">{$greeting}</p>
        <div style="font-size:15px;line-height:1.7;color:#0F172A">{$body}</div>
        {$cta}
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td style="padding:24px 40px;border-top:1px solid rgba(15,23,42,0.08);background:#F8FAFC">
        <p style="font-size:12px;color:#64748B;margin:0;line-height:1.6">
          You're receiving this email from Nexisco Network Inc. because you requested a service or opted in to commercial communications. This message complies with Canada's Anti-Spam Legislation (CASL).<br><br>
          <strong style="color:#475569">Nexisco Network Inc.</strong><br>
          1404, 49A Street NW, Edmonton, Alberta T6L 6H6, Canada<br>
          Phone: +1 (825) 771-7727 · Email: support@nexisconetwork.ca<br><br>
          <a href="https://nexisconetwork.ca/opt-in-opt-out" style="color:#0891B2;text-decoration:none">Unsubscribe</a> ·
          <a href="https://nexisconetwork.ca/privacy" style="color:#0891B2;text-decoration:none">Privacy Policy</a> ·
          <a href="https://nexisconetwork.ca/terms" style="color:#0891B2;text-decoration:none">Terms</a><br><br>
          © {$year} Nexisco Network Inc. All rights reserved.
        </p>
      </td>
    </tr>

  </table>
</td></tr>
</table>
</body>
</html>
HTML;
}
