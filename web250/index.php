<?php
// Base path for the web250 folder
$base = __DIR__;

// Requested page OR default to "index"
$page = isset($_GET['page']) ? trim($_GET['page']) : 'index';

// Security: prevent directory traversal (e.g., "?page=../hack")
$page = basename($page);

// Build the full path for the requested content file
$content_file = $base . "/contents/{$page}.php";

// If file does not exist, fall back to contents/index.php
if (!file_exists($content_file)) {
    $content_file = $base . "/contents/index.php";
}

// Create a readable page title automatically
// e.g., "superduper_php" → "Superduper Php"
$formatted_title = ucwords(str_replace('_', ' ', $page));
$full_title = "Zachary Tucker's Web Projects | WEB250 | {$formatted_title}";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web250/styles/default.css">
    <title><?= htmlspecialchars($full_title) ?></title>
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- HEADER -->
    <?php include $base . "/components/header.php"; ?>

    <main>
        <?php include $content_file; ?>
    </main>

    <!-- FOOTER -->
    <?php include $base . "/components/footer.php"; ?>

</body>
</html>
