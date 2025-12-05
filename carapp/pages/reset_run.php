<?php
session_start();
if (!isset($_SESSION['user'])) die("Access denied.");

require_once APP_PATH . '/db.php';

echo "<h2>Well, you asked for it…</h2>";

function logMsg($msg) {
    echo "<p>$msg</p>";
}

// Drop tables except users
logMsg("Dropping images table…");
$pdo->exec("DROP TABLE IF EXISTS images");

logMsg("Dropping inventory table…");
$pdo->exec("DROP TABLE IF EXISTS inventory");

// Recreate tables
logMsg("Recreating inventory…");
$pdo->exec("
    CREATE TABLE inventory (
        VIN varchar(17) PRIMARY KEY,
        YEAR INT,
        Make varchar(50),
        Model varchar(100),
        ASKING_PRICE DECIMAL(10,2)
    )
");

logMsg("Recreating images…");
$pdo->exec("
    CREATE TABLE images (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        VIN varchar(17),
        ImageFile varchar(250)
    )
");

// Add sample data
logMsg("Adding sample vehicles…");

$pdo->exec("
INSERT INTO inventory (VIN, YEAR, Make, Model, ASKING_PRICE)
VALUES
('12345678901234567', 2016, 'Honda', 'Pilot', 26000),
('12345678901234568', 2016, 'Honda', 'Civic', 15000),
('TESTVIN123456789', 2020, 'Honda', 'Civic', 13000)
");

logMsg("<strong>Reset complete!</strong>");
logMsg("<a href='" . BASE_URL . "'>Return to site</a>");
