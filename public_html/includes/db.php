<?php
declare(strict_types=1);
/**
 * Nexisco Network — PDO Database Singleton
 */

function db(): PDO {
    static $pdo = null;

    if ($pdo !== null) return $pdo;

    $config = require __DIR__ . '/../config/config.php';

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
        $config['db']['host']    ?? 'localhost',
        $config['db']['port']    ?? 3306,
        $config['db']['name']    ?? 'nexisco_db',
    );

    $pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_STRINGIFY_FETCHES  => false,
        PDO::MYSQL_ATTR_FOUND_ROWS   => true,
    ]);

    return $pdo;
}
