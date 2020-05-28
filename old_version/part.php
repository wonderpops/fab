<?php
    include 'db_connect.php';
    $id = $_POST['id'];

    $query ="SELECT * FROM `parts` WHERE `id`=$id";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $sql = "SELECT * FROM `cars` WHERE `id`=$id";
        $car = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        $type_id = $row['type'];
        $sql = "SELECT * FROM `parts_types` WHERE `id`=$type_id";
        $type = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        $table_name = $type['table_name'];
        $sql = "SELECT * FROM $table_name WHERE `part_id`=$id";
        $part_fields = mysqli_fetch_assoc(mysqli_query($conn, $sql));

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
                        <label class="label">Тип</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" placeholder="Medium sized input" value="'); echo $type['name']; echo('" disabled>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-medium">
                        <label class="label">Машина</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" placeholder="Medium sized input" value="'); echo $car['name']; echo('" disabled>
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
                <div class="field is-horizontal">
                    <div class="field-label is-medium">
                        <label class="label">Стоимость</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" placeholder="Medium sized input" value="'); echo $row['cost']; echo('" disabled>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>');

            for (Reset($part_fields); ($k = key($part_fields)); Next ($part_fields)){
                
                echo('<div class="field is-horizontal">
                    <div class="field-label is-medium">
                        <label class="label">'); echo $k; echo('</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <div class="control">
                            <input name="field" class="input is-medium" type="text" value="'); echo $part_fields[$k]; echo('" disabled>
                        </div>
                        </div>
                    </div>
                </div>');
            }

            echo ('</div><footer class="card-footer"><a id="editBtn" class="card-footer-item" onclick="editOnClick()">Редактировать</a></footer>
            
        </div>
        </div>
        <div class="column is-2"></div>');
    }
?>