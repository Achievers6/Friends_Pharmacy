<?php

$med_type = $_GET['medtype'];
$search = $_GET['search'];

//$conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
include '../database/dbconnect.php';
if (!$mysqli) {
    echo "Error";
}

switch($med_type) {
  
    case '1': {
        $sql = "SELECT * FROM stock s, drug d WHERE s.medicine_name=d.medicine_name AND  d.medicine_name LIKE '$search%'";
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res_data, $row);
        }
        echo(json_encode($res_data));
    }
    break;
    case '2': {
        $sql = "SELECT * FROM stock s, drug d WHERE s.medicine_name=d.medicine_name AND  s.batch_no LIKE '$search%'";
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            
            array_push($res_data, $row);
        }
        echo(json_encode($res_data));
    }
    break;
    case '3': {
        $sql = "SELECT * FROM stock s, drug d WHERE s.medicine_name=d.medicine_name AND s.category LIKE '$search%'";
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            
            array_push($res_data, $row);
        }
        echo(json_encode($res_data));
    }
        
        
    break;
    default: {
        
    }
}

?>