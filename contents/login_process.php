<?php
// Pull submitted username/password safely
$username = htmlspecialchars($_POST['username'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

// Hardcoded correct values
$correctUser = "web250user";
$correctPass = "LetMeIn!";

// Successful login — redirect back WITH username
if ($username === $correctUser && $password === $correctPass) {
    header("Location: /index.php?page=login&user=" . urlencode($username));
    exit;
}

// Failed login — show message
?>
<h2>Login Result</h2>

<p style="color:red; font-weight:bold;">Access Denied</p>
<p>The username or password you entered is incorrect.</p>

<p><a href="/index.php?page=login">Back to Login</a></p>
