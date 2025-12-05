<?php
session_start();
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}
?>

<?php
require_once APP_PATH . '/models/carModel.php';

$vin = $_GET['VIN'] ?? null;

if (!$vin) {
    die("Missing VIN");
}

$car = CarModel::find($pdo, $vin);
if (!$car) {
    die("Car not found");
}

$title = "Upload Image";
ob_start();
?>

<h2>Upload Image for <?= htmlspecialchars($car['Make'] . " " . $car['Model']) ?></h2>

<form action="<?= BASE_URL ?>/?page=car_upload_submit" 
      method="post" enctype="multipart/form-data">

    <input type="hidden" name="VIN" value="<?= htmlspecialchars($vin) ?>">

    <p>
        <label>Select Image:</label><br>
        <input type="file" name="image" accept="image/*" required>
    </p>

    <button type="submit">Upload</button>
</form>

<hr>

<h3>Existing Images</h3>

<?php
$images = CarModel::getImages($pdo, $vin);

if (empty($images)) {
    echo "<p>No images uploaded yet.</p>";
} else {
    foreach ($images as $img) {
        $path = BASE_URL . "/public/images/uploads/" . $img['filename'];
        echo "<img src='$path' width='200' style='margin:10px; border-radius:6px;'>";
    }
}
?>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
