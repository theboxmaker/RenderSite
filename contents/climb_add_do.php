<?php
require_once __DIR__ . '/../db.php';

$type = trim($_POST['climb_type']);
$grade = trim($_POST['grade']);
$attempts = (int) $_POST['attempts'];

$stmt = $pdo->prepare("INSERT INTO climbs (climb_type, grade, attempts)
                       VALUES (?, ?, ?)");
$stmt->execute([$type, $grade, $attempts]);

header("Location: /index.php?page=climbs");
exit;
