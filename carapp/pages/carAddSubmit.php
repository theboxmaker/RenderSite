<?php
require_once __DIR__ . '/../config_db.php';
require_once __DIR__ . '/../db.php';

// Load CarModel safely regardless of case
$modelPath1 = __DIR__ . '/../models/CarModel.php';
$modelPath2 = __DIR__ . '/../models/carModel.php';
$modelPath3 = __DIR__ . '/../models/carmodel.php';

if (file_exists($modelPath1)) {
    require_once $modelPath1;
} elseif (file_exists($modelPath2)) {
    require_once $modelPath2;
} elseif (file_exists($modelPath3)) {
    require_once $modelPath3;
} else {
    die("CarModel.php not found in /carapp/models. Check filename case.");
}

CarModel::add($pdo, $_POST);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
