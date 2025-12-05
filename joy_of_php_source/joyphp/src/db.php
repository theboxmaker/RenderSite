<?php
/**
 * Joy of PHP – Render-compatible MySQL connection
 */

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: 3306;

if (!$host || !$user || !$db) {
    die("<h2>Joy of PHP DB Error</h2>
         <p>Missing database environment variables on Render.</p>");
}

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    die("<h2>Joy of PHP DB Connection Failed</h2>
         <p>Error {$mysqli->connect_errno}: {$mysqli->connect_error}</p>");
}
?>
