<?php
// API/db.php — unified DB connection for API endpoints

$mysqli = new mysqli(
    'mySQL',      // Docker container name
    'root',       // username
    'verysecret', // password
    'Cars',       // database name
    3306          // MySQL port
);

if ($mysqli->connect_errno) {
    http_response_code(500);
    die(json_encode([
        "error" => "Database connection failed",
        "details" => $mysqli->connect_error
    ]));
}

$mysqli->set_charset("utf8mb4");
?>
