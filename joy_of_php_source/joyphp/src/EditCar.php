<?php
require_once __DIR__ . '/db.php';

function safe($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $mysqli->prepare("
        UPDATE inventory SET Make=?, Model=?, ASKING_PRICE=?
        WHERE VIN=?
    ");
    $stmt->bind_param("ssds",
        $_POST['Make'],
        $_POST['Model'],
        $_POST['ASKING_PRICE'],
        $_POST['VIN']
    );

    $stmt->execute();
    $stmt->close();

    header("Location: /joy_of_php_source/joyphp/src/samsusedcars.html");
    exit;
}

if (!isset($_GET['VIN'])) die("Missing VIN");

$stmt = $mysqli->prepare("SELECT * FROM inventory WHERE VIN=?");
$stmt->bind_param("s", $_GET['VIN']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<body>

<h1>Edit Car</h1>

<form method="POST">
    <input type="hidden" name="VIN" value="<?= safe($row['VIN']) ?>">

    Make: <input type="text" name="Make" value="<?= safe($row['Make']) ?>"><br>
    Model: <input type="text" name="Model" value="<?= safe($row['Model']) ?>"><br>
    Price: <input type="number" step="0.01" name="ASKING_PRICE" value="<?= safe($row['ASKING_PRICE']) ?>"><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
