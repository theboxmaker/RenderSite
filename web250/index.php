<?php
// Absolute base path (prevents include path issues with Docker/Apache)
$base = __DIR__;

// Determine requested page (default = home)
$page = isset($_GET['page']) ? trim($_GET['page']) : 'home';

// Whitelist pages (must match EXACT filenames in /contents)
$allowed_pages = [
    'home',
    'introduction',
    'contract',
    'superduper_static',
    'superduper_php'
];

// If page is not allowed, fall back to home
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Titles for each page
$titles = [
    'home'             => "Home",
    'introduction'     => "Introduction",
    'contract'         => "Contract",
    'superduper_static'=> "SuperDuper Static",
    'superduper_php'   => "SuperDuper PHP"
];

// Build the final <title> text
$full_title = "Zachary Tucker's Web Projects | WEB250 | " . ($titles[$page] ?? "Home");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/default.css">
    <title><?= htmlspecialchars($full_title) ?></title>
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include "$base/components/header.html"; ?>

    <main>
        <?php 
        $content_file = "$base/contents/$page.php";

        if (file_exists($content_file)) {
            include $content_file;
        } else {
            echo "<p>Error: Content file not found.</p>";
        }
        ?>
    </main>

    <?php include "$base/components/footer.html"; ?>

</body>
</html>
