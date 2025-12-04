<?php
/**
 * Joy of PHP — Docker version
 * Creates the Cars database and the Cars table with sample data.
 */

include 'db.php';

// Create the Cars database if it doesn't exist
$createDB = "CREATE DATABASE IF NOT EXISTS Cars";
if ($mysqli->query($createDB)) {
    echo "Database 'Cars' created or already exists.<br>";
} else {
    die("Error creating database: " . $mysqli->error);
}

// Select the Cars database
$mysqli->select_db("Cars");
echo "Selected database: Cars<br><br>";


// Create the Cars table (original Joy of PHP schema)
$query = "
CREATE TABLE IF NOT EXISTS Cars (
    VIN varchar(17) PRIMARY KEY,
    YEAR INT,
    Make varchar(50),
    Model varchar(100),
    TRIM varchar(50),
    EXT_COLOR varchar(50),
    INT_COLOR varchar(50),
    ASKING_PRICE DECIMAL(10,2),
    MILEAGE INT
)";

if ($mysqli->query($query)) {
    echo "Created table Cars.<br>";
} else {
    die('Error creating table: ' . $mysqli->error);
}


// Insert one sample record
$insert = "
INSERT IGNORE INTO Cars
(VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE, MILEAGE)
VALUES
('5FNYF4H91CB054036', 2012, 'Honda', 'Pilot', 'Touring', 'White Diamond Pearl', 'Leather', 37807, 7076)
";

if ($mysqli->query($insert)) {
    echo "Inserted Honda Pilot.<br>";
} else {
    echo "Insert failed: " . $mysqli->error . "<br>";
}

echo "<br>Done!";
$mysqli->close();
?>
