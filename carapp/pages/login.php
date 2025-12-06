<?php
// DO NOT start a session here — index.php already does that.
?>

<h2>Login</h2>

<form action="<?= BASE_URL ?>/?page=login_submit" method="post">

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Invalid username or password.</p>
<?php endif; ?>
