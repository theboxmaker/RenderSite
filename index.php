<?php
$base = __DIR__;

// Determine page or default to index
$page = isset($_GET['page']) ? basename(trim($_GET['page'])) : 'index';

// Build content path
$content_file = $base . "/contents/{$page}.php";

// Fallback to home if content missing
if (!file_exists($content_file)) {
    $page = "index";
    $content_file = $base . "/contents/index.php";
}

// Title based on filename
$formatted_title = ucwords(str_replace('_', ' ', $page));
$full_title = "Zachary Tucker | {$formatted_title}";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/default.css">
    <title><?= htmlspecialchars($full_title) ?></title>
</head>

<body>

    <?php include $base . "/components/header.php"; ?>

    <main>
        <?php include $content_file; ?>
    </main>

    <?php include $base . "/components/footer.php"; ?>

</body>
</html>
