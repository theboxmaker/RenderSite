<?php
/**
 * CreateDB.php — Render-compatible database initializer for Joy of PHP
 *
 * This script:
 *  ✓ Connects using Render environment variables (DB_HOST, DB_USER, DB_PASS, DB_NAME)
 *  ✓ Ensures we are working inside the Render-provided database
 *  ✓ Creates the "inventory" table if it does not exist
 *  ✓ Inserts one sample car if inventory is empty
 */

require_once __DIR__ . '/db.php';  // Uses the updated mysqli ENV-based connection

// Make sure we are selecting the correct Render database
$mysqli->select_db(getenv('DB_NAME'));

echo "<h1>Initializing Joy Of PHP Database</h1>";
echo "<p>Using database: <strong>" . htmlspecialchars(getenv('DB_NAME')) . "</strong></p>";

/***************************************************
 * 1️⃣  Create the inventory table
 **************************************************/
$createTable = "
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if ($mysqli->query($createTable)) {
    echo "<p>✔ inventory table created (or already exists)</p>";
} else {
    die("<p style='color:red;'>Error creating table: " . $mysqli->error . "</p>");
}

/***************************************************
 * 2️⃣ Check if table already has data
 **************************************************/
$count = $mysqli->query("SELECT COUNT(*) AS total FROM inventory");
$row = $count->fetch_assoc();

if ($row['total'] > 0) {
    echo "<p>✔ Inventory table already contains data. No inserts were performed.</p>";
    $mysqli->close();
    exit("<p>Done!</p>");
}

/***************************************************
 * 3️⃣ Insert sample Joy-of-PHP data (1 or more rows)
 **************************************************/

$sampleInsert = "
INSERT INTO inventory
(VIN, YEAR, Make, Model, TRIM, EXT_COLOR, INT_COLOR, ASKING_PRICE, PURCHASE_PRICE, MILEAGE, TRANSMISSION, PURCHASE_DATE)
VALUES
('5FNYF4H91CB054036', 2012, 'Honda', 'Pilot', 'Touring', 'White Diamond Pearl', 'Leather', 37807, 34250, 7076, 'Automatic', '2012-11-08');
";

if ($mysqli->query($sampleInsert)) {
    echo "<p>✔ Inserted sample Honda Pilot</p>";
} else {
    echo "<p style='color:red;'>Error inserting sample data: " . $mysqli->error . "</p>";
}

echo "<p><strong>Database initialization complete!</strong></p>";

$mysqli->close();

echo '<p><a href="/carapp/?page=cars_list">➡ View Inventory</a></p>';
?>
