<?php
require_once __DIR__ . '/db.php';

$vin = $_POST['VIN'] ?? null;

if (!$vin) {
    die("VIN missing.");
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    die("Upload failed.");
}

$file = $_FILES['image'];
$tmp = $file['tmp_name'];

$allowed = [
    'image/jpeg' => '.jpg',
    'image/png'  => '.png',
    'image/gif'  => '.gif'
];

$type = mime_content_type($tmp);

if (!isset($allowed[$type])) {
    die("Invalid file type.");
}

$filename = $vin . "_" . time() . $allowed[$type];

$dir = __DIR__ . "/uploads/";

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$path = $dir . $filename;

if (!move_uploaded_file($tmp, $path)) {
    die("Unable to save uploaded image.");
}

$stmt = $mysqli->prepare("INSERT INTO images (VIN, ImageFile) VALUES (?, ?)");
$stmt->bind_param("ss", $vin, $filename);
$stmt->execute();
$stmt->close();

header("Location: ViewCar.php?VIN=" . urlencode($vin));
exit;
