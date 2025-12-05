<?php
require_once __DIR__ . '/db.php';

// Escape helper
function h($value) {
    return $value === null ? '' : htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Get VIN if coming from another page
$VIN = $_GET['VIN'] ?? null;

// Fetch all cars for the dropdown
$result = $mysqli->query("SELECT VIN, Make, Model FROM inventory ORDER BY Make, Model");

if (!$result) {
    die("Database query failed: " . h($mysqli->error));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Images to Cars</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 25px;
        }
        .container {
            max-width: 600px;
            background: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
        }
        input[type=file] {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h2>Add Images to Vehicles</h2>

<div class="container">

    <form action="upload_file.php" method="POST" enctype="multipart/form-data">

        <label><strong>Select a Vehicle:</strong></label><br>
        <select name="VIN" required>
            <option value="">-- Select VIN --</option>

            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= h($row['VIN']) ?>"
                    <?= ($VIN && $VIN == $row['VIN']) ? 'selected' : '' ?>>
                    <?= h($row['Make']) . " " . h($row['Model']) . " (" . h($row['VIN']) . ")" ?>
                </option>
            <?php endwhile; ?>
        </select>

        <br><br>

        <label><strong>Upload Image:</strong></label><br>
        <input type="file" name="UploadFile" required>

        <br><br>

        <button type="submit">Upload Image</button>
    </form>

</div>

<br><br>

<p><a href="samsusedcars.html">Back to Home</a></p>

</body>
</html>
