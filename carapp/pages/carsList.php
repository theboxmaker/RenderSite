<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

// Load CarModel (case-safe)
$modelPaths = [
    APP_PATH . '/models/CarModel.php',
    APP_PATH . '/models/carModel.php',
    APP_PATH . '/models/carmodel.php'
];

foreach ($modelPaths as $file) {
    if (file_exists($file)) {
        require_once $file;
        break;
    }
}

$cars = CarModel::getAll($pdo);
?>

<h2>Car Inventory</h2>

<?php if (empty($cars)): ?>
    <p>No cars found in the database.</p>
<?php else: ?>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($cars as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['VIN']) ?></td>
            <td><?= htmlspecialchars($c['Make']) ?></td>
            <td><?= htmlspecialchars($c['Model']) ?></td>
            <td><?= htmlspecialchars($c['YEAR']) ?></td>
            <td>$<?= number_format($c['ASKING_PRICE'], 2) ?></td>

            <td>
                <a href="<?= BASE_URL ?>/?page=carEdit&VIN=<?= urlencode($c['VIN']) ?>">Edit</a>
                |
                <a href="<?= BASE_URL ?>/?page=carDelete&VIN=<?= urlencode($c['VIN']) ?>"
                   onclick="return confirm('Delete this vehicle? This cannot be undone.');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
