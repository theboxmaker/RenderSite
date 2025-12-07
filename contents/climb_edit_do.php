<?php
require_once __DIR__ . '/../carapp/db.php';

$id = intval($_POST['id'] ?? 0);
$type = $_POST['climb_type'] ?? "";
$grade = $_POST['grade'] ?? "";
$attempts = intval($_POST['attempts'] ?? 0);
$notes = $_POST['notes'] ?? "";

$stmt = $pdo->prepare("
    UPDATE climbing_log
    SET climb_type = ?, grade = ?, attempts = ?, notes = ?
    WHERE id = ?
");
$stmt->execute([$type, $grade, $attempts, $notes, $id]);

header("Location: /index.php?page=climb_list");
exit;
