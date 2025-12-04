<?php
require_once APP_PATH . '/models/CarModel.php';

CarModel::update($pdo, $_POST['VIN'], $_POST);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
