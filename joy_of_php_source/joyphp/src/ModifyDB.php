<?php
/**
 * ModifyDB — runs updates on database
 */
include 'db.php';

echo "<h1>Modify Database</h1>";

$mysqli->select_db("railway");

// Example update — keep original functionality
$query = "UPDATE inventory SET ASKING_PRICE = ASKING_PRICE + 100";

if ($mysqli->query($query)) {
    echo "<p>Prices updated successfully.</p>";
} else {
    echo "<p>Error updating database: {$mysqli->error}</p>";
}

$mysqli->close();
?>

<p><a href="index.php">Return to Home</a></p>
