<?php
    unset($_COOKIE['login']);
    setcookie('login', null, -1, '/');
    unset($_COOKIE['password']);
    setcookie('password', null, -1, '/');
    header('Location: /index.php');
?>