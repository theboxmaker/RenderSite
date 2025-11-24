<header>
    <div class="header">
        <img src="/images/favicon.png" alt="Logo">
        <h1>Zachary Tucker's Web Projects</h1>
    </div>

    <nav class="navbar">
        <a href="/index.php?page=index"
           class="<?= $page === 'index' ? 'active' : '' ?>">Home</a>

        <a href="/index.php?page=introduction"
           class="<?= $page === 'introduction' ? 'active' : '' ?>">Introduction</a>

        <a href="/index.php?page=contract"
           class="<?= $page === 'contract' ? 'active' : '' ?>">Contract</a>
    </nav>
</header>
