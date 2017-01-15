<DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/member.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--     <script src="js/jquery-3.1.0.min.js"></script>-->
    <?php require('../includes/_header.php'); ?>
    <script src="js/jquery.validate.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/members.js"></script>
    
    <style>
             .error {
                color: #ff0000;
}

            label.error {
                display:block;
                height:17px;
                margin-left:9px;
                font-size:15px;
                position:relative;
                top:1px;


            }


</style>
     
</head>

<body>
     <h2>Add a member</h2> 
<?php
 require_once("../includes/navigation.php");
?>
   
    <div id="d1">
    <form action="newMember.php" method="POST" id="main" enctype="multipart/form-data">
<fieldset>
    <center>
	<table>
	
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>First Name </td>
            <td> <input type="text" name="fname" ></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Last Name </td>
            <td> <input type="text" name="lname" ></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Gender </td>
            <td> <Input type="radio" name="gender" value="male" checked>Male</td>
            <td> <Input type="radio" name="gender" value="female" >Female</td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Birthday </td>
            <td> <input type="text" id="bday" name="bday"></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>NIC </td>
            <td> <input type="text" name="nic" ></td>
        </tr>
		
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Address</td>
            <td> <textarea rows="4" cols="30" name="address" ></textarea></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Contact Number</td>
            <td> <input type="tel" name="contact" ></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Email</td>
            <td> <input type="email" name="email"></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Password</td>
            <td> <input type="password" name="password"></td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Occupation </td>
            <td> <Input type="radio" name="occupation" value="pharmacist" checked >Pharmacist</td>
            <td> <Input type="radio" name="occupation" value="assistant">Assistant</td>
            <td> <Input type="radio" name="occupation" value="cashier" >Cashier</td>
        </tr>
		<tr height="50px">
            <td><span class="star" style="color:red">*</span>Joining Date </td>
            <td> <input type="date" name="date"></td></tr>
		<tr>
            <td><input type="submit" name="submit" id="submit"></td>
        </tr>
	</table>
        </center>
    </fieldset>
	</form>
    



</div>

</body>
</html>
    <!-- <script>
 $(function() {
    $( "#bday" ).datepicker({  maxDate: new Date() });
  });
    </script>

 -->