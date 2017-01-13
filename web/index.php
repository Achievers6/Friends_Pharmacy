<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Friends Pharmacy</title>

	<meta charset="utf-8" />
	<link rel="stylesheet" href="../public/css/web/homeStyle.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="../public/js/jquery-2.0.0.js"></script>
</head>
<body>

    <?php session_start(); require '../includes/customer_header.php';?>
    <?php require '../includes/slideshow.php';?>

	<div class="bottomContent">
		<div class="bottomLeft">
			<h3>Why you need pharmacy?</h3>
			<p  style="font-size:20px">As human beigns we all fall in sick in several times. After doctors pharmacy is the place where you fulfill your medical needs. Those medical needs are inevitable. But there are so many pharmacies out there will they fulfill all your medical needs? </p>
		</div>

		<div class="bottomMiddle">
			<h3>What makes a ‘Good’ pharmacy?</h3>
			<p style="font-size:20px"> Pharmacy is a place where most of the people tend to come in their day to day life. So the famarcy should win the trust of their customers highly. While providing medicine a pharmacy should take care of the patients  </p>
		</div>

		<div class="bottomRight">
			<h3>“Why you should choose us among others” </h3>
			<p style="font-size:20px">Selling medicine is not the one and only thing we provide for our customers. We always take good care of you and put our maximum to ease your medical needs. </p>
		</div>
	</div>

    <?php require '../includes/customer_footer.php';?>

</body>
</html>