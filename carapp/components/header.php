<header>
    <h1>Zany Terrapin's Used Cars</h1>

    <nav>
        <a href="<?= BASE_URL ?>/?page=home">Home</a>
        <a href="<?= BASE_URL ?>/?page=cars_list">Inventory</a>

        <?php if (!isset($_SESSION['user'])): ?>

            <a href="<?= BASE_URL ?>/?page=login">Login</a>

        <?php else: ?>

            <a href="<?= BASE_URL ?>/?page=carAdd">Add Car</a>
            <a href="<?= BASE_URL ?>/?page=reset_warning" style="color:red;">Reset DB</a>
            <a href="<?= BASE_URL ?>/?page=logout">Logout (<?= htmlspecialchars($_SESSION['user']['username']) ?>)</a>

        <?php endif; ?>
    </nav>
</header>
