<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';
require_once APP_PATH . '/models/CarModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate & normalize data
    $newCar = [
        'vin'   => trim($_POST['vin']),
        'make'  => trim($_POST['make']),
        'model' => trim($_POST['model']),
        'year'  => (int) $_POST['year'],
        'price' => (float) $_POST['price']
    ];

    CarModel::add($pdo, $newCar);

    // IMPORTANT: no output before this
    if (!CarModel::add($pdo, $newCar)) {
    header("Location: " . BASE_URL . "/?page=carAdd&error=vin_exists");
    exit;
}

}

// If someone loads the file directly
header("Location: " . BASE_URL . "/?page=carAdd");
exit;
