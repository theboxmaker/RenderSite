<?php
require_once APP_PATH . '/models/CarModel.php';

CarModel::add($pdo, $_POST);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
