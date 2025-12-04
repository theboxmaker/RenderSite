<?php
/**
 * Joy of PHP — MySQL connection using Render/Railway environment variables
 */

$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: 3306; // fallback for local dev
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    if (getenv('RENDER')) {
        die("Database connection failed.");
    } else {
        die("MySQL connection failed ({$mysqli->connect_errno}): {$mysqli->connect_error}");
    }
}
?>
