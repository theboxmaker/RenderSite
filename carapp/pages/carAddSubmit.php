<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';
require_once APP_PATH . '/models/carModel.php';

CarModel::add($pdo, $_POST);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
