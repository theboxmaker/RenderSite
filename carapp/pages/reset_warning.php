<?php
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}

$title = "Database Reset Warning";
ob_start();
?>

<h2 style="color:red;">⚠ WARNING: Database Reset Operation</h2>

<p>
    You are about to completely <strong>destroy and recreate</strong> the database tables.<br>
    <strong>This action CANNOT be undone.</strong>
</p>

<ul>
    <li>Drop all fields in <strong>inventory</strong></li>
    <li>Drop <strong>inventory</strong> table</li>
    <li>Drop all fields in <strong>images</strong></li>
    <li>Drop <strong>images</strong> table</li>
    <li>Recreate tables</li>
    <li>Repopulate sample data</li>
    <li><strong>Users table will NOT be dropped</strong></li>
</ul>

<p style="color:darkred; font-weight:bold;">Are you sure?</p>

<div style="margin-top:20px;">

    <!-- FIXED — route through index.php -->
    <a href="<?= BASE_URL ?>/?page=reset_run"
       style="padding:10px 18px; background:red; color:white; text-decoration:none; border-radius:5px; margin-right:20px;">
       YES — Proceed with Reset
    </a>

    <a href="<?= BASE_URL ?>/"
       style="padding:10px 18px; background:gray; color:white; text-decoration:none; border-radius:5px;">
       CANCEL — Go Back
    </a>
</div>

<?php
$content = ob_get_clean();
echo $content;
?>
