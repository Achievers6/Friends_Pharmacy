<?php

session_start();
	
//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysql_error());
include '../database/dbconnect.php';
if(isset($_POST['login']))
{ 	
	$email=mysqli_real_escape_string($mysqli, $_POST['user']);
	$password=mysqli_real_escape_string($mysqli, $_POST['pass']);	

	$query1 = mysqli_query($mysqli, "SELECT * FROM customer WHERE email='$email'");
	$numrows1 = mysqli_num_rows($query1);

	$query2 = mysqli_query($mysqli, "SELECT * FROM staff WHERE email='$email'");
	$numrows2 = mysqli_num_rows($query2);

	if($numrows1 != 0)
	{
		while ($row = mysqli_fetch_assoc($query1)) 
		{
			$dbemail = $row['email'];
			$dbpassword = $row['password'];
		}
		if($email == $dbemail && md5($password) == $dbpassword)
		{
			echo'<script>alert("Welcome to Friends Pharmacy."); window.location.href="index.php";</script>';  
			$_SESSION['email'] = $email;
			
		}
		else
		{
			echo'<script>alert("Your password is incorrect."); window.location.href="index.php";</script>';  
		}
	}
	else if ($numrows2 != 0)
	{
		while ($row = mysqli_fetch_assoc($query2)) 
		{
			$dbemail = $row['email'];
			$dbpassword = $row['password'];
		}
		if($email == $dbemail && md5($password) == $dbpassword)
		{
			echo'<script>alert("Welcome to Friends Pharmacy."); window.location.href="../main/main.php";</script>';  
			$_SESSION['email'] = $email;
			
		}
		else
		{
			echo'<script>alert("Your password is incorrect."); window.location.href="index.php";</script>';  
		}		 
	}
	else
	{
		echo'<script>alert("You are not registered. \nPlease create an account."); window.location.href="index.php";</script>'; 
	}
}

?>