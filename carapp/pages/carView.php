<?php
require_once APP_PATH . '/models/CarModel.php';
$car = CarModel::find($pdo, $_GET['VIN']);

if (!$car) {
    die("Car not found");
}

$title = "{$car['YEAR']} {$car['Make']} {$car['Model']}";
ob_start();
?>

<h2><?= $title ?></h2>

<ul>
    <li>Year: <?= $car['YEAR'] ?></li>
    <li>Make: <?= $car['Make'] ?></li>
    <li>Model: <?= $car['Model'] ?></li>
    <li>Price: $<?= number_format($car['ASKING_PRICE'], 0) ?></li>
</ul>

$images = CarModel::getImages($pdo, $car['VIN']);
?>

<h3>Images</h3>

<?php if (empty($images)): ?>
<p>No images uploaded yet.</p>
<?php else: ?>
<div>
<?php foreach ($images as $img): ?>
    <img src="<?= BASE_URL ?>/public/images/uploads/<?= htmlspecialchars($img['filename']) ?>"
         width="250" style="margin:10px; border-radius:8px;">
<?php endforeach; ?>
</div>
<?php endif; ?>

<p>
    <a href="<?= BASE_URL ?>/?page=car_upload&VIN=<?= urlencode($car['VIN']) ?>">
        Upload More Images
    </a>
</p>


<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
