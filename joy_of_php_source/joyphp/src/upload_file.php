<?php
require_once __DIR__ . '/db.php';

$vin = trim($_POST['VIN'] ?? "");

// Validate VIN
if ($vin === "") {
    die("<p>Error: VIN is required.</p>");
}

// Validate upload
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    die("<p>Error uploading file. Error code: " . $_FILES['file']['error'] . "</p>");
}

$file = $_FILES["file"];
$filename = basename($file["name"]);
$tmpPath  = $file["tmp_name"];
$fileSize = $file["size"];
$fileType = mime_content_type($tmpPath);

// Allow only safe image types
$allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
if (!in_array($fileType, $allowedTypes)) {
    die("<p>Error: Only JPG, PNG, GIF, and WEBP files are allowed.</p>");
}

// Size limit: 5MB
if ($fileSize > 5 * 1024 * 1024) {
    die("<p>Error: File too large. Max 5MB.</p>");
}

// Ensure upload directory exists
$uploadDir = __DIR__ . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Build full path
$targetPath = $uploadDir . $filename;

// Move file
if (!move_uploaded_file($tmpPath, $targetPath)) {
    die("<p>Error: Could not save uploaded file.</p>");
}

// Store filename only in DB
$stmt = $mysqli->prepare("INSERT INTO images (VIN, ImageFile) VALUES (?, ?)");
$stmt->bind_param("ss", $vin, $filename);

echo "<h2>Image Upload Results</h2>";
echo "<p>VIN: " . htmlspecialchars($vin) . "</p>";
echo "<p>Stored as: uploads/" . htmlspecialchars($filename) . "</p>";

if ($stmt->execute()) {
    echo "<p><strong>Image saved successfully!</strong></p>";
} else {
    echo "<p>Error saving to database: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$mysqli->close();

// Display uploaded image
echo "<p><img src='uploads/" . htmlspecialchars($filename) . "' width='250'></p>";

echo "<p><a href='AddImage.php?VIN=$vin'>Upload Another</a></p>";
echo "<p><a href='ViewCars.php'>Back to Inventory</a></p>";

?>
