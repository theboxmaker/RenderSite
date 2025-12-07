<?php
// Start session BEFORE any HTML output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require login
if (!isset($_SESSION['user'])) {
    echo "<h2>Access Denied</h2><p>You must be logged in.</p>";
    exit;
}

require_once __DIR__ . '/../carapp/db.php'; // Shared PDO connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/default.css">
    <title>Zachary Tucker | Climb Add</title>
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>

<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

<main>

<h2>Add a Climb</h2>

<form action="/index.php?page=climb_add_do" method="post">

    <label for="climb_type">Climb Type</label>
    <select id="climb_type" name="climb_type" required>
        <option value="Boulder">Boulder</option>
        <option value="Top Rope">Top Rope</option>
        <option value="Lead">Lead</option>
    </select>

    <label for="grade">Grade</label>
    <input type="text" id="grade" name="grade" required>

    <label for="attempts">Attempts</label>
    <input type="number" id="attempts" name="attempts" min="1" required>

    <button type="submit">Save Climb</button>

</form>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>

</body>
</html>
