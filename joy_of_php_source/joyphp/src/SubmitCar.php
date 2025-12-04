<?php
include 'db.php';

$VIN   = trim($_POST['VIN'] ?? '');
$Make  = trim($_POST['Make'] ?? '');
$Model = trim($_POST['Model'] ?? '');
$Price = trim($_POST['Asking_Price'] ?? '');

if ($VIN === '' || $Make === '' || $Model === '' || $Price === '') {
    die("<p style='color:red;'>All fields are required.</p>");
}

$mysqli->select_db("Cars");

$stmt = $mysqli->prepare("
    INSERT INTO Cars (VIN, Make, Model, ASKING_PRICE)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param('sssd', $VIN, $Make, $Model, $Price);

try {
    $stmt->execute();
    echo "<p>Successfully entered $Make $Model into database.</p>";
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        echo "<p style='color:red;'>VIN <strong>$VIN</strong> already exists.</p>";
    } else {
        echo "<p style='color:red;'>Database Error: {$e->getMessage()}</p>";
    }
}

$stmt->close();
$mysqli->close();
?>
