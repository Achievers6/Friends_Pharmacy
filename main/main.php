<?php
//session_start();
include '../database/dbconnect.php';
?>

<html>
    <header>
        <link rel="stylesheet" href="styles/mstyle.css" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/menuStyle.css" />
    </head/>

    <body>

        <?php
        $title = "Main Menu";
        $content = '';
        include 'template.php';
        ?>

        <div style="position: relative;margin-left: 200px;">
            <div class="row1">

                <h3  style="position:relative; left:400px;"> 

<?php
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $result = mysqli_query($mysqli, "SELECT first_name from staff WHERE email='$email'");
    $row = mysqli_fetch_array($result);
    $n = $row[0];
    echo "Welcome " . "$n" . "!";
}
?>            		
                </h3>

                <div><a class="shortcut-button" style="position:relative; top:40px; left:200px;" href="../pharmacist/addMedicine.php"> <span><img src="images/medi.png" width="100" height="100" border="0">Add Medicine</span></a>
                </div>

                <div><a class="shortcut-button" style="position:relative; top:-140px; left:400px;"  href="../pharmacist/viewstock.php"> <span><img src="images/in.jpg" width="100" height="100" border="0">Stock </span></a></div>

                <div><a class="shortcut-button" style="position:relative; top:-320px; left:600px;" href="main2.php"> <span><img src="images/report.png" width="100" height="100" border="0">Report</span></a> </div>

                <div><a class="shortcut-button"  style="position:relative; top:-500px; left:800px;" href="../web/index.php"> <span><img src="images/globe.png" width="100" height="100" border="0">Website</span></a> </div>

            </div>	

            <div class="row3" style="position:relative; top:100px; " >		

                <div><a class="shortcut-button"  style="position:relative; top:-590px; left:300px;"  href="../pharmacist/members.php"> <span><img src="images/user.png" width="100" height="100" border="0">User</span></a></div>

                <div><a class="shortcut-button"  style="position:relative; top:-770px; left:500px;" href="../supplier/viewsupplier.php"><span> <img src="images/supplier.png" width="100" height="100" border="0"> Supplier</span></a></div>

                <div> <a class="shortcut-button"  style="position:relative; top:-950px; left:700px;"  href="../customer/customerdetails.php"  class="shortcut-button"><span> <img src="images/customer.png" width="100" height="100" border="0">Customer</span></a></div>			

            </div>   

        </div>


    </body>
</html>


