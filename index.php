<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base = __DIR__;


<?php
$base = __DIR__;

// Determine page or default to index
$page = isset($_GET['page']) ? basename(trim($_GET['page'])) : 'index';

// Route map for files whose name does not match ?page=
$route_map = [
    "introform"             => "introduction_form",
    "introduction_process"  => "introduction_process",
    "login_process"         => "login_process",
    "climbs"                => "climbs_list",
    "climb_add"             => "climb_add",
    "climb_add_do"          => "climb_add_do",
    "climb_edit"            => "climb_edit",
    "climb_edit_do"         => "climb_edit_do",
    "climb_delete"          => "climb_delete",
    "register_process"      => "register_process"
];

// Apply route map rewrite
if (isset($route_map[$page])) {
    $page = $route_map[$page];
}

// Build expected content path
$content_file = $base . "/contents/{$page}.php";

// Action pages that must NOT load header/footer
$action_pages = [
    "introduction_process",
    "login_process",
    "climb_add_do",
    "climb_edit_do",
    "climb_delete",
    "register_process"
];

// ACTION HANDLING — direct include, no layout
if (in_array($page, $action_pages)) {
    if (file_exists($content_file)) {
        include $content_file;
    } else {
        echo "<h2>Action file not found.</h2>";
    }
    exit;
}

// FALLBACK for missing content files
if (!file_exists($content_file)) {
    $page = "index";
    $content_file = $base . "/contents/index.php";
}

// Page title
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
    <script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include $base . "/components/header.php"; ?>

    <main>
        <?php include $content_file; ?>
    </main>

    <?php include $base . "/components/footer.php"; ?>

</body>
</html>
