<?php
    include 'db_connect.php';
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $today = date('Y-m-d');

    $query ="INSERT INTO cars VALUES(NULL, '$name', '$today', '$comment')";
    $result = mysqli_query($conn, $query);
    if($result)
    {
        echo "ok";
    }
?>