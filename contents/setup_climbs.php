<?php
require_once __DIR__ . '/../db.php'; // now loads carapp DB

$sql = "
CREATE TABLE IF NOT EXISTS climbs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    climb_type VARCHAR(50) NOT NULL,
    grade VARCHAR(50) NOT NULL,
    attempts INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

$pdo->exec($sql);

echo "<h2>Climbs table created successfully in carapp database!</h2>";
