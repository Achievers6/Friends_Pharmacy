<html>
<header>
	<link rel="stylesheet" type="text/css" href="styles/menuStyle.css" />
</head/>

<body>
	
<?php
$title = "Main Menu";
$content = '<div class="row1">
		<table>
			<tr>
				<td><a href="../pharmacist/members.php"> <img src="images/user.png" width="100" height="100" border="0"> </a></td>
				<td><a href="../pharmacist/viewstock.php"> <img src="images/stock.png" width="100" height="100" border="0"> </td>
				<td><a href="../supplier/viewsupplier.php"> <img src="images/supplier.png" width="100" height="100" border="0"> </td>
				<td><a href="#"> <img src="images/customer.png" width="100" height="100" border="0"> </td>
			</tr>
		</table>
	</div>

	<div class="row2">	
		<table>
			<tr>
				<td>Staff</td>
				<td>Stock</td>
				<td>Supplier</td>
				<td>Customer</td>
			</tr>
		</table>
	</div>

	<div class="row3">
		<table>
			<tr>
				<td><a href="#"> <img src="images/bill.png" width="100" height="100" border="0"> </td>
				<td><a href="../dailly/p.php"> <img src="images/report.png" width="100" height="100" border="0"> </td>
				<td><a href="../web/index.php"> <img src="images/web.png" width="100" height="100" border="0"> </td>
			</tr>
		<table>
	</div>

	<div class="row4">	
		<table>
			<tr>
				<td>Transaction</td>
				<td>Report</td>
				<td>Manage Website</td>
			</tr>
		</table>
	</div>';


include 'template.php';
?>
</body>
</html>


