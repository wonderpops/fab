<?php

function checkAuth(string $login, string $password): bool 
{
    $servername = "localhost"; 
    $username = "root"; 
    $passwordd = ""; 
    $db = "fab"; 
    $mysqli =  mysqli_connect($servername, $username, $passwordd, $db);
    $sql = "SELECT * FROM   users";
    $result = mysqli_query($mysqli, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["login"] === $login
            && $row["password"] === $password) {
                return true;
            }
    }
    


    return false;
}

function getUserLogin()
{
    $loginFromCookie = $_COOKIE['login'] ?? '';
    $passwordFromCookie = $_COOKIE['password'] ?? '';

    if (checkAuth($loginFromCookie, $passwordFromCookie)) {
        return $loginFromCookie;
    }

    return NULL;
}