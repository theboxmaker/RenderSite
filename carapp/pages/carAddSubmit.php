<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';
require_once APP_PATH . '/models/CarModel.php';

try {
    CarModel::add($pdo, $_POST);

    // Redirect to car list on success
    header("Location: " . BASE_URL . "/?page=cars_list");
    exit;

} catch (Exception $e) {

    // Show clean error without Flash messaging:
    echo "<h2>Error Adding Vehicle</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><a href='" . BASE_URL . "/?page=carAdd'>← Go Back</a></p>";
    exit;
}
