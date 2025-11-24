<?php
// ViewCars.php — cleaned + fixed for Render/Railway
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars</title>
    <style>
        /* Inline minimal styling — feel free to move to a CSS file */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background: #f8f8f8;
        }
        th, td {
            padding: 10px 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background: #444;
            color: #fff;
        }
        tr.odd {
            background: #ffffff;
        }
        tr.even {
            background: #f0f0f0;
        }
        h1, h3 {
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Complete Inventory</h3>

<?php
// Query the database
$query = "SELECT VIN, Make, Model, ASKING_PRICE FROM inventory ORDER BY Make";

$result = $mysqli->query($query);

if (!$result) {
    die("<p>Error retrieving cars: " . $mysqli->error . "</p>");
}

// Begin table
echo "<table>";
echo "<tr>";
echo "<th>Make</th>";
echo "<th>Model</th>";
echo "<th>Asking Price</th>";
echo "<th>Actions</th>";
echo "</tr>";

$rowClass = "odd";

// Output rows
while ($row = $result->fetch_assoc()) {
    echo "<tr class=\"$rowClass\">";
    echo "<td>" . htmlspecialchars($row['Make']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Model']) . "</td>";
    echo "<td>$" . number_format($row['ASKING_PRICE'], 2) . "</td>";
    
    // Add optional action links
    echo "<td>";
    echo "<a href=\"viewcar.php?VIN=" . urlencode($row['VIN']) . "\">View</a> | ";
    echo "<a href=\"EditCar.php?VIN=" . urlencode($row['VIN']) . "\">Edit</a> | ";
    echo "<a href=\"deletecar.php?VIN=" . urlencode($row['VIN']) . "\">Delete</a>";
    echo "</td>";

    echo "</tr>";

    // Swap row styles
    $rowClass = ($rowClass === "odd") ? "even" : "odd";
}

echo "</table>";

$mysqli->close();
?>

</body>
</html>
