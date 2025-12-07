<?php
session_start();
if (!isset($_SESSION['climb_user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}
?>


<?php
require_once __DIR__ . '/../db.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM climbs WHERE id = ?");
$stmt->execute([$id]);
$climb = $stmt->fetch();

if (!$climb) {
    die("<h2>Climb not found</h2>");
}
?>

<h2>Edit Climb</h2>

<form action="/index.php?page=climb_edit_do" method="post">
    <input type="hidden" name="id" value="<?= $climb['id'] ?>">

    <label>Climb Type:
        <select name="climb_type">
            <option <?= $climb['climb_type']=='Boulder'?'selected':'' ?>>Boulder</option>
            <option <?= $climb['climb_type']=='Sport'?'selected':'' ?>>Sport</option>
            <option <?= $climb['climb_type']=='Trad'?'selected':'' ?>>Trad</option>
            <option <?= $climb['climb_type']=='Gym Route'?'selected':'' ?>>Gym Route</option>
        </select>
    </label><br><br>

    <label>Grade:
        <input type="text" name="grade" value="<?= htmlspecialchars($climb['grade']) ?>">
    </label><br><br>

    <label>Attempts:
        <input type="number" name="attempts" min="1" value="<?= $climb['attempts'] ?>">
    </label><br><br>

    <button type="submit">Update</button>
</form>
