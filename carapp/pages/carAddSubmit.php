<?php

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';
require_once APP_PATH . '/models/CarModel.php';

// Validate POST data
if (
    empty($_POST['vin']) ||
    empty($_POST['make']) ||
    empty($_POST['model']) ||
    empty($_POST['year']) ||
    empty($_POST['price'])
) {
    die("All fields are required.");
}

// Call the model to insert the record
CarModel::add($pdo, [
    'vin'   => $_POST['vin'],
    'make'  => $_POST['make'],
    'model' => $_POST['model'],
    'year'  => $_POST['year'],
    'price' => $_POST['price']
]);

// Redirect back to inventory list
header("Location: " . BASE_URL . "/?page=cars_list");
exit;
