<?php
// Build navigation items dynamically by scanning the contents folder
$contents_path = __DIR__ . '/../contents/';
$content_files = glob($contents_path . '*.php');

$nav_items = [];

foreach ($content_files as $file) {
    $slug = basename($file, '.php');
    $title = ucwords(str_replace('_', ' ', $slug));
    $nav_items[$slug] = $title;
}
?>

<header>
    <div class="header">
        <img src="/web250/images/favicon_io/android-chrome-192x192.png" alt="TuckTech logo">
        <h1>Zachary Tucker's Zany Terrapin | WEB250</h1>
    </div>

    <nav class="navbar">
        <?php foreach ($nav_items as $slug => $title): ?>
            <a href="/web250/index.php?page=<?= $slug ?>">
                <?= htmlspecialchars($title) ?>
            </a>
        <?php endforeach; ?>
    </nav>
</header>
