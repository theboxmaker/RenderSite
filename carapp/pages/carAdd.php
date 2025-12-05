<h2>Add a New Car</h2>

<form method="post" action="<?= BASE_URL ?>/?page=carAddSubmit">

    <label>VIN:</label><br>
    <input type="text" name="vin" required><br><br>

    <label>Make:</label><br>
    <input type="text" name="make" required><br><br>

    <label>Model:</label><br>
    <input type="text" name="model" required><br><br>

    <label>Year:</label><br>
    <input type="number" name="year" required><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <button type="submit">Save Car</button>
</form>
