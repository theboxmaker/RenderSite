<?php
include 'db.php';

// Ensure we are using the Cars database
$mysqli->query("CREATE DATABASE IF NOT EXISTS Cars");
$mysqli->select_db("Cars");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars</title>
    <style>
        table { width: 80%; border-collapse: collapse; margin: 20px auto; background: #f8f8f8; }
        th, td { padding: 10px 12px; border: 1px solid #ccc; text-align: left; }
        th { background: #444; color: #fff; }
        tr.odd { background: #ffffff; }
        tr.even { background: #f0f0f0; }
        h1, h3 { text-align: center; font-family: Arial, sans-serif; }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Complete Inventory</h3>

<?php
$query = "SELECT VIN, Make, Model, ASKING_PRICE FROM Cars ORDER BY Make";
$result = $mysqli->query($query);

if (!$result) {
    die("<p>Error retrieving cars: " . $mysqli->error . "</p>");
}

echo "<table>";
echo "<tr><th>Make</th><th>Model</th><th>Asking Price</th><th>Actions</th></tr>";

$rowClass = "odd";

while ($row = $result->fetch_assoc()) {
    echo "<tr class=\"$rowClass\">";
    echo "<td>" . htmlspecialchars($row['Make']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Model']) . "</td>";
    echo "<td>$" . number_format($row['ASKING_PRICE'], 2) . "</td>";
    echo "<td>
            <a href='viewcar.php?VIN=" . urlencode($row['VIN']) . "'>View</a> |
            <a href='EditCar.php?VIN=" . urlencode($row['VIN']) . "'>Edit</a> |
            <a href='deletecar.php?VIN=" . urlencode($row['VIN']) . "'>Delete</a>
          </td>";
    echo "</tr>";

    $rowClass = ($rowClass === "odd") ? "even" : "odd";
}

echo "</table>";

$mysqli->close();
?>

<p><a href="samsusedcars.html">Return to Home</a></p>

</body>
</html>
