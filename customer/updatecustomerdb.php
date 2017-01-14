<?php
    //$con=mysqli_connect("localhost","root","", "friends_pharmacy") or die("couldn't connect ");
    include '../database/dbconnect.php';
    switch ($_GET['type']) {
    case 'get' : {
        $search = $_GET['search'];
        
        $sql = "SELECT * FROM customer WHERE `nic` LIKE '%$search%'";
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res_data, $row);
        }

        echo (json_encode($res_data));
    }
    break;
    case 'update': {
        // Update customer details
        $nic = $_GET['nic'];
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $email = $_GET['email'];
        $tp = $_GET['tp'];

        $sql = "UPDATE customer SET first_name='$fname', last_name='$lname', email='$email', contact_number='$tp' WHERE nic='$nic'";
        mysqli_query($mysqli, $sql);

        // Update reminders
        $reminders = $_GET['reminders'];
        for ($x = 0; $x <= count($reminders); $x++) {
            $remider_id = $reminders[$x]['reminder_id'];
            $medicine_name = $reminders[$x]['medicine_name'];
            $duration = $reminders[$x]['duration'];
            $start_date = $reminders[$x]['start_date'];
            $end_date = $reminders[$x]['end_date'];
            
            $sql1 = "UPDATE reminder_table SET medicine_name='$medicine_name', duration='$duration', start_date='$start_date', end_date='$end_date' WHERE reminder_id='$remider_id'";
            
            mysqli_query($mysqli,$sql1);    
        }
    }
    break;
}

?>
