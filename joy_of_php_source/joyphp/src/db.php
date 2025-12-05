<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');   // THIS is defaultdb
$port = getenv('DB_PORT') ?: 3306;

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    die("Database connection failed ({$mysqli->connect_errno}): {$mysqli->connect_error}");
}
?>
