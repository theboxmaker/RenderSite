<h2>Add a New Car</h2>

<form method="post" action="<?= BASE_URL ?>/pages/carAddSubmit.php">

    <label>VIN:</label><br>
    <input type="text" name="vin" minlength="17" maxlength="17" required><br><br>

    <label>Make:</label><br>
    <input type="text" name="make" required><br><br>

    <label>Model:</label><br>
    <input type="text" name="model" required><br><br>

    <label>Year:</label><br>
    <input type="number" name="year" min="1900" max="<?= date('Y') + 1 ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" min="0" required><br><br>

    <button type="submit">Save Car</button>
</form>
<?php if (isset($_GET['error']) && $_GET['error'] === 'vin_exists'): ?>
    <p style="color:red;">A vehicle with that VIN already exists.</p>
<?php endif; ?>

