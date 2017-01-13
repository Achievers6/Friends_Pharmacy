  <DOCTYPE html>
<html lang="en">

<head>
	<title>Welcome to Friends Pharmacy</title>
	
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../public/css/web/eventStyle.css" type="text/css" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="../public/js/jquery-2.0.0.js"></script>
	
</head>

<body>
	<?php session_start(); require '../includes/customer_header.php';?>
	<?php require '../includes/slideshow.php';?>	
	
	<div class="content">
		<article class="topContent">
			<h1>Get Your Flu Shot Today</h1>
			<input type="checkbox" class="read-more-state1" id="post-1" />
                                <img src="../public/image/event1.jpg" class="logo"> 
				<p class="read-more-wrap">Get Your Flu Shot Today
				Get the flu shot that helps provide a lifesaving vaccine to a child in need. </p>
				<label for="post-1" class="read-more-trigger1"></label>
		</article>
		
		<article class="middleContent">
			<h1>So long sore throat. Hello long distance!</h1>
			<input type="checkbox" class="read-more-state2" id="post-2" />
                                <img src="../public/image/event2.jpg" class="logo"> 
				<p class="read-more-wrap">Get treatment for minor illnesses and more at select stores.</span></p>

				<label for="post-2" class="read-more-trigger2"></label>	
		</article>
		
		<article class="See a Doctor Virtually with MDLIVE">
			<h1>Event 3</h1>
			<input type="checkbox" class="read-more-state3" id="post-3" />
                                 <img src="../public/image/event3.png" class="logo">
				<p class="read-more-wrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				Next time skip the waiting room. Video chat with a U.S. board-certified physician who can treat common illnesses like sinus and ear infections, sore throats, and skin problems, 24/7. Doctors can even write prescriptions, if necessary.</span></p>

				<label for="post-3" class="read-more-trigger3"></label>
		</article>
		
	</div>	
	
	
	<aside class="topSide">			
		<img src="../public/image/add1.jpeg">
	</aside>
	
	<aside class="bottomSide">		
		<img src="../public/image/add2.jpg">
	</aside>
	
		
	
	




	
	<?php require '../includes/customer_footer.php';?>
</body>

</html>