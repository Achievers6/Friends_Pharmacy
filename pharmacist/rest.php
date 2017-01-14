<?php

//$conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
include '../database/dbconnect.php';
if (!$mysqli) {
    echo "Error";
}

$sql = "SELECT * FROM stock s, drug d WHERE s.medicine_name=d.medicine_name";
$result = mysqli_query($mysqli, $sql);
$res_data = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($res_data, $row);
}
echo(json_encode($res_data));


?>