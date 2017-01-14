<?php

class presController {

    function newPresTable() 
    {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM prescription where status = 'new' or status='pending'";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
        <h2 style='text-align:center;'>New Prescriptions<h2>
        
        <table class='sortable'>
        <tr>
            <th><b>Prescription ID</b></th>
            <th><b>Customer email</b></th>
            <th><b>Date</b></th>
            <th><b>Status</b></th>           
        </tr>";

        while ($row = mysqli_fetch_array($resultq)) 
        {
            $result = $result . "
            <tr>
                <td><b>$row[0]</b></td>
                <td><b>$row[1]</b></td>
                <td><b>$row[2]</b></td>
                <td><b>$row[4]</b></td>
                <td><a href='viewPrescription.php?prescription_id=$row[0]'><img  class='confirm' src='../public/image/view.png' style='width: 25px; height: 25px;'></a></td>
                <td><a href='#'><img  class='confirm' src='../public/image/reject.png' style='width: 25px; height: 25px;'></a></td>
                
             </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }
    
    function newPresView($id) 
    {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM prescription where status = 'new' status='pending'";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h2 style='text-align:center;'>New Prescriptions<h2>
        
        <table class='sortable'>
        <tr>
            <th><b>Prescription ID</b></th>
            <th><b>Customer email</b></th>
            <th><b>Date</b></th>
            <th><b>Status</b></th>
        </tr>";

        while ($row = mysqli_fetch_array($resultq)) 
        {
            $result = $result . "
            <tr>
                <td><b>$row[0]</b></td>
                <td><b>$row[1]</b></td>
                <td><b>$row[2]</b></td>
                <td><b>$row[4]</b></td>
                <td><a href='viewPrescription.php'><img  class='confirm' src='../public/image/view.png' style='width: 25px; height: 25px;'></a></td>
                <td><a href='#'><img  class='confirm' src='../public/image/reject.png' style='width: 25px; height: 25px;'></a></td>
                
             </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }

}

?>
