<?php
include 'db.php';

function safe($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

if (!isset($_GET['VIN']) || trim($_GET['VIN']) === "") {
    die("<h2>Error: No VIN provided.</h2>");
}

$vin = $mysqli->real_escape_string($_GET['VIN']);

// Select correct DB
$mysqli->select_db("Cars");

// Query the Cars table
$query = "SELECT * FROM Cars WHERE VIN='$vin'";
$result = $mysqli->query($query);

if (!$result) {
    die("<p>Error querying database: " . safe($mysqli->error) . "</p>");
}

if ($result->num_rows === 0) {
    echo "<h2>No vehicle found with VIN: " . safe($vin) . "</h2>";
    exit;
}

$row = $result->fetch_assoc();

$year     = safe($row['YEAR']);
$make     = safe($row['Make']);
$model    = safe($row['Model']);
$trim     = safe($row['TRIM']);
$color    = safe($row['EXT_COLOR']);
$interior = safe($row['INT_COLOR']);
$mileage  = safe($row['MILEAGE']);
$trans    = safe($row['TRANSMISSION']);
$price    = safe($row['ASKING_PRICE']);

$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars</title>
</head>

<body style="background: url('bg.jpg'); background-size: cover; font-family: Arial, sans-serif;">

<h1>Sam's Used Cars</h1>
<h2><?= "$year $make $model" ?></h2>

<p><strong>Asking Price:</strong> $<?= $price ?></p>
<p><strong>Exterior Color:</strong> <?= $color ?></p>
<p><strong>Interior Color:</strong> <?= $interior ?></p>
<p><strong>Mileage:</strong> <?= $mileage ?> miles</p>
<p><strong>Transmission:</strong> <?= $trans ?></p>

<p>
    <a href="ViewCars.php">← Back to Inventory</a>
</p>

</body>
</html>
