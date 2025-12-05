<?php
session_start();
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';

$error = $_GET['error'] ?? null;

$title = "Login";
?>

<h2>Login</h2>

<?php if ($error === "invalid"): ?>
    <p style="color:red;">Invalid username or password.</p>
<?php endif; ?>

<form method="post" action="<?= BASE_URL ?>/?page=loginSubmit">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Log In</button>
</form>
