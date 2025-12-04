<?php
/**
 * ModifyDB — sample table modification script
 */

include 'db.php';

echo "<h1>Modify Database</h1>";

// Select correct database
$mysqli->select_db("Cars");

// Example update (optional)
$query = "UPDATE Cars SET ASKING_PRICE = ASKING_PRICE + 100";

if ($mysqli->query($query)) {
    echo "<p>Prices updated successfully.</p>";
} else {
    echo "<p>Error updating database: " . htmlspecialchars($mysqli->error) . "</p>";
}

$mysqli->close();
?>

<p><a href="index.php">Return to Home</a></p>
