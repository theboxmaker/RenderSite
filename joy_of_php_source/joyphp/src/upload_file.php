<?php
include 'db.php';

$vin = trim($_POST['VIN'] ?? "");

// Validate VIN
if ($vin === "") {
    die("<p>Error: VIN is required.</p>");
}

// Ensure the upload exists and no server error
if (!isset($_FILES["file"]) || $_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
    die("<p>Error uploading file. Code: " . $_FILES["file"]["error"] . "</p>");
}

// File info
$file      = $_FILES["file"];
$filename  = basename($file["name"]);
$tmpPath   = $file["tmp_name"];
$fileSize  = $file["size"];
$fileType  = mime_content_type($tmpPath);

// Security: allow only images
$allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
if (!in_array($fileType, $allowedTypes)) {
    die("<p>Error: Only image files (JPG, PNG, GIF, WEBP) are allowed.</p>");
}

// Security: limit size (5MB)
if ($fileSize > 5 * 1024 * 1024) {
    die("<p>Error: File is too large. Max size is 5MB.</p>");
}

// Ensure /uploads directory exists
$uploadDir = getcwd() . "/uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Build full path
$targetPath = $uploadDir . $filename;

// Move file
if (!move_uploaded_file($tmpPath, $targetPath)) {
    die("<p>Error: Could not save uploaded file.</p>");
}

// Build relative path for displaying images
$imagePath = "uploads/" . $filename;

// Insert into database
$query = "INSERT INTO images (VIN, ImageFile) VALUES (?, ?)";

$stmt = $mysqli->prepare($query);
if (!$stmt) {
    die("<p>Database error: " . $mysqli->error . "</p>");
}
$stmt->bind_param("ss", $vin, $filename);

echo "<h2>Image Upload Results</h2>";
echo "<p>VIN: $vin</p>";
echo "<p>Stored as: $imagePath</p>";

if ($stmt->execute()) {
    echo "<p><strong>Image successfully saved to the database.</strong></p>";
} else {
    echo "<p>Error saving to database: " . $stmt->error . "</p>";
}

$stmt->close();
$mysqli->close();

// Display uploaded image
echo "<p><img src='$imagePath' width='200' alt='Uploaded image'></p>";

// Link to add another image
echo "<p><a href='AddImage.php?VIN=$vin'>Upload another image for this car</a></p>";

// Footer
include 'footer.php';
?>
