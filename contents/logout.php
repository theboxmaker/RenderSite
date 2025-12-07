<?php
session_start();
unset($_SESSION['climb_user']);
header("Location: /index.php");
exit;
