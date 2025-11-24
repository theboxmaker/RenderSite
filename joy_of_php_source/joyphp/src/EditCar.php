<?php
// EditCar.php — cleaned, secured, Railway + Render compatible

include 'db.php';

// Validate POST data
if (
    !isset($_POST['VIN']) ||
    !isset($_POST['Make']) ||
    !isset($_POST['Model']) ||
    !isset($_POST['Asking_Price'])
) {
    die("<h2>Error: Missing form data.</h2>");
}

$vin    = trim($_POST['VIN']);
$make   = trim($_POST['Make']);
$model  = trim($_POST['Model']);
$price  = trim($_POST['Asking_Price']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Updated</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 25px; }
        h1 { color: #333; }
        .msg { padding: 15px; background: #f0f0f0; border-left: 4px solid #444; }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>

<div class="msg">
<?php

// Prepared statement to update the record
$stmt = $mysqli->prepare("
    UPDATE inventory 
    SET Make = ?, Model = ?, ASKING_PRICE = ?
    WHERE VIN = ?
");

if (!$stmt) {
    die("<p>Error preparing statement: " . htmlspecialchars($mysqli->error) . "</p>");
}

$stmt->bind_param("ssds", $make, $model, $price, $vin);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<p><strong>" . htmlspecialchars($make) . " " . htmlspecialchars($model) .
             "</strong> was successfully updated.</p>";
    } else {
        echo "<p>No changes were made (VIN not found or data identical).</p>";
    }
} else {
    echo "<p>Error updating vehicle: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$mysqli->close();
?>
</div>

<p><a href="ViewCarsWithStyle2.php">← Return to Cars with Edit Links</a></p>

</body>
</html>
