<?php
require_once __DIR__ . '/../db.php';

$sql = "
ALTER TABLE climbing_log
ADD COLUMN user_id INT NOT NULL AFTER id;

);
";

$pdo->exec($sql);

echo "<h2>Table altered</h2>";