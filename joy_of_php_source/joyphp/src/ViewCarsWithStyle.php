<?php
require_once __DIR__ . '/db.php';

$query = "SELECT Make, Model, YEAR, ASKING_PRICE FROM inventory ORDER BY Make";

$result = $mysqli->query($query);

if (!$result) {
    die("Query error: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Styled Cars</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f2f2f2; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ccc; }
        th { background: #C2D9FE; }
        tr:nth-child(odd) { background: #F2F5A9; }
    </style>
</head>
<body>

<h1>Sam's Used Cars</h1>
<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Price</th>
    </tr>

    <?php while ($car = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($car['Make']) ?></td>
            <td><?= htmlspecialchars($car['Model']) ?></td>
            <td><?= htmlspecialchars($car['YEAR']) ?></td>
            <td>$<?= number_format($car['ASKING_PRICE'], 0) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
