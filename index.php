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
    <script src="lib/anime.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <title>Главная страница</title>
    </head>
    <body>

        <!-- LOADING -->
        <div class="loading">
            <span class = "wheel"></span>
            <script src="js/loading.js"></script>
        </div>

        <!-- NAVBAR -->
        <nav class="navbar is-light" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                </a>

                <a role="button" onclick="document.querySelector('#navMenu').classList.toggle('is-active');this.classList.toggle('is-active');" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navMenu" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item">
                        Главная
                    </a>

                    <a class="navbar-item" href='?page=cars'>
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
                            <a class="button is-link is-rounded">
                                <span class="icon is-small">
                                    <i class="fas fa-user"></i>
                                </span>
                            <strong><?php ?>Добро пожаловать, <?= $login ?></strong>
                            </a>
                            <a href="/logout.php" class="button is-link is-inverted is-rounded">
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

        <!-- main-container -->
        <div id="main_container" class="columns main-container">
            
        </div>

    </body>
    <script src="js/page_changer.js"></script>
    <?php
        switch ($_GET['page']){
            case "cars":
                echo('<script>getPage("cars");</script>');
                break;
            case "add_car":
                echo('<script>getPage("add_car");</script>');
                break;
            case "car":
                $id = $_GET['id'];
                echo "<script>getPage('car', $id);</script>')";
                break;
        }
    ?>
</html>