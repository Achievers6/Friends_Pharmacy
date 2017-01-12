<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Friends Pharmacy</title>

	<meta charset="utf-8" />
	<link rel="stylesheet" href="../public/css/web/contactStyle.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	
    <?php session_start(); require '../includes/customer_header.php';?>
    <?php require '../includes/slideshow.php';?>
    
	<div class="mainContent">	
		<h3>Send us a Message</h3>			
		<p><br>
		We hope you are provided the best customer service. We are happy to ask any question you have or provide with you an estimate. Just send us a message in the form below and we'll respond as soon as we can. Your feedback will be highly appreciated.</p> <br>

		<form action="" method="POST">
			<label>Full Name</label> <br> <input type="text" name="name"><br>
			<label>Email</label> <br> <input type="email" name="email"><br>
			<label>Message</label> <br> <textarea rows="10" cols="70" name="msg"></textarea><br>
			<input type="submit" name="submit" value="SEND" id="btn_send">
		</form>			
	</div>
	
	<aside class="contactSide">			
		<h3>Contact Info</h3>
		We love to hear from you. It's easy to contact our patient service at Friends Pharmacy any time.
		Just use any o the following information to find out how to call us, write us, email us, fax us or dropped by in person if you just happen to be in Kirulapone. <br> <br>

		<img src="../public/image/tele.png"> <label><b>Phone</b></label> <br>
		<p>+94-11- 342 3462</p>
		<img src="../public/image/email.png"> <label><b>Email</b></label> <br>
		<p>friendspharmacy@gmail.com</p>
		<img src="../public/image/fax.png"> <label><b>Fax</b></label> <br>
		<p>+94-11- 259 2549 </p>
		<img src="../public/image/letter.png"> <label><b>Address</b></label> <br>
		<p>No: 65, <br> Main Street, <br> Kirulapone </p>
	</aside>
	<div>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.346597921573!2d79.87071011772228!3d6.880222420450976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25a367c0cc0e9%3A0xfb690e92b68a5eec!2sKirulapone%2C+Colombo!5e0!3m2!1sen!2slk!4v1479953320568" width="1306" height="480" frameborder="0" style="border:0;margin-left: 1%;" allowfullscreen></iframe>
	</div>
	

    <?php require '../includes/customer_footer.php';?>

</body>
</html>


<?php

	if(isset($_POST['submit']))
	{

		$name = $_POST['name'];
		$email = $_POST['email'];
		$msg = $_POST['msg'];
		$day = date("Y-m-d");	
		$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
		
		$sql = "INSERT INTO feedback (name, email, message, day) VALUES ('$name', '$email', '$msg', '$day')";

		if(mysqli_query($conn, $sql))
	    {
	    	echo'<script>alert("Your feedback is submited successfully.\nThank You."); window.location.href="contact.php";</script>';  
	    }
	    else
	    {
	    	echo '<script>alert("Your feedback was not submited.\nPlease try again.); window.location.href="contact.php";</script>';
	    }

	    mysqli_close($conn);	
	}

?>