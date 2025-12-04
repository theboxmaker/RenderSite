<?php
require_once __DIR__ . '/db.php';

$page = $_GET['page'] ?? 'home';

$path = __DIR__ . "/pages/{$page}.php";

if (!file_exists($path)) {
    http_response_code(404);
    $path = __DIR__ . "/pages/home.php";
}

include $path;
