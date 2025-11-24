<?php
// Joy of PHP - Railway MySQL connection

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');   // Railway requires custom port
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

// Create MySQLi connection
$mysqli = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($mysqli->connect_errno) {
    die("MySQL connection failed (" . $mysqli->connect_errno . "): " . $mysqli->connect_error);
}
?>
