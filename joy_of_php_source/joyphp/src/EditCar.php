<?php
include 'db.php';

function safe($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $VIN   = trim($_POST['VIN']);
    $Make  = trim($_POST['Make']);
    $Model = trim($_POST['Model']);
    $Price = trim($_POST['ASKING_PRICE']);

    $mysqli->select_db("Cars");

    $stmt = $mysqli->prepare("
        UPDATE Cars
        SET Make=?, Model=?, ASKING_PRICE=?
        WHERE VIN=?
    ");

    $stmt->bind_param("ssds", $Make, $Model, $Price, $VIN);

    if ($stmt->execute()) {
        echo "<h2>Car updated successfully.</h2>";
        echo "<p><a href='ViewCars.php'>Return to Inventory</a></p>";
    } else {
        echo "<p>Error updating car: " . safe($stmt->error) . "</p>";
    }

    exit;
}

if (!isset($_GET['VIN'])) {
    die("<h2>Error: No VIN provided.</h2>");
}

$vin = $mysqli->real_escape_string($_GET['VIN']);

$mysqli->select_db("Cars");
$result = $mysqli->query("SELECT * FROM Cars WHERE VIN='$vin'");

if ($result->num_rows === 0) {
    die("<h2>No vehicle found with VIN: " . safe($vin) . "</h2>");
}

$row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
</head>
<body>

<h1>Edit <?= safe($row['Make'] . ' ' . $row['Model']) ?></h1>

<form action="EditCar.php" method="POST">

    <input type="hidden" name="VIN" value="<?= safe($row['VIN']) ?>">

    <p>
        <label>Make:</label><br>
        <input type="text" name="Make" value="<?= safe($row['Make']) ?>">
    </p>

    <p>
        <label>Model:</label><br>
        <input type="text" name="Model" value="<?= safe($row['Model']) ?>">
    </p>

    <p>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="ASKING_PRICE" value="<?= safe($row['ASKING_PRICE']) ?>">
    </p>

    <p>
        <button type="submit">Save Changes</button>
    </p>

</form>

<p><a href="ViewCars.php">← Back to Inventory</a></p>

</body>
</html>
