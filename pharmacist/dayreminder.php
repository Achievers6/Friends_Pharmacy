<?php

include ("../Entities/dayreminderEntity.php");
require 'msg/example.php';
//set defalt time zone ti asia/colombo
date_default_timezone_set('Asia/Colombo');
//create connection
include '../database/dbconnect.php';
//get the current day,hour and minute
$curhour = date("H");
$m = date("i");
$curdate = date('y:m:d');
//get the values from db 
$query = "SELECT * FROM reminderday where enddate>CURDATE() AND ((time1=$curhour AND min1=$m) OR (time2=$curhour AND min2=$m) OR (time3=$curhour AND min3=$m))";
$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
$reminderArray = array();
while ($row = mysqli_fetch_array($result)) {

    $reminder_id = $row[0];
    $nic = $row[1];
    $contactno = $row[2];
    $medname = $row[3];
    $instruction = $row[4];
    $quantity = $row[5];
    $time1 = $row[6];
    $time2 = $row[7];
    $time3 = $row[8];
    $startdate = $row[9];
    $enddate = $row[10];

    //Create stock objects and store them in an array.
    $dayreminder = new dayreminderEntity($reminder_id, $nic, $contactno, $medname, $instruction, $quantity, $time1, $time2, $time3, $startdate, $enddate);
    array_push($reminderArray, $dayreminder);
}
//close connection
mysqli_close($mysqli);
print_r($reminderArray);

$text = new text();
//create msg object and send 
foreach ($reminderArray as $key => $dayreminder) {
    echo $dayreminder->medname;
    echo $dayreminder->contactno;
    echo $dayreminder->instruction;
    echo $dayreminder->quantity;
    echo $dayreminder->time;

    $text->msg($dayreminder->medname, $dayreminder->instruction, $dayreminder->quantity, $dayreminder->time,$dayreminder->contactno);
    //$reminder->contactno
}
?>
