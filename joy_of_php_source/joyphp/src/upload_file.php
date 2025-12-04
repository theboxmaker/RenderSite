<?php
include 'db.php';

$vin = trim($_POST['VIN'] ?? "");

// Validate VIN
if ($vin === "") {
    die("<p>Error: VIN is required.</p>");
}

// Select correct database
$mysqli->select_db("Cars");

// Ensure file is present
if (!isset($_FILES["file"]) || $_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
    die("<p>Error uploading file. Code: " . ($_FILES["file"]["error"] ?? 'unknown') . "</p>");
}

// File details
$file      = $_FILES["file"];
$filename  = basename($file["name"]);
$tmpPath   = $file["tmp_name"];
$fileSize  = $file["size"];
$fileType  = mime_content_type($tmpPath);

// Allowed MIME types
$allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
if (!in_array($fileType, $allowedTypes)) {
    die("<p>Error: Only JPG, PNG, GIF, and WEBP image files are allowed.</p>");
}

// File size limit (5MB)
if ($fileSize > 5 * 1024 * 1024) {
    die("<p>Error: File is too large. Maximum size is 5MB.</p>");
}

// Upload directory (inside the container)
$uploadDir = __DIR__ . "/uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Prevent overwriting existing files
$uniquePrefix = time() . "_";
$finalName = $uniquePrefix . $filename;
$targetPath = $uploadDir . $finalName;

// Move file to uploads directory
if (!move_uploaded_file($tmpPath, $targetPath)) {
    die("<p>Error: Could not save uploaded file.</p>");
}

// Insert into Images table
$query = "INSERT INTO Images (VIN, ImageFile) VALUES (?, ?)";
$stmt = $mysqli->prepare($query);

if (!$stmt) {
    die("<p>Database error: " . $mysqli->error . "</p>");
}

$stmt->bind_param("ss", $vin, $finalName);

echo "<h2>Image Upload Results</h2>";
echo "<p>VIN: $vin</p>";
echo "<p>Stored as: uploads/$finalName</p>";

if ($stmt->execute()) {
    echo "<p><strong>Image successfully saved to the database.</strong></p>";
} else {
    echo "<p>Error saving to database: " . $stmt->error . "</p>";
}

$stmt->close();
$mysqli->close();

// Display uploaded image
echo "<p><img src='uploads/$finalName' width='250' alt='Uploaded image'></p>";

// Link to upload another
echo "<p><a href='AddImage.php?VIN=$vin'>Upload another image for this car</a></p>";

// Include footer if it exists
if (file_exists("footer.php")) {
    include 'footer.php';
}
?>
