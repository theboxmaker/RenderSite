<?php
require_once __DIR__ . '/config.php';

$host = DB_HOST;
$port = DB_PORT ?: 3306; // fallback for local dev
$db   = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

$dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

try {
    $pdo = new PDO(
        $dsn,
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    // Use a clean message on production, full message on local
    if (getenv('RENDER')) {
        die("Database connection failed.");
    } else {
        die("Database connection failed: " . $e->getMessage());
    }
}
