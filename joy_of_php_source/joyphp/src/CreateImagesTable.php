<?php
/**
 * Joy of PHP — Docker version
 * Creates the Images table inside Cars database.
 */

include 'db.php';

// Ensure Cars database exists
$mysqli->query("CREATE DATABASE IF NOT EXISTS Cars");

// Select Cars
$mysqli->select_db("Cars");
echo "Selected the Cars database.<br>";

// Create Images table
$query = "
CREATE TABLE IF NOT EXISTS Images (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    VIN varchar(17),
    ImageFile varchar(250)
)
";

if ($mysqli->query($query) === TRUE) {
    echo "Database table 'Images' created.<br>";
} else {
    echo "Error: " . $mysqli->error . "<br>";
}

echo "<br><a href='index.php'>Home</a>";
$mysqli->close();
?>
