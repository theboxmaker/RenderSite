<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';
require_once APP_PATH . '/models/CarModel.php';

$vin = $_POST['vin'] ?? '';

$data = [
    'YEAR'         => $_POST['year'] ?? '',
    'Make'         => $_POST['make'] ?? '',
    'Model'        => $_POST['model'] ?? '',
    'ASKING_PRICE' => $_POST['price'] ?? '',
];

CarModel::update($pdo, $vin, $data);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
