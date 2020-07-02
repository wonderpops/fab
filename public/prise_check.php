<?php
$servername = "localhost"; 
$username = "fab"; 
$password = "10502248Ss"; 
$db = "fab";
$conn = mysqli_connect($servername, $username, $password, $db);

$query = $_POST['query'];
$part_id = $_POST['part_id'];

 exec("python3 parser/main.py '$query' '$part_id' 2>&1", $output, $return_var);
 //var_dump($output);
$query = str_replace(' ', '_',$query);
$path = "parser/searches/part_$part_id"."[$query].json";
$path = mb_convert_encoding($path, 'utf-8', mb_detect_encoding($path));
$j = file_get_contents($path); 
$j = json_decode($j);
echo json_encode($j);
?>