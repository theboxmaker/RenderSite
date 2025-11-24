<?php
// Load database connection
include 'db.php';

// Query all inventory items
$query = "SELECT Make, Model, ASKING_PRICE FROM inventory ORDER BY Make ASC";

$result = $mysqli->query($query);

if (!$result) {
    die("<p>Error retrieving car inventory: " . htmlspecialchars($mysqli->error) . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars – Styled Inventory</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
            text-align: center;
        }

        h1 {
            margin-bottom: 0;
            color: #333;
        }

        h3 {
            margin-top: 5px;
            color: #555;
        }

        /* Table Styling */
        #Grid {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 0 10px #aaa;
        }

        #Grid th {
            background-color: #C2D9FE;
            color: #3f4b5c;
            padding: 12px;
            font-size: 1.1rem;
            text-align: left;
            border-bottom: 2px solid #61ADD7;
        }

        #Grid td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr.odd td {
            background-color: #F2F5A9;
        }

        tr.even td {
            background-color: #ffffff;
        }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Complete Inventory</h3>

<table id="Grid">
    <tr>
        <th style="width: 150px;">Make</th>
        <th style="width: 150px;">Model</th>
        <th style="width: 150px;">Asking Price</th>
    </tr>

    <?php
    $rowClass = "odd";

    while ($row = $result->fetch_assoc()): ?>
        <tr class="<?= $rowClass ?>">
            <td><?= htmlspecialchars($row['Make']) ?></td>
            <td><?= htmlspecialchars($row['Model']) ?></td>
            <td>$<?= number_format($row['ASKING_PRICE'], 0) ?></td>
        </tr>

        <?php
        // Toggle row class
        $rowClass = ($rowClass === "odd") ? "even" : "odd";
    endwhile;

    $mysqli->close();
    ?>
</table>

<?php include "footer.php"; ?>

</body>
</html>
