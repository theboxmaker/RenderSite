<?php
// Query the inventory
$stmt = $pdo->query("SELECT VIN, Make, Model, YEAR, ASKING_PRICE FROM inventory ORDER BY Make, Model");
$cars = $stmt->fetchAll();
?>

<h2>Inventory</h2>

<table>
    <tr>
        <th>Year</th>
        <th>Make</th>
        <th>Model</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($cars as $car): ?>
        <tr>
            <td><?= htmlspecialchars($car['YEAR']) ?></td>
            <td><?= htmlspecialchars($car['Make']) ?></td>
            <td><?= htmlspecialchars($car['Model']) ?></td>
            <td>$<?= number_format($car['ASKING_PRICE'], 2) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/?page=car_edit&VIN=<?= urlencode($car['VIN']) ?>">Edit</a> |
                <a href="<?= BASE_URL ?>/?page=car_delete&VIN=<?= urlencode($car['VIN']) ?>"
                   onclick="return confirm('Delete this car?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
