<?php
require_once __DIR__ . '/config_db.php';
require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Optional: block non-admin use
// if (!isset($_SESSION['user'])) {
//     die("Access denied.");
// }

echo "<h2>Creating Users Table...</h2>";

// Create table
$pdo->exec("
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50)
)");
echo "✔ users table created<br>";

// Insert default login
$username = "web250user";
$plainPass = "LetMeIn!";
$hash = password_hash($plainPass, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT IGNORE INTO users (username, password, first_name, last_name)
    VALUES (:u, :p, 'Web', 'User')
");
$stmt->execute([':u' => $username, ':p' => $hash]);

echo "<p>✔ Default login created:</p>";
echo "<p><strong>Username:</strong> $username<br>";
echo "<strong>Password:</strong> $plainPass</p>";

echo "<p><a href='" . BASE_URL . "/?page=login'>Go to Login</a></p>";
