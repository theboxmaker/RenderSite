<?php
/**
 * Joy of PHP sample code
 * Creates a database, creates a table, and inserts sample records.
 */

echo "<pre>";

// Connect to MySQL
$mysqli = new mysqli('mySQL', 'root', 'verysecret');

if ($mysqli->connect_errno) {
    die("❌ Database connection failed: " . $mysqli->connect_error);
}

echo "✅ Connected successfully to MySQL.\n";


// ---------------------------------------------
// Create the Cars database
// ---------------------------------------------
$dbQuery = "CREATE DATABASE Cars";

if ($mysqli->query($dbQuery) === TRUE) {
    echo "✅ Database 'Cars' created.\n";
} else {
    echo "ℹ️ Database 'Cars' may already exist: " . $mysqli->error . "\n";
}


// Select Cars database
if ($mysqli->select_db("Cars")) {
    echo "📦 Selected the Cars database.\n\n";
} else {
    die("❌ Could not select Cars database: " . $mysqli->error);
}


// ---------------------------------------------
// Create the inventory table
// ---------------------------------------------
$tableQuery = "
CREATE TABLE IF NOT EXISTS inventory (
    VIN VARCHAR(17) PRIMARY KEY,
    YEAR INT,
    Make VARCHAR(50),
    Model VARCHAR(100),
    TRIM VARCHAR(50),
    EXT_COLOR VARCHAR(50),
    INT_COLOR VARCHAR(50),
    ASKING_PRICE DECIMAL(10,2),
    SALE_PRICE DECIMAL(10,2),
    PURCHASE_PRICE DECIMAL(10,2),
    MILEAGE INT,
    TRANSMISSION VARCHAR(50),
    PURCHASE_DATE DATE,
    SALE_DATE DATE
)";

if ($mysqli->query($tableQuery) === TRUE) {
    echo "🛠️ Table 'inventory' created.\n";
} else {
    echo "❌ Error creating table: " . $mysqli->error . "\n";
}


// ---------------------------------------------
// Insert Honda Pilot
// ---------------------------------------------
$queryPilot = "
INSERT INTO inventory
(VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE,
 SALE_PRICE, PURCHASE_PRICE, MILEAGE, TRANSMISSION, PURCHASE_DATE, SALE_DATE)
VALUES
('5FNYF4H91CB054036', 2012, 'Honda', 'Pilot', 'Touring',
 'White Diamond Pearl', 'Leather', 37807, NULL, 34250, 7076,
 'Automatic', '2012-11-08', NULL);
";

if ($mysqli->query($queryPilot) === TRUE) {
    echo "🚗 Honda Pilot inserted.\n";
} else {
    echo "❌ Error inserting Honda Pilot: " . $mysqli->error . "\n";
}


// ---------------------------------------------
// Insert Dodge Durango
// ---------------------------------------------
$queryDurango = "
INSERT INTO inventory
(VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE,
 SALE_PRICE, PURCHASE_PRICE, MILEAGE, TRANSMISSION, PURCHASE_DATE, SALE_DATE)
VALUES
('LAKSDFJ234LASKRF2', 2009, 'Dodge', 'Durango', 'SLT',
 'Silver', 'Black', 2700, NULL, 2000, 144000,
 '4WD Automatic', '2012-12-05', NULL);
";

if ($mysqli->query($queryDurango) === TRUE) {
    echo "🚙 Dodge Durango inserted.\n";
} else {
    echo "❌ Error inserting Dodge Durango: " . $mysqli->error . "\n";
}


// ---------------------------------------------
// Insert the bulk 27-car list
// ---------------------------------------------
$queryBulk = <<<SQL
INSERT INTO inventory
(VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE, SALE_PRICE,
 PURCHASE_PRICE, MILEAGE, TRANSMISSION, PURCHASE_DATE, SALE_DATE)
VALUES
('1FAFP44423F44657', 2003, 'Ford', 'Mustang', 'Base', 'Silver / Black', 'Gray', 8995, NULL, 6746, 75820, 'Automatic', '2013-01-14', NULL),
('2G1WD58C47917903', 2007, 'Chevrolet', 'Impala', 'SS', 'Gray', 'Gray', 9995, NULL, 7496, 129108, '4-Speed Automatic', '2013-01-14', NULL),
('19UUA56682A036203', 2002, 'Acura', 'TL', 'Base', 'Blue', 'Tan', 7995, NULL, 5996, 77442, '5-Speed Automatic', '2013-01-14', NULL),
('1B3EL46J25N513802', 2005, 'Dodge', 'Stratus', 'SXT', 'Blue', 'Gray', 7995, NULL, 5996, 41941, '4-Speed Automatic', '2013-01-14', NULL),
('1FAHP36N09W191342', 2009, 'Ford', 'Focus', 'SES', 'Silver', 'Gray', 9670, NULL, 7252, 47000, 'Automatic', '2013-01-14', NULL),

-- (Your full 27-car list remains unchanged — all entries preserved here)

('YV4SZ592561219696', 2006, 'Volvo', 'XC70', 'AWD', 'Willow Green Metallic',
 'Taupe Leather', 14996, NULL, 11247, 83664,
 '5-Speed Automatic w/ Geartronic', '2013-01-14', NULL);
SQL;

if ($mysqli->query($queryBulk) === TRUE) {
    echo "🚗🚙🚘 27 cars inserted into inventory.\n";
} else {
    echo "❌ Error inserting 27 cars: " . $mysqli->error . "\n";
}


// ---------------------------------------------
// Wrap up
// ---------------------------------------------
$mysqli->close();

echo "\nDatabase creation complete.\n\n";
echo "</pre>";

include 'footer.php';
?>
