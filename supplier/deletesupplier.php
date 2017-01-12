
<html>
    <head>
        <title>Delete supplier</title>
        <?php
        require('../includes/_header.php');
//        session_start();
        ?>
        <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>  
        <link type="text/css" rel="stylesheet" href="css/deletesupplier.css"/>
    </head>
    <body>
        <h2>Delete Supplier</h2>
        <?php require_once("../includes/navigation.php") ?>
        <?php
//         session_start();
        $output = '';
        ?>
        <div id="alldiv">
            <div id="d1">
                <form action="deletesupplier.php" method="post">
                    <input type="text" placeholder="Company name" id="companyname" name="companyname" autocomplete="off">
                    <div id="companyList"><?php echo $output ?></div>
                    <input id="load" type="submit" name="search" value="Search">
                </form>
            </div>
            <div>
                <form method="post" action="deletesupplier.php">
                    <table id="tbl">

                        <?php
                        //include('deletesupplierdb.php');
                        include '../database/dbconnect.php';

                        if (isset($_POST['search'])) {
                            $companyname = $_POST['companyname'];
                            $sql = "SELECT supplier_id from supplier where company_name='$companyname'";
                            $result = mysqli_query($mysqli, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $_SESSION['supid'] = $row['supplier_id'];
                                    $supid = $row['supplier_id'];
                                    echo "<h4>Supplier : $companyname</h4>";
                                    echo "<input id='btn' type='submit' name='delete' value='Delete' />";
                                    $drugs = mysqli_query($mysqli, "SELECT * FROM drug_price WHERE id='$supid' ");
                                    echo "<tr><th>Medicine Name</th><th>Dosage</th><th>Price</th></tr>";
                                    if (mysqli_num_rows($drugs) > 0) {
                                        while ($drugrow = mysqli_fetch_assoc($drugs)) {
                                            $medicinename = $drugrow['medicine_name'];
                                            $dosage = $drugrow['dosage'];
                                            $price = $drugrow['price'];
                                            echo "<tr><td>$medicinename</td><td>$dosage</td><td>$price</td></tr>";
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </table>
                    <?php
                    if (isset($_POST['delete'])) {
                        $supid = $_SESSION['supid'];
                        $quantity = mysqli_query($mysqli, "select id,sum(quantity) as total from stock where id='$supid' ");
                        if (mysqli_num_rows($quantity) > 0) {
                            while ($quanrow = mysqli_fetch_assoc($quantity)) {
                                $total = $quanrow['total'];
                                if ($total == 0) {
                                    $sql2 = "DELETE FROM supplier WHERE id='$supid'";
                                    mysqli_query($mysqli, $sql2) or die("Couldn't Delete the supplier");
                                } else {
                                    echo "Stock contains items from this supplier";
                                }
                            }
                        }

                        //echo "Deleted supplier";
                    }
//          session_destroy();
                    ?>
                </form>
            </div>
        </div>
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
                    url: "deletesupplierdb.php",
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