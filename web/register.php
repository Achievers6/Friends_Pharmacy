<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create New Account</title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/css/web/register.css" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript"></script>
        <script src="../public/js/jquery-3.1.1.min.js"></script>
        <script src="../public/js/jquery.validate.min.js"></script>
        <script src="../public/js/registervald.js"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <style>
            .error {
                color: #ff0000;
                font-size: 17px;

            }

        </style>
    </head>

    <body>

        <?php
        session_start();
        require '../includes/customer_header.php';
        ?>

        <h3 style="text-align: center; margin-top: 3%; margin-bottom: 2%;">Create A New Account</h3>
        <div class="signup_table">
            <form id="main" action="signup.php" method="POST" enctype="multipart/form-data">

                <table>				
                    <tr>
                        <td><span class="star" style="color:red">*</span>First Name: </td>
                        <td><input type="text" name="fname" id="fname"  class="required specialChar" ></td>
                    </tr>
                    <tr>
                        <td><span class='star' style="color:red">*</span>Last Name:</td>
                        <td><input type="text" name="lname" id="lname"></td>
                    </tr>
                    <tr>
                        <td> <span class='star' style="color:red">*</span>NIC:</td>
                        <td><input type="text" name="nic" id="nic"></td>
                    </tr>
                    <tr>
                        <td><span class='star' style="color:red">*</span>Email:</td>
                        <td><input type="email" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td><span class='star' style="color:red">*</span>Password:</td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td><span class='star' style="color:red">*</span>Birthday:</td>
                        <td> <input type="text" name="bday" id="bday"  ></td>
                    </tr>
                    <tr>
                        
                    <form action="">
                        <td><span class='star' style="color:red">*</span>Gender:</td>
                        <td><input type="radio" name="gender" value="male" checked> Male<br></td>
                        <td><input type="radio" name="gender" value="female"> Female<br></td>
                    </form>

                    </tr>
                    <tr>
                        <td><span class='star' style="color:red">*</span>Contact Number:</td>
                        <td><input type="tel" name="contact" id="contact"></td>
                    </tr>		

                    <tr><td><input type="submit" name="submit" id="submit" value="Create My Account"></td></tr>
                </table>			
            </form>
        </div>

<?php require '../includes/customer_footer.php'; ?>

    </body>
</html>
<script>
 $(function() {
    $( "#bday" ).datepicker({  maxDate: new Date() });
  });
    </script>