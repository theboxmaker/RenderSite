<?php
/**
 * View details about a single car.
 * Cleaned & modernized version with NULL-safe output handling.
 */

include 'db.php';

// Helper to avoid PHP 8.1+ "Passing null to htmlspecialchars() is deprecated"
function safe($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Make sure VIN was provided
if (!isset($_GET['VIN']) || trim($_GET['VIN']) === "") {
    die("<h2>Error: No VIN provided.</h2>");
}

$vin = $mysqli->real_escape_string($_GET['VIN']);

// Query for the specific VIN
$query = "SELECT * FROM inventory WHERE VIN='$vin'";

$result = $mysqli->query($query);

if (!$result) {
    die("<p>Error querying database: " . safe($mysqli->error) . "</p>");
}

// If no rows returned, VIN not found
if ($result->num_rows === 0) {
    echo "<h2>No vehicle found with VIN: " . safe($vin) . "</h2>";
    $mysqli->close();
    exit;
}

// Fetch row
$row = $result->fetch_assoc();

// Safely sanitize values (NULL-safe)
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
