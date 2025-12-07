<?php
// Require login
if (empty($_SESSION['climb_user'])) {
    echo "
        <section>
            <h2>Access Denied</h2>
            <p>You must be logged in.</p>
        </section>
";
exit;

}

require_once __DIR__ . '/../carapp/db.php'; // Shared PDO connection
?>

<h2>Add a Climb</h2>

<form action="/index.php?page=climb_add_do" method="post">

    <label for="climb_type">Climb Type</label>
    <select id="climb_type" name="climb_type" required>
        <option value="Boulder" label="Boulder">Boulder</option>
        <option value="Top Rope"label="Top Rope">Top Rope</option>
        <option value="Lead" label="Lead">Lead</option>
    </select>

    <label for="grade">Grade</label>
    <input type="text" id="grade" name="grade" required>

    <label for="attempts">Attempts</label>
    <input type="number" id="attempts" name="attempts" min="1" required>

    <button type="submit">Save Climb</button>

</form>
