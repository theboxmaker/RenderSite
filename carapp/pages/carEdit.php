<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}

require_once APP_PATH . '/models/CarModel.php';

$car = CarModel::find($pdo, $_GET['VIN']);

$title = "Edit Car";
ob_start();
?>

<h2>Edit Car</h2>

<form action="<?= BASE_URL ?>/?page=carEditSubmit" method="post">
    <input type="hidden" name="VIN" value="<?= htmlspecialchars($car['VIN']) ?>">

    <p><label>Year: 
        <input name="YEAR" value="<?= htmlspecialchars($car['YEAR']) ?>">
    </label></p>

    <p><label>Make: 
        <input name="Make" value="<?= htmlspecialchars($car['Make']) ?>">
    </label></p>

    <p><label>Model: 
        <input name="Model" value="<?= htmlspecialchars($car['Model']) ?>">
    </label></p>

    <p><label>Price: 
        <input name="ASKING_PRICE" value="<?= htmlspecialchars($car['ASKING_PRICE']) ?>">
    </label></p>

    <button type="submit">Update</button>
</form>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
