<?php
require_once __DIR__ . '/db.php';

$result = $mysqli->query("SELECT VIN, Make, Model, YEAR, ASKING_PRICE FROM inventory ORDER BY Make, Model");

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Cars</title>
</head>
<body>
<h1>Sam's Used Cars</h1>

<table border="1" cellpadding="6">
    <tr>
        <th>VIN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Asking Price</th>
    </tr>

<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['VIN']) ?></td>
        <td><?= htmlspecialchars($row['Make']) ?></td>
        <td><?= htmlspecialchars($row['Model']) ?></td>
        <td><?= htmlspecialchars($row['YEAR']) ?></td>
        <td>$<?= number_format($row['ASKING_PRICE'], 2) ?></td>
    </tr>
<?php endwhile; ?>

</table>

</body>
</html>
