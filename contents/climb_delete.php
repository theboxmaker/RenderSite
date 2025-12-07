<?php
// Require login
if (!isset($_SESSION['user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

<?php
require_once __DIR__ . '/../carapp/db.php';

// Validate ID
$id = intval($_GET['id'] ?? 0);
if ($id === 0) {
    header("Location: /index.php?page=climb_list");
    exit;
}

// Delete from DB
$stmt = $pdo->prepare("DELETE FROM climbing_log WHERE id = ?");
$stmt->execute([$id]);

// Redirect back to list
header("Location: /index.php?page=climb_list");
exit;
