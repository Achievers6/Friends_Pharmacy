<?php

if(isset($_POST['submit']))
{
	$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
	
	$first = mysqli_real_escape_string($conn, $_POST['fname']);
	$last = mysqli_real_escape_string($conn, $_POST['lname']);
	$nic = mysqli_real_escape_string($conn, $_POST['nic']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$bday = mysqli_real_escape_string($conn, $_POST['bday']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);

	//check user already exists by checking the NIC
	$query = mysqli_query($conn, "SELECT * FROM customer WHERE nic='$nic'");
	$rows = mysqli_num_rows($query);
	if($rows > 0)
	{
		echo'<script>alert("This NIC already exists."); window.location.href="register.php";</script>';
		exit();
	}
	else
	{
		$encrypt_password=md5($password);
		$sql = "INSERT INTO customer (first_name, last_name, nic, email, password, birthday, gender, contact_number) VALUES ('$first','$last','$nic','$email','$encrypt_password','$bday','$gender','$contact')";
		
		
		if(mysqli_query($conn, $sql))
	    {
	    	echo'<script>alert("Your account has been created."); window.location.href="index.php";</script>';  
	    }
	    else
	    {
	    	echo '<script>alert("Unsuccessful); window.location.href="index.php";</script>';
	    }

	    mysqli_close($conn);	
	}
}

?>