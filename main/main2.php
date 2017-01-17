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
                <h2  style="position:relative; left:493px;"> Reports</h2>

            </div>	

            <div class="row3" style="position:relative; top:100px; " >		

                <div><a class="shortcut-button1"  style="position:relative; top:-70px; left:300px;"  href="../dailly/p.php"> <span><img src="images/daily.png" width="100" height="100" border="0">Daily Report</span></a></div>

                <div><a class="shortcut-button1"  style="position:relative; top:-260px; left:500px;" href="../medicine/sales.php"><span> <img src="images/ca.png" width="100" height="100" border="0">Cashier Wise Report</span></a></div>

                <div> <a class="shortcut-button1"  style="position:relative; top:-455px; left:700px;"  href="../cashier/b.php"  class="shortcut-button"><span> <img src="images/med.png" width="100" height="100" border="0">Sales of each Medicine</span></a></div>			

            </div>   

        </div>


    </body>
</html>


