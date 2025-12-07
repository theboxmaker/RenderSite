<?php
require_once __DIR__ . '/../carapp/db.php'; // Using shared DB from carapp

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

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; background:#fff;">
    <tr style="background:#8b4513; color:white;">
        <th>Date</th>
        <th>Type</th>
        <th>Grade</th>
        <th>Attempts</th>
        <th>Notes</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($climbs as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['climb_date']) ?></td>
            <td><?= htmlspecialchars($c['climb_type']) ?></td>
            <td><?= htmlspecialchars($c['grade']) ?></td>
            <td><?= htmlspecialchars($c['attempts']) ?></td>
            <td><?= nl2br(htmlspecialchars($c['notes'])) ?></td>

            <td>
                <a href="/index.php?page=climb_edit&id=<?= $c['id'] ?>">Edit</a> |
                <a href="/index.php?page=climb_delete&id=<?= $c['id'] ?>"
                   onclick="return confirm('Delete this climbing entry?');"
                   style="color:red;">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>
