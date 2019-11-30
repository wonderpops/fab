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

    <!-- NAVBAR -->
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Главная
                </a>

                <a class="navbar-item">
                    Машины
                </a>

                <a class="navbar-item">
                    Поиск
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Детали
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            На складе
                        </a>
                        <a class="navbar-item">
                            Проданные
                        </a>
                        <a class="navbar-item">
                            Все
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-link">
                            <span class="icon is-small">
                                <i class="fas fa-user"></i>
                            </span>
                        <strong><?php ?>Добро пожаловать, <?= $login ?></strong>
                        </a>
                        <a href="/logout.php" class="button is-link is-inverted">
                            <span class="icon is-small">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <strong>Выйти</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    </body>
</html>