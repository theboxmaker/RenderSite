<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Saved</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// -----------------------------
// Capture incoming POST values
// -----------------------------
$VIN   = isset($_POST['VIN']) ? trim($_POST['VIN']) : '';
$Make  = isset($_POST['Make']) ? trim($_POST['Make']) : '';
$Model = isset($_POST['Model']) ? trim($_POST['Model']) : '';
$Price = isset($_POST['Asking_Price']) ? trim($_POST['Asking_Price']) : '';

if ($VIN === '' || $Make === '' || $Model === '' || $Price === '') {
    echo "<p><strong>Error:</strong> All fields are required.</p>";
    exit;
}

// Make sure price is numeric
if (!is_numeric($Price)) {
    echo "<p><strong>Error:</strong> Price must be a valid number.</p>";
    exit;
}

// Escape dangerous characters
$VIN   = addslashes($VIN);
$Make  = addslashes($Make);
$Model = addslashes($Model);

// --------------------------------
// Build the SQL query
// --------------------------------
$query = "
    INSERT INTO inventory
        (VIN, Make, Model, ASKING_PRICE)
    VALUES
        ('$VIN', '$Make', '$Model', $Price)
";

echo "<p><strong>Executing query:</strong><br>$query</p>";


// --------------------------------
// Connect to database
// --------------------------------
include 'db.php';

echo "<p>Connected successfully to MySQL.</p>";

// Select database
$mysqli->select_db("Cars");
echo "<p>Selected the Cars database.</p>";

// --------------------------------
// Run the INSERT query
// --------------------------------
if ($mysqli->query($query) === TRUE) {
    echo "<p><strong>Success!</strong> The $Make $Model has been saved.</p>";
} else {
    echo "<p><strong>Error inserting record:</strong> " . $mysqli->error . "</p>";
}

$mysqli->close();

// Footer
include 'footer.php';
?>

</body>
</html>
