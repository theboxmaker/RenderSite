<?php

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

/**
 * Safe HTML output helper
 * Prevents PHP 8.1+ deprecation notices when value is NULL.
 */
function h($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Load CarModel safely (Render is case-sensitive)
$modelPaths = [
    APP_PATH . '/models/CarModel.php',
    APP_PATH . '/models/carModel.php',
    APP_PATH . '/models/carmodel.php'
];

$modelLoaded = false;

foreach ($modelPaths as $file) {
    if (file_exists($file)) {
        require_once $file;
        $modelLoaded = true;
        break;
    }
}

if (!$modelLoaded) {
    echo "<h2>MODEL LOAD ERROR</h2>";
    echo "<pre>";
    print_r($modelPaths);
    echo "</pre>";
    exit;
}

// Fetch cars
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
            <td><?= h($c['VIN']) ?></td>
            <td><?= h($c['Make']) ?></td>
            <td><?= h($c['Model']) ?></td>
            <td><?= h($c['YEAR']) ?></td>
            <td>$<?= number_format((float)($c['ASKING_PRICE'] ?? 0), 2) ?></td>

            <td>
                <a href="<?= BASE_URL ?>/?page=carEdit&VIN=<?= urlencode($c['VIN']) ?>">
                    Edit
                </a>
                |
                <a href="<?= BASE_URL ?>/?page=carDelete&VIN=<?= urlencode($c['VIN']) ?>"
                   onclick="return confirm('Delete this vehicle?');">
                    Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>
