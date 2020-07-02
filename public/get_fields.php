<?php
$servername = "localhost"; 
$username = "fab"; 
$password = "10502248Ss"; 
$db = "fab";
$conn = mysqli_connect($servername, $username, $password, $db);

$type = $_POST['type'];
$fields = array();

$sql = "SELECT column_name,column_comment FROM information_schema.columns WHERE table_schema = 'fab' and table_name = '$type'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    array_push($fields, $row);
}

echo json_encode($fields);
?>