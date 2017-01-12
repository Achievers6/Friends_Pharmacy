<?php

	//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
	include '../database/dbconnect.php';
        
	$newpass = $_POST['newpass'];
	$newpass1 = $_POST['newpass1'];
	$post_email = $_POST['email'];
	$code = $_GET['code'];
	
	if($newpass == $newpass1)
	{
		$encrypt_password = md5($newpass);
		
		mysqli_query($mysqli, "UPDATE customer SET password='$encrypt_password' WHERE email='$post_email'");
		mysqli_query($mysqli, "UPDATE customer SET reset='0' WHERE email='$post_email'");
		
		echo "Your pass has been updated. <a href='index.php'>Click here to login</a>";
	}
	else
	{
		echo "Passwords must match <a href='reset.php?code=$code&email=$post_email'>Click here to go back<a>";
	}
	


?>