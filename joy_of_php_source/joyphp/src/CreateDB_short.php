<?php
/**
 * CreateDB_short — clean Docker-compatible version
 * Creates Cars DB and Cars table, inserts sample data.
 */

include 'db.php';

// Create database (if not exists)
if ($mysqli->query("CREATE DATABASE IF NOT EXISTS Cars")) {
    echo "<p>Database 'Cars' is ready.</p>";
} else {
    die("<p>Error creating database: " . htmlspecialchars($mysqli->error) . "</p>");
}

$mysqli->select_db("Cars");
echo "<p>Selected Cars database.</p>";

// Create table
$query = "CREATE TABLE IF NOT EXISTS Cars (
    VIN varchar(17) PRIMARY KEY,
    YEAR INT,
    Make varchar(50),
    Model varchar(100),
    TRIM varchar(50),
    EXT_COLOR varchar(50),
    INT_COLOR varchar(50),
    ASKING_PRICE DECIMAL(10,2),
    SALE_PRICE DECIMAL(10,2),
    PURCHASE_PRICE DECIMAL(10,2),
    MILEAGE INT,
    TRANSMISSION varchar(50),
    PURCHASE_DATE DATE,
    SALE_DATE DATE
)";

if ($mysqli->query($query)) {
    echo "<p>Cars table created.</p>";
} else {
    echo "<p>Error creating Cars table: " . htmlspecialchars($mysqli->error) . "</p>";
}

// Insert sample Honda
$stmt = $mysqli->prepare("
    INSERT INTO Cars 
    (VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE, SALE_PRICE, PURCHASE_PRICE, MILEAGE, TRANSMISSION, PURCHASE_DATE, SALE_DATE)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$data = [
    '5FNYF4H91CB054036', 2012, 'Honda', 'Pilot', 'Touring',
    'White Diamond Pearl', 'Leather', 37807, null, 34250,
    7076, 'Automatic', '2012-11-08', null
];

$stmt->bind_param(
    "sissssssdiisss",
    ...$data
);

$stmt->execute();

echo "<p>Inserted Honda Pilot.</p>";

// Insert another sample car
$data2 = [
    'LAKSDFJ234LASKRF2', 2009, 'Dodge', 'Durango', 'SLT',
    'Silver', 'Black', 2700, null, 2000,
    144000, '4WD Automatic', '2012-12-05', null
];

$stmt->bind_param(
    "sissssssdiisss",
    ...$data2
);

$stmt->execute();

echo "<p>Inserted Dodge Durango.</p>";

$stmt->close();
$mysqli->close();

include 'footer.php';
?>
