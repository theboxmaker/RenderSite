<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Saved</title>
</head>

<body>

<h1>Submit Car</h1>

<?php
include 'db.php';

// Validate input
$VIN   = trim($_POST['VIN'] ?? '');
$Make  = trim($_POST['Make'] ?? '');
$Model = trim($_POST['Model'] ?? '');
$Price = trim($_POST['Asking_Price'] ?? '');

if ($VIN === '' || $Make === '' || $Model === '' || $Price === '') {
    echo "<p style='color:red;'>All fields are required.</p>";
    exit;
}

$mysqli->select_db("railway");

// Prepared statement for safety
$stmt = $mysqli->prepare(
    "INSERT INTO inventory (VIN, Make, Model, ASKING_PRICE)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param('sssd', $VIN, $Make, $Model, $Price);

if ($stmt->execute()) {
    echo "<p>Successfully entered $Make $Model into database.</p>";
} else {
    echo "<p>Error: {$stmt->error}</p>";
}

$stmt->close();
$mysqli->close();
?>

<p><a href="index.php">Return to Home</a></p>

</body>
</html>
