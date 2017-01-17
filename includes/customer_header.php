<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../public/css/web/customer_header.css" type="text/css" />
    <!--     <script src="../public/js/jquery-2.0.0.js"></script>-->

        <script src="../public/js/nav.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <li><img src="../public/image/logo_white.png" class="logo"></li>
                    <li><a href="../web/index.php">Home </a></li>
                    <li><a href="../web/about.php">About Us </a></li>
                    <li><a href="../web/otc.php">Over the Counter Products </a></li>
                    <li><a href="../web/prescription.php">Prescription Products </a></li>
                    <!-- <li><a href="../web/events.php">Events </a></li> -->
                    <li><a href="../web/contact.php">Contact Us </a></li>
                    <div class="user">
                        <?php
                        if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                            ?>  <li>                        
                                <div class="dropdown">
                                    <a href="#" onclick="myFunction()">
                                        <img src="../public/image/user.png" style="width: 40px; height: 40px; margin-left: 100px; position: relative; top: -5px;" class="dropbtn">
                                    </a>                          
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="profile.php">My Profile</a>
                                        <hr style="margin: 0"> 
                                        <?php
                                        $email = $_SESSION['email'];

                                        include '../database/dbconnect.php';
                                        if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM staff WHERE email ='$email'"))) {
                                            ?>
                                            <a href="../main/main.php">Pharmacy Website</a>
                                        <?php } ?>
                                        <a href="logout.php">Logout</a>
                                    </div> 
                                </div>                        
                            </li>
                            <?php
                        } else {
                            ?>   
                            <li>                
                                <a href="#" id="loginform" style="padding-left: 60px;">Login</a>
                                <div class="login">
                                    <div class="arrow-up"></div>
                                    <div class="formholder">
                                        <div class="randompad">
                                            <fieldset>
                                                <form action="login.php" method="post">
                                                    <label name="email">Email</label>
                                                    <input type="email" name="user" required="required" />
                                                    <label name="password">Password</label>
                                                    <input type="password" name="pass" required="required" />
                                                    <input type="submit" value="Login" name="login" /> 
                                                    <div style="text-align: center; margin-top: 3%;" class="login_bottom">
                                                        <!--                                 <a href="#" style="color: black; font-size: 15px; margin-bottom:-15px;">Forgot Your Password?</a>-->
                                                        <a href="register.php" style="color: black; font-size: 15px;">Create an Account</a> 
                                                    </div>    
                                                </form>                                                            
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <?php
                        }
                        ?>
                    </div>            
                </ul>
            </nav>
        </header>
        <!--    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
        <script src="../public/js/index.js"></script>



        <script>
                                        /* When the user clicks on the button, 
                                         toggle between hiding and showing the dropdown content */
                                        function myFunction() {
                                            document.getElementById("myDropdown").classList.toggle("show");
                                        }

                                        // Close the dropdown if the user clicks outside of it
                                        window.onclick = function(event) {
                                            if (!event.target.matches('.dropbtn')) {

                                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                                var i;
                                                for (i = 0; i < dropdowns.length; i++) {
                                                    var openDropdown = dropdowns[i];
                                                    if (openDropdown.classList.contains('show')) {
                                                        openDropdown.classList.remove('show');
                                                    }
                                                }
                                            }
                                        }
        </script>


    </body>

</html>