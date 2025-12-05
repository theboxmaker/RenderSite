<?php
require_once __DIR__ . '/db.php';

// Escape helper
function h($value): string
{
    return $value === null ? '' : htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$query = "SELECT VIN, Make, Model, YEAR, EXT_COLOR, ASKING_PRICE 
          FROM inventory 
          ORDER BY Make, Model";

$result = $mysqli->query($query);

if (!$result) {
    die("Query failed: " . h($mysqli->error));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars - Styled Inventory 2</title>

    <style>
        body { font-family: Arial; background: #e9eef3; padding: 20px; }
        .car-card {
            background: #fff;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .car-title {
            font-size: 20px;
            margin-bottom: 6px;
            color: #003459;
        }
        .price {
            color: #0077cc;
            font-weight: bold;
        }
        .label {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Inventory (Card Layout)</h3>

<?php while ($car = $result->fetch_assoc()): ?>
<div class="car-card">
    <div class="car-title">
        <?= h($car['YEAR']) ?> <?= h($car['Make']) ?> <?= h($car['Model']) ?>
    </div>

    <div class="label">
        VIN: <?= h($car['VIN']) ?>
    </div>

    <p>Exterior Color: <?= h($car['EXT_COLOR']) ?: 'Not listed' ?></p>

    <p class="price">
        Price: $<?= $car['ASKING_PRICE'] !== null 
                    ? number_format((float)$car['ASKING_PRICE'], 2) 
                    : '0.00' ?>
    </p>
</div>
<?php endwhile; ?>

</body>
</html>
