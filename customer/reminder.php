<?php
        
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                /*$server = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'friends_pharmacy';

                //create connection
                $conn = mysqli_connect($server, $username, $password, $database);*/
                include '../database/dbconnect.php';

                //check connection
                if (!$mysqli){
                    die("Connection faied: ".mysqli_connect_error());
                }
//                echo "connected successfully";
                
                $nic = $_POST['nic'];
                $firstname = $_POST['fname'];
                $lastname = $_POST['lname'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];
             
               
                $sql = "INSERT INTO customer (nic,first_name,last_name,birthday,gender,email,contact_number) VALUES ('$nic', '$firstname', '$lastname', '$dob', '$gender', '$email', '$mobile')";

                if (mysqli_query($mysqli, $sql)) {
//                    echo "insert successful";
				} else {
//                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

            }
            header("Location: ../pharmacist/reminder2.php?nic=$nic&cno=$mobile");
        ?>
<html>
<head>
	
    <?php require('../includes/_header.php'); ?>
	<script src="js/jquery-2.0.0.js"></script>
        <script>
        function addReminder(){
            var nic = $("#nic").val();
            var medname = $("#medname").val();
            var duration = $("#duration").val();
            var sdate = $("#sdate").val();
            var edate = $("#edate").val();
            var medlist = document.getElementById("medlist");
            medlist.innerHTML += "<li>" + medname + "</li>";
            document.getElementById("rform").reset();

            var packet = {};
            packet['nic'] = nic;
            packet['medname'] = medname;
            packet['duration'] = duration;
            packet['sdate'] = sdate;
            packet['edate'] = edate;

            $.ajax({
                url: "addreminder.php",
                async: true,
                type: "POST",
                data: packet
            })
            .done(function(data){
                console.log(data);
            });
        }
            
        function cancel() {
            window.location = "../../main/main/main.php";
        }
            
        </script>
        <title>reminders</title>
</head>

<body style="text-align:center">
    
    <?php require_once("../includes/navigation.php") ?>
    
    <div style="height:80%; width:300px; position:absolute; right:10px;  margin-top:50px">
        <ul id="medlist">
            <li><b>Medicine Name</b></li>
        </ul>
    </div>
    
    
}
<style> 
    .customer_template_container {
    padding-left:13px;
    padding-top:20px;
    margin-top:2.28%;
    padding: 5px;
    }
 fieldset{
  border: none;
  width: 500px;
  margin:auto;
  text-align: center;
  border: 2px solid rgb(106,184,42);
  padding-top: 30px;
  padding-bottom: 20px;
  background-color: rgb(229, 249, 212);
  height:400px;
 
}
h2{
    position:relative;
    top:30px;
}
table{
    border-spacing: 28px;
}
#i1{
    position:relative;
    top:70px;
    height:30px;
    width: 50px;
}
#i2{
    position:relative;
    top:70px;
    height:30px;
    width: 50px;
}
    
 </style>
    <!--content goes here -->
    <h2>Add Reminders</h2>
    <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">
     <fieldset>
    <table style=" margin:0 auto">
       
    <form id="rform">
        <tr >
        <td>
         NIC 
        </td>
            <td><input type="text" name="nic" id="nic" value='<?php echo $_POST['nic']; ?>'></td>
        </tr>
        
        
        <tr >
            <td>
                Medicine Name </td>
            <td><input type="text" name="medname" id="medname"></td>
        </tr>
        
         <tr >
             <td>
                 Duration </td>
             <td>
                 <input type="number" name="duration" id="duration"></td>
            <td>
                <select name="dsuffix">
            <option value="hours">Hours</option>
            <option value="days">Days</option>
            <option value="month">Month</option>
                 </select>
             </td>
        </tr>
        
        <tr >
            <td>
                Starting Date </td>
            <td><input type="date" name="sdate" id="sdate"></td>
        </tr>
        
        <tr >
            <td>
                End Date </td>
            <td>
                <input type="date" name="edate" id="edate"></td>
        </tr>
        
        
        </form>
        </table>
        
        <input id="i1" type="button" value="Add" onclick="addReminder()">
        <input id="i2" type="button" value="Finish" onclick="cancel()">
       
     </fieldset>
        <?php // echo $content; ?>
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
</body>

</html>