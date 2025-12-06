<?php
// Start session BEFORE any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// Pages that run WITHOUT header/footer (actions)
$actionPages = ['carAddSubmit', 'carDelete', 'carEditSubmit', 'carUploadSubmit', 'login_submit', 'logout', 'reset_run'];

if (in_array($page, $actionPages)) {
    include $path;
    exit;
}

// Render layout for normal pages
include APP_PATH . "/components/header.php";
include $path;
include APP_PATH . "/components/footer.php";
