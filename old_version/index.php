<?php
    require __DIR__ . '/auth.php';
    $login = getUserLogin();
    if (getUserLogin() == null) {
        header('Location: /login.php');
    }
    echo '<script src="http://code.jquery.com/jquery-latest.js"></script>';
    echo '<script src="js/page_changer.js"></script>';
    echo '<script src="js/functions.js"></script>';
    if ($_GET['page'] == ''){
        $_GET['page'] = 'home';
    }
    $page = $_GET['page'];
    $type = $_GET['type'];
    $id = $_GET['id'];
    if (is_null($id)){
        echo "<script>window.addEventListener('load', function(event){getPage('$page');history.replaceState({page: '$page'}, '', '?page=$page');});</script>";
    } else {
        echo "<script>window.addEventListener('load', function(event){getPage('$page');history.replaceState({page: '$page'}, '', '?page=$page');getItem('$type',$id);history.pushState({page: '$page', type: '$type', id: $id}, '', '?page=$page&type=$type&id=$id');});</script>";
    }
    
?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=500, initial-scale=0.7 user-scalable=No">
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

                <a id="burger_button" role="button" onclick="document.querySelector('#navMenu').classList.toggle('is-active');this.classList.toggle('is-active');" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navMenu" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item unselectable" onclick="document.querySelector('#navMenu').classList.toggle('is-active');document.querySelector('#burger_button').classList.toggle('is-active');getPage('home');history.pushState({page: 'home'}, '', '?page=home');">
                        Главная
                    </a>

                    <a class="navbar-item unselectable" onclick="document.querySelector('#navMenu').classList.toggle('is-active');document.querySelector('#burger_button').classList.toggle('is-active');getPage('cars');history.pushState({page: 'cars'}, '', '?page=cars');">
                        Машины
                    </a>

                    <a class="navbar-item unselectable">
                        Поиск
                    </a>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link unselectable" onclick="document.querySelector('#navMenu').classList.toggle('is-active');document.querySelector('#burger_button').classList.toggle('is-active');getPage('parts');history.pushState({page: 'parts'}, '', '?page=parts');">
                            Детали
                        </a>

                        <div class="navbar-dropdown unselectable">
                            <a class="navbar-item unselectable">
                                На складе
                            </a>
                            <a class="navbar-item unselectable">
                                Проданные
                            </a>
                            <a class="navbar-item unselectable">
                                Все
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item unselectable">
                                Report an issue
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-link is-rounded unselectable">
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

        <!-- modal-container -->
        <div id="modal_container" class="modal">
                <div class="modal-background" onclick="document.querySelector('#modal_container').classList.toggle('is-active');history.back();"></div>
                <div id="modal_content" class="modal-content">
                    <p class="image is-4by3">
                        <img src="https://bulma.io/images/placeholders/1280x960.png" alt="">
                    </p>
                </div>
                <button class="modal-close is-large" aria-label="close" onclick="document.querySelector('#modal_container').classList.toggle('is-active');history.back();"></button>
        </div>

    </body>
</html>