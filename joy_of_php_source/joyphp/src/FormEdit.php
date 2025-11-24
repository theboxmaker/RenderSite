<?php
// FormEdit.php — modernized, secured, and HTML5 compliant

include 'db.php';

// Ensure VIN is provided
if (!isset($_GET['VIN']) || trim($_GET['VIN']) === "") {
    die("<h2>Error: No VIN provided.</h2>");
}

$vin = trim($_GET['VIN']);

// Prepared statement to prevent SQL injection
$stmt = $mysqli->prepare("SELECT * FROM inventory WHERE VIN = ?");
$stmt->bind_param("s", $vin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<h2>No vehicle found with VIN: " . htmlspecialchars($vin) . "</h2>");
}

$row = $result->fetch_assoc();

$VIN          = htmlspecialchars($row['VIN']);
$make         = htmlspecialchars($row['Make']);
$model        = htmlspecialchars($row['Model']);
$price        = htmlspecialchars($row['ASKING_PRICE']);

$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 25px; }
        h1 { color: #333; }
        form { max-width: 400px; background: #f8f8f8; padding: 20px; border-radius: 6px; }
        label { display: block; margin-top: 10px; }
        input[type="text"] { width: 100%; padding: 8px; margin-top: 4px; }
        input[type="submit"] { margin-top: 15px; padding: 10px 15px; }
    </style>
</head>

<body>

<h1>Edit Vehicle</h1>

<p><strong>VIN:</strong> <?= $VIN ?></p>

<form action="EditCar.php" method="post">

    <!-- Hidden VIN field -->
    <input type="hidden" name="VIN" value="<?= $VIN ?>">

    <label for="make">Make:</label>
    <input id="make" name="Make" type="text" value="<?= $make ?>">

    <label for="model">Model:</label>
    <input id="model" name="Model" type="text" value="<?= $model ?>">

    <label for="price">Price:</label>
    <input id="price" name="Asking_Price" type="text" value="<?= $price ?>">

    <input type="submit" value="Update Vehicle">
</form>

<p>
    <a href="ViewCarsWithStyle2.php">← Back to Car List</a>
</p>

</body>
</html>
