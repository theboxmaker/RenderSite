<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Load CarModel class
require_once __DIR__ . '/../models/CarModel.php';

// Valid VIN?
if (!isset($_GET['VIN'])) {
    die("<h2>Error</h2><p>No VIN provided.</p>");
}

$vin = $_GET['VIN'];

// Load the vehicle
$car = CarModel::find($pdo, $vin);

if (!$car) {
    die("<h2>Error</h2><p>Vehicle not found.</p>");
}
?>

<h2>Edit Vehicle</h2>

<form method="post" action="<?= BASE_URL ?>/?page=carEditSubmit">

    <input type="hidden" name="vin" value="<?= htmlspecialchars($car['VIN']) ?>">

    <label>Make:</label><br>
    <input type="text" name="make" value="<?= htmlspecialchars($car['Make']) ?>" required><br><br>

    <label>Model:</label><br>
    <input type="text" name="model" value="<?= htmlspecialchars($car['Model']) ?>" required><br><br>

    <label>Year:</label><br>
    <input type="number" name="year" value="<?= htmlspecialchars($car['YEAR']) ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($car['ASKING_PRICE']) ?>" required><br><br>

    <button type="submit">Save Changes</button>
</form>
