<?php
require_once __DIR__ . '/../db.php';

echo "<h2>Creating Tables...</h2>";

$pdo->exec("
    CREATE TABLE IF NOT EXISTS inventory (
        VIN varchar(17) PRIMARY KEY,
        YEAR INT,
        Make varchar(50),
        Model varchar(100),
        TRIM varchar(50),
        EXT_COLOR varchar(50),
        INT_COLOR varchar(50),
        ASKING_PRICE DECIMAL (10,2),
        SALE_PRICE DECIMAL (10,2),
        PURCHASE_PRICE DECIMAL (10,2),
        MILEAGE INT,
        TRANSMISSION varchar(50),
        PURCHASE_DATE DATE,
        SALE_DATE DATE
    )
");

echo "✔ inventory table created<br>";

$pdo->exec("
    CREATE TABLE IF NOT EXISTS images (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        VIN varchar(17),
        ImageFile varchar(250)
    )
");

echo "✔ images table created<br>";

echo "<br>Done.";
