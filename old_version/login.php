<?php
if (!empty($_POST)) {
    require __DIR__ . '/auth.php';

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    if (checkAuth($login, $password)) {
        setcookie('login', $login, 0, '/');
        setcookie('password', $password, 0, '/');
        header('Location: /index.php');
    } else {
        $error = 'Ошибка';
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=500, initial-scale=0.7 user-scalable=No">
    <script src="lib/anime.min.js"></script>
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.4.1.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Форма авторизации</title>
</head>
<body>

    <!-- LOADING -->
    <div class="loading">
        <span class = "wheel"></span>
        <script src="js/loading.js"></script>
    </div>
        
<?php if (isset($error)): ?>
<?php endif; ?>
<form class="form" action="/login.php" method="post">
            <div class="box">
                <p class="title is-2 is-spaced">Вход</p>
                <div class="login">
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input is-link" name="login" id="login" placeholder="Login">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input is-link" type="password" name="password" id="password" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                        </p>
                    </div>
                    <span style="color: red;"><?= $error ?></span>
                    <br>
                    <div class="field has-addons has-addons-centered">
                        <button class="button is-link is-light is-medium" value="Войти">Войти</button>
                    </div> 
                </div>
            </div>
        </div>
</form>
</body>
<script src="js/animations.js"></script>
</html>