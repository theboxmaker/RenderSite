<?php
/**
 * CreateImagesTable.php — Render-compatible initializer for Joy of PHP
 *
 * This script:
 *  ✓ Uses the same ENV-based DB connection as the rest of the site
 *  ✓ Ensures the "images" table exists in the Render-provided database
 */

require_once __DIR__ . '/db.php';  // mysqli version already updated

// Ensure we select the correct Render database (usually "defaultdb")
$mysqli->select_db(getenv('DB_NAME'));

echo "<h1>Create Images Table</h1>";
echo "<p>Using database: <strong>" . htmlspecialchars(getenv('DB_NAME')) . "</strong></p>";

/***************************************************
 * 1️⃣ Create the IMAGES table
 **************************************************/

$createImages = "
CREATE TABLE IF NOT EXISTS images (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    VIN VARCHAR(17) NOT NULL,
    ImageFile VARCHAR(255) NOT NULL,
    FOREIGN KEY (VIN) REFERENCES inventory(VIN) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if ($mysqli->query($createImages)) {
    echo "<p>✔ Images table created (or already exists)</p>";
} else {
    die("<p style='color:red;'>Error creating Images table: " . $mysqli->error . "</p>");
}

$mysqli->close();

echo "<p><strong>Images table setup complete!</strong></p>";
echo '<p><a href="/carapp/?page=cars_list">➡ Back to Inventory</a></p>';
?>
