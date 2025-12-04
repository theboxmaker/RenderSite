<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
    <title><?= $title ?? 'Zany Terrapin Used Cars' ?></title>
</head>
<body>

<?php include APP_PATH . '/views/header.php'; ?>

<main class="container">
    <?= $content ?>
</main>

<?php include APP_PATH . '/views/footer.php'; ?>

</body>
</html>
