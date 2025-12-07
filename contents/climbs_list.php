<?php
require_once __DIR__ . '/../db.php';

$result = $pdo->query("SELECT * FROM climbs ORDER BY created_at DESC");
$climbs = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Climbing Log</h2>

<a href="/index.php?page=climb_add" class="button">➕ Add New Climb</a>

<table>
    <tr>
        <th>Type</th>
        <th>Grade</th>
        <th>Attempts</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($climbs as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c['climb_type']) ?></td>
        <td><?= htmlspecialchars($c['grade']) ?></td>
        <td><?= htmlspecialchars($c['attempts']) ?></td>
        <td><?= htmlspecialchars($c['created_at']) ?></td>
        <td>
            <a href="/index.php?page=climb_edit&id=<?= $c['id'] ?>">Edit</a>
            |
            <a href="/index.php?page=climb_delete&id=<?= $c['id'] ?>"
               onclick="return confirm('Delete this entry?');">
               Delete
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
