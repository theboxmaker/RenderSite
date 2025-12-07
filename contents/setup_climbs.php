<?php
require_once __DIR__ . '/../carapp/db.php'; // Use the same DB as carapp

echo "<h2>Setting up climbing_log table…</h2>";

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS climbing_log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            climb_type VARCHAR(50) NOT NULL,
            grade VARCHAR(20) NOT NULL,
            attempts INT NOT NULL DEFAULT 1,
            notes TEXT,
            date_logged TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    echo "<p>✔ Table <strong>climbing_log</strong> created successfully!</p>";
    echo "<p><a href='/index.php?page=climb_list'>Go to Climb List</a></p>";
} 
catch (PDOException $e) {
    echo "<p style='color:red;'>ERROR: " . $e->getMessage() . "</p>";
}
