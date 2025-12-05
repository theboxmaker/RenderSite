<?php
session_start();
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}
?>

<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Try loading the model with multiple possible name cases
$paths = [
    APP_PATH . '/models/CarModel.php',
    APP_PATH . '/models/carModel.php',
    APP_PATH . '/models/carmodel.php',
    APP_PATH . '/Models/CarModel.php'
];

$loaded = false;
foreach ($paths as $file) {
    if (file_exists($file)) {
        require_once $file;
        $loaded = true;
        break;
    }
}

if (!$loaded) {
    die("
        <h2>CarModel.php Not Found</h2>
        <p>Searched for:</p>
        <pre>" . implode("\n", $paths) . "</pre>
    ");
}

if (!isset($_GET['VIN'])) {
    die("Missing VIN");
}

// Perform deletion
CarModel::delete($pdo, $_GET['VIN']);

// Redirect back to list
header("Location: " . BASE_URL . "/?page=cars_list");
exit;
