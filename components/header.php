<header>
    <div class="header">
        <img class="logo" src="/images/favicon.png" alt="Logo">
        <h1>Zachary Tucker's Web Projects</h1>
    </div>

    <nav class="navbar">

        <a href="/index.php?page=index"
           class="<?= $page === 'index' ? 'active' : '' ?>">Home</a>

        <a href="/index.php?page=introduction"
           class="<?= $page === 'introduction' ? 'active' : '' ?>">Introduction</a>

        <a href="/index.php?page=contract"
           class="<?= $page === 'contract' ? 'active' : '' ?>">Contract</a>

        <!-- DROPDOWN -->
        <div class="dropdown">
            <button class="dropbtn">Projects ▼</button>
            <div class="dropdown-content">
                <a href="/superduper_static/index.html">SuperDuper Static</a>
                <a href="/superduper_php/index.php">SuperDuper PHP</a>
                <a href="/joy_of_php_source/joyphp/src/index.php">Joy of PHP</a>
                <a href="/joy_of_php_source/joyphp/src/samsusedcars.html">Sam's Used Cars</a>
                <a href="/carapp/index.php">Zany Terrapin's Used Cars</a>
            </div>
        </div>

    </nav>
</header>
