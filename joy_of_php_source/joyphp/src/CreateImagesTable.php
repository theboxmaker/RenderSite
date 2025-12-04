<?php
require_once __DIR__ . '/db.php';

echo "Connected successfully.<br>";
echo "Using database: " . getenv('DB_NAME') . "<br>";

$query = "
CREATE TABLE IF NOT EXISTS images (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    VIN varchar(17),
    ImageFile varchar(250)
)";

if ($mysqli->query($query) === TRUE) {
    echo "Database table 'images' created.<br>";
} else {
    echo "Error creating table: " . $mysqli->error;
}

$mysqli->close();
?>
