<?php
require_once __DIR__ . '/db.php';

if (!isset($_GET['VIN'])) die("Missing VIN");

$stmt = $mysqli->prepare("DELETE FROM inventory WHERE VIN=?");
$stmt->bind_param("s", $_GET['VIN']);
$stmt->execute();

echo $stmt->affected_rows > 0
    ? "Car deleted."
    : "VIN not found.";

$stmt->close();
$mysqli->close();
?>
