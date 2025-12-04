<?php
$isRenderOrDocker = true; // containerized environment ALWAYS remote DB

$DB_HOST = $_ENV['DB_HOST'];
$DB_PORT = $_ENV['DB_PORT'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASS = $_ENV['DB_PASS'];
$DB_NAME = $_ENV['DB_NAME'];
$DB_SSL  = $_ENV['DB_SSL'] ?? null;

$mysqli = mysqli_init();

if ($DB_SSL) {
    mysqli_ssl_set($mysqli, null, null, $DB_SSL, null, null);
    mysqli_real_connect(
        $mysqli,
        $DB_HOST,
        $DB_USER,
        $DB_PASS,
        $DB_NAME,
        (int)$DB_PORT,
        null,
        MYSQLI_CLIENT_SSL
    );
} else {
    mysqli_real_connect(
        $mysqli,
        $DB_HOST,
        $DB_USER,
        $DB_PASS,
        $DB_NAME,
        (int)$DB_PORT
    );
}

if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
?>
