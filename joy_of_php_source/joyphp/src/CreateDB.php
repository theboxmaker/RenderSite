<?php
require_once __DIR__ . '/db.php';

echo "Connected successfully to MySQL.<br>";
echo "Using database: " . getenv('DB_NAME') . "<br><br>";

$query = "CREATE TABLE IF NOT EXISTS inventory (
    VIN varchar(17) PRIMARY KEY,
    YEAR INT,
    Make varchar(50),
    Model varchar(100),
    TRIM varchar(50),
    EXT_COLOR varchar (50),
    INT_COLOR varchar (50),
    ASKING_PRICE DECIMAL (10,2),
    SALE_PRICE DECIMAL (10,2),
    PURCHASE_PRICE DECIMAL (10,2),
    MILEAGE int,
    TRANSMISSION varchar (50),
    PURCHASE_DATE DATE,
    SALE_DATE DATE
)";

if ($mysqli->query($query)) {
    echo "Created table INVENTORY.<br>";
} else {
    die("Error creating table: " . $mysqli->error);
}

echo "<br>Done!";
$mysqli->close();
?>
