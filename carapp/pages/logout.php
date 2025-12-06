<?php
// Do NOT call session_start() here.
// index.php already started the session before including this file.

require_once __DIR__ . '/../config_db.php';

// Destroy session cleanly
$_SESSION = [];
session_unset();
session_destroy();

// Redirect to homepage
header("Location: " . BASE_URL);
exit;
