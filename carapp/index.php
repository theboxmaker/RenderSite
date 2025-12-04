<?php
require_once __DIR__ . '/db.php';

// Base URL (adjust if needed for Render)
define('BASE_URL', '/carapp');

$page = $_GET['page'] ?? 'home';

$pageFile = __DIR__ . "/pages/{$page}.php";

if (!file_exists($pageFile)) {
    http_response_code(404);
    $pageFile = __DIR__ . "/pages/home.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zany Terrapin's Used Cars</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/default.css">
</head>

<body>

    <?php include __DIR__ . "/components/header.php"; ?>

    <main>
        <?php include $pageFile; ?>
    </main>

    <?php include __DIR__ . "/components/footer.php"; ?>

</body>
</html>
