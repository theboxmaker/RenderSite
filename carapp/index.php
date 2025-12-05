<?php
require_once __DIR__ . '/config_db.php';
require_once __DIR__ . '/db.php';

// Determine requested page
$page = $_GET['page'] ?? 'home';

// Resolve page path
$path = APP_PATH . "/pages/{$page}.php";
if (!file_exists($path)) {
    http_response_code(404);
    $path = APP_PATH . "/pages/home.php";
}
$actionPages = ['carAddSubmit', 'carDelete', 'carEditSubmit', 'carUploadSubmit'];

if (in_array($page, $actionPages)) {
    // Do NOT wrap with header/footer
    include $path;
    exit;
}
// Render layout
include APP_PATH . "/components/header.php";
include $path;
include APP_PATH . "/components/footer.php";
