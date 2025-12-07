<?php
// Require login
if (empty($_SESSION['climb_user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

require_once __DIR__ . '/../carapp/db.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM climbing_log WHERE id = ?");
$stmt->execute([$id]);
$climb = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$climb) {
    die("<h2>Climb not found</h2>");
}
?>

<h2>Edit Climb</h2>

<form action="/index.php?page=climb_edit_do" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($climb['id']) ?>">

    <label for="climb_type">Climb Type:</label>
    <select name="climb_type" id="climb_type">
        <option value="Boulder" <?= $climb['climb_type'] === 'Boulder' ? 'selected' : '' ?>>Boulder</option>
        <option value="Top Rope" <?= $climb['climb_type'] === 'Top Rope' ? 'selected' : '' ?>>Top Rope</option>
        <option value="Lead" <?= $climb['climb_type'] === 'Lead' ? 'selected' : '' ?>>Lead</option>
    </select>
    <br><br>

    <label for="grade">Grade:</label>
    <input type="text" id="grade" name="grade"
           value="<?= htmlspecialchars($climb['grade']) ?>">
    <br><br>

    <label for="attempts">Attempts:</label>
    <input type="number" id="attempts" name="attempts" min="1"
           value="<?= (int) $climb['attempts'] ?>">
    <br><br>

    <button type="submit">Update</button>
</form>
