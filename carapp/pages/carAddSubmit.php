<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Try multiple case variants (Render is case-sensitive)
$paths = [
    APP_PATH . '/models/CarModel.php',
    APP_PATH . '/models/carModel.php',
    APP_PATH . '/models/carmodel.php',
    APP_PATH . '/Models/CarModel.php',
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
        <p>Searched for these files:</p>
        <pre>" . implode("\n", $paths) . "</pre>
        <p>Make sure your model file is named <strong>CarModel.php</strong> and located in <strong>/carapp/models/</strong>.</p>
    ");
}

// Process the form
try {
    CarModel::add($pdo, $_POST);

    header("Location: " . BASE_URL . "/?page=cars_list");
    exit;

} catch (Exception $e) {
    echo "<h2>Error Adding Vehicle</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><a href='" . BASE_URL . "/?page=carAdd'>← Go Back</a></p>";
    exit;
}
