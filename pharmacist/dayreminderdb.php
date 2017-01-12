<?php
//$con= mysqli_connect("localhost", "root", "", "friends_pharmacy");
include '../database/dbconnect.php';
if(!$mysqli) {
    die("Connection failed");
}
$sid='';
switch ($_GET['type']) {
    case 'get' : {
      $search = $_GET['search'];

$sql = "SELECT reminderday.nic,reminderday.contactno,reminderday.medname,reminderday.instruction,reminder.quantity,reminder.time1,reminder.time2,reminder.time3,reminder.startdate,reminder.enddate FROM reminderday INNER JOIN customer reminderday.nic= customer.nic AND customer.first_name LIKE '%$search%'";
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res_data, $row);
        
        
        }
        }
    

    echo (json_encode($res_data)); 
    }


       
?>