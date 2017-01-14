


<html>
<head>
	
    <?php require('../includes/_header.php'); ?>
    <link rel="stylesheet" href="aboutStyle.css" type="text/css" />	
    <title><?php echo $title; ?></title>
</head>

<body>
    
    <?php require_once("../includes/navigation.php") ?>
    
    <!--content goes here -->
    <div class="customer_template_container" style="position: relative; top: 50px;">
        <div class="mainContent">	
		<div class="content">
			<article class="topContent">
			<div  id = "printContent">
				<div class="center">
					<img src="../public/image/logo_green.png" style="width: 20%;">
                                        <h5 style="position: relative; top: -25px; margin-bottom:-40px; ">Kirulapone</h5>
					<h4>Reg No:A5SH1120GB21</h4>
					<h1>Cashier Wise Report</h1>
				</div>
				
				<form action="#" method="POST">
					<div class="location">
						<?php echo $_POST["mode"]; ?>
						<table class="tableNormal" cellspacing="0" cellpadding="0">
						<tr><td><!--Medicine Name : <?php echo $_POST["name"]; ?>--></td><td><br> <!--Location  : <?php echo $_POST["1"]; ?>--><br><br></td></tr>
						<tr><td>Date From : <?php echo $_POST["dates"]; ?></td><td><br> Date To : <?php echo $_POST["dates2"]; ?><br><br></td></tr>
						<!--<tr><td>Time From : <?php echo $_POST["times"]; ?> </td><td><br>Time To : <?php echo $_POST["times2"]; ?><br><br></td></tr>-->
						</table>
						<?php
						   //session_start();
						?>
						<?php
						
							//$name=$_POST['name'];
							$cashier_name=$_POST['cashier_name'];
							
							$dates=$_POST['dates'];
							$dates2=$_POST['dates2'];
							//$methode=$_POST['methode'];
							//$type=$_POST['type'];
							//$In_type=$_POST['In_type'];
							$mode=$_POST['mode'];
							//$times=$_POST['times'];
							//$times2=$_POST['times2'];
							
							//$con = mysqli_connect("localhost","root","","friends_pharmacy");
							include '../database/dbconnect.php';
							
							
								if($mode=='Details'){
								
							
									if($cashier_name=='all' ){
										$sql1 = "SELECT bill_table.date,staff.first_name,staff.last_name,bill_table.total,bill_table.discount,(bill_table.total - bill_table.discount) AS amount FROM staff,bill_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND staff.member_id=bill_table.staff_ID GROUP BY date,bill_number; ";
										
										$result1 = mysqli_query($mysqli,$sql1);
									
										
										//$price1 = mysqli_query($mysqli,"SELECT SUM(cashier_amount) FROM location WHERE date BETWEEN '$dates' AND '$dates2' AND (end_time <> '$times2' OR start_time ='$times');");
										//$result = mysqli_fetch_array($price1);
										
									}else{
										$sql2 = "SELECT bill_table.date,staff.first_name,staff.last_name,bill_table.total,bill_table.discount,(bill_table.total - bill_table.discount) AS amount FROM staff,bill_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND staff.member_id='$cashier_name' AND staff.member_id=bill_table.staff_ID GROUP BY date,bill_number;";
										
										$result1 = mysqli_query($mysqli,$sql2);
									
										
										//$price2 = mysqli_query($con,"SELECT SUM(cashier_amount) FROM location WHERE (date BETWEEN '$dates' AND '$dates2' AND (end_time <> '$times2' OR start_time ='$times')) AND cashier_id ='$cashier_name';");
										//$result = mysqli_fetch_array($price2);
										
									}
									
									
									echo "<table>";
									echo "<tr><th>Date</th><th>First Name</th><th>Last Name</th><th>Bill Amount</th><th>Discount</th><th>Total Amount<br>&nbsp&nbsp(Rs)</th></tr>";
									while($row = mysqli_fetch_array($result1)){
										echo"<tr><td>".$row ['date']."</td><td>".$row ['first_name']."</td><td>".$row ['last_name']."</td><td>".$row ['total']."</td><td>".$row ['discount']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['amount']."</td></tr>";
										
										
										
										//echo "<br>ID : ".$row{'m_code'}."m_name : ".$row{'m_name'}."com_name : ".$row{'com_name'}."shelf_no :".$row{'shelf_no'};
									}
									
									//echo "<tr><td>"."</td><td>"."Total" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$result['SUM(cashier_amount)']."</td><tr>";
											
									 
									
									echo "</table>";
								}elseif($mode=='Graph'){
									
																		
									
								}
							
								
							
						?>
					</div>
				</form>
				</div>
				<div class="location">
						<iframe id="prt" name="prt" style="display:none;"></iframe>
						<button  style="vertical-align:middle" onclick="myFunction();"><span>Print </span></button>
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
        
        
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
</body>

</html>