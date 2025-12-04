<?php
require_once APP_PATH . '/models/CarModel.php';

$cars = CarModel::all($pdo);

$title = "Inventory";
ob_start();
?>
<h2>Inventory</h2>

<table class="table">
    <tr>
        <th>Make</th><th>Model</th><th>Price</th><th></th>
    </tr>

<?php foreach ($cars as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['Make']) ?></td>
    <td><?= htmlspecialchars($c['Model']) ?></td>
    <td>$<?= number_format($c['ASKING_PRICE'], 0) ?></td>
    <td>
        <a href="<?= BASE_URL ?>/?page=car_view&VIN=<?= urlencode($c['VIN']) ?>">View</a>
        <a href="<?= BASE_URL ?>/?page=car_edit&VIN=<?= urlencode($c['VIN']) ?>">Edit</a>
        <a href="<?= BASE_URL ?>/?page=car_delete&VIN=<?= urlencode($c['VIN']) ?>">Delete</a>
        <a href="<?= BASE_URL ?>/?page=car_upload&VIN=<?= urlencode($c['VIN']) ?>">Images</a>
    </td>
</tr>
<?php endforeach; ?>

</table>
<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
