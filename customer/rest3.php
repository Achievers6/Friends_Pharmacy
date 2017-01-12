<?php

$nic = $_GET['nic'];
$type = $_GET['type'];

//$conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
include '../database/dbconnect.php';
if (!$mysqli) {
    echo "Error";
}



switch($type) {
    case 'search': {

        // Setup limit suffix
        $limit = '';
		$suffix = '';
        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
			if ($limit !== "all") {
    	        $suffix = ' LIMIT ' . $limit;
	        }
        }
    
        if(isset($_GET['active'])) {
            $active = $_GET['active'];
            $sql = "SELECT * FROM customer WHERE nic LIKE '$nic%' AND active=$active";
        } else {
            if ($nic !== '') {
                $sql = "SELECT * FROM customer WHERE nic LIKE '$nic%'";
            } else {
                $sql = "SELECT * FROM customer";
            }
        }
        $sql .= $suffix;
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            
            array_push($res_data, $row);
        }
        echo(json_encode($res_data));
    }
    break;
    case 'details': {
        $sql = "SELECT * FROM reminder_table WHERE nic = '$nic'";
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($res_data, $row);
        }
        echo(json_encode($res_data));
    }
    break;
    case 'changeActive': {
        $active = $_GET['active'];
        $sql = "UPDATE customer SET active=$active WHERE nic='$nic'";
        mysqli_query($mysqli, $sql);
    }
    break;
    case '2': {
        $sql = "SELECT * FROM stock s, drug d WHERE s.medicine_id=d.medicine_id AND  d.medicine_name LIKE '$search%'";
        $re10ult = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            
            array_push($res_data, $row);
        }
        echo(json_encode($res_data));
    }
    break;
    case '3': {
        $sql = "SELECT * FROM stock s, drug d WHERE s.medicine_id=d.medicine_id AND  d.batch_no LIKE '$search%'";
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
