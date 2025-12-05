<?php
require_once __DIR__ . '/db.php';

// Validate VIN
$vin = trim($_GET['VIN'] ?? "");
if ($vin === "") {
    die("<p>Error: VIN is required.</p>");
}

// Fetch vehicle info securely
$stmt = $mysqli->prepare("
    SELECT YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, MILEAGE, TRANSMISSION, ASKING_PRICE
    FROM inventory
    WHERE VIN = ?
");
$stmt->bind_param("s", $vin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<p>No vehicle found with VIN: " . htmlspecialchars($vin) . "</p>");
}

$car = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Image – Sam's Used Cars</title>

    <style>
        body { font-family: Arial, sans-serif; background: #eee; padding: 30px; }
        h1, h3 { text-align: center; }
        .car-info { text-align: center; margin-bottom: 20px; }
        .upload-box {
            background: white;
            max-width: 500px;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #999;
        }
        .gallery img {
            width: 200px;
            margin: 10px;
            border-radius: 6px;
            box-shadow: 0 0 5px #666;
        }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Add Image</h3>

<div class="car-info">
    <p>
        <strong><?= htmlspecialchars($car['EXT_COLOR']) ?>
            <?= htmlspecialchars($car['YEAR']) ?>
            <?= htmlspecialchars($car['Make']) ?>
            <?= htmlspecialchars($car['Model']) ?>
        </strong>
    </p>

    <p>VIN: <?= htmlspecialchars($vin) ?></p>
    <p>Asking Price: $<?= number_format($car['ASKING_PRICE'], 2) ?></p>
</div>

<div class="upload-box">
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <label><strong>Choose an image:</strong></label><br>
        <input type="file" name="file" accept="image/*" required><br><br>

        <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">

        <button type="submit">Upload Image</button>
    </form>
</div>

<h3 style="margin-top:40px; text-align:center;">Existing Images</h3>

<div class="gallery" style="text-align:center;">
<?php
// Fetch existing images
$stmt = $mysqli->prepare("SELECT ImageFile FROM images WHERE VIN = ?");
$stmt->bind_param("s", $vin);
$stmt->execute();
$images = $stmt->get_result();

while ($img = $images->fetch_assoc()) {
    $file = htmlspecialchars($img['ImageFile']);
    echo "<img src='/joy_of_php_source/joyphp/src/uploads/$file' alt='Vehicle image'>";
}

$stmt->close();
$mysqli->close();
?>
</div>

<p style="text-align:center;">
    <a href="ViewCars.php">← Back to Inventory</a>
</p>

</body>
</html>
