<?php
// Session is already active from index.php
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}

require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

function logMsg($msg) {
    echo "<p>$msg</p>";
}

echo "<h2>Well, you asked for it…</h2>";

// Drop tables
logMsg("Dropping <strong>images</strong> table…");
$pdo->exec("DROP TABLE IF EXISTS images");

logMsg("Dropping <strong>inventory</strong> table…");
$pdo->exec("DROP TABLE IF EXISTS inventory");

// Recreate
logMsg("Recreating <strong>inventory</strong> table…");
$pdo->exec("
    CREATE TABLE inventory (
        VIN varchar(17) PRIMARY KEY,
        YEAR INT,
        Make varchar(50),
        Model varchar(100),
        ASKING_PRICE DECIMAL(10,2)
    )
");

logMsg("Recreating <strong>images</strong> table…");
$pdo->exec("
    CREATE TABLE images (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        VIN varchar(17),
        ImageFile varchar(250)
    )
");

// Sample data
logMsg("Adding sample vehicles…");
$pdo->exec("
INSERT INTO inventory (VIN, YEAR, Make, Model, ASKING_PRICE)
VALUES
('12345678901234567', 2016, 'Honda', 'Pilot', 26000),
('12345678901234568', 2016, 'Honda', 'Civic', 15000),
('TESTVIN123456789', 2020, 'Honda', 'Civic', 13000)
");

logMsg("<strong>Database reset complete!</strong>");

echo "<p><a href='" . BASE_URL . "'>Return to site</a></p>";
