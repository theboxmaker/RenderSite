<?php
require_once APP_PATH . '/models/carModel.php';

$vin = $_GET['VIN'] ?? null;

if (!$vin) {
    die("Missing VIN.");
}

CarModel::delete($pdo, $vin);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
