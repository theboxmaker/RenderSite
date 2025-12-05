<?php
require_once __DIR__ . '/db.php';

// Safe escape helper
function h($value): string
{
    return $value === null ? '' : htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Fetch inventory
$query = "SELECT VIN, Make, Model, YEAR, EXT_COLOR, ASKING_PRICE FROM inventory ORDER BY Make, Model";
$result = $mysqli->query($query);

if (!$result) {
    die("Database query failed: " . h($mysqli->error));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars - Styled Inventory</title>

    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 20px; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #003459; color: white; }
        tr:hover { background: #eef; }
        .price { font-weight: bold; }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Inventory (Styled Version)</h3>

<table>
    <tr>
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Exterior Color</th>
        <th>Price</th>
    </tr>

    <?php while ($car = $result->fetch_assoc()): ?>
        <tr>
            <td><?= h($car['VIN']) ?></td>
            <td><?= h($car['Make']) ?></td>
            <td><?= h($car['Model']) ?></td>
            <td><?= $car['YEAR'] !== null ? h($car['YEAR']) : '—' ?></td>
            <td><?= h($car['EXT_COLOR']) ?></td>
            <td class="price">
                $<?= $car['ASKING_PRICE'] !== null ? number_format((float)$car['ASKING_PRICE'], 2) : '0.00' ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
