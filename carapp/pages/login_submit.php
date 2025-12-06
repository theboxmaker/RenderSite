<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once APP_PATH . '/db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    die("<h2>Invalid login</h2><p><a href='" . BASE_URL . "/?page=login'>Try again</a></p>");
}

$_SESSION['user'] = [
    'id'        => $user['id'],
    'username'  => $user['username'],
    'first'     => $user['first_name'],
    'last'      => $user['last_name']
];

header("Location: " . BASE_URL);
exit;
