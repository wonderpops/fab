<?php 
    $servername = "localhost"; 
    $username = "fab"; 
    $password = "10502248Ss"; 
    $db = "fab"; 
    
    $conn = mysqli_connect($servername, $username, $password, $db); 

    if (!$conn){ 
        die("connection failed: ". mysqli_connect_error()); 
    } 
?>