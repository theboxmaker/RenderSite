<?php
include 'db.php';

// This file originally calculated age based on birth year.
// The updated version will include proper validation.

$birthYear = isset($_GET['year']) ? intval($_GET['year']) : null;
$currentYear = date('Y');
$age = null;

if ($birthYear) {
    if ($birthYear > $currentYear) {
        $error = "Birth year cannot be in the future.";
    } elseif ($birthYear < 1900) {
        $error = "Birth year must be 1900 or later.";
    } else {
        $age = $currentYear - $birthYear;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Age Calculator – Sam's Used Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #fafafa;
            text-align: center;
        }

        .calculator {
            background: white;
            max-width: 400px;
            margin: 20px auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px #bbb;
        }

        input[type="number"] {
            padding: 8px;
            width: 90%;
            margin: 10px 0;
            font-size: 1rem;
        }

        button {
            background: teal;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #006b6b;
        }

        .result {
            margin-top: 15px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h1>Age Calculator</h1>

<div class="calculator">
    <form method="get">
        <label for="year">Enter Birth Year:</label><br>
        <input type="number" name="year" id="year" min="1900" max="<?= $currentYear ?>" required>
        <br>
        <button type="submit">Calculate Age</button>
    </form>

    <?php if (isset($age)): ?>
        <div class="result">
            You are approximately <?= htmlspecialchars($age) ?> years old.
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
