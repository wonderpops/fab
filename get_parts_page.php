<?php
include 'db_connect.php';

$name = $_GET['frequest'];

$sql = "SELECT * FROM `parts`";
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
        <table class="table is-fullwidth">
        <thead>
            <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Машина</th>
            <th>Дата</th>
            <th>Стоимость</th>
            <th>Характеристики</th>
            </tr>
        </thead>
        <tbody>');

while ($row = mysqli_fetch_assoc($result)) {
    $car_id = $row['car'];
    $sql = "SELECT * FROM `cars` WHERE `id`=$car_id";
    $car = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    echo('<tr>');

    echo('<td>');
        echo $row['id'];
            echo('</td>');

    echo('<td><a href="http://fab:81/index.php?page=part&id=');
        echo $row['id'];
            echo('">');
                echo $row['name'];
                    echo('</a>');
    
    echo('<td><a href="http://fab:81/index.php?page=car&id=');
    echo $row['car'];
        echo('">');
            echo $car['name'];
                echo('</a>');

    echo('<td>');
        echo $row['date'];
            echo('</td>');

    echo('<td>');
        echo $row['cost'];
            echo(' руб.</td>');

    echo('<td>');
        echo $row['specification'];
            echo('</td>');

    echo('</tr>');
}
echo('</tbody></table></div>');

?>