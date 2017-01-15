<script>
    function removeConfirm(no)
    {
        // build the confirmation box
        var c = confirm("You wish to remove the order?");

        // if true, delete item and refresh
        if (c)
            window.location = "confirmedPres.php?del=" + no;
    }
</script>

<?php

class presController {

    function newPresTable() {
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

        while ($row = mysqli_fetch_array($resultq)) {
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

    function newPresView($id) {
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

        while ($row = mysqli_fetch_array($resultq)) {
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

    function reject($no) {
        include '../database/dbconnect.php';
        $query = "update prescription set status='reject' where prescription_id = $no";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        mysqli_close($mysqli);
    }

    function conPresTable() {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM prescription where status = 'confirmed'";
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

        while ($row = mysqli_fetch_array($resultq)) {
            $result = $result . "
            <tr>
                <td><b>$row[0]</b></td>
                <td><b>$row[1]</b></td>
                <td><b>$row[2]</b></td>
                <td><b>$row[4]</b></td>
                <td><a href='confirmedPres.php?pres_no=$row[0]&confirm=1' style='color:blue;'>List items</td>
                    <td><a href='confirmedPres.php?smsemail=$row[1]&presNo=$row[0]'><img  class='confirm' src='../public/image/sms.png' style='width: 40px; height: 40px;'></a></td>
                    <td><a href='billprestmp.php?pres_no=$row[0]&email=$row[1]'><img  class='confirm' src='../public/image/bill.png' style='width: 40px; height: 40px;'></a></td>
                    <td><a onClick=removeConfirm($row[0])><img  class='confirm' src='../public/image/remove.png' style='width: 25px; height: 25px;'></a></td>
                    
             </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }

    function presListTable($no) {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM prescription_items where pres_id = '$no'";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h2 style='text-align:center;'>Order List - $no<h2>
        <table class='sortable'>
                <tr>
                   
                    <th><b>Medicine name</b></th>
                    <th><b>Dosage</b></th>
                    <th><b>unit price (Rs)</b></th>
                    <th><b>Quantity</b></th>
                    <th><b>Amount (Rs)</b></th>
                </tr>";
        while ($row = mysqli_fetch_array($resultq)) {
            $medname = $row[1];
            $queryp = "SELECT price FROM drug_price where medicine_name = '$medname' and dosage = '$row[2]' ";
            $resultp = mysqli_query($mysqli, $queryp) or die(mysqli_error($mysqli));
            $rowp = mysqli_fetch_array($resultp);
            $amount = $row[3] * $rowp[0];
            $result = $result . "
                <tr>
                    
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$rowp[0]</b></td>
                    <td><b>$row[3]</b></td>
                    <td><b>$amount</b></td>
                </tr>
";
        }
        $result = $result . "</table>";
        return $result;
    }
    function sendsms($email, $msg) {
        include '../database/dbconnect.php';
        $query2 = "SELECT first_name,last_name,contact_number FROM customer where email = '$email'";
        $result2 = mysqli_query($mysqli, $query2) or die(mysqli_error($mysqli));
        $row2 = mysqli_fetch_array($result2);
        $fname = $row2["first_name"];
        $lname = $row2["last_name"];
        $cno = $row2["contact_number"];
        $message = "Dear " . $fname . $lname ." ". $msg;
        
        include '../msg/example.php';
        $text = new text();
        $no =  "94".substr($cno, 1);
        
        $text->msg($no, $message);
        echo '<script language="javascript">';
        echo 'alert("Confirmed prescription order has been sent successfully by SMS")';
        echo '</script>';
    }

}
?>
