<?php
// Connect to DB
include 'db.php';

// Fetch all cars
$query = "SELECT VIN, Make, Model FROM inventory ORDER BY Make, Model";

$result = $mysqli->query($query);
if (!$result) {
    die("Error retrieving inventory: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars – Add Images</title>

    <style>
        /* Table styling */
        #Grid {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        #Grid td, #Grid th {
            font-size: 1em;
            border: 1px solid #61ADD7;
            padding: 8px 10px;
        }
        #Grid th {
            background-color: #C2D9FE;
            color: #333;
            text-align: left;
            font-size: 1.1em;
        }
        #Grid tr.odd {
            background-color: #F2F5A9;
        }
        #Grid tr.even {
            background-color: white;
        }

        body {
            background: url('bg.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-bottom: 40px;
        }

        h1 {
            margin-top: 20px;
            font-size: 36px;
        }
        h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <h1>Sam's Used Cars</h1>
    <h3>Add an Image to a Car</h3>

    <table id="Grid">
        <tr>
            <th style="width: 150px;">Make</th>
            <th style="width: 200px;">Model</th>
            <th style="width: 120px;">Action</th>
        </tr>

        <?php
include 'db.php';

$mysqli->select_db("Cars");

$query = "SELECT VIN, Make, Model FROM Cars ORDER BY Make, Model";
$result = $mysqli->query($query);

if (!$result) {
    die("Error retrieving inventory: " . $mysqli->error);
}
?>

    </table>

    <?php include 'footer.php'; ?>

</body>
</html>
