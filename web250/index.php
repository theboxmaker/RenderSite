<?php
// Absolute base path for stable includes (works in Docker/Apache/Render)
$base = __DIR__;

// Determine requested page (default = home)
$page = isset($_GET['page']) ? trim($_GET['page']) : 'home';

// Whitelist pages that exist in /web250/contents/
$allowed_pages = [
    'home',
    'introduction',
    'contract',
    'superduper_static',
    'superduper_php'
];

// If page not allowed, fall back to home
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Page titles
$titles = [
    'home'             => "Home",
    'introduction'     => "Introduction",
    'contract'         => "Contract",
    'superduper_static'=> "SuperDuper Static",
    'superduper_php'   => "SuperDuper PHP"
];

// Final title text
$full_title = "Zachary Tucker's Web Projects | WEB250 | " . ($titles[$page] ?? "Home");
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
    <?php include "$base/web250/components/header.php"; ?>

    <main>
        <?php
        // Build full path to the requested content file
        $content_file = "$base/web250/contents/$page.php";

        // Load the requested content if it exists
        if (file_exists($content_file)) {
            include $content_file;
        } else {
            echo "<p><strong>Error:</strong> Content file not found.</p>";
        }
        ?>
    </main>

    <!-- FOOTER -->
    <?php include "$base/web250/components/footer.php"; ?>

</body>
</html>
