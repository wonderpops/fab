<?php
    include 'db_connect.php';
    $id = $_POST['id'];

    $query ="SELECT * FROM `cars` WHERE `id`=$id";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        echo('<div class="column is-2"></div>
    <div class="column">
    <div class="card">
        <div class="card-content">
            <div class="media">
            <div class="media-left">
                <img src="https://bulma.io/images/placeholders/256x256.png">
            </div>
            <div class="media-content">
                <div class="field is-horizontal">
                    <div class="field-label is-medium">
                        <label class="label">Название</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" placeholder="Medium sized input" value="'); echo $row['name']; echo('" disabled>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-medium">
                        <label class="label">Комментарий</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" placeholder="Medium sized input" value="'); echo $row['comment']; echo('" disabled>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-medium">
                        <label class="label">Дата</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" placeholder="Medium sized input" value="'); echo $row['date']; echo('" disabled>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>');

            $sql = "SELECT * FROM `parts` WHERE `car`=$id";
            $result = mysqli_query($conn, $sql);

            echo('
        <table class="table is-fullwidth">
        <thead>
            <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Тип</th>
            <th>Дата</th>
            <th>Стоимость</th>
            </tr>
        </thead>
        <tbody>');

        while ($row = mysqli_fetch_assoc($result)) {

            $part_id = $row['type'];
            $sql = "SELECT * FROM `parts_types` WHERE `id`=$part_id";
            $type = mysqli_fetch_assoc(mysqli_query($conn, $sql));

            echo('<tr>');

            echo('<td>');
                echo $row['id'];
                    echo('</td>');

            echo('<td><a href="http://fab:81/index.php?page=part&id=');
                echo $row['id'];
                    echo('">');
                        echo $row['name'];
                            echo('</a>');

            echo('<td>');
                echo $type['name'];
                    echo('</td>');

            echo('<td>');
                echo $row['date'];
                    echo('</td>');

            echo('<td>');
                echo $row['cost'];
                    echo(' руб.</td>');

            echo('</tr>');
        }

        echo('</tbody></table><a name="field" class="button is-link is-light is-fullwidth" disabled>Добавить деталь</a>');
        echo ('</div><footer class="card-footer"><a id="editBtn" class="card-footer-item" onclick="editOnClick()">Редактировать</a></footer>
            
        </div>
        </div>
        <div class="column is-2"></div>');
    }
?>