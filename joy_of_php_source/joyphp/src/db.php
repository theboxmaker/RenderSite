<?php
// Railway MySQL connection for Render

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    die("MySQL connection failed ({$mysqli->connect_errno}): {$mysqli->connect_error}");
}
?>
