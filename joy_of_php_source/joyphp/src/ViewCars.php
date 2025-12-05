<?php
require_once __DIR__ . '/db.php';

// Small helper to safely escape values (handles NULL)
function h($value): string
{
    if ($value === null) {
        return '';
    }
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$result = $mysqli->query("
    SELECT VIN, Make, Model, YEAR, ASKING_PRICE 
    FROM inventory 
    ORDER BY Make, Model
");

if (!$result) {
    die("Query error: " . h($mysqli->error));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars - Basic Inventory</title>
</head>
<body>
<h1>Sam's Used Cars</h1>
<h3>Complete Inventory</h3>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Asking Price</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= h($row['VIN']) ?></td>
            <td><?= h($row['Make']) ?></td>
            <td><?= h($row['Model']) ?></td>

            <!-- YEAR might be NULL, show blank or a dash instead of error -->
            <td><?= $row['YEAR'] !== null ? h($row['YEAR']) : '—' ?></td>

            <td>
                $<?= $row['ASKING_PRICE'] !== null
                        ? number_format((float)$row['ASKING_PRICE'], 2)
                        : '0.00' ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
