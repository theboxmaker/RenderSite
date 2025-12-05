<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

echo "<h2>DB Debug</h2>";

try {
    $dbName = $pdo->query("SELECT DATABASE()")->fetchColumn();
    echo "<p>Connected to database: <strong>$dbName</strong></p>";

    echo "<h3>Tables:</h3>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<pre>";
    print_r($tables);
    echo "</pre>";

    echo "<h3>Inventory Rows:</h3>";
    $rows = $pdo->query("SELECT * FROM inventory")->fetchAll();
    echo "<pre>";
    print_r($rows);
    echo "</pre>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>ERROR: {$e->getMessage()}</p>";
}
