<?php
    require __DIR__ . '/auth.php';
    $login = getUserLogin();
    if (getUserLogin() == null) {
        header('Location: /login.php');
    }
?>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <title>Главная страница</title>
    </head>
    <body>
        <?php if ($login === null): ?>
            <a href="/login.php">Авторизуйтесь</a>
        <?php else: ?>
            Добро пожаловать, <?= $login ?>
            <br>
            <a href="/logout.php">Выйти</a>
        <?php endif; ?>
    </body>
</html>