<?php
require_once __DIR__ . '/db.php';

if (!isset($_GET['VIN'])) die("Missing VIN");

$stmt = $mysqli->prepare("DELETE FROM inventory WHERE VIN=?");
$stmt->bind_param("s", $_GET['VIN']);
$stmt->execute();
$stmt->close();
$mysqli->close();

header("Location: /joy_of_php_source/joyphp/src/samsusedcars.html");
exit;
