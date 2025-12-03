<?php

$DB_HOST = "localhost";
$DB_USER = "root";        // change for your server
$DB_PASS = "";            // change for your server
$DB_NAME = "railway";     // or whatever DB name you used

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
?>
