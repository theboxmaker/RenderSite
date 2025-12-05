<?php
session_start();
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}
?>

<?php
require_once APP_PATH . '/models/carModel.php';

$vin = $_GET['VIN'] ?? null;
$car = CarModel::find($pdo, $vin);

if (!$car) {
    die("Car not found");
}

$title = "Edit Vehicle";
?>

<h2>Edit Vehicle</h2>

<form action="<?= BASE_URL ?>/?page=carEditSubmit" method="post">
    <input type="hidden" name="VIN" value="<?= htmlspecialchars($car['VIN']) ?>">

    <label>Year:<br>
        <input type="number" name="YEAR" value="<?= htmlspecialchars($car['YEAR']) ?>">
    </label><br><br>

    <label>Make:<br>
        <input type="text" name="Make" value="<?= htmlspecialchars($car['Make']) ?>">
    </label><br><br>

    <label>Model:<br>
        <input type="text" name="Model" value="<?= htmlspecialchars($car['Model']) ?>">
    </label><br><br>

    <label>Price:<br>
        <input type="number" name="ASKING_PRICE" step="0.01" value="<?= htmlspecialchars($car['ASKING_PRICE']) ?>">
    </label><br><br>

    <button type="submit">Save Changes</button>
</form>
