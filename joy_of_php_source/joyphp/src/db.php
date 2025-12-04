<?php
// Docker-based MySQL connection for Joy of PHP

$host = 'mySQL';        // matches docker-compose service name
$user = 'root';
$pass = 'verysecret';
$db   = 'Cars';         // Joy of PHP’s database name
$port = 3306;           // default MySQL port inside Docker

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
    die("MySQL connection failed ({$mysqli->connect_errno}): {$mysqli->connect_error}");
}
?>
