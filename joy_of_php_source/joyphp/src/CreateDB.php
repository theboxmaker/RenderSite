<?php
/**
 * Joy of PHP — Fixed for Render + Railway
 * Creates the inventory table and inserts sample data.
 */

// Load shared database connection
include 'db.php';

// Confirm connection
echo "Connected successfully to MySQL.<br>";

// Railway already creates the database. Just select it.
$mysqli->select_db(getenv('DB_NAME'));
echo "Selected database: " . getenv('DB_NAME') . "<br><br>";

// ---- Create inventory table ----
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

// ---- Insert sample cars ----
$insert1 = "INSERT INTO inventory
(VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE, SALE_PRICE, PURCHASE_PRICE, MILEAGE, TRANSMISSION, PURCHASE_DATE, SALE_DATE)
VALUES
('5FNYF4H91CB054036', 2012, 'Honda', 'Pilot', 'Touring', 'White Diamond Pearl', 'Leather', 37807, NULL, 34250, 7076, 'Automatic', '2012-11-08', NULL)
";

if ($mysqli->query($insert1)) {
    echo "Inserted Honda Pilot.<br>";
} else {
    echo "Error inserting Honda: " . $mysqli->error . "<br>";
}

// Insert the large bulk list
// (Your existing $query3 block goes here unchanged)

echo "<br>Done!";
$mysqli->close();

include 'footer.php';
?>
