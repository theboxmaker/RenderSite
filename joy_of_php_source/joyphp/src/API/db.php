<?php
$mysqli = new mysqli('mySQL', 'root', 'verysecret', 'Cars', 3306);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$mysqli->select_db("Cars");
?>
