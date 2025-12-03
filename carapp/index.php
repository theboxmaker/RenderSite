<?php
// index.php - Zany Terrapin's Used Cars

include 'config_db.php';

$message = '';
$messageType = ''; // 'success' or 'error'

// ---------- Handle INSERT / UPDATE (form submit) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode  = $_POST['mode'] ?? 'insert'; // 'insert' or 'update'

    $vin   = trim($_POST['VIN'] ?? '');
    $make  = trim($_POST['Make'] ?? '');
    $model = trim($_POST['Model'] ?? '');
    $price = trim($_POST['Asking_Price'] ?? '');

    // Basic validation
    if ($vin === '' || $make === '' || $model === '' || $price === '') {
        $message = 'All fields are required.';
        $messageType = 'error';
    } elseif (!is_numeric($price) || $price < 0) {
        $message = 'Asking price must be a positive number.';
        $messageType = 'error';
    } else {
        if ($mode === 'insert') {
            // INSERT new car
            $stmt = $mysqli->prepare(
                "INSERT INTO inventory (VIN, Make, Model, Asking_Price)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("sssd", $vin, $make, $model, $price);

            if ($stmt->execute()) {
                $message = "Successfully added $make $model (VIN: $vin).";
                $messageType = 'success';
            } else {
                if ($stmt->errno == 1062) {
                    $message = "Error: A car with VIN $vin already exists.";
                    $messageType = 'error';
                } else {
                    $message = "Database error: " . $stmt->error;
                    $messageType = 'error';
                }
            }

            $stmt->close();
        } elseif ($mode === 'update') {
            // UPDATE existing car (VIN is primary key, not changing here)
            $stmt = $mysqli->prepare(
                "UPDATE inventory
                 SET Make = ?, Model = ?, Asking_Price = ?
                 WHERE VIN = ?"
            );
            $stmt->bind_param("ssds", $make, $model, $price, $vin);

            if ($stmt->execute()) {
                if ($stmt->affected_rows >= 0) {
                    $message = "Updated car $make $model (VIN: $vin).";
                    $messageType = 'success';
                } else {
                    $message = "No changes were made.";
                    $messageType = 'error';
                }
            } else {
                $message = "Database error while updating: " . $stmt->error;
                $messageType = 'error';
            }

            $stmt->close();
        }
    }
}

// ---------- Handle DELETE ----------
if (isset($_GET['delete'])) {
    $deleteVin = $_GET['delete'];

    // Basic VIN cleanup
    $deleteVin = trim($deleteVin);

    if ($deleteVin !== '') {
        $stmt = $mysqli->prepare("DELETE FROM inventory WHERE VIN = ?");
        $stmt->bind_param("s", $deleteVin);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $message = "Deleted car with VIN $deleteVin.";
                $messageType = 'success';
            } else {
                $message = "No car found with VIN $deleteVin.";
                $messageType = 'error';
            }
        } else {
            $message = "Database error while deleting: " . $stmt->error;
            $messageType = 'error';
        }

        $stmt->close();
    }
}

// ---------- Handle EDIT (pre-fill form) ----------
$editMode = false;
$editCar = [
    'VIN'          => '',
    'Make'         => '',
    'Model'        => '',
    'Asking_Price' => '',
];

if (isset($_GET['edit'])) {
    $editVin = trim($_GET['edit']);
    if ($editVin !== '') {
        $stmt = $mysqli->prepare(
            "SELECT VIN, Make, Model, Asking_Price
             FROM inventory
             WHERE VIN = ?"
        );
        $stmt->bind_param("s", $editVin);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $editMode = true;
            $editCar = $row;
        }
        $stmt->close();
    }
}

// ---------- Load all cars for display ----------
$carsResult = $mysqli->query(
    "SELECT VIN, Make, Model, Asking_Price
     FROM inventory
     ORDER BY Make, Model"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zany Terrapin's Used Cars</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<header>
    <h1>Zany Terrapin's Used Cars</h1>
</header>

<main>
    <h2>Inventory Control Panel</h2>

    <?php if ($message): ?>
        <h3 class="message <?= htmlspecialchars($messageType) ?>">
            <?= htmlspecialchars($message) ?>
        </h3>
    <?php endif; ?>

    <!-- Inventory Table -->
    <section class="inventory">
        <h3>Current Cars on the Lot</h3>

        <?php if ($carsResult && $carsResult->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>VIN</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Asking Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($car = $carsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($car['VIN']) ?></td>
                        <td><?= htmlspecialchars($car['Make']) ?></td>
                        <td><?= htmlspecialchars($car['Model']) ?></td>
                        <td>$<?= number_format($car['Asking_Price'], 2) ?></td>
                        <td>
                            <a class="btn btn-edit"
                               href="?edit=<?= urlencode($car['VIN']) ?>">Edit</a>
                            <a class="btn btn-delete"
                               href="?delete=<?= urlencode($car['VIN']) ?>"
                               onclick="return confirm('Delete car with VIN <?= htmlspecialchars($car['VIN']) ?>?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No cars in the inventory yet. Add one below!</p>
        <?php endif; ?>
    </section>

    <!-- Insert / Update Form -->
    <section class="car-form">
        <?php if ($editMode): ?>
            <h3>Edit Car (VIN: <?= htmlspecialchars($editCar['VIN']) ?>)</h3>
        <?php else: ?>
            <h3>Add a New Car</h3>
        <?php endif; ?>

        <form action="index.php<?= $editMode ? '?edit=' . urlencode($editCar['VIN']) : '' ?>" method="post">
            <input type="hidden" name="mode" value="<?= $editMode ? 'update' : 'insert' ?>">

            <div class="form-row">
                <label for="VIN">VIN:</label>
                <input
                    type="text"
                    id="VIN"
                    name="VIN"
                    value="<?= htmlspecialchars($editCar['VIN']) ?>"
                    <?= $editMode ? 'readonly' : '' ?>
                    required
                >
            </div>

            <div class="form-row">
                <label for="Make">Make:</label>
                <input
                    type="text"
                    id="Make"
                    name="Make"
                    value="<?= htmlspecialchars($editCar['Make']) ?>"
                    required
                >
            </div>

            <div class="form-row">
                <label for="Model">Model:</label>
                <input
                    type="text"
                    id="Model"
                    name="Model"
                    value="<?= htmlspecialchars($editCar['Model']) ?>"
                    required
                >
            </div>

            <div class="form-row">
                <label for="Asking_Price">Asking Price:</label>
                <input
                    type="number"
                    step="0.01"
                    id="Asking_Price"
                    name="Asking_Price"
                    value="<?= htmlspecialchars($editCar['Asking_Price']) ?>"
                    required
                >
            </div>

            <div class="form-row">
                <button type="submit">
                    <?= $editMode ? 'Update Car' : 'Add Car' ?>
                </button>
            </div>
        </form>
    </section>
</main>

<footer>
    <p>Designed by Zany Terrapin Webwerks &mdash; don’t sue us if we use gum to hold your car together.</p>
    <p>All sales final. Shell not included.</p>
</footer>

</body>
</html>
<?php
// Clean up
if ($carsResult instanceof mysqli_result) {
    $carsResult->free();
}
$mysqli->close();
?>
