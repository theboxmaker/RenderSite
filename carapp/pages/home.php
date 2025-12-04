<?php
$title = "Welcome";
ob_start();
?>

<h2>Welcome to Zany Terrapin’s Car Lot</h2>
<p>Browse the inventory or add a new vehicle.</p>

<?php
$content = ob_get_clean();
include __DIR__ . "/../components/header.php";

