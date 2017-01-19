<?php

include ("../Entities/reminderEntity.php");
require 'msg/example.php';
//set defalt time zone ti asia/colombo
date_default_timezone_set('Asia/Colombo');
//create connection
include '../database/dbconnect.php';
//get the current day,hour and minute
$today = date("l");
$curhour = date("H");
$minutes = date("i");

//get the values from db 
$query = "SELECT * FROM reminderweekday where $today=1 AND time=$curhour AND min=$minutes";
$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
$reminderArray = array();
while ($row = mysqli_fetch_array($result)) {

    $reminder_id = $row[0];
    $nic = $row[1];
    $contactno = $row[2];
    $medname = $row[3];
    $instruction = $row[4];
    $quantity = $row[5];
    $time = $row[6];
    $startdate = $row[7];
    $enddate = $row[8];
    $Monday = $row[9];
    $Tuesday = $row[10];
    $Wednesday = $row[11];
    $Thursday = $row[12];
    $Friday = $row[13];
    $Saturday = $row[14];
    $Sunday = $row[15];

    //Create stock objects and store them in an array.
    $reminder = new reminderEntity($reminder_id, $nic, $contactno, $medname, $instruction, $quantity, $time, $startdate, $enddate, $Monday, $Tuesday, $Wednesday, $Thursday, $Friday, $Saturday, $Sunday);
    array_push($reminderArray, $reminder);
}
//close connection
mysqli_close($mysqli);


print_r($reminderArray);

//print_r($reminderArray);
$text = new text();
foreach ($reminderArray as $key => $reminder) {
    echo $reminder->medname;
    echo $reminder->contactno;
    echo $reminder->instruction;
    echo $reminder->quantity;
    echo $reminder->time;

    $text->msg($reminder->medname, $reminder->instruction, $reminder->quantity, $reminder->time, $reminder->contactno);
    //$reminder->contactno 
}






















