<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Joy of PHP</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: url('bg.jpg') no-repeat center top fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            color: #222;
        }
        h2 { color: #2f4f4f; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .auto-style1 { border: 1px solid #888; background-color: #c0c0c0; }
        td, th { padding: 12px; vertical-align: top; }
        a { color: #004c66; font-weight: bold; }
        a:hover { color: #007799; text-decoration: underline; }
        img.header-logo { max-width: 100%; height: auto; margin-bottom: 15px; }
        img.book-cover { margin-top: 25px; max-width: 200px; }
    </style>
</head>

<body>

    <img src="joy_logo.jpg" alt="The Joy of PHP" class="header-logo">

    <h2>Introduction</h2>
    <p>
        This folder contains the complete source code from the 
        <strong>Joy of PHP</strong> book.  
        It is now fully configured to run inside a Docker environment using:
        <strong>Apache + PHP + MySQL</strong>.
    </p>

    <h2>Database Tools</h2>

    <p><a href="CreateDB.php">Create the Cars Database</a></p>
    <p><a href="CreateImagesTable.php">Create the Images Table</a></p>
    <p><a href="ModifyDB.php">Modify the Cars Table</a></p>

    <h2>Inventory Tools</h2>
    <p><a href="ViewCars.php">View Cars (Simple)</a></p>
    <p><a href="ViewCarsWithStyle2.php">View Cars (Styled)</a></p>
    <p><a href="formEnterCar.htm">Enter a New Car</a></p>

    <img src="smallcover.jpg" alt="Joy of PHP Book Cover" class="book-cover">

</body>
</html>
