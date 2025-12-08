<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Try loading CarModel with flexible path search
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
        <p>Searched these locations:</p>
        <pre>" . implode("\n", $paths) . "</pre>
    ");
}

// VIN must be provided
if (!isset($_GET['VIN'])) {
    die("<h2>Error</h2><p>Missing VIN.</p>");
}

$car = CarModel::get($pdo, $_GET['VIN']);

if (!$car) {
    die("<h2>Error</h2><p>Car not found.</p>");
}
?>


<h2>Edit Car</h2>

<form action="<?= BASE_URL ?>/?page=carEditSubmit" method="post">
    <input type="hidden" name="VIN" value="<?= htmlspecialchars($car['VIN']) ?>">

    <p><label>Year: <input name="YEAR" value="<?= htmlspecialchars($car['YEAR']) ?>"></label></p>
    <p><label>Make: <input name="Make" value="<?= htmlspecialchars($car['Make']) ?>"></label></p>
    <p><label>Model: <input name="Model" value="<?= htmlspecialchars($car['Model']) ?>"></label></p>
    <p><label>Price: <input name="ASKING_PRICE" value="<?= htmlspecialchars($car['ASKING_PRICE']) ?>"></label></p>

    <button type="submit">Update</button>
</form>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
