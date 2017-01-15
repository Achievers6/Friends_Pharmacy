<DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../public/css/web/member.css" type="text/css" />

</head>

<body>


<?php

include 'template.php';

?>

<form action="" method="POST" enctype="multipart/form-data">
	<table>
	
		<tr><td>First Name: </td><td> <input type="text" name="fname" required="required"></td></tr>
		<tr><td>Last Name: </td><td> <input type="text" name="lname" required="required"></td></tr>
		<tr><td>Gender: </td><td> <Input type="radio" name="gender" value="male" required="required">Male</td>
							 <td> <Input type="radio" name="gender" value="female" required="required">Female</td></tr>
		<tr><td>Birthday: </td><td> <input type="date" name="bday" required="required"></td></tr>
		<tr><td>NIC: </td><td> <input type="text" name="nic" required="required"></td></tr>
		<tr><td>Address:</td><td> <textarea rows="3" cols="50" name="address" required="required"></textarea></td></tr>
		<tr><td>Contact Number:</td><td> <input type="tel" name="contact" required="required"></td></tr>
		<tr><td>Email:</td><td> <input type="email" name="email" required="required"></td></tr>
		<tr><td>Password:</td><td> <input type="password" name="password" required="required"></td></tr>
		<tr><td>Occupation: </td>
		<td><Input type="radio" name="occupation" value="assistant" required="required">Assistant</td>
								 <td> <Input type="radio" name="occupation" value="cashier" required="required">Cashier</td></tr>
		<tr><td>Joining Date: </td><td> <input type="date" name="date" required="required"></td></tr>
		<tr><td><input type="submit" name="submit" id="submit"></td></tr>
	</table>			
</form>

<?php

if(isset($_POST['submit']))
{
	//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
	include '../database/dbconnect.php';
        
	$first = mysqli_real_escape_string($mysqli, $_POST['fname']);
	$last = mysqli_real_escape_string($mysqli, $_POST['lname']);
	$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
	$bday = mysqli_real_escape_string($mysqli, $_POST['bday']);
	$nic = mysqli_real_escape_string($mysqli, $_POST['nic']);
	$address = mysqli_real_escape_string($mysqli, $_POST['address']);
	$contact = mysqli_real_escape_string($mysqli, $_POST['contact']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$password = mysqli_real_escape_string($mysqli, $_POST['password']);
	$occupation = mysqli_real_escape_string($mysqli, $_POST['occupation']);
	$join_date = mysqli_real_escape_string($mysqli, $_POST['date']);	

	//check user already exists by checking the NIC
	$query = mysqli_query($mysqli, "SELECT * FROM staff WHERE nic='$nic'");
	$rows = mysqli_num_rows($query);
	if($rows > 0)
	{
		echo'<script>alert("This NIC already exists."); window.location.href="members.php";</script>';
		exit();
	}
	else
	{
		$encrypt_password=md5($password);
		$sql = "INSERT INTO customer (first_name, last_name, gender, birthday, nic, address, contact_number, email, password, occupation, start_date) VALUES ('$first', '$last', '$gender', '$bday', '$nic', '$address', '$contact', '$email', '$encrypt_password', '$occupation', '$join_date')";
		
		
		if(mysqli_query($mysqli, $sql))
	    {
	    	echo'<script>alert("New member added successfully."); window.location.href="members.php";</script>';  
	    }
	    else
	    {
	    	echo '<script>alert("Error adding new member."); window.location.href="members.php";</script>';
	    }

	    mysqli_close($mysqli);	
	}
}

?>
</body>
</html>