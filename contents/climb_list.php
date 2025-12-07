<?php
require_once __DIR__ . '/../carapp/db.php'; // Using shared DB from carapp

// Safe output helper to avoid warnings
function safe($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

// Fetch all climbing logs
$stmt = $pdo->query("SELECT * FROM climbing_log ORDER BY id DESC");
$climbs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Climbing Log</h2>

<p>
    <a href="/index.php?page=climb_add"
       style="padding:10px 15px; background:#8b4513; color:white; border-radius:6px; text-decoration:none;">
       ➕ Add New Climb
    </a>
</p>

<?php if (empty($climbs)): ?>

    <p>No climbs logged yet.</p>

<?php else: ?>

<table class="climb-table">
        <th>Type</th>
        <th>Grade</th>
        <th>Attempts</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($climbs as $c): ?>
        <tr>
            <td><?= safe($c['climb_type']) ?></td>
            <td><?= safe($c['grade']) ?></td>
            <td><?= safe($c['attempts']) ?></td>
            <td><?= nl2br(safe($c['notes'])) ?></td>

            <td>
                <a href="/index.php?page=climb_edit&id=<?= safe($c['id']) ?>">Edit</a> |
                <a href="/index.php?page=climb_delete&id=<?= safe($c['id']) ?>"
                   onclick="return confirm('Delete this climbing entry?');"
                   style="color:darkred;">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>
