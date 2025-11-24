<?php
/**
 * Simple countdown script (modernized)
 */

$target = mktime(0, 0, 0, 12, 25, date("Y")); // Christmas example
$now = time();

$seconds = $target - $now;
$days = max(0, floor($seconds / 86400));
?>

<h1>Countdown</h1>
<p>Our event will occur in <strong><?= $days ?></strong> days.</p>

<p><a href="/joy_of_php_source/joyphp/src/index.php">Back to Sam’s Used Cars</a></p>
