<?php
// Session already started in index.php
unset($_SESSION['climb_user']);
header("Location: /index.php");
exit;
