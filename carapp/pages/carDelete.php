<?php
require_once APP_PATH . '/models/CarModel.php';

CarModel::delete($pdo, $_GET['VIN']);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
