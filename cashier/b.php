
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
                color: #777777; 
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



        <div class="medium" style="position:relative; left: 405px;  top: 40px;">

            <?php
            // define variables and set to empty values
            $cnameErr = $datesErr = $dates2Err = $methodErr = "";
            $cname = $dates = $dates2 = $method = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["cname"])) {
                    $cnameErr = "Name is required";
                } else {
                    $cname = test_input($_POST["cname"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/", $cname)) {
                        $cnameErr = "Only letters and white space allowed";
                    }
                }




                if (empty($_POST["dates"])) {
                    $dateErr = "Date is required";
                } else {
                    $dates = test_input($_POST["dates"]);
                }

                if (empty($_POST["dates2"])) {
                    $dateErr = "Date is required";
                } else {
                    $dates2 = test_input($_POST["dates2"]);
                }

                if (empty($_POST["method"])) {
                    $methodeErr = "Method is required";
                } else {
                    $methode = test_input($_POST["method"]);
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
                <h2>CASHIER WISE REPORT</h2>
            </div>

            <div>
                <fieldset class='explicit'>
                    <form name='myform' action="casier_wise2.php" method ='post' >
                        <?php
                        $sql = "SELECT  * FROM staff";
                        $con = mysqli_connect("localhost", "root", "", "friends_pharmacy");
                        $result = mysqli_query($con, $sql);
                        $rows = mysqli_num_rows($result);
                        ?>
                        <table class="tableNormal" cellspacing="5" cellpadding="5">
                            <!--<tr><td><label for="name">Cashier Name</label></td><td><select name="cname" required><option value="all">All</option><?php
                                        /*if ($rows > 0) {
                                            for ($i = 0; $i < $rows; $i++) {
                                                mysqli_data_seek($result, $i);
                                                $record = mysqli_fetch_assoc($result);
                                                echo '<option value="' . $record['member_id'] . '">' . $record['first_name'] . '</option>';
                                            }
                                        }
                                        */?> </select></td></tr><span class="error">* <?php //echo $cnameErr; ?></span>-->

                            <tr><td><label for="sdate">Start Date</label></td>
                                <td><input type="date" id="sdate" name="dates" value="<?php echo date("Y-m-d") ?>"></br></td></tr>

                            <tr><td><label for="edate">End Date</label></td>
                                <td><input type="date" id="edate" name="dates2" value="<?php echo date("Y-m-d") ?>"></br></td></tr>

<!--<tr><td><label for="category">Method</label></td>
<td><select id="category" name="category">
<option value="price">Price</option>
<option value="quantity">Quantity</option>

</select></td></tr>-->

                            <tr><td></td><td><input type="submit" value="Submit" ></td></tr>
                    </form>
                </fieldset>
            </div>
        </div>


        <?php require_once('../includes/_footer.php') ?>
    </body>
</html>




