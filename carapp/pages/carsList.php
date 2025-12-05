<?php
require_once APP_PATH . '/models/CarModel.php';
$cars = CarModel::getAll($pdo);
?>

<h2>Car Inventory</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Price</th>
    </tr>

    <?php foreach ($cars as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['Make']) ?></td>
            <td><?= htmlspecialchars($c['Model']) ?></td>
            <td><?= htmlspecialchars($c['YEAR']) ?></td>
            <td>$<?= number_format($c['ASKING_PRICE'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
