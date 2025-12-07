<?php
require_once __DIR__ . '/../db.php';

$id = $_POST['id'];
$type = trim($_POST['climb_type']);
$grade = trim($_POST['grade']);
$attempts = (int) $_POST['attempts'];

$stmt = $pdo->prepare("UPDATE climbs 
                       SET climb_type=?, grade=?, attempts=? 
                       WHERE id=?");
$stmt->execute([$type, $grade, $attempts, $id]);

header("Location: /index.php?page=climbs");
exit;
