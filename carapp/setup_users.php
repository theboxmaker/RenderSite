<?php
require_once __DIR__ . '/config_db.php';
require_once APP_PATH . '/db.php';

echo "<h2>Creating Users Table…</h2>";

$pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        first_name VARCHAR(50),
        last_name VARCHAR(50)
    )
");

echo "✔ users table created<br>";

// Add default testing user
$username = "web250user";
$passwordHash = password_hash("LetMeIn!", PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT IGNORE INTO users (username, password, first_name, last_name)
    VALUES (?, ?, 'Web', 'User')
");
$stmt->execute([$username, $passwordHash]);

echo "✔ Added default account: web250user / LetMeIn!<br>";

echo "<br>Done.";
