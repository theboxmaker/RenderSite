<?php
require_once __DIR__ . '/../db.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("DELETE FROM climbs WHERE id=?");
$stmt->execute([$id]);

header("Location: /index.php?page=climbs");
exit;
