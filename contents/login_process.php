<?php

// Pull submitted username/password safely
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

$correctUser = "web250user";
$correctPass = "LetMeIn!";

// Successful login — redirect back with username in query string
if ($username === $correctUser && $password === $correctPass) {
    header("Location: /index.php?page=login&user=" . urlencode($username));
    exit;
}

// FAILED LOGIN — no redirect needed, but NO OUTPUT must occur before here
echo "<h2>Login Result</h2>";
echo "<p style='color:red; font-weight:bold;'>Access Denied</p>";
echo "<p>The username or password you entered is incorrect.</p>";
echo "<p><a href='/index.php?page=login'>Back to Login</a></p>";
