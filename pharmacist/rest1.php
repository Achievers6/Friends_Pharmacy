<?php

$med_type = $_GET['medtype'];
$search = $_GET['search'];
$action = $_GET['action'];  
$period = $_GET['period'];
$date = date_create(date("o-m-d"));
switch($period) {
    case '1': {         date_sub($date,date_interval_create_from_date_string("365 days"));
    }
    break;
    case '2': {         date_sub($date,date_interval_create_from_date_string("30 days"));
    }
    break;
        case '3': {         date_sub($date,date_interval_create_from_date_string("7 days"));
    }
    break;
        case '4': {         date_sub($date,date_interval_create_from_date_string("1 days"));
    }
    break;
}
//$conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
include '../database/dbconnect.php';
if (!$mysqli) {
    echo "Error";
}
$sql = '';
switch($med_type) {
   
    case '1': {
        if($action == '1') {
            //  $sql = "SELECT * FROM purchasing p, drug d, stock s WHERE p.medicine_name = d.medicine_name AND s.medicine_name = d.medicine_name AND d.medicine_name LIKE '$search%' AND p.`date` > '" . date_format($date,"Y-m-d") . "'";
            $sql = "SELECT i.`date`, d.`medicine_name`, d.`medicine_name`, d.`category`, st.`batch_no`, d.`supplier_id`, st.`quantity`
             FROM invoice i, drug d, stock st 
             WHERE i.medicine_name = d.medicine_name AND d.medicine_name = st.medicine_name AND d.medicine_name LIKE '$search%' AND i.`date` > '" .  date_format($date,"Y-m-d") . "'";
        } else if($action == '2') {
            $sql = "SELECT s.`date`, s.`medicine_name`, d.`medicine_name`, d.`category`, st.`batch_no`, d.`supplier_id`, st.`quantity`
            FROM selling s, drug d, stock st 
            WHERE s.medicine_name = d.medicine_name AND s.medicine_name = st.medicine_name AND d.medicine_name LIKE '$search%' AND s.`date` > '" .  date_format($date,"Y-m-d") . "'";
        }        
    }
    break;
    case '2': {
        if($action == '1') {
             $sql = "SELECT i.`date`, d.`medicine_name`, d.`medicine_name`, d.`category`, st.`batch_no`, d.`supplier_id`, st.`quantity`
             FROM invoice i, drug d, stock st 
             WHERE i.medicine_name = d.medicine_name AND p.medicine_name = st.medicine_name AND st.`batch_no` LIKE '$search%' AND i.`date` > '" .  date_format($date,"Y-m-d") . "'";
        } else if($action == '2') {
            // $sql = "SELECT * FROM selling s, drug d, stock st WHERE d.medicine_name = s.medicine_name AND st.medicine_name = d.medicine_name AND s.batch_no LIKE '$search%'" ;
            $sql = "SELECT s.`date`, s.`medicine_name`, d.`medicine_name`, d.`category`, st.`batch_no`, d.`supplier_id`, st.`quantity`
            FROM selling s, drug d, stock st 
            WHERE s.medicine_name = d.medicine_name AND s.medicine_name = st.medicine_name AND st.`batch_no` LIKE '$search%' AND s.`date` > '" .  date_format($date,"Y-m-d") . "'";
        }    
    }
    break;
     case '3': {
        if($action == '1') {
            $sql = "SELECT i.`date`, d.`medicine_name`, d.`medicine_name`, d.`category`, st.`batch_no`, d.`supplier_id`, st.`quantity`
             FROM invoice i, drug d, stock st 
             WHERE i.medicine_name = d.medicine_name AND d.medicine_name = st.medicine_name AND d.medicine_name LIKE '$search%' AND i.`date` > '" .  date_format($date,"Y-m-d") . "'";
        } else if($action == '2') {
            $sql = "SELECT s.`date`, s.`medicine_name`, d.`medicine_name`, d.`category`, st.`batch_no`, d.`supplier_id`, st.`quantity`
            FROM selling s, drug d, stock st 
            WHERE s.medicine_name = d.medicine_name AND s.medicine_name = st.medicine_name AND d.medicine_name LIKE '$search%' AND s.`date` > '" .  date_format($date,"Y-m-d") . "'";
        }        
    }
    break;
    default: {
        
    }
}
echo $sql;
// echo "<br>";
$result = mysqli_query($mysqli, $sql);
echo($result);
$res_data = array();
while($row = mysqli_fetch_assoc($result)) {
    
    array_push($res_data, $row);
}
echo(json_encode($res_data));

?>