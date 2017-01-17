<?php
error_reporting(0);

$displayForm = "display:none";

$output = '';
$cname = '';
$add = '';
$lno = '';
$mno = '';
$mail = '';
$fax = '';
//$con=mysqli_connect("localhost","root","") or die("Couldn't connect sql");
include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");

if (isset($_POST['search'])) {

    $company = $_POST['company'];

    $displayForm = "display:none";

    $query1 = mysqli_query($mysqli, "SELECT * FROM supplier WHERE company_name='$company'") or die("don't work");

    if ($query1) {
        $displayForm = "display:block";
    }
}

if (isset($_POST['go'])) {
    $cname = $_POST['cname'];
    $add = $_POST['add'];
    $lno = $_POST['lno'];
    $mno = $_POST['mno'];
    $mail = $_POST['mail'];
    $fax = $_POST['fax'];

    $query2 = mysqli_query($mysqli, "UPDATE supplier set company_name='$cname' ,address='$add',telephone='$lno', mobile='$mno', email='$mail',fax='$fax'   WHERE company_name='$cname'");
    ?>
    <script>
        alert("Updated successfully!");
    </script>
    <?php
}
?>





<html>
    <head>
        <title>Update supplier details</title>
        <script type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="css/updatesupplier.css" >
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/updatesupplier.js"></script>
<?php require('../includes/_header.php'); ?>

        <style>
            .error {
                color: #ff0000;


            }

            label.error {
                display:block;
                height:17px;
                margin-left:9px;
                padding:1px 5px 0px 5px;
                font-size:medium;
                position:absolute;
                left:270px;

            }

        </style>




    </head>

    <body>
        <h2 style="position: relative; left:-540px;">Update supplier</h2>
<?php require_once("../includes/navigation.php") ?>
        <div id="search_box">
            <form id="search_form" method="post" action="" >
                <input type="text" placeholder="Enter company name" id="companyname" name="company" autocomplete="off">
                <div id="companyList"><?php echo $output ?></div><br><br><br>
                <input type="submit" name="search" id="search" value="Search">
            </form>   
        </div>

<?php while ($rows = mysqli_fetch_assoc($query1)) { ?>


            <div id="update_box" style="<?php echo $displayForm ?>" >
                <fieldset>
                    <form id="update_form" method="post" action="updatesupplier.php" >

                        <table id="tbl">
                            <tr height=60>
                                <td><span class="star">*</span>Company name</td>
                                <td><input type="text" id="cname" name="cname"  value="<?php echo $rows['company_name']; ?>" ></td>
                            </tr>
                            <tr height=60>
                                <td><span class="star">*</span>Address </td>
                                <td><textarea cols="22" rows="4" type="text" id="add" name="add" value="<?php echo $rows['address']; ?> "><?php echo $rows['address']; ?> </textarea></td>
                            </tr>
                            <tr height=60>
                                <td><span class="star">*</span>Land number </td>
                                <td><input type="text" id="lno" name="lno" value="<?php echo $rows['telephone']; ?> "></td>
                            </tr>
                            <tr height=60>
                                <td><span class="star">*</span>Mobile number </td>
                                <td><input type="text" id="mno" name="mno" value="<?php echo $rows['mobile']; ?> "></td>
                            </tr>
                            <tr height=60>
                                <td><span class="star">*</span>Email </td>
                                <td><input type="text" id="mail" name="mail" value="<?php echo $rows['email']; ?>"></td>
                            </tr>
                            <tr height=60>
                                <td>Fax </td>
                                <td><input type="text" id="fax" name="fax" value="<?php echo $rows['fax']; ?>"></td>
                            </tr>
                        </table>
                        <input  type="submit" name="go" value="Update" id="update" >

                    </form>

                </fieldset>
            </div>

<?php } ?>
        <?php require_once('../includes/_footer.php') ?>

    </body>
</html>




<script>
    $(document).ready(function() {
        $('#companyname').keyup(function() {
            var query = $(this).val();
            if (query != '')
            {
                $.ajax({
                    url: "updatesupplierdb.php",
                    method: "POST",
                    data: {query: query},
                    success: function(data)
                    {
                        $('#companyList').fadeIn();
                        $('#companyList').html(data);
                    }
                });
            }
        });
        $(document).on('click', 'li', function() {
            $('#companyname').val($(this).text());
            $('#companyList').fadeOut();


        });

    });

</script>