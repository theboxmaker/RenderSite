<?php
session_start();
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}
?>

<?php
require_once APP_PATH . '/models/carModel.php';

$vin = $_POST['VIN'] ?? null;

if (!$vin) {
    die("Missing VIN.");
}

CarModel::update($pdo, $vin, $_POST);

header("Location: " . BASE_URL . "/?page=cars_list");
exit;
