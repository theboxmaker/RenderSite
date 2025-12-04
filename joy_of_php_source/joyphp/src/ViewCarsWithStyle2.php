<?php
// ViewCarsWithStyle2.php — Styled inventory with action links
include 'db.php';

// Select the correct database
$mysqli->select_db("Cars");

// Query all cars
$query = "SELECT VIN, Make, Model, ASKING_PRICE FROM Cars ORDER BY Make, Model";
$result = $mysqli->query($query);

if (!$result) {
    die("<p>Error retrieving inventory: " . htmlspecialchars($mysqli->error) . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars – Inventory</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('bg.jpg');
            background-size: cover;
            text-align: center;
            padding: 30px;
            margin: 0;
        }

        h1 { margin-bottom: 0; color: #333; }
        h3 { margin-top: 5px; color: #444; }

        #Grid {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            width: 85%;
            margin: 25px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px #888;
            background: #fff;
        }

        #Grid th {
            background-color: #C2D9FE;
            color: #3f4b5c;
            padding: 12px;
            font-size: 1.1rem;
            border-bottom: 2px solid #61ADD7;
            text-align: left;
        }

        #Grid td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr.odd td { background-color: #F2F5A9; }
        tr.even td { background-color: #ffffff; }

        a {
            color: #0b3d91;
            font-weight: bold;
            text-decoration: none;
        }
        a:hover { text-decoration: underline; }

        .actions a { margin-right: 12px; }
    </style>
</head>

<body>

<h1>Sam's Used Cars</h1>
<h3>Current Inventory</h3>

<table id="Grid">
    <tr>
        <th style="width: 150px;">Make</th>
        <th style="width: 150px;">Model</th>
        <th style="width: 150px;">Asking Price</th>
        <th style="width: 200px;">Actions</th>
    </tr>

<?php
$rowClass = "odd";

while ($row = $result->fetch_assoc()):
?>
    <tr class="<?= $rowClass ?>">
        <td>
            <a href="viewcar.php?VIN=<?= urlencode($row['VIN']) ?>">
                <?= htmlspecialchars($row['Make']) ?>
            </a>
        </td>

        <td><?= htmlspecialchars($row['Model']) ?></td>

        <td>$<?= number_format($row['ASKING_PRICE'], 0) ?></td>

        <td class="actions">
            <a href="FormEdit.php?VIN=<?= urlencode($row['VIN']) ?>">Edit</a>
            <a href="deletecar.php?VIN=<?= urlencode($row['VIN']) ?>">Delete</a>
        </td>
    </tr>
<?php
    $rowClass = ($rowClass === "odd") ? "even" : "odd";
endwhile;

$mysqli->close();
?>
</table>

<?php include 'footer.php'; ?>

</body>
</html>
