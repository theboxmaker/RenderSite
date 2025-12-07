<?php
require_once __DIR__ . '/../db.php';

CREATE TABLE IF NOT EXISTS climb_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

$pdo->exec($sql);

echo "<h2>Climbs table created!</h2>";