<?php
// deletecar.php — secure, modernized version

include 'db.php';

// Ensure VIN exists
if (!isset($_GET['VIN']) || trim($_GET['VIN']) === "") {
    die("<h2>Error: No VIN provided.</h2>");
}

$vin = trim($_GET['VIN']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { color: #333; }
        .msg { padding: 15px; background: #f7f7f7; border-left: 4px solid #444; }
        a { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>

<h1>Sam's Used Cars</h1>

<div class="msg">
<?php
// Use a prepared statement to safely delete the record
$stmt = $mysqli->prepare("DELETE FROM inventory WHERE VIN = ?");
$stmt->bind_param("s", $vin);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<p>The vehicle with VIN <strong>" . htmlspecialchars($vin) . "</strong> has been deleted.</p>";
    } else {
        echo "<p>No vehicle found with VIN <strong>" . htmlspecialchars($vin) . "</strong>.</p>";
    }
} else {
    echo "<p>Error deleting vehicle: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$mysqli->close();
?>
</div>

<p>
    <a href="ViewCars.php">← Return to Inventory</a>
</p>

</body>
</html>
