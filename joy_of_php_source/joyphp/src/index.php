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

        h2 {
            color: #2f4f4f;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .auto-style1 {
            border: 1px solid #888;
            background-color: #c0c0c0;
        }

        td, th {
            padding: 12px;
            vertical-align: top;
        }

        a {
            color: #004c66;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            color: #007799;
            text-decoration: underline;
        }

        img.header-logo {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 15px;
        }

        img.book-cover {
            display: block;
            margin-top: 25px;
            max-width: 200px;
            height: auto;
        }
    </style>
</head>

<body>

    <img src="joy_logo.jpg" alt="The Joy of PHP" class="header-logo">

    <h2>Introduction</h2>
    <p>
        The <strong>Joy of PHP</strong> book walks you through creating a website for 
        <strong><a href="samsusedcars.html">Sam's Used Cars</a></strong>.
        All the sample code in the book is conveniently collected here.
        To get started, make sure you have PHP and MySQL running on your machine.
    </p>

    <h2>Getting Started</h2>

    <table class="auto-style1">
        <tr>
            <th style="width: 40%;">Prerequisites</th>
            <th>Free Code Editors</th>
        </tr>
        <tr>
            <td>
                <p>PC Users: <a href="http://www.wampserver.com/en/">Download WAMP</a></p>
                <p>Mac Users: <a href="http://www.apachefriends.org/en/xampp-macosx.html">Download XAMPP</a></p>
            </td>

            <td>
                <p><a href="http://www.pnotepad.org/">Programmer's Notepad</a> — good all-purpose editor</p>
                <p><a href="http://devphp.sourceforge.net/">Dev-PHP</a> — PHP-specific editor</p>
                <p><a href="http://www.barebones.com/products/textwrangler/">TextWrangler</a> — great for Mac OS</p>
            </td>
        </tr>
    </table>

    <h2>Following Along with the Lessons</h2>
    <p>
        Check your PHP version and configuration:
        <a href="phpinfo.php" target="_blank">PHP Info Page</a>
    </p>

    <p>
        Try a simple PHP page:
        <a href="simple.php">simple.php</a>
    </p>

    <h2>Database-Related Scripts</h2>
    <p><a href="CreateDB.php">Create the Cars Database</a><br>
       (Edit line 8 with your username & password first.)</p>

    <p><a href="ModifyDB.php">Modify the Inventory Table</a><br>
       (Adds the <strong>Primary_Image</strong> column.)</p>

    <p><a href="CreateImagesTable.php">Create the Images Table</a></p>

    <img src="smallcover.jpg" alt="Joy of PHP Book Cover" class="book-cover">

</body>
</html>
