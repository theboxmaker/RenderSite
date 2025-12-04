<?php
require_once __DIR__ . '/db.php';

$vin = trim($_POST['VIN'] ?? '');

if ($vin === '') {
    die("<p>Error: VIN is required.</p>");
}

// Validate upload exists
if (!isset($_FILES["file"]) || $_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
    die("<p>Error uploading file. Code: " . ($_FILES["file"]["error"] ?? 'No file') . "</p>");
}

$file = $_FILES["file"];
$tmpPath = $file["tmp_name"];
$filename = basename($file["name"]);
$fileSize = $file["size"];
$fileType = mime_content_type($tmpPath);

// Allowed types
$allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
if (!in_array($fileType, $allowedTypes)) {
    die("<p>Error: Only image files (JPG, PNG, GIF, WEBP) are allowed.</p>");
}

// Max size 5MB
if ($fileSize > 5 * 1024 * 1024) {
    die("<p>Error: File is too large. Max size is 5MB.</p>");
}

// Ensure uploads folder exists
$uploadDir = __DIR__ . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Secure unique filename
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$newFilename = uniqid("car_", true) . "." . strtolower($ext);
$targetPath = $uploadDir . $newFilename;

// Move to uploads/
if (!move_uploaded_file($tmpPath, $targetPath)) {
    die("<p>Error: Could not move uploaded file.</p>");
}

// Insert into images table
$stmt = $mysqli->prepare("INSERT INTO images (VIN, ImageFile) VALUES (?, ?)");
$stmt->bind_param("ss", $vin, $newFilename);

?>
<!DOCTYPE html>
<html>
<body style="font-family: Arial; padding: 30px;">

<h2>Image Upload Results</h2>

<?php
if ($stmt->execute()) {
    echo "<p><strong>Image uploaded successfully.</strong></p>";
} else {
    echo "<p style='color:red;'>Database error: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$mysqli->close();

$imageUrl = "uploads/" . $newFilename;

echo "<p>VIN: " . htmlspecialchars($vin) . "</p>";
echo "<p>Stored as: $imageUrl</p>";
echo "<p><img src='$imageUrl' width='250' style='border-radius:6px; box-shadow:0 0 6px #555;'></p>";
?>

<p><a href="AddImage.php?VIN=<?= htmlspecialchars($vin) ?>">Upload another image</a></p>

</body>
</html>
