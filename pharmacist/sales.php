 <DOCTYPE html>
<html lang="en">

<head>
	<title>Welcome to Friends Pharmacy</title>
	
	<meta charset="utf-8" />
	<link rel="stylesheet" href="aboutStyle.css" type="text/css" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>

<body class="body">
	
	<header class="mainHeader">
		<img src="images/logo.png">
		
		<nav>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="about.html">About Us</a></li>
				<li><a href="otc.html">Over the Counter Products</a></li>
				<li><a href="prescription.html">Prescription Products</a></li>
				<li><a href="events.html">Events</a></li>
				<li><a href="contact.html">Contact Us</a></li>		
			</ul>
		</nav>
	</header>
	
	<div class="mainContent">	
		<div class="content">
			<article class="topContent">
			<div  id = "printContent">
				<div class="center">
					<img src="images/logo.png"><h3>Kirulapana</h3>
					<h4>Reg No:A5SH1120GB21</h4>
					<h1>SALES REPORT</h1>
				</div>
				
				<form action="#" method="POST">
					<div class="location">
						<?php echo $_POST["mode"]; ?>
						<table class="tableNormal" cellspacing="0" cellpadding="0">
						<tr><td>Medicine Name : <?php echo $_POST["name"]; ?></td><td><br> <!--Location  : <?php echo $_POST["1"]; ?>--><br><br></td></tr>
						<tr><td>Date From : <?php echo $_POST["dates"]; ?></td><td><br> Date To : <?php echo $_POST["dates2"]; ?><br><br></td></tr>
						<!--<tr><td>Time From : <?php echo $_POST["times"]; ?> </td><td><br>Time To : <?php echo $_POST["times2"]; ?><br><br></td></tr>-->
						</table>
						<?php
						   //session_start();
						?>
						<?php
						
							$name=$_POST['name'];
							//$cashier_name=$_POST['cashier_name'];
							
							$dates=$_POST['dates'];
							$dates2=$_POST['dates2'];
							$methode=$_POST['methode'];
							//$type=$_POST['type'];
							//$In_type=$_POST['In_type'];
							$mode=$_POST['mode'];
							//$times=$_POST['times'];
							//$times2=$_POST['times2'];
							
							$con = mysqli_connect("localhost","root","","friends_pharmacy");
							
							
									if($methode=='Price' && $mode=='Details'){
										
										if($name=='all'){
											$sql1 = "  SELECT bill_table.date,selling_table.bill_number,selling_table.quantity,selling_table.unit_price,selling_table.dosage,(selling_table.quantity * selling_table.unit_price) AS amount FROM bill_table,selling_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND bill_table.bill_number=selling_table.bill_number GROUP BY date,bill_number;";
											
											$result1 = mysqli_query($con,$sql1);
										
											
											//$price1 = mysqli_query($con,"SELECT SUM(quantity * selling_price) FROM selling WHERE date BETWEEN '$dates' AND '$dates2';");
											//$result = mysqli_fetch_array($price1);
											
										}else{
											$sql2 = "  SELECT bill_table.date,selling_table.bill_number,selling_table.quantity,selling_table.unit_price,selling_table.dosage,(selling_table.quantity * selling_table.unit_price) AS amount FROM bill_table,selling_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND selling_table.medicine_name='$name' AND bill_table.bill_number=selling_table.bill_number GROUP BY date,bill_number;";
											
											$result1 = mysqli_query($con,$sql2);
										
											
											//$price2 = mysqli_query($con," SELECT SUM(quantity * selling_price) FROM selling WHERE medicine_id='$name';");
											//$result = mysqli_fetch_array($price2);
											
										}
										
										
										echo "<table>";
										echo "<tr><th>Date</th><th>Bill Number</th><th>Quantity</th><th>Unite Price</th><th>Dosage</th><th>Amount<br>(Rs)</th></tr>";
										while($row = mysqli_fetch_array($result1)){
											echo"<tr><td>".$row ['date']."</td><td>".$row ['bill_number']."</td><td>".$row ['quantity']."</td><td>".$row ['unit_price']."</td><td>".$row ['dosage']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['amount']."</td></tr>";
											
											
											
											//echo "<br>ID : ".$row{'m_code'}."m_name : ".$row{'m_name'}."com_name : ".$row{'com_name'}."shelf_no :".$row{'shelf_no'};
										}
										
										//echo "<tr><td>"."</td><td>"."TOTAL AMOUNT" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$result['SUM(quantity * selling_price)']."</td><tr>";
												
										 
										
										echo "</table>";
										
									
										
										
										
									}elseif($methode=='Qty' && $mode=='Details'){
										
										if($name=='all'){
											$sql1 = "  SELECT bill_table.date,selling_table.bill_number,selling_table.dosage,selling_table.quantity FROM bill_table,selling_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2'  AND bill_table.bill_number=selling_table.bill_number GROUP BY date,bill_number;";
											
											$result1 = mysqli_query($con,$sql1);
										
											
											//$price1 = mysqli_query($con,"SELECT SUM(quantity * selling_price) FROM selling WHERE date BETWEEN '$dates' AND '$dates2';");
											//$result = mysqli_fetch_array($price1);
											
										}else{
											$sql2 = " SELECT bill_table.date,selling_table.bill_number,selling_table.dosage,selling_table.quantity FROM bill_table,selling_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2'  AND selling_table.medicine_name='$name' AND bill_table.bill_number=selling_table.bill_number GROUP BY date,bill_number;";
											
											$result1 = mysqli_query($con,$sql2);
										
											
											//$price2 = mysqli_query($con," SELECT SUM(quantity * selling_price) FROM selling WHERE medicine_id='$name';");
											//$result = mysqli_fetch_array($price2);
											
										}
										
										
										echo "<table>";
										echo "<tr><th>Date</th><th>Bill Number</th><th>Dosage</th><th>Quantity</th></tr>";
										while($row = mysqli_fetch_array($result1)){
											echo"<tr><td>".$row ['date']."</td><td>".$row ['bill_number']."</td><td>".$row ['dosage']."</td><td>".$row ['quantity']."</td></tr>";
											
											
											
											//echo "<br>ID : ".$row{'m_code'}."m_name : ".$row{'m_name'}."com_name : ".$row{'com_name'}."shelf_no :".$row{'shelf_no'};
										}
										
										//echo "<tr><td>"."</td><td>"."TOTAL AMOUNT" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$result['SUM(quantity * selling_price)']."</td><tr>";
												
										 
										
										echo "</table>";
										
									}elseif($methode=='Qty' && $mode=='Graph'){
										
										
										
									}elseif($methode=='Price' && $mode=='Graph'){
										
									}
										
										
									
								
							
						?>
					</div>
				</form>
				</div>
				<div class="location">
						<iframe id="prt" name="prt" style="display:none;"></iframe>
						<button class="button" style="vertical-align:middle" onclick="myFunction();"><span>Print </span></button>
						<script>
							function myFunction() {
								var mywindow = window.open('', 'my div', 'height=800,width=1200');
								//window.frames['prt'].document.write(document.getElementById("printContent").innerHTML);
								mywindow.document.write('<link rel="stylesheet" href="aboutStyle.css" type="text/css" />	')
								mywindow.document.write(document.getElementById("printContent").innerHTML);
								mywindow.document.getElementsByClassName("location")[0].setAttribute("style","padding:0px 180px;");
								//mywindow.document.getElementsBytagName("tableNormal td")[0].setAttribute("style","text-align: center;");
								mywindow.print();
								mywindow.close();
								//window.print();
							}
							</script>
				</div>	
					
				    
				<br><br><br><br>
			
			</article>
			
			
			
		</div>
	</div>
	
	
	
	
	
		
	
	<footer class="mainFooter">
		<p>Copyright &copy; <a href="#" title="Friends Pharmacy">friendspharmacy.lk</a></p>
	</footer>

</body>

</html>