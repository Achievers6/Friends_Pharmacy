<?php

$duration = $_GET['duration'];
$medicine = $_GET['medicine'];

$date = date_create(date("o-m-d"));

date_sub($date,date_interval_create_from_date_string($duration . " days"));

include '../database/dbconnect.php';

$sql = "SELECT * FROM bill_table b, selling_table s WHERE b.bill_number=s.bill_number AND b.date='" . date_format($date,"Y-m-d") . "' AND s.medicine_name='$medicine'";

$result = mysqli_query($mysqli, $sql);
$arr = array();

while (($row = mysqli_fetch_assoc($result))) {
    array_push($arr, $row);
}

echo json_encode($arr);

?>