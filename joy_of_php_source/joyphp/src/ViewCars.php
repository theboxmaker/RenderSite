<?php
require_once __DIR__ . '/db.php';

$query = "SELECT VIN, Make, Model, ASKING_PRICE FROM inventory ORDER BY Make";
$result = $mysqli->query($query);

if (!$result) {
    die("Error retrieving cars: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars</title>
</head>
<body>

<h1>Sam's Used Cars — Inventory</h1>

<table border="1" cellpadding="8">
<tr>
    <th>Make</th>
    <th>Model</th>
    <th>Price</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['Make']) ?></td>
    <td><?= htmlspecialchars($row['Model']) ?></td>
    <td>$<?= number_format($row['ASKING_PRICE'], 2) ?></td>
    <td>
        <a href="viewcar.php?VIN=<?= urlencode($row['VIN']) ?>">View</a>
        <a href="EditCar.php?VIN=<?= urlencode($row['VIN']) ?>">Edit</a>
        <a href="deletecar.php?VIN=<?= urlencode($row['VIN']) ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
