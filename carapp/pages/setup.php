<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

echo "<pre>";

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS inventory (
            VIN VARCHAR(17) PRIMARY KEY,
            Make VARCHAR(50),
            Model VARCHAR(50),
            YEAR INT,
            ASKING_PRICE DECIMAL(10,2)
        )
    ");

    echo "Inventory table created or already exists.\n";

    // Insert sample test row
    $pdo->exec("
        INSERT INTO inventory (VIN, Make, Model, YEAR, ASKING_PRICE)
        VALUES ('TESTVIN123456789', 'Honda', 'Civic', 2020, 15000)
        ON DUPLICATE KEY UPDATE Make = VALUES(Make)
    ");

    echo "Inserted test row successfully.\n";

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

echo "</pre>";
