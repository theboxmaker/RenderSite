<?php
$DB_HOST = "127.0.0.1";  // Required for XAMPP
$DB_USER = "root";       // XAMPP default user
$DB_PASS = "";           // XAMPP default has NO password
$DB_NAME = "railway";    // <-- Change if your database has a different name

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
?>
