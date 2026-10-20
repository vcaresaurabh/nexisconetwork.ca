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
        // Optional: a full PDO DSN instead of the MySQL settings above
        // (e.g. 'sqlite:/path/to/test.db' for local testing).
        // 'dsn' => '',
    ],
    'smtp' => [
        'host'         => 'smtpout.secureserver.net', // GoDaddy; use your host's SMTP server
        'port'         => 465,
        'user'         => 'noreply@nexisconetwork.ca',
        'pass'         => 'CHANGE_ME_smtp_password',
        'from_address' => 'noreply@nexisconetwork.ca',
        'from_name'    => 'Nexisco Network',
        'admin_email'  => 'admin@nexisconetwork.ca',
        'secure'       => 'ssl',  // 'ssl' (port 465), 'tls' (STARTTLS, port 587) or '' (local testing only)
        'auth'         => true,
    ],
    'app' => [
        'url'         => 'https://nexisconetwork.ca',
        'debug'       => false,
        'timezone'    => 'America/Edmonton',
        // Which request header holds the visitor's IP (form rate limits + newsletter
        // consent record): '' = the connection's address (no proxy), 'CF-Connecting-IP'
        // behind Cloudflare, 'X-Forwarded-For' behind a load balancer. Only set it if
        // the server accepts traffic exclusively from that proxy.
        'client_ip_header' => '',
        // Admin panel is disabled until this is a password_hash() value:
        //   php -r "echo password_hash('your-password', PASSWORD_DEFAULT);"
        'admin_pass'  => '',
    ],
];
