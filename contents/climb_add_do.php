<?php
// Require login
if (!isset($_SESSION['user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

<?php
require_once __DIR__ . '/../carapp/db.php';

// Collect form data
$type = $_POST['climb_type'] ?? '';
$grade = $_POST['grade'] ?? '';
$attempts = intval($_POST['attempts'] ?? 1);
$notes = $_POST['notes'] ?? '';

$stmt = $pdo->prepare("
    INSERT INTO climbing_log (climb_type, grade, attempts, notes)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([$type, $grade, $attempts, $notes]);

header("Location: /index.php?page=climb_list");
exit;
