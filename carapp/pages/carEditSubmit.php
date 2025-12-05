<?php
require_once APP_PATH . '/models/CarModel.php';

$vin = $_POST['VIN'] ?? null;

if (!$vin) {
    die("Missing VIN.");
}

CarModel::update($pdo, $vin, $_POST);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
