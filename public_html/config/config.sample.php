<?php
/**
 * Nexisco Network — Config Sample
 * COPY this file to config.php and fill in real credentials.
 * config.php is gitignored — NEVER commit credentials.
 */
return [
    'db' => [
        'host' => 'localhost',
        'port' => 3306,
        'name' => 'nexisco_db',
        'user' => 'nexisco_user',
        'pass' => 'CHANGE_ME_strong_password',
    ],
    'smtp' => [
        'host'         => 'smtp.hostinger.com',
        'port'         => 587,
        'user'         => 'noreply@nexisconetwork.ca',
        'pass'         => 'CHANGE_ME_smtp_password',
        'from_address' => 'noreply@nexisconetwork.ca',
        'from_name'    => 'Nexisco Network Inc.',
        'admin_email'  => 'admin@nexisconetwork.ca',
    ],
    'app' => [
        'url'         => 'https://nexisconetwork.ca',
        'debug'       => false,
        'timezone'    => 'America/Edmonton',
        'admin_pass'  => '', // Use password_hash() to generate this
    ],
];
