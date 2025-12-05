<?php
// Render environment variables
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');   // Usually "defaultdb" on Render
$port = getenv('DB_PORT') ?: 3306;

if (!$host || !$user || !$db) {
    die("ERROR: Database environment variables missing.");
}

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    die("Database connection failed ({$mysqli->connect_errno}): {$mysqli->connect_error}");
}

$mysqli->set_charset("utf8mb4");
