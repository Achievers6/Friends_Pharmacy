
<?php
//$con=mysqli_connect("localhost","root","") or die("coudn't connect") ;
include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy");
if (isset($_POST['cname'])) {
    $cname = $_POST['cname'];
}
if (isset($_POST['add'])) {
    $add = $_POST['add'];
}
if (isset($_POST['mno'])) {
    $mno = $_POST['mno'];
}
if (isset($_POST['lno'])) {
    $lno = $_POST['lno'];
}
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
}
if (isset($_POST['fax'])) {
    $fax = $_POST['fax'];
}

if (isset($_POST['go'])) {

    $query = mysqli_query($mysqli, "SELECT * FROM supplier WHERE company_name='$cname'");
    $numrows = mysqli_num_rows($query);
    if ($numrows != 0) {
        ?>
        <script>
            alert("This supplier exist");
        </script>

        <?php
    } else {

        mysqli_query($mysqli, "INSERT INTO supplier (company_name,address,telephone,mobile,email,fax) VALUES ('$cname','$add','$mno','$lno','$mail','$fax');") or die("coudn't connect");
        ?>
        <script>
            alert("Added successfully");
        </script>
        <?php
    }
}
?>






<html>
    <head>
        <title>Add Supplier</title>
        <?php require('../includes/_header.php'); ?>
        <link href="css/addsupplier.css" rel="stylesheet" type="text/css">


        <script src="js/jquery.validate.min.js"></script>
        <script src="js/addsupplier.js"></script>
        <style>
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
        </style>

    </head>
    <body>
        <h2 style="position: relative; left:-450px;">Add Supplier</h2>


        <?php require_once("../includes/navigation.php") ?>


        <!--        gfh-->
        <div id="d1" style="position: relative; left:-40px;">
            <center>
                <fieldset>
                    <center>
                        <form method="post" action="addsupplier.php" id="form">

                            <table>
                                <tr height=60>
                                    <td ><span class="star">*</span>Company name</td>
                                    <td><input type="text" id="cname" name="cname" autocomplete="off"></td>
                                </tr>
                                <tr height=60>
                                    <td><span class="star">*</span>Address </td>
                                    <td><textarea rows="4" cols="22" type="text" id="add" name="add" autocomplete="off"></textarea></td>
                                </tr>
                                <tr height=60>
                                    <td><span class="star">*</span>Land number </td>
                                    <td><input type="text" id="lno" name="lno" autocomplete="off"></td>
                                </tr>
                                <tr height=60>
                                    <td><span class="star">*</span>Mobile number </td>
                                    <td><input type="text" id="mno" name="mno" autocomplete="off"></td>
                                </tr>
                                <tr height=60>
                                    <td><span class="star">*</span>Email </td>
                                    <td><input type="text" id="mail" name="mail" autocomplete="off"></td>
                                </tr>
                                <tr height=60>
                                    <td>Fax </td>
                                    <td><input type="text" id="fax" name="fax" autocomplete="off"></td>
                                </tr>
                            </table>
                            <input id="i1" type="submit" name="go" value="Add" >



                        </form>


                    </center>
                </fieldset>
            </center>
        </div>


        <?php require_once('../includes/_footer.php') ?>
    </body>
</html>