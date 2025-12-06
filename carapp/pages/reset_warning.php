<?php
// Must already have a session from index.php
if (!isset($_SESSION['user'])) {
    die("<h2>Access Denied</h2><p>You must be logged in.</p>");
}

$title = "Database Reset Warning";
ob_start();
?>

<h2 style="color:red;">⚠ WARNING: Database Reset Operation</h2>

<p>
    You are about to completely <strong>destroy and recreate</strong> the database tables.<br>
    <strong>This action CANNOT be undone.</strong><br><br>
    The following will happen:
</p>

<ul>
    <li>All fields in <strong>inventory</strong> table will be dropped</li>
    <li>The <strong>inventory</strong> table itself will be dropped</li>
    <li>All fields in <strong>images</strong> table will be dropped</li>
    <li>The <strong>images</strong> table will be dropped</li>
    <li>The tables will be recreated and repopulated</li>
    <li><strong>The users table will NOT be dropped</strong></li>
</ul>

<p style="color:darkred; font-weight:bold;">
    If you did NOT mean to do this, click CANCEL!
</p>

<div style="margin-top:20px;">
    <!-- YES: go to reset_run.php (the script that actually runs the reset) -->
    <a href="<?= BASE_URL ?>/?page=reset_run"
       style="padding:10px 18px; background:red; color:white; text-decoration:none; border-radius:5px; margin-right:20px;">
       YES — Proceed with Reset
    </a>

    <!-- NO: go back to the main page -->
    <a href="<?= BASE_URL ?>/"
       style="padding:10px 18px; background:gray; color:white; text-decoration:none; border-radius:5px;">
       CANCEL — Go Back
    </a>
</div>

<?php
$content = ob_get_clean();
echo $content;

