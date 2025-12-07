<h2>Create an Account</h2>

<form action="/index.php?page=register_process" method="post">
    <label>Username<br>
        <input type="text" name="username" required>
    </label><br><br>

    <label>Password<br>
        <input type="password" name="password" required>
    </label><br><br>

    <button type="submit">Register</button>
</form>

<p>Already have an account?
    <a href="/index.php?page=login">Login here</a>
</p>
