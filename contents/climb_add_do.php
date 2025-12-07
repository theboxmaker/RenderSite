<?php
if (!isset($_SESSION['climb_user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

require_once __DIR__ . '/../carapp/db.php';

$user_id = $_SESSION['climb_user']['id'];

$type = $_POST['climb_type'] ?? '';
$grade = $_POST['grade'] ?? '';
$attempts = intval($_POST['attempts'] ?? 1);
$notes = $_POST['notes'] ?? '';

$stmt = $pdo->prepare("
    INSERT INTO climbing_log (climb_type, grade, attempts, notes, user_id)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([$type, $grade, $attempts, $notes, $user_id]);

header("Location: /index.php?page=climb_list");
exit;
