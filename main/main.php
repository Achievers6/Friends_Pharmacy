<html>
    <header>
        <link rel="stylesheet" href="styles/mstyle.css" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/menuStyle.css" />
    </head/>

    <body>

        <?php
        session_start();
        $title = "Main Menu";
        $content = '<div class="row1">
                            <h3  style="position:relative; left:20px;">Welcome John</h2>
		
				
                                <div><a class="shortcut-button" style="position:relative; top:40px; left:200px;" href="../pharmacist/members.php"> <span><img src="images/user.png" width="100" height="100" border="0">Staff </span></a></div>
				<div><a class="shortcut-button" style="position:relative; top:-140px; left:400px;"  href="../pharmacist/viewstock.php"> <span><img src="images/stock.png" width="100" height="100" border="0">Stock </span></a><div>
				<div><a class="shortcut-button" style="position:relative; top:-320px; left:600px;" href="../supplier/viewsupplier.php"> <span><img src="images/supplier.png" width="100" height="100" border="0">Supplier</span></a> <div>
				<div><a class="shortcut-button"  style="position:relative; top:-500px; left:800px;" href="#"> <span><img src="images/customer.png" width="100" height="100" border="0">Customer </span></a> </td>
			
	</div>

	

	<div class="row3" style="position:relative; top:100px; " >
		
			
				 <div><a class="shortcut-button"  style="position:relative; top:-590px; left:300px;"  href="#"> <span><img src="images/bill.png" width="100" height="100" border="0">Transaction</span></a><div>
				 <div><a class="shortcut-button"  style="position:relative; top:-770px; left:500px;" href="../dailly/p.php"><span> <img src="images/report.png" width="100" height="100" border="0"> Report</span></a><div>
				 <div> <a class="shortcut-button"  style="position:relative; top:-950px; left:700px;"  href="../web/index.php"  class="shortcut-button"><span> <img src="images/web.png" width="100" height="100" border="0">Manage Website</span></a><div>
			
		
	</div>

	



';


        include 'template.php';
        ?>
    </body>
</html>


