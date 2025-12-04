<?php
$title = "Add Car";
ob_start();
?>

<h2>Add a Car</h2>

<form action="<?= BASE_URL ?>/?page=car_add_submit" method="post">
    <p><label>VIN: <input name="VIN" required></label></p>
    <p><label>Year: <input name="YEAR" type="number" required></label></p>
    <p><label>Make: <input name="Make" required></label></p>
    <p><label>Model: <input name="Model" required></label></p>
    <p><label>Price: <input name="ASKING_PRICE" type="number" step="0.01" required></label></p>
    <button type="submit">Save</button>
</form>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
