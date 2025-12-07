<?php
session_start();
require_once __DIR__ . '/../carapp/db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

$stmt = $pdo->prepare("SELECT * FROM climb_users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    die("<h2>Invalid login</h2><p><a href='/index.php?page=login'>Try again</a></p>");
}

// Save user session
$_SESSION['climb_user'] = [
    'id' => $user['id'],
    'username' => $user['username']
];

header("Location: /index.php?page=climb_list");
exit;
