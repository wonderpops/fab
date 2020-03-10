<?php
include 'db_connect.php';

$name = $_GET['frequest'];

$sql = "SELECT * FROM `cars`";
$result = mysqli_query($conn, $sql);

echo('<div class="column is-2">
<nav class="panel panel_search">
    <p class="panel-heading">Поиск</p>
    <div class="panel-block">
        <p class="control has-icons-left">
        <input class="input" type="text" placeholder="Search">
        <span class="icon is-left">
            <i class="fas fa-search" aria-hidden="true"></i>
        </span>
        </p>
    </div>
    <p class="panel-tabs">
        <a class="is-active">Все</a>
        <a>Разбираются</a>
        <a>Разобранные</a>
    </p>
    <a class="panel-block is-active">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
    </a>
    <label class="panel-block">
        <input type="checkbox">
        remember me
    </label>
    <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
        Reset all filters
        </button>
    </div>
</nav>
</div>');

echo('<div class="column is-8">
        <div id = "main_contant" class = "main-contant">
            <div id="results" class="columns is-multiline">');

while ($row = mysqli_fetch_assoc($result)) {
    echo('<div class="column is-4">');
    echo('<div class="card ">
        <div class="card-image">');
        echo ('<img src="res/alloy-wheel.png"');
        echo('</img>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-content">
                    <p class="title is-4">');
                    echo $row['name'];
                    echo('</p>
                    <p class="subtitle is-6">');
                    echo $row['comment'];
                    echo('</p>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <a href="?page=car&id=');
            echo $row['id'];
            echo('" class="card-footer-item">Изменить</a>
        </footer>
    </div>');
    echo('</div>');
}
echo('</div></div></div>');

echo('<div class="column is-2">
<nav class="panel panel_search">
    <p class="panel-heading">Редактировать</p>
    <div class="panel-block">
        <a class="button is-link is-outlined is-fullwidth" href="?page=add_car">Добавить</a>
    </div>
    <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">Удалить</button>
    </div>
</nav>
</div>');
?>