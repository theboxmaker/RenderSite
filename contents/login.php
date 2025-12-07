<?php if (isset($_GET['user'])): ?>
    <div class="login-welcome">
        <p style="color:green; font-weight:bold;">
            Welcome back, <?= htmlspecialchars($_GET['user']) ?>!
        </p>
    </div>
<?php endif; ?>

<h2>Login to use Climbing App</h2>

<p>Sign in here to use the climbing application!</p>

<form action="/index.php?page=login_process" method="post" class="demo-login-form">

    <label>Username:
        <input type="text" name="username" required>
    </label>

    <label>Password:
        <input type="password" name="password" required>
    </label>

    <button type="submit">Log In</button>

</form>
