<?php
include 'db.php';

// Validate VIN
$vin = trim($_GET['VIN'] ?? "");
if ($vin === "") {
    die("<p>Error: VIN is required.</p>");
}

// Select correct DB
$mysqli->select_db("Cars");

// Fetch vehicle info
$stmt = $mysqli->prepare("
    SELECT YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, MILEAGE, TRANSMISSION, ASKING_PRICE
    FROM Cars 
    WHERE VIN = ?
");
$stmt->bind_param("s", $vin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<p>Sorry, no vehicle found with VIN: $vin</p>");
}

$row = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Image – Sam's Used Cars</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eee;
            padding: 30px;
        }
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
        label { font-weight: bold; }
        input[type="file"] { margin: 10px 0; }
        input[type="submit"] {
            padding: 10px 20px;
            background: teal;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }
        input[type="submit"]:hover { background: #006b6b; }
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
    <p><strong>
        <?= htmlspecialchars($row['EXT_COLOR']) ?> 
        <?= htmlspecialchars($row['YEAR']) ?> 
        <?= htmlspecialchars($row['Make']) ?> 
        <?= htmlspecialchars($row['Model']) ?>
    </strong></p>

    <p>VIN: <?= htmlspecialchars($vin) ?></p>
    <p>Asking Price: $<?= number_format($row['ASKING_PRICE'], 2) ?></p>
</div>

<div class="upload-box">
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose an image:</label><br>
        <input type="file" name="file" id="file" accept="image/*" required><br>

        <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">

        <input type="submit" name="submit" value="Upload Image">
    </form>
</div>

<h3 style="text-align:center; margin-top:40px;">Existing Images</h3>

<div class="gallery" style="text-align:center;">
<?php
// Load existing images
$stmt = $mysqli->prepare("SELECT ImageFile FROM Images WHERE VIN = ?");
$stmt->bind_param("s", $vin);
$stmt->execute();
$images = $stmt->get_result();

while ($img = $images->fetch_assoc()) {
    $file = htmlspecialchars($img['ImageFile']);
    echo "<img src='uploads/$file' alt='Vehicle image'>";
}

$stmt->close();
$mysqli->close();
?>
</div>

<?php if (file_exists("footer.php")) include 'footer.php'; ?>

</body>
</html>
