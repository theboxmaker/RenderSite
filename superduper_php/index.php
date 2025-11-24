<?php
// Pages available in the application
$pages = ["home", "alpha", "bravo", "charlie", "delta", "echo"];

// Determine the current page from the rewritten URL (?page=…)
$current = $_GET["page"] ?? "home";

// Sanitize / validate the requested page
if (!in_array($current, $pages)) {
    $current = "home";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Super Duper Paratrooper – <?= ucfirst($current) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>
    <!-- Banner — links to the home page -->
    <a href="/superduper_php/home">
        <img class="linkedimage" src="images/sdp_banner.png" alt="Super Duper Paratrooper Banner">
    </a>
    <br>

    <!-- Navigation -->
    <?php
    foreach ($pages as $i => $page) {
        // Active link highlight
        $active = ($current === $page)
            ? 'style="color:#005f5f; text-decoration:underline;"'
            : '';

        echo "<a $active href=\"/superduper_php/$page\">" . ucfirst($page) . "</a>";

        if ($i < count($pages) - 1) {
            echo " | ";
        }
    }
    ?>
</header>

<hr>

<main>
<?php
    // Load the corresponding PHP content file
    $file = "$current.php";

    if (file_exists($file)) {
        include $file;
    } else {
        echo "<p><strong>Error:</strong> Page '$current' not found.</p>";
    }
?>
</main>

<hr>

<footer id="tagline">
    We bring it... from above!
    <br><br>
    <a href="https://validator.w3.org/check?uri=referer">
        <img src="images/valid_html5.gif" alt="Valid HTML 5" height="31" width="88" style="border:0;">
    </a>
</footer>

</body>
</html>
