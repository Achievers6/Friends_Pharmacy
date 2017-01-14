<?php

include '../database/dbconnect.php';
if(!$mysqli){

}

$nic = $_POST['nic'];
$medname = $_POST['medname'];
$duration = $_POST['duration'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];

$sql = "INSERT INTO reminder_table (NIC, medicine_name, duration, start_date, end_date) values ('$nic','$medname','$duration','$sdate','$edate')";
//echo $sql;
mysqli_query($mysqli, $sql);

?>