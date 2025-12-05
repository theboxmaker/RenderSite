<?php
session_start();
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}
?>

<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// MUST match your real filename exactly:
require_once APP_PATH . '/models/carModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate & normalize input
    $newCar = [
        'vin'   => trim($_POST['vin']),
        'make'  => trim($_POST['make']),
        'model' => trim($_POST['model']),
        'year'  => (int) $_POST['year'],
        'price' => (float) $_POST['price']
    ];

    try {
        CarModel::add($pdo, $newCar);

        // Redirect to inventory
        header("Location: " . BASE_URL . "/?page=cars_list");
        exit;

    } catch (Exception $e) {

        // VIN already exists or database error
        header("Location: " . BASE_URL . "/?page=carAdd&error=" . urlencode($e->getMessage()));
        exit;
    }
}

// If someone loads this file directly:
header("Location: " . BASE_URL . "/?page=carAdd");
exit;
