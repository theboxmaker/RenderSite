<link rel="stylesheet" href="/styles/default.css">

<header> 
    <div class="header">
        <img class="logo" src="/images/favicon.png" alt="TuckTech Logo">
        <h1>Zachary Tucker's Web Projects</h1>
    </div>

    <nav class="navbar">

        <a href="/index.php?page=index"
           class="<?= $page === 'index' ? 'active' : '' ?>">Home</a>

        <a href="/index.php?page=introduction"
           class="<?= $page === 'introduction' ? 'active' : '' ?>">Introduction</a>

        <a href="/index.php?page=contract"
           class="<?= $page === 'contract' ? 'active' : '' ?>">Contract</a>

        <a href="/index.php?page=introform"
           class="<?= $page === 'introform' ? 'active' : '' ?>">Intro Form</a>

        <a href="/index.php?page=login"
            class="<?= $page === 'login' ? 'active' : '' ?>">Login Demo</a>
        
         <a href="/index.php?page=climb_list"
           class="<?= $page === 'climb_list' ? 'active' : '' ?>">Climbing Log</a>

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

        <div class="dropdown">
            <button class="dropbtn">Projects Pt. 2 ▼</button>
            <div class="dropdown-content">
                <a href="/contents/fizzbuzz.html">FizzBuzz</a>
            </div>
        </div>

        <?php if (!isset($_SESSION['climb_user'])): ?>
            <a href="/index.php?page=login">Login</a>
            <a href="/index.php?page=register">Register</a>
        <?php else: ?>
            <span>Welcome, <?= htmlspecialchars($_SESSION['climb_user']['username']) ?></span>
            <a href="/index.php?page=climb_add">Add Climb</a>
            <a href="/index.php?page=logout">Logout</a>
        <?php endif; ?>

    </nav>
</header>
