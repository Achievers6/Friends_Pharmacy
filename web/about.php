<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Friends Pharmacy</title>

	<meta charset="utf-8" />
	<link rel="stylesheet" href="../public/css/web/aboutStyle.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script scr="../public/js/jquery-2.0.0.js" ></script>
	<script scr="../public/js/comment.js"></script>
</head>
<body>

    <?php  session_start(); require '../includes/customer_header.php';?>
    <?php require '../includes/slideshow.php';?>
    
	<div class="content">
		<div class="sideContent">
			<h3>About</h3>
			<ul>
				<li><a href="#">Who we are</a> </li>
				<li><a href="#">What do we do</a> </li>
				<li><a href="#">Awards and Recognitions</a></li>
			</ul>

			<h3>Policies</h3>
			<ul>
				<li><a href="#">Advertising policy</a></li>
				<li><a href="#">Privacy policy</a></li>
				<li><a href="#">Editorial policy</a></li>
			</ul>

			<h3>Servies</h3>
			<ul>
				<li><a href="#">SMS service</a></li>
				<li><a href="contact.php">Ask Questions</a></li>
				<li><a href="contact.php">View map</a></li>
			</ul>
		</div>
		<div class="mainContent">
			<div class="top">
				<h2>WHO WE ARE</h2>
				<hr>
				<p>Driven by the deeply held belief that people should be free to make their own choices when it comes to healthcare, we launched the website friendspharmacy.com to enable customers to help them live a healthier life.</p>
				<p>To this day, friendspharmacy.com provides an invaluable service to thousands of customers by supplying them with medicines approved by the authorities and so many other services. <a href="#">Read More...</a></p><br>
				
			</div>
			<div class="middle">
				<h2>AWARDS AND RECOGNITIONS</h2>
				<hr>
				<img src="../public/image/award.png" style="width: 90px; height: 100px;">
				<p>
					We offer credible and in-depth medical news, features, reference material, and online community programs. We are proud that others in the fields of media and health have recognized our efforts. <a href="award.php">Read More...</a>
				</p><br>
			</div>
			<div class="bottom">
				<H2>OUR POLICIES</H2>
				<hr>
				<h4>ADVERTOSING POLICY</h4>
					<p>
						Friends Pharmacy requires advertisers to provide ads that are accurate, in good taste, and otherwise comply with our Advertising Policy.<br>
						<a href="#">Read Our Advertising Policy</a> 
					</p>
				<h4>PRIVACY POLICY</h4>
					<p>
						We understand that health is a very personal, private subject, and we want you to feel as comfortable as possible visiting our web site and using its services.<br>
						<a href="#">Read Our Privacy Policy</a>
					</p>
				<h4>EDITORIAL POLICY</h4>
					<p>
						Our mission is to bring you objective, trustworthy, and timely health information.<br>
						<a href="#">Read Our Editorial Policy</a>
					</p><br>			
			</div>
			<div class="comment">
				<h4 style="color: #6bc91a">COMMENTS</h4>
				<form method="POST" action="">
					<textarea placeholder="Add a public comment..." style="width: 980px; height: 40px; padding: 10px;" name="comment"></textarea>
					<input type="submit" name="post" value="POST" style="cursor: pointer;">
				</form><br>
				<?php

					//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
                                        include '../database/dbconnect.php';
					if(isset($_POST['comment']) && !empty($_POST['comment']))
					{							
						$msg = nl2br($_POST['comment']);
						$day = date("Y-m-d");				

						$sql = "INSERT INTO comment (post, day) VALUES ('$msg', '$day')";
						if(mysqli_query($mysqli, $sql))
					    {
					    	echo'<script>alert("Your comment is recorded successfully.\n\tThank You."); window.location.href="about.php";</script>';  
					    }
					    else
					    {
					    	echo '<script>alert("Cannot record your comment.\nPlease try again.); window.location.href="about.php";</script>';
					    }
						
					}

					$post_query = mysqli_query($mysqli, "SELECT * FROM comment");
					while ($run_post = mysqli_fetch_array($post_query)) 
					{
						$post_id = $run_post['id'];
						$post_user = $run_post['user_name'];
						$post = $run_post['post'];
						$post_day = $run_post['day'];
				?>

				<div class="box">
					<b><?php echo $post_user?></b> <font style="color: #967979; font-size: 12px;"><?php echo $post_day?> </font><br>
					<div style="margin-left: 8px;"><?php echo $post?></div>	
					<input type="text" name="reply" class="reply" placeholder="reply..." post_id="<?php echo $post_id?>">		
				</div><br>

				<?php
					}
				?>

			</div>
			
		</div>	
	</div>
    
    <?php require '../includes/customer_footer.php';?>

</body>
</html>