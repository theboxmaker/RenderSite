<?php
require_once __DIR__ . '/db.php';

$VIN   = trim($_POST['VIN'] ?? '');
$Make  = trim($_POST['Make'] ?? '');
$Model = trim($_POST['Model'] ?? '');
$Price = trim($_POST['Asking_Price'] ?? '');

if ($VIN === '' || $Make === '' || $Model === '' || $Price === '') {
    die("All fields are required.");
}

$stmt = $mysqli->prepare("
    INSERT INTO inventory (VIN, Make, Model, ASKING_PRICE)
    VALUES (?, ?, ?, ?)
");
$stmt->bind_param('sssd', $VIN, $Make, $Model, $Price);

$stmt->execute();
$stmt->close();
$mysqli->close();

header("Location: /joy_of_php_source/joyphp/src/samsusedcars.html");
exit;
