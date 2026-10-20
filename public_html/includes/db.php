<?php
declare(strict_types=1);
/**
 * Nexisco Network — PDO Database Singleton
 */

function db(): PDO {
    static $pdo = null;

    if ($pdo !== null) return $pdo;

    $db = app_config()['db'] ?? [];

    // 'dsn' overrides the MySQL settings (e.g. sqlite:/path/test.db for local tests)
    $dsn = !empty($db['dsn']) ? $db['dsn'] : sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
        $db['host'] ?? 'localhost',
        $db['port'] ?? 3306,
        $db['name'] ?? 'nexisco_db',
    );

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_STRINGIFY_FETCHES  => false,
        PDO::ATTR_TIMEOUT            => 5, // don't hang form requests on an unreachable DB host
    ];
    if (str_starts_with($dsn, 'mysql:') && defined('PDO::MYSQL_ATTR_FOUND_ROWS')) {
        $options[PDO::MYSQL_ATTR_FOUND_ROWS] = true; // UPDATE rowCount() = matched rows
    }

    $pdo = new PDO($dsn, $db['user'] ?? null, $db['pass'] ?? null, $options);

    return $pdo;
}

/**
 * Run one prepared statement. Returns the statement, or null (and logs why)
 * when the database isn't configured or the query fails.
 */
function db_run(string $sql, array $params = []): ?PDOStatement {
    if (!db_configured()) return null;
    try {
        $stmt = db()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (Throwable $e) {
        error_log('db_run: ' . $e->getMessage());
        return null;
    }
}
