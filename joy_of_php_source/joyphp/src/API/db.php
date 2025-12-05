<?php
/**
 * Joy of PHP API – Render-compatible MySQL connection
 */

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: 3306;

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    printf("Connect failed (%s): %s\n", 
           $mysqli->connect_errno, 
           $mysqli->connect_error);
    exit();
}
?>
