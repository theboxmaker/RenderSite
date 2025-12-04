<?php
include 'db.php';

// Ensure VIN provided
if (!isset($_GET['VIN']) || trim($_GET['VIN']) === "") {
    die("<h2>Error: No VIN provided.</h2>");
}

$vin = trim($_GET['VIN']);

// Select correct DB
$mysqli->select_db("Cars");

// Fetch car entry
$stmt = $mysqli->prepare("SELECT VIN, Make, Model, ASKING_PRICE FROM Cars WHERE VIN = ?");
$stmt->bind_param("s", $vin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<h2>No vehicle found with VIN: " . htmlspecialchars($vin) . "</h2>");
}

$row = $result->fetch_assoc();

$VIN   = htmlspecialchars($row['VIN']);
$make  = htmlspecialchars($row['Make']);
$model = htmlspecialchars($row['Model']);
$price = htmlspecialchars($row['ASKING_PRICE']);

$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle</title>
    <style>
        body { font-family: Arial; margin: 25px; }
        form {
            max-width: 400px;
            background: #f8f8f8;
            padding: 20px;
            border-radius: 6px;
        }
        label { margin-top: 12px; display: block; }
        input[type="text"] { width: 100%; padding: 8px; }
    </style>
</head>

<body>

<h1>Edit Vehicle</h1>

<p><strong>VIN:</strong> <?= $VIN ?></p>

<form action="EditCar.php" method="post">

    <input type="hidden" name="VIN" value="<?= $VIN ?>">

    <label for="make">Make:</label>
    <input id="make" name="Make" type="text" value="<?= $make ?>">

    <label for="model">Model:</label>
    <input id="model" name="Model" type="text" value="<?= $model ?>">

    <label for="price">Asking Price:</label>
    <input id="price" name="ASKING_PRICE" type="text" value="<?= $price ?>">

    <input type="submit" value="Update Vehicle">

</form>

<p><a href="ViewCarsWithStyle2.php">← Back to Car List</a></p>

</body>
</html>
