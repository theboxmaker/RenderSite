<?php
require_once APP_PATH . '/models/CarModel.php';

// Fetch all cars
$cars = CarModel::getAll($pdo);
?>

<h2>Car Inventory</h2>

<?php if (empty($cars)): ?>
    <p>No vehicles found in inventory.</p>
<?php else: ?>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($cars as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['Make']) ?></td>
            <td><?= htmlspecialchars($c['Model']) ?></td>
            <td><?= htmlspecialchars($c['YEAR']) ?></td>
            <td>$<?= number_format($c['ASKING_PRICE'], 2) ?></td>

            <td>
                <a href="<?= BASE_URL ?>/?page=carView&VIN=<?= urlencode($c['VIN']) ?>">View</a> |
                <a href="<?= BASE_URL ?>/?page=carEdit&VIN=<?= urlencode($c['VIN']) ?>">Edit</a> |
                <a href="<?= BASE_URL ?>/?page=carDelete&VIN=<?= urlencode($c['VIN']) ?>"
                   onclick="return confirm('Delete this vehicle?');">
                    Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>
