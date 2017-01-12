<script>
    function showConfirm()
    {
        // build the confirmation box
        var c = confirm("Are you sure you wish to delete this item?");

        // if true, delete item and refresh
        if (c)
            window.location = "otc.php";
    }
</script>
<?php
session_start();
include '../database/dbconnect.php';
include ("../Entities/drugEntity.php");
include ("../Entities/stockEntity.php");
include 'drugcon.php';


if (isset($_POST["next"])) {
    $page = $_GET["page"] + 1;
} else if (isset($_POST["previous"])) {
    $page = $_GET["page"] - 1;
} else if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};

if (isset($_GET["cat"])) {
    $catname = $_GET["cat"];
    $query = "SELECT COUNT(id) AS total FROM drug where category='$catname'";
} else {
    $query = "SELECT COUNT(id) AS total FROM drug";
}

$results_per_page = 5;
$start_from = ($page - 1) * $results_per_page;

$resultpage = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
$row = $resultpage->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);


if (empty($_SESSION['cart'])) {
    $_SESSION['name'] = array("1");
    $_SESSION['cart'] = array("1");
    $_SESSION['qty'] = array("1");
    $_SESSION['dosage'] = array("1");
    $_SESSION['unitprice'] = array("0");
    $_SESSION['amount'] = array("0");
}
//session_destroy();
if (isset($_POST['btnsubmititem'])) {



    $name = $_POST['medname'];
    $dosagetype = $_POST['dosagetype'];
    $id = $_POST['id'];

    $query6 = "SELECT sum(quantity) from stock where dosage='$dosagetype' AND medicine_name='$name'";
    $result6 = mysqli_query($mysqli, $query6) or die(mysqli_error($mysqli));
    $row = mysqli_fetch_array($result6);
    $stockqty = $row[0];
    $needqty = $_POST['qtybox'];
  
    if("" == trim($_POST['qtybox'])){
        $idx = $_GET['id2'];
        $page = $_GET['page'];
        echo '<script language="javascript">';
        echo "var c = confirm('please enter valid quantity');";
        echo 'if (c)';
        echo "window.location = 'otc.php?id=$idx';";
        echo '</script>';
    }
    else if ($stockqty < $needqty) {
        $idx = $_GET['id2'];
        $page = $_GET['page'];

        echo '<script language="javascript">';
        echo "var c = confirm('$name $dosagetype only $stockqty units in the stock,please order low quantity');";
        echo 'if (c)';
        echo "window.location = 'otc.php?id=$idx';";
        echo '</script>';
    } else if (array_search($name, $_SESSION['name'])) {
        echo '<script language="javascript">';
        echo "var c = confirm('$name is already added to the shopping cart');";
        echo 'if (c)';
        echo "window.location = 'otc.php';";
        echo '</script>';
    } else {
        $query = "SELECT price from stock where dosage='$dosagetype' AND medicine_name='$name' AND entry_date = (select max(entry_date) from stock where medicine_name='$name' AND dosage='$dosagetype')";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $row = mysqli_fetch_array($result);
        array_push($_SESSION['name'], $_POST['medname']);
        array_push($_SESSION['cart'], $id);
        array_push($_SESSION['qty'], $_POST['qtybox']);
        array_push($_SESSION['dosage'], $dosagetype);
        array_push($_SESSION['unitprice'], $row[0]);
        array_push($_SESSION['amount'], ($row[0] * $needqty));



        echo '<script language="javascript">';
        echo "alert('$name is added to the shopping cart')";
        echo '</script>';
    }
}

if (isset($_GET["cat"])) {
    $catname = $_GET["cat"];
    $query = "SELECT * FROM drug where category='$catname' ORDER BY id ASC LIMIT $start_from, $results_per_page";
} else {
    $query = "SELECT * FROM drug ORDER BY id ASC LIMIT $start_from, $results_per_page";
}



$drugArray = array();
$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
while ($row = mysqli_fetch_array($result)) {


    $id = $row[0];
    $medicine_name = $row[1];
    $generic_name = $row[2];
    $type = $row[3];
    $category = $row[4];
    $supplier_id = $row[5];
    $discription = $row[6];
    $image = $row[7];
    $group_name = $row[8];


    $drug = new drugEntity($id, $medicine_name, $generic_name, $type, $category, $supplier_id, $discription, $image, $group_name);
    array_push($drugArray, $drug);
}

echo "<div id='notifications'>";
echo "<h3 id='h3' style='text-align: center; color:red;'>Shopping Cart</h3>";

echo "<p class='totaltxt' style='text-align: center  font:13px helvetica; font-weight:bold;'>Total :</p>";
echo "<p class='totalno' style='text-align: center' font:13px helvetica; font-weight:bold;>" . array_sum($_SESSION['amount']) . "</p>";

echo "<button class='addorder'  onclick='confirmorder()'><span>Add to Order list</span></button>";

echo "<div id=inner_noti>";
echo '<table id="myTable" class="sortable">';
echo '<tr>';
echo '<th>
            Medicine name
        </th>
        <th>
            Dosage
        </th>
         <th>
            Quantity
        </th>
         <th>
            Unit price
        </th> 
        <th>
            Amount
        </th>

         <th>
         
        </th>';
echo '</tr>';


foreach ($_SESSION['name'] as $key => $item) {
    echo '<tr>';

    echo '<td>';
    echo $item;
    echo '</td>';
    echo '<td>';
    echo $_SESSION['dosage'][$key];
    echo '</td>';
    echo '<td>';
    echo $_SESSION['qty'][$key];
    echo '</td>';
    echo '<td>';
    echo $_SESSION['unitprice'][$key];
    echo '</td>';
    echo '<td>';
    echo $_SESSION['amount'][$key];
    echo '</td>';
    echo '<td>';
    echo '<img  class="cancel" src="../public/image/cancel.png" style="width: 20px; height: 20px;">';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo "</div>";
echo "</div>";

//print_r($_SESSION['cart']);
//print_r($_SESSION['qty']);
//session_destroy();

$t = sizeof($_SESSION['cart']);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Friends Pharmacy</title>

        <meta charset="utf-8" />
        <link rel="stylesheet" href="../public/css/web/otcStyle.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../public/css/web/otcStyle.css" type="text/css" />
        <link rel="stylesheet" href="../public/css/web/cart.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../public/js/jquery-2.0.0.js"></script>
        <link href="../public/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style>

            .totaltxt {
                position: absolute;
                right: 380px;
                top:25px;
            }
            .totalno {
                position: absolute;
                right: 340px;
                top:25px;
            }
            .next,.previous {

                background-color: rgb(106,184,42);
                color: white;

                border: none;
                cursor: pointer;
                border-radius: 6px;
            }

            .addorder {
                width: 100px;
                height: autopx;
                position: absolute;
                right:5px; top:0px;
                background-color: rgb(106,184,42);
                color: white;
                padding: 10px 10px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                border-radius: 6px;

            }
            .addorder:hover {
                background-color:rgb(152, 214, 72);

            }
            .drugTable
            {
                width: 750px;
                height: 200px;
                padding-right: 30px;
                padding-bottom: -100px;
                background-color: white;

            }

            .drugTable tr th, .drugTable tr td
            {
                text-align: left;
                padding: 0px 5px 0 5px;
            }

            .drug img
            {
                padding: 0px 10px 10px 10px;
                height: 150px;
                width: 150px;
                -moz-border-radius: 50px;
                -webkit-border-radius: 50px;
                border-radius: 50px;
            }
            .cancel {
                cursor:pointer;
            }
            #noti_Button {
                cursor:pointer;
            }
            #noti_Counter {
                display:block;
                position:absolute;

                right:30px;
                background:#E1141E;
                color:#FFF;
                font-size:12px;
                font-weight:normal;
                padding:1px 3px;
                margin:-8px 0 0 25px;
                border-radius:2px;
                -moz-border-radius:2px; 
                -webkit-border-radius:2px;
                z-index:1;
            }

            /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
            #notifications {
                display:none;
                width:430px;
                position:absolute;
                top:60px;
                right:5px;
                background:#FFF;
                border:solid 1px rgba(100, 100, 100, .20);
                -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
                z-index: 0;
                border-radius: 6px;
            }
            /* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
            #notifications:before {         
                content: '';
                display:block;
                width:0;
                height:0;
                color:transparent;
                border:10px solid #CCC;
                border-color:transparent transparent #FFF;
                margin-top:-20px;
                margin-left:80%;
            }
            #inner_noti {
                border-bottom:solid 1px rgba(100, 100, 100, .30);
                background-color: #caf7a3;

            }

            #bbc {
                color: #0066cc;

            }
            .container-1{
                width: 300px;
                vertical-align: middle;
                white-space: nowrap;
                position: relative;

            }
            .container-1 input#search{
                width: 300px;
                height: 35px;
                background: #d1e0e0;
                border: none;
                font-size: 10pt;
                float: left;
                color: #63717f;
                padding-left: 45px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
            }
            .container-1 .icon{
                position: absolute;
                top: 50%;
                margin-left: 13px;
                margin-top: 5px;
                z-index: 1;
                color: #4f5b66;
            }
            .container-1 input#search::-webkit-input-placeholder {
                color: #65737e;
            }

            .container-1 input#search:-moz-placeholder { /* Firefox 18- */
                color: #65737e;  
            }

            .container-1 input#search::-moz-placeholder {  /* Firefox 19+ */
                color: #65737e;  
            }

            .container-1 input#search:-ms-input-placeholder {  
                color: #65737e;  
            }
            .container-1 input#search:hover, .container-1 input#search:focus, .container-1 input#search:active{
                outline:none;
                background: #c2d6d6;
            }
            .to {
                color: #777777;
                position: relative;
                top: 10px;
            }
            .myButton {
                position: relative; 
                left: 125px; 

                -moz-box-shadow: 0px 1px 0px 0px #fff6af;
                -webkit-box-shadow: 0px 1px 0px 0px #fff6af;
                box-shadow: 0px 1px 0px 0px #fff6af;
                background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffec64), color-stop(1, #ffab23));
                background:-moz-linear-gradient(top, #ffec64 5%, #ffab23 100%);
                background:-webkit-linear-gradient(top, #ffec64 5%, #ffab23 100%);
                background:-o-linear-gradient(top, #ffec64 5%, #ffab23 100%);
                background:-ms-linear-gradient(top, #ffec64 5%, #ffab23 100%);
                background:linear-gradient(to bottom, #ffec64 5%, #ffab23 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffec64', endColorstr='#ffab23',GradientType=0);
                background-color:#ffec64;
                -moz-border-radius:19px;
                -webkit-border-radius:19px;
                border-radius:19px;
                border:2px solid #ffaa22;
                display:inline-block;
                cursor:pointer;
                color:#333333;
                font-family:Trebuchet MS;
                font-size:16px;
                font-weight:bold;
                padding:7px 16px;
                text-decoration:none;
                text-shadow:0px 1px 0px #ffee66;
            }
            .myButton:hover {
                background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffab23), color-stop(1, #ffec64));
                background:-moz-linear-gradient(top, #ffab23 5%, #ffec64 100%);
                background:-webkit-linear-gradient(top, #ffab23 5%, #ffec64 100%);
                background:-o-linear-gradient(top, #ffab23 5%, #ffec64 100%);
                background:-ms-linear-gradient(top, #ffab23 5%, #ffec64 100%);
                background:linear-gradient(to bottom, #ffab23 5%, #ffec64 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffab23', endColorstr='#ffec64',GradientType=0);
                background-color:#ffab23;
            }

            .mdh {
                text-align:center; 
                color: green; 
                font-family: SourceSansPro;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 50px 0;
            }

        </style>



    </head>
    <body>

        <div id="noti_Container" >
            <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
            <div id="noti_Button">
                <div>
                    <img  class="cancel" src="../public/image/cart1.png" style="width: 50px; height: 50px; position: absolute; right: 10px;">    
                </div>
            </div>  
            <?php
            echo "<div id='notifications'>";
            echo "<h3 id='h3' style='text-align: center; color:red;'>Shopping Cart</h3>";

            echo "<p class='totaltxt' style='text-align: center  font:13px helvetica; font-weight:bold;'>Total :</p>";
            echo "<p class='totalno' style='text-align: center' font:13px helvetica; font-weight:bold;>" . array_sum($_SESSION['amount']) . "</p>";

            echo "<button class='addorder'  onclick='confirmorder()'><span>Add to Order list</span></button>";

            echo "<div id=inner_noti>";
            echo '<table id="myTable" class="sortable">';
            echo '<tr>';
            echo '<th>
            Medicine name
        </th>
        <th>
            Dosage
        </th>
         <th>
            Quantity
        </th>
         <th>
            Unit price
        </th> 
        <th>
            Amount
        </th>

         <th>
         
        </th>';
            echo '</tr>';


            foreach ($_SESSION['name'] as $key => $item) {
                if ($key != 0) {
                    echo '<tr>';

                    echo '<td>';
                    echo $item;
                    echo '</td>';
                    echo '<td>';
                    echo $_SESSION['dosage'][$key];
                    echo '</td>';
                    echo '<td>';
                    echo $_SESSION['qty'][$key];
                    echo '</td>';
                    echo '<td>';
                    echo $_SESSION['unitprice'][$key];
                    echo '</td>';
                    echo '<td>';
                    echo $_SESSION['amount'][$key];
                    echo '</td>';
                    echo '<td>';
                    echo '<img  class="cancel" src="../public/image/cancel.png" style="width: 20px; height: 20px;">';
                    echo '</td>';
                   
                    echo '</tr>';
                }
            }
            echo '</table>';
            echo "</div>";
            echo "</div>";
            ?>
        </div>


        <?php require '../includes/customer_header.php'; ?>
        <?php require '../includes/slideshow.php'; ?>

        <div class="content">
            <article>
                <a href="catbrows.php" id="bbc"><p>Browse by category</p></a>


                <hr>
                <table>
                    <td>
                        <h2 class="to">Search for a medicine:</h2>
                    </td>
                    <td>

                        <form>
                            <div class="container-1">
                                <span class="icon"><i class="fa fa-search"></i></span>
                                <input type="search" placeholder="Search..." id="search" />
                            </div>
                        </form>
                    </td>
                </table>
                <div id="contentProduct">

                    <?php foreach ($drugArray as $key => $drug) { ?>

                        <table class = 'drugTable'>
                            <tr>

                                <?php echo "<th rowspan='6' width = '150px' ><img runat = 'server' src = '$drug->image' /></th>" ?>

                                <th width = '75px' >Brand: </th>
                                <td><?php echo $drug->medicine_name ?> </td>
                            </tr>

                            <tr>
                                <th>Generic: </th>
                                <td><?php echo $drug->generic_name ?></td>
                            </tr>

                            <tr>
                                <th>Group: </th>
                                <td><?php echo $drug->group_name ?></td>
                            </tr>

                            <tr>
                                <th>Type: </th>
                                <td><?php echo $drug->type ?></td>
                            </tr>

                            <tr>
                                <th>Category: </th>
                                <td><?php echo $drug->category ?></td>
                            </tr>

                            <tr>
                                <td colspan='2' ><?php echo $drug->discription ?></td>
                            </tr>   

                        </table>




                        <a href='#' onclick= "window.location.href = 'otc.php?id=<?php echo $drug->id ?>&page=<?php echo $page ?>'">
                            <img src='../public/image/addCart.png' style="width: 200px; height: 110px;; position: relative; left: 590px; top:-40px;;" >
                        </a>

                        

                    <?php } ?>
                    <table>
                        <tr>


                            <?php if (!($page <= 1)) { ?>
                                <?php echo " <form name = 'myFormprevious' action = 'otc.php?page=$page' method = 'post'>" ?>

                                <td><input type='submit' style=" height:25px; width: 90px; " name="previous" value="Back" class="previous"></td>

                                <?php echo "</form>" ?>
                            <?php } ?>
                            <?php if ($total_pages > $page) { ?>
                                <?php echo " <form name = 'myFormnext' action = 'otc.php?page=$page' method = 'post'>" ?>

                                <td><input type='submit' name="next" class="next" value="Next" style="height:25px; width: 90px;"></td>

                                <?php echo "</form>" ?>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </article>
        </div>
        <aside class="topSide">			
            <img src="../public/image/add3.jpg">
        </aside>

        <aside class="bottomSide">		
            <img src="../public/image/add2.jpg">
        </aside>


        <?php require '../includes/customer_footer.php'; ?>
        

        <?php if (isset($_GET['id'])) { ?>
            <?php if (isset($_GET['id']) && isset($_SESSION['email']) && !empty($_SESSION['email'])) { ?>
                <?php echo $id2 = $_GET['id']; ?>

                <?php
                $query = "SELECT * FROM drug where id=$id2";
                $drugarray = array();
                $result1 = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
                while ($row = mysqli_fetch_array($result1)) {
                    $id = $row[0];
                    $medicine_name = $row[1];
                    $generic_name = $row[2];
                    $type = $row[3];
                    $category = $row[4];
                    $supplier_id = $row[5];
                    $discription = $row[6];
                    $image = $row[7];
                    $group_name = $row[8];
                    $drugforcart = new drugEntity($id, $medicine_name, $generic_name, $type, $category, $supplier_id, $discription, $image, $group_name);
                }



                $query3 = "SELECT DISTINCT dosage from stock where medicine_name='$drugforcart->medicine_name'";
                $result3 = mysqli_query($mysqli, $query3) or die(mysqli_error($mysqli));
                $disdosage = array();



                while ($row = mysqli_fetch_array($result3)) {
                    array_push($disdosage, $row[0]);
                }

                $disprice = array();
                foreach ($disdosage as $val) {
                    $query4 = "SELECT price from stock where dosage='$val' AND medicine_name='$drugforcart->medicine_name' AND entry_date = (select max(entry_date) from stock where medicine_name='$drugforcart->medicine_name' AND dosage='$val')";
                    $result4 = mysqli_query($mysqli, $query4) or die(mysqli_error($mysqli));
                    while ($row = mysqli_fetch_array($result4)) {
                        array_push($disprice, $row[0]);
                    }
                }
                $disid = array();
                foreach ($disdosage as $val) {
                    $query5 = "SELECT id from stock where dosage='$val' AND medicine_name='$drugforcart->medicine_name' AND expire_date = (select MIN(expire_date) from stock where medicine_name='$drugforcart->medicine_name' AND dosage='$val')";
                    $result5 = mysqli_query($mysqli, $query5) or die(mysqli_error($mysqli));
                    while ($row = mysqli_fetch_array($result5)) {
                        array_push($disid, $row[0]);
                    }
                }
                $disqty = array();
                foreach ($disdosage as $val) {
                    $query6 = "SELECT sum(quantity) from stock where dosage='$val' AND medicine_name='$drugforcart->medicine_name'";
                    $result6 = mysqli_query($mysqli, $query6) or die(mysqli_error($mysqli));
                    while ($row = mysqli_fetch_array($result6)) {
                        array_push($disqty, $row[0]);
                    }
                }



                mysqli_close($mysqli);
                ?>
                <?php if (sizeof($disqty) > 0) { ?>

                    <div id = 'myModal' class = 'modal'>
                        <div class = 'modal-content' style="padding: 20px; outline-style: double;">
                            <h2 class="mdh" style = 'text-align:center;'><?php echo $drugforcart->medicine_name ?></h2>
                            <a href='otc.php'>
                                <img src='../public/image/cancel.png' style="width: 35px; height: 35px; position: relative; left: 515px; top:-100px;" >
                            </a>
                            <div class="inter" style="position: relative; top: -40px;">
                                <?php echo " <form name = 'myForm2' action = 'otc.php?id2=$id2&page=$page' method = 'post' onsubmit = 'return validateForm2()'>" ?>
                                <table class = 'drugforcartTable' >
                                    <tr>

                                        <?php echo "<th rowspan='6' width = '120px' ><img runat = 'server' src = '$drugforcart->image'/></th>" ?>
                                        <td><input type="hidden" name ="medname" value=<?php echo $drugforcart->medicine_name ?> ></td>
                                        <td><input type="hidden" name ="id" value=<?php echo $drugforcart->id; ?> ></td>


                                    </tr>

                                    <tr>
                                        <th>Generic: </th>
                                        <td><?php echo $drugforcart->generic_name ?></td>

                                    </tr>

                                    <tr>
                                        <th>Group: </th>
                                        <td><?php echo $drugforcart->group_name ?></td>
                                    </tr>

                                    <tr>
                                        <th>Type: </th>
                                        <td><?php echo $drugforcart->type ?></td>
                                    </tr>

                                    <tr>
                                        <th>Category: </th>
                                        <td><?php echo $drugforcart->category ?></td>
                                    </tr>

                                    <tr>
                                        <td colspan='2' ><?php echo $drugforcart->discription ?></td>
                                    </tr> 

                                    <tr>


                                        <td></td>
                                        <td>Dosage:</td>

                                        <td>
                                            <select name = 'dosagetype' style="width: 173px;">

                                                <?php foreach ($disdosage as $value) { ?>
                                                    <?php $drid = $disid[array_search($value, $disdosage)] ?>
                                                    <?php $drprice = $disprice[array_search($value, $disdosage)] ?>
                                                    <?php echo "<option value=$value>$value" . " (Rs " . $disprice[array_search($value, $disdosage)] . ")" . "</option>"; ?>
                                                <?php } ?>
                                            </select>      
                                        </td>

                                    </tr>

                                    <td></td>
                                    <td>Quantity:</td>
                                    <td><input type="number" name='qtybox'></td>
                                    <td>

                                    </td>

                                    </tr>

                                    <tr>
                                        <td align="center"><?php foreach ($disdosage as $value) { ?>
                                                <?php echo $value . " " . $disqty[array_search($value, $disdosage)] . " unit in stock<br>"; ?>
                                            <?php } ?></td>

                                        <td><input type = 'submit' class="myButton" name = 'btnsubmititem' value='Add to cart'><td>


                                    </tr>   

                                </table>
                                <?php
                                "</form>"
                                ?>

                            </div>
                        </div>
                    </div>
                    <?php
                } else
                if ((sizeof($disqty) == 0)) {
                    echo '<script language="javascript">';
                    echo "alert('This medicine is not in stock  ')";
                    echo '</script>';
                }
                ?>
            <?php } else if (isset($_GET['id']) && !isset($_SESSION['email']) && empty($_SESSION['email'])) { ?>        
                echo'<script>alert("\t\t\tYou are not logged in.\nPlease logged in before make an order.");
            window.location.href = "otc.php?page=<?php echo $page ?>";</script>';

            <?php } ?>
        <?php } ?>


    </body>
</html>

<script>
    function confirmorder() {
        var t = <?php echo $t ?>;
        if (t != 0) {
            var c = confirm("Confirm your order");

            // if true, delete item and refresh
            if (c)
                window.location = "addOrder.php";
        }
        else {
            alert("Order is empty!");
        }
    }

    $(".cancel").click(function() {
        var index = $(this).closest("tr").index();
        $('.totalno').hide();
        if (index != '')
        {
            $.ajax({
                url: "removecart.php",
                method: "POST",
                data: {query: index},
                success: function(data)
                {
                    $('.totalno').show();
                    $('.totalno').html(data);
                }

            });
        }

        var here = this;

        $(this).closest('tr').find('td').fadeOut('fast',
                function(here) {
                    $(here).parents('tr:first').remove();
                });


    });



    $(document).ready(function() {

        // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
        $('#noti_Counter')
                .css({opacity: 0})
                .text(<?php echo count($_SESSION['cart']) - 1; ?>)               // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
                .css({top: '-15px', right: '10px'})
                .animate({top: '10px', opacity: 1}, 500);

        $('#noti_Button').click(function() {

            // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
            $('#notifications').fadeToggle('fast', 'linear', function() {
                if ($('#notifications').is(':hidden')) {
                    $('#noti_Button').css('background-color', '#2E467C');
                }
                else
                    $('#noti_Button').css('background-color', '#FFF');        // CHANGE BACKGROUND COLOR OF THE BUTTON.
            });

            $('#noti_Counter').fadeOut('slow');                 // HIDE THE COUNTER.

            return false;
        });

        // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
        $(document).click(function() {


            // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
            if ($('#noti_Counter').is(':hidden')) {
                // CHANGE BACKGROUND COLOR OF THE BUTTON.
                $('#noti_Button').css('background-color', '#2E467C');
            }
        });

        $('#notifications').click(function() {
            return True;       // DO NOTHING WHEN CONTAINER IS CLICKED.
        });
    });

    $(document).ready(function() {
        $('#search').keyup(function() {
            var query = $(this).val();

            $.ajax({
                url: "searchProduct.php",
                method: "POST",
                data: {query: query},
                success: function(data)
                {
                    $('#contentProduct').fadeIn();
                    $('#contentProduct').html(data);
                }
            });

        });

    });

</script>




