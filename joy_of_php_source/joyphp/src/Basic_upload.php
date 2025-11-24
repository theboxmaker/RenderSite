<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sam's Used Cars – Upload Image</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .upload-container {
            background: white;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #aaa;
        }

        label {
            font-weight: bold;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 1rem;
            background: teal;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background: #006b6b;
        }
    </style>
</head>

<body>

<h1>Upload an Image</h1>

<div class="upload-container">
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose an image file:</label><br>
        <input type="file" name="file" id="file" accept="image/*" required><br><br>

        <input type="submit" name="submit" value="Upload Image">
    </form>
</div>

</body>
</html>
