<?php
// Secure session initialization
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require login
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Load CarModel
$modelPaths = [
    APP_PATH . '/models/CarModel.php',
    APP_PATH . '/models/carModel.php',
    APP_PATH . '/models/carmodel.php',
    APP_PATH . '/Models/CarModel.php'
];

$loaded = false;
foreach ($modelPaths as $file) {
    if (file_exists($file)) {
        require_once $file;
        $loaded = true;
        break;
    }
}

if (!$loaded) {
    die("<h2>CarModel.php Not Found</h2>");
}

if (!isset($_GET['VIN'])) {
    die("Missing VIN");
}

CarModel::delete($pdo, $_GET['VIN']);

// Redirect safely AFTER no output
header("Location: " . BASE_URL . "/?page=cars_list");
exit;
