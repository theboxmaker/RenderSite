<?php
require_once __DIR__ . '/db.php';

if (!isset($_GET['VIN'])) die("Missing VIN");
$vin = $_GET['VIN'];

$stmt = $mysqli->prepare("SELECT * FROM inventory WHERE VIN=?");
$stmt->bind_param("s", $vin);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if (!$row) die("Car not found");

function safe($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }
?>
<!DOCTYPE html>
<html>
<body>

<h1><?= safe($row['YEAR']) ?> <?= safe($row['Make']) ?> <?= safe($row['Model']) ?></h1>

<p>Price: $<?= number_format($row['ASKING_PRICE'],2) ?></p>

<a href="ViewCars.php">Back</a>

</body>
</html>
