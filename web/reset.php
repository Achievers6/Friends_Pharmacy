<?php
	//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
	include '../database/dbconnect.php';
	if($_GET['code'])
	{
		$get_email = $_GET['email'];
		$get_code = $_GET['code'];
		
		$query = mysqli_query($mysqli, "SELECT * FROM customer WHERE email='$get_email'");
		
		while($row = mysqli_fetch_assoc($query))
		{
			$db_code = $row['reset'];
			$db_email = $row['email'];
		}
		if($get_email == $db_email && $get_code == $db_code)
		{
			echo "
			
				<form action='resetComplete.php?code=$get_code' method='POST'>
					Enter a new password <input type='password' name='newpw'><br>
					Re-Enter the password  <input type='password' name='newpw1'><br>
					<input type='hidden' name='email' value='$db_email'>
					<input type='submit' value='Update Password'>
				</form>
			
			";
		}
	}

	if(!$_GET['code'])
	{		
		if(isset($_POST['submit']))
		{
			
			$email = mysqli_real_escape_string($mysqli, $_POST['email']);
			$query = mysqli_query($mysqli, "SELECT * FROM customer WHERE email='$email'");
			$numrows = mysqli_num_rows($query);
			if($numrows != 0)
			{
				while($row = mysqli_fetch_assoc($query))
				{
					$db_email = $row['email'];
				}
				$code = rand(10000,1000000);
				$to = $db_email;
				$subject = "Password Reset";
				$body = "Click the link below to reset your password.
				http://localhost/friends_pharmacy/forget.php?code=$code&email=$email";
				
				mysqli_query($mysqli, "UPDATE customer SET reset='$code' WHERE email='$email'")or die(mysqli_error($mysqli));
				
				mail($to,$subject,$body);
				echo "Check Your Emails";
			}
			else
			{
				echo "User does not exist";
			}
		}
	}
		
?>