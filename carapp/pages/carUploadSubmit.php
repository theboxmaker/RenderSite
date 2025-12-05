<?php
require_once APP_PATH . '/models/carModel.php';

$vin = $_POST['VIN'] ?? null;

if (!$vin) {
    die("VIN missing");
}

$car = CarModel::find($pdo, $vin);
if (!$car) {
    die("Car not found");
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    die("Upload error");
}

$file = $_FILES['image'];
$tmp  = $file['tmp_name'];

// Validate size
if ($file['size'] > 5 * 1024 * 1024) {
    die("File too large (max 5MB)");
}

// Validate type
$allowed = [
    "image/jpeg" => ".jpg",
    "image/png"  => ".png",
    "image/gif"  => ".gif",
    "image/webp" => ".webp"
];

$type = mime_content_type($tmp);

if (!isset($allowed[$type])) {
    die("Invalid file type");
}

// Create sanitized + unique filename
$filename = $vin . "_" . time() . $allowed[$type];

// Path to store
$uploadDir = APP_PATH . "/public/images/uploads/";
$dest = $uploadDir . $filename;

if (!move_uploaded_file($tmp, $dest)) {
    die("Failed to save file");
}

// Save to DB
CarModel::addImage($pdo, $vin, $filename);

// Redirect back
header("Location: " . BASE_URL . "/?page=car_upload&VIN=" . urlencode($vin));
exit;
