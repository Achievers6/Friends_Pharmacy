<html>
    <head>
        <title>Add Supplier</title>
        <?php require('../includes/_header.php'); ?>
        <style>
            input[type=text], select {
                width: 250px;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 100px;
                background-color: rgb(106,184,42);
                color: white;
                padding: 5px 8px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            .medium {
                border-radius: 5px;
                background-color: #F1FE9;
                padding: 20px;
                width:800px;

            }
            #edate,#sdate{
                width: 250px;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            fieldset.explicit{
                align: right;
                background-color: rgb(229, 249, 212);
            }
            table {
                border-collapse: collapse;
                margin: 10px 180px;
            }
            .center {
                text-align: center;

            }
            body{
                background-color: #F1FE9;

            }
            h2 {
                text-align:center; 
                color: black; 
                font-family: SourceSansPro;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 50px 0;
            }

        </style>
    </head>
    <body>

        <?php require_once("../includes/navigation.php") ?>

        <div class="medium" style="position: relative; left: 405px; top: 40px;">

            <?php
            // define variables and set to empty values
            $nameErr = $dateErr = "";
            $name = $dates = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                } else {
                    $name = test_input($_POST["name"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                        $nameErr = "Only letters and white space allowed";
                    }
                }


                if (empty($_POST["dates"])) {
                    $dateErr = "Date is required";
                } else {
                    $dates = test_input($_POST["dates"]);
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
            <div class='center'>
                <h2>DAILY REPORT</h2>
            </div>

            <div>
                <fieldset class='explicit'>
                    <form name='myform' action="daily.php" method ='post' >

                        <table class="tableNormal" cellspacing="5" cellpadding="5">

                            <!--<tr><td><label for="spice">Category</label></td>
                                <td><select id="spice" name="spice">
                                        <option value="medicine" onclick="myFunction()">Medicine</option>
                                        <option value="cashier" onclick="myFunction()">Cashier</option>

                                    </select></td></tr>-->
                            <div id="myDIV">
                                <?php
                                $sql = "SELECT * FROM drug";
                                $con = mysqli_connect("localhost", "root", "", "friends_pharmacy");
                                $result = mysqli_query($con, $sql);
                                $rows = mysqli_num_rows($result);
                                ?>
                                <tr><td><label for="name">Medicine Name</label></td><td><select name="name" required><option value="all">All</option><?php
                                if ($rows > 0) {
                                    for ($i = 0; $i < $rows; $i++) {
                                        mysqli_data_seek($result, $i);
                                        $record = mysqli_fetch_assoc($result);
                                        echo '<option value="' . $record['medicine_name'] . '">' . $record['medicine_name'] . '</option>';
                                    }
                                }
                                ?> </select></td></tr><span class="error"> <?php echo $nameErr; ?></span>


                                <?php
                                /* $sql = "SELECT  * FROM staff";

                                  $result = mysqli_query($con, $sql);
                                  $rows = mysqli_num_rows($result); */
                                ?>											
                                <!--<tr><td><label for="name">Cashier Name</label></td><td><select name="cname" required><option value="all">All</option>
                                <?php /* if ($rows > 0) {
                                  for ($i = 0; $i < $rows; $i++) {
                                  mysqli_data_seek($result, $i);
                                  $record = mysqli_fetch_assoc($result);
                                  echo '<option value="' . $record['member_id'] . '">' . $record['first_name'] . '</option>';
                                  }
                                  }
                                 */ ?> </select></td></tr><span class="error">* <?php //echo $cnameErr; ?></span>-->
                            </div>

                            <tr><td><label for="sdate">Date</label></td>
                                <td><input type="date" id="sdate" name="dates" value="<?php echo date("Y-m-d") ?>"></br></td></tr>



<!--<tr><td><label for="take">Method</label></td>
<td><select id="take" name="take">
<option value="price">Price</option>
<option value="quantity">Quantity</option>

</select></td></tr>-->

                            <tr><td></td><td><input type="submit" value="Submit" name="submitReport"></td></tr>
                    </form>
                </fieldset>
            </div>
        </div>

<?php require_once('../includes/_footer.php') ?>
    </body>
</html>


