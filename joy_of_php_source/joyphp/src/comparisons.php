<?php
// Set timezone (modern format)
date_default_timezone_set("America/New_York");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comparison Operators Demo</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 25px;
            background: #f7f7f7;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.1rem;
        }
        .section {
            background: #fff;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 6px #aaa;
        }
        code {
            background: #eee;
            padding: 3px 6px;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<div class="section">
    <h1>Open Hours</h1>
    <p>
        <?php
        if (date("l") === 'Sunday') {
            echo "Sorry, we are closed today.";
        } else {
            echo "We are open today from 10 AM to 9 PM.";
        }
        ?>
    </p>
</div>

<div class="section">
    <h1>Comparison Operators</h1>

    <p>
        <?php
        $FirstName = 'Alan';

        if ($FirstName === "Alan") {
            echo "Hello Master";
        } else {
            echo "Hello " . htmlspecialchars($FirstName);
        }
        ?>
    </p>

    <p>
        <?php
        $a = 1;
        $b = "1";

        // Loose comparison
        if ($a == $b) {
            echo "<code>\$a == \$b</code> : TRUE (values match)";
        } else {
            echo "<code>\$a == \$b</code> : FALSE (values differ)";
        }
        ?>
    </p>

    <p>
        <?php
        // Strict comparison
        if ($a === $b) {
            echo "<code>\$a === \$b</code> : TRUE (value AND type match)";
        } else {
            echo "<code>\$a === \$b</code> : FALSE (types differ)";
        }
        ?>
    </p>
</div>

<div class="section">
    <h1>While Loop Output</h1>
    <p>
        <?php
        $i = 1;
        while ($i <= 10):
            echo $i . " ";
            $i++;
        endwhile;
        ?>
    </p>
</div>

</body>
</html>
