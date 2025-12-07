<?php
if (!isset($_SESSION['climb_user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

require_once __DIR__ . '/../carapp/db.php';

$user_id = $_SESSION['climb_user']['id'];

$id = intval($_POST['id'] ?? 0);
$type = $_POST['climb_type'] ?? '';
$grade = $_POST['grade'] ?? '';
$attempts = intval($_POST['attempts'] ?? 1);
$notes = $_POST['notes'] ?? '';

// Check ownership
$check = $pdo->prepare("SELECT user_id FROM climbing_log WHERE id = ?");
$check->execute([$id]);
$row = $check->fetch();

if (!$row || $row['user_id'] != $user_id) {
    die("<h2>Access Denied</h2><p>You cannot edit another user's climb.</p>");
}

$stmt = $pdo->prepare("
    UPDATE climbing_log
    SET climb_type=?, grade=?, attempts=?, notes=?
    WHERE id=? AND user_id=?
");
$stmt->execute([$type, $grade, $attempts, $notes, $id, $user_id]);

header("Location: /index.php?page=climb_list");
exit;
