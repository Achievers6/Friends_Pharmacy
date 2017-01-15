<?php

if(isset($_POST['submit']))
{
	//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysql_error());
	include '../database/dbconnect.php';
	$first = mysqli_real_escape_string($mysqli,$_POST['fname']);
	$last = mysqli_real_escape_string($mysqli,$_POST['lname']);
	$gender = mysqli_real_escape_string($mysqli,$_POST['gender']);
	// $bday = mysqli_real_escape_string($mysqli,$_POST['bday']);
	$bday = date("Y-m-d");
	$nic = mysqli_real_escape_string($mysqli,$_POST['nic']);
	$address = mysqli_real_escape_string($mysqli,$_POST['address']);
	$contact = mysqli_real_escape_string($mysqli,$_POST['contact']);
	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
	$password = mysqli_real_escape_string($mysqli,$_POST['password']);
	$occupation = mysqli_real_escape_string($mysqli,$_POST['occupation']);
	$start = mysqli_real_escape_string($mysqli,$_POST['date']);	
	
	$encrypt_password=md5($password);

	$sql = "INSERT INTO staff (first_name, last_name, gender, birthday, nic, address, contact_number, email, password, occupation, start_date) 
	VALUES ('$first','$last','$gender','$bday','$nic','$address','$contact','$email','$encrypt_password','$occupation','$start')";

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

?>