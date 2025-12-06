<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Load the model safely (case-insensitive)
$modelPaths = [
    APP_PATH . '/models/CarModel.php',
    APP_PATH . '/models/carModel.php',
    APP_PATH . '/models/carmodel.php'
];

foreach ($modelPaths as $file) {
    if (file_exists($file)) {
        require_once $file;
        break;
    }
}

// SECURITY: require login (BUT do NOT call session_start() — index.php already did)
if (!isset($_SESSION['user'])) {
    // No session_start() here!
    header("Location: " . BASE_URL . "/?page=login&error=not_logged_in");
    exit;
}

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        CarModel::add($pdo, [
            'vin'   => $_POST['vin'] ?? '',
            'make'  => $_POST['make'] ?? '',
            'model' => $_POST['model'] ?? '',
            'year'  => $_POST['year'] ?? '',
            'price' => $_POST['price'] ?? ''
        ]);

        // Redirect on success — NO OUTPUT ABOVE THIS POINT
        header("Location: " . BASE_URL . "/?page=cars_list");
        exit;

    } catch (Exception $e) {
        // Redirect back to form with error
        header("Location: " . BASE_URL . "/?page=carAdd&error=" . urlencode($e->getMessage()));
        exit;
    }
}

// If someone visits directly (not POST)
header("Location: " . BASE_URL . "/?page=carAdd");
exit;
