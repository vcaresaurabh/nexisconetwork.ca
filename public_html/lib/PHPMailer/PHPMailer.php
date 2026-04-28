<?php
// PHPMailer stub — replace with real files from:
// https://github.com/PHPMailer/PHPMailer/tree/master/src
namespace PHPMailer\PHPMailer;
class PHPMailer {
    const CHARSET_UTF8 = 'UTF-8';
    const ENCRYPTION_STARTTLS = 'tls';
    public $Host; public $SMTPAuth; public $Username; public $Password;
    public $SMTPSecure; public $Port; public $CharSet; public $Subject;
    public $Body; public $AltBody; public $ErrorInfo = '';
    public function __construct(bool $exceptions = false) {}
    public function isSMTP() {}
    public function setFrom(string $address, string $name = ''): bool { return true; }
    public function addAddress(string $address, string $name = ''): bool { return true; }
    public function addReplyTo(string $address, string $name = ''): bool { return true; }
    public function isHTML(bool $isHtml = true): void {}
    public function send(): bool { return false; }
}
