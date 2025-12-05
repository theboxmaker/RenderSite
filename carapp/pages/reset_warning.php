<?php
session_start();
if (!isset($_SESSION['user'])) die("Access denied.");

$title = "Reset Database";
ob_start();
?>

<h2 style="color:red;">⚠ WARNING: You are about to destroy ALL data.</h2>

<p>This will:</p>
<ul>
    <li>Drop every table (EXCEPT users)</li>
    <li>Recreate tables</li>
    <li>Repopulate sample data</li>
</ul>

<p style="color:red;font-weight:bold;">
This action cannot be undone. Proceed?
</p>

<a href="<?= BASE_URL ?>/pages/reset_run.php" 
   style="padding:10px;background:red;color:white;">YES, DESTROY EVERYTHING</a>

<?php
$content = ob_get_clean();
include APP_PATH . '/views/layout.php';
