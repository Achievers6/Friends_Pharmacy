<html>
    <head>
        
        <?php require('../includes/_header.php'); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-2.0.0.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/jquery.validate.min.js"></script>
            <script src="js/addcustomer.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
       
        <script>
        $( function() {
            $( "#dob" ).datepicker();
        } );
        
        </script>
        
        <style>
            .radio-left {
                float: left;
            }

            fieldset{
                border: none;
                width: 600px;
                height:450px;
                margin:auto;
                text-align: center;
                border: 2px solid rgb(106,184,42);
                padding-top: 30px;
                padding-bottom: 70px;
                background-color: rgb(229, 249, 212);
             

            }
            form div {
                margin-bottom: 10px; 
            }
            form input {
                margin: 10px;
            }
            #btn{
                position:relative;
                top:450px;
                float:right;
                right:250px;
                height:30px;
            }
            #tbl{
                position: relative;
                float:right;
                right:100px;
                
            }
            h2{
                position:relative;
                float:right;
                right:520px;
                top:70px;
            }
            .customer_template_container {
                top: 160px;
                left: 70px;
            }
           
            .error {
                    color: #ff0000;
  
  
                }

            label.error {
                        display:block;
                        height:17px;
                        margin-left:9px;
                        font-size:15px;
                        position:relative;
                        top:1px;
                        
    
                }
            .star{
                color: red;
            }


        </style>
        
        <title>customer</title>
    </head>
    <body>
         <?php require_once("../includes/navigation.php") ?>
    
    <!--content goes here -->
     <h2>Add Customers</h2>
    <div class="customer_template_container" >
        <fieldset >
        <form action="reminder.php" method="POST" style="text-align:center" id="form">
       <table id="tbl">
        <tr >
                <td><span class="star">*</span>NIC</td>
        <td><input type="text" name="nic"></td>
        </tr>
        <tr >
          <td><span class="star">*</span>First name</td>
        <td><input type="text" name="fname" ><td>
        </tr>
        <tr > 
            <td><span class="star">*</span>Last Name</td>
        <td><input type="text" name="lname" ></td>
        </tr>
        <tr>
            <td><span class="star">*</span>Date Of Birth</td>
        <td><input type="date" name="dob" id="dob"></td>
        </tr>
        <tr>
        <td>Gender</td>
        <td><input type="radio" name="gender" value="male" checked> Male<br>
        <input type="radio" name="gender" value="female"> Female<br>
        </tr>
       
       <tr>
        
            <td><span class="star">*</span>Email Address</td>
        <td><input type="email" name="email"></td>
         </tr>
           <tr>        
            <td><span class="star">*</span>Contact Number</td>
        <td><input type="text" name="mobile"></td>
        </tr>
                <br>
                <br>
               
        <input id="btn" type="submit" value="Next">
        </table> 
            </form>
        <?php // echo $content; ?>
        </fieldset>
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
        
        
       
        <!--<div class="container" style='text-align:center;'>
        <h2 style="margin-bottom:20px;">Add Customer</h2>
        <form class="form-horizontal"  method="post" action="">-->
    
    </body>
</html>