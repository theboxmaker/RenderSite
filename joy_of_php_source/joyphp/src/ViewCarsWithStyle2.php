<?php
require_once __DIR__ . '/db.php';

// Escape helper
function h($value): string
{
    return $value === null ? '' : htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Fetch cars
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
        body { 
            font-family: Arial; 
            background: #e9eef3; 
            padding: 20px; 
        }

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
            font-weight: bold;
        }

        .price {
            color: #0077cc;
            font-weight: bold;
        }

        .label {
            color: #666;
            font-size: 14px;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 8px;
            background: #003459;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .actions a.delete-btn {
            background: #b30000;
        }

        .actions a:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Inventory (Card Layout + Edit/Delete)</h3>

<?php while ($car = $result->fetch_assoc()): ?>

<div class="car-card">

    <div class="car-title">
        <?= h($car['YEAR']) ?> <?= h($car['Make']) ?> <?= h($car['Model']) ?>
    </div>

    <div class="label">VIN: <?= h($car['VIN']) ?></div>

    <p>Exterior Color: <?= h($car['EXT_COLOR']) ?: 'Not listed' ?></p>

    <p class="price">
        Price: $<?= $car['ASKING_PRICE'] !== null 
                    ? number_format((float)$car['ASKING_PRICE'], 2) 
                    : '0.00' ?>
    </p>

    <div class="actions">
        <!-- FIX: Stay inside JoyOfPHP folder -->
        <a href="/joy_of_php_source/joyphp/src/EditCar.php?VIN=<?= urlencode($car['VIN']) ?>">
            Edit
        </a>

        <a class="delete-btn"
           href="/joy_of_php_source/joyphp/src/deletecar.php?VIN=<?= urlencode($car['VIN']) ?>"
           onclick="return confirm('Are you sure you want to delete this vehicle?');">
            Delete
        </a>
    </div>

</div>

<?php endwhile; ?>

</body>
</html>
