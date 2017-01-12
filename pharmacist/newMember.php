<?php


if(isset($_POST['submit']))
{
	//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysql_error());
	include '../database/dbconnect.php';
	$first = mysqli_real_escape_string($conn,$_POST['fname']);
	$last = mysqli_real_escape_string($conn,$_POST['lname']);
	$gender = mysqli_real_escape_string($conn,$_POST['gender']);
	$bday = mysqli_real_escape_string($conn,$_POST['bday']);
	$nic = mysqli_real_escape_string($conn,$_POST['nic']);
	$status = mysqli_real_escape_string($conn,$_POST['status']);	
	$address = mysqli_real_escape_string($conn,$_POST['address']);
	$contact = mysqli_real_escape_string($conn,$_POST['contact']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	$occupation = mysqli_real_escape_string($conn,$_POST['occupation']);
	$start = mysqli_real_escape_string($conn,$_POST['date']);	
	
	$encrypt_password=md5($password);

	$sql = "INSERT INTO staff (first_name, last_name, gender, birthday, nic, address, contact_number, email, password, occupation, start_date) 
	VALUES ('$first','$last','$gender','$bday','$nic','$address','$contact','$email','$encrypt_password','$occupation','$start')";

	mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	mysqli_close($mysqli);
	header("Location: ../../main/main/main.php");
}

?>