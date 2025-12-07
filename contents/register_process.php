<?php
session_start();
require_once __DIR__ . '/../carapp/db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    die("<h2>Error</h2><p>Both fields are required.</p>");
}

// Check if user already exists
$stmt = $pdo->prepare("SELECT id FROM climb_users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    die("<h2>Error</h2><p>Username already taken. Try another.</p>");
}

// Insert new user
$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO climb_users (username, password) VALUES (?, ?)");
$stmt->execute([$username, $hashed]);

echo "<h2>Registration successful!</h2>";
echo "<p>You can now <a href='/index.php?page=login'>log in</a>.</p>";
