<?php
require_once APP_PATH . '/models/CarModel.php';

$car = CarModel::find($pdo, $_GET['VIN']);

$title = "Edit Car";
ob_start();
?>

<h2>Edit Car</h2>

<form action="<?= BASE_URL ?>/?page=car_edit_submit" method="post">
    <input type="hidden" name="VIN" value="<?= $car['VIN'] ?>">

    <p><label>Year: <input name="YEAR" value="<?= $car['YEAR'] ?>"></label></p>
    <p><label>Make: <input name="Make" value="<?= $car['Make'] ?>"></label></p>
    <p><label>Model: <input name="Model" value="<?= $car['Model'] ?>"></label></p>
    <p><label>Price: <input name="ASKING_PRICE" value="<?= $car['ASKING_PRICE'] ?>"></label></p>

    <button type="submit">Update</button>
</form>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
