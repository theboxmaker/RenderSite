<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>super duper paratrooper page</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<header>
    <a href="index.php">
        <img class="linkedimage" src="images/sdp_banner.png" alt="Super Duper Paratrooper" />
    </a>
    <br />

    <?php
        // Define page list in one place — avoids repeating
        $pages = ["home", "alpha", "bravo", "charlie", "delta", "echo"];

        // Generate the navigation dynamically
        foreach ($pages as $i => $page) {
            echo '<a href="?p=' . $page . '">' . $page . '</a>';
            if ($i < count($pages) - 1) echo ' | ';
        }
    ?>
</header>

<hr />

<!-- Dynamic content -->
<?php
    // Get page from query string or default to 'home'
    $sPage = isset($_GET["p"]) ? $_GET["p"] : "home";

    // Append .php once only here
    $fileToInclude = $sPage . ".php";

    // Include the page if it exists
    if (file_exists($fileToInclude)) {
        include($fileToInclude);
    } else {
        echo "<p>Sorry, that page doesn't exist.</p>";
    }
?>
<hr />

<footer id="tagline">
    We bring it... from above!
    <br/><br/>
    <a href="http://validator.w3.org/check?uri=referer">
        <img src="images/valid_html5.gif" alt="Valid HTML 5"
            height="31" width="88" style="border:0px;" />
    </a>
</footer>
</body>
</html>
