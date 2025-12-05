<?php
require_once __DIR__ . '/db.php';

if (!isset($_POST['VIN']) || !isset($_FILES['UploadFile'])) {
    die("Invalid request.");
}

$vin = $_POST['VIN'];
$file = $_FILES['UploadFile'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    die("Upload error.");
}

$allowed = [
    'image/jpeg' => '.jpg',
    'image/png'  => '.png',
    'image/gif'  => '.gif'
];

$tmp = $file['tmp_name'];
$type = mime_content_type($tmp);

if (!isset($allowed[$type])) {
    die("Bad file type.");
}

$filename = $vin . "_" . time() . $allowed[$type];

$dir = __DIR__ . "/uploads/";

if (!is_dir($dir)) mkdir($dir);

$path = $dir . $filename;

if (!move_uploaded_file($tmp, $path)) {
    die("Could not save file.");
}

$q = $mysqli->prepare("INSERT INTO images (VIN, ImageFile) VALUES (?, ?)");
$q->bind_param("ss", $vin, $filename);
$q->execute();

header("Location: ViewCar.php?VIN=" . urlencode($vin));
exit;
