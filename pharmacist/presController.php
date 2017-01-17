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
     
        include '../database/dbconnect.php';

        

        

        $sql = "SELECT * FROM Prescription WHERE prescription_id='$no'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result) ;
           $result= "
                <style>
                #myImg {
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
                }

                #myImg:hover {opacity: 0.7;}
                #myImg {
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            #myImg:hover {opacity: 0.7;}

            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }

            /* Modal Content (image) */
            .modal-content {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
            }

            /* Caption of Modal Image */
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }

            /* Add Animation */
            .modal-content, #caption {    
                -webkit-animation-name: zoom;
                -webkit-animation-duration: 0.6s;
                animation-name: zoom;
                animation-duration: 0.6s;
            }
            
            @-webkit-keyframes zoom {
                from {-webkit-transform:scale(0)} 
            to {-webkit-transform:scale(1)}
            }

            @keyframes zoom {
                from {transform:scale(0)} 
            to {transform:scale(1)}
            }

            /* The Close Button */
            .close {
                position: absolute;
                top: 15px;
                right: 35px;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;
            }

            .close:hover,
            .close:focus {
                color: #bbb;
                text-decoration: none;
                cursor: pointer;
            }

            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
                .modal-content {
                    width: 100%;
                }
            }
            #btnr {
                width: 100px;
                height: 
                </style>
		<div class='image'>
			<img id='myImg' src='../customer/uploads/" . $row['image'] . "' style='position: absolute;
                left: 840px;
                width: 300px;
                height: 400px;
                top:200px;'>
		</div>
                <div id='myModal' class='modal'>
                <span class='close'>&times;</span>
                <img class='modal-content' id='img01'>
                <div id='caption'></div>
            </div>
                
                        
";
        
        

$result =$result. "

<h2 style='text-align:center;'>Order List - $no<h2>
        <table class='sortable' style='width:700px; position:absolute; right:400px;'>
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
        $message = "Dear " . $fname ." ". $lname .", ". $msg;

        include '../msg/example.php';
        $text = new text();
        $no =  "94".substr($cno, 1);

        $text->msg($no, $message);

        }

        }
        ?>
