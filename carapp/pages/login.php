<?php
$title = "Login";

ob_start();
?>

<h2>Login</h2>

<form method="post" action="<?= BASE_URL ?>/?page=login_submit">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
