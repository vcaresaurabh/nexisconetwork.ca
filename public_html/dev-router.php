<?php
// Dev-only router for `php -S`. Returns false → server serves file directly.
$path = $_SERVER['DOCUMENT_ROOT'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (is_file($path)) {
    return false;
}
require __DIR__ . '/index.php';
