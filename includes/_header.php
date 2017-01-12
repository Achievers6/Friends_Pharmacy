<?php
require ("../Entities/stockEntityHead.php");
$host = "localhost";
$user = "root";
$passwd = "";
$database = "friends_pharmacy";
$mysqli = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());
$query = mysqli_query($mysqli, "SELECT * FROM stock where 21>DATEDIFF(expire_date,CURDATE()) and 0<DATEDIFF(expire_date,CURDATE());");
$query2 = mysqli_query($mysqli, "SELECT * FROM cust_orders where status = 'not confirmed';");

$rows = mysqli_num_rows($query);
$orderrows = mysqli_num_rows($query2);

$stockArray = array();

while ($row = mysqli_fetch_array($query)) {
    $id = $row[0];
    $medicineName = $row[1];
    $batchNumber = $row[2];
    $quantity = $row[3];
    $entry_date = $row[4];
    $production_date = $row[5];
    $EXP_date = $row[6];


    //Create stock objects and store them in an array.
    $stock = new StockEntityHead($id, $medicineName, $batchNumber, $quantity, $entry_date, $production_date, $EXP_date);
    array_push($stockArray, $stock);
}
?>

<!DOCTYPE html>

<html>
    <head>

        <script src="../public/js/jquery-2.0.0.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {

                // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
                $('#order_Counter')
                        .css({opacity: 0})
                        .text('<?php echo $orderrows ?>')               // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
                        .css({top: '-10px'})
                        .animate({top: '-2px', opacity: 1}, 500);

                $('#noti_Counter')
                        .css({opacity: 0})
                        .text('<?php echo $rows ?>')               // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
                        .css({top: '-10px'})
                        .animate({top: '-2px', opacity: 1}, 500);

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
                    $('#notifications').hide();

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
        </script>

        <link rel="stylesheet" type="text/css" href="../public/css/application.css"/>

        <style>
            .ul {
                position: fixed;
                display:block;
                background:#6AB82A;
                list-style:none;
                margin:0;
                padding:12px 10px;
                height:21px;
                z-index: +1;
                width: 100%;

            }
            #logout {
                position: absolute;
                right: 25px;
            }
            #orders {
                position: absolute;
                right: 270px;
            }
            #msg {
                position: absolute;
                right: 350px;
            }
            .ul .li {
                float:left;
                font:13px helvetica;
                font-weight:bold;
                margin:3px 0;
            }
            .ul .li a {
                color:#FFF;
                text-decoration:none;
                padding:6px 15px;
                cursor:pointer;
            }
            .ul .li a:hover {

                text-decoration:none;
                cursor:pointer;
            }

            #noti_Container {
                position:absolute;

                right: 450px;

                z-index: +1;

            }

            /* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
            #noti_Button {
                width:22px;
                height:22px;
                line-height:22px;
                border-radius:50%;
                -moz-border-radius:50%; 
                -webkit-border-radius:50%;
                background:#FFF;
                margin:-3px 10px 0 10px;
                cursor:pointer;

            }

            /* THE POPULAR RED NOTIFICATIONS COUNTER. */
            #noti_Counter {
                display:block;
                position:absolute;
                left: 25px;
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
            #order_Counter {
                display:block;
                position:absolute;
                right: 80px;
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
                top:30px;
                left:0;
                background:#FFF;
                border:solid 1px rgba(100, 100, 100, .20);
                -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
                z-index: 0;
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
                margin-left:10px;
            }
            #inner_noti {
                border-bottom:solid 1px rgba(100, 100, 100, .30);
                background-color: #caf7a3;
            }
            #inner_noti:hover {
                background-color: #a9f26a;
            }

            #h3 {
                display:block;
                color:#333; 
                background:#FFF;
                font-weight:bold;
                font-size:13px;    
                padding:8px;
                margin:0;
                border-bottom:solid 1px rgba(100, 100, 100, .30);

            }

            .seeAll {
                background:#F6F7F8;
                padding:8px;
                font-size:12px;
                font-weight:bold;
                border-top:solid 1px rgba(100, 100, 100, .30);
                text-align:center;
            }
            .seeAll a {
                color:#3b5998;
            }
            .seeAll a:hover {
                background:#F6F7F8;
                color:#3b5998;
                text-decoration:underline;
            }
            #link1:link {
                text-decoration: none;
                color: none;
            }
            #link1:visited {
                color: none;
            }
            #lblneworders {
                display: none;
            }
            #lblexp {
                font:13px helvetica;
                font-weight:bold;
                display: none;
            }
            #order_Button:hover + #lblneworders {
                display: block;
            }
            #noti_Button:hover + #lblexp {
                display: block;
            }
            a, u {
                text-decoration: none;
                color:#000000;
            }
          
            a:visited {color:#808080;}  /* visited link */
            a:active {color:#0000FF;} 

            .nav {
                overflow: scroll;
            }


        </style>
    </head>


    <body style="margin:0;padding:0;">
        <div>
            <ul class="ul">
                <li class="li" id="logout"><a href="../web/index.php">Logout</a></li>

                <li class="li" id="orders">
                    <div id="order_Counter"></div> 
                    <div id="order_Button">
                        <a href="../pharmacist/cust_orders.php"><img  src="../public/image/orders.png" style="display: block; margin-left: auto; margin-right: auto; width:35px; height:35px; position:relative; right:90px;  top:-28px;"></a>   
                    </div>
                    <div id="lblneworders" style="position: absolute; right:60px;  top:33px; width:80px; ">new orders</div>
                </li>





                <li id="noti_Container" >
                    <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                    <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                    <div id="noti_Button">
                        <div>
                            <img  src="../public/image/exp.png"  style="display: block; margin-left: auto; margin-right: auto; width:35px; height:35px; position: relative; top: -5px;">    
                        </div>

                    </div>   
                    <div id="lblexp" style="position: absolute; right:-30px;  top:33px; width:80px; ">short expiry</div>
                    <div id="notifications">
                        <h3 id="h3">Short expiry</h3>
                        <?php
                        foreach ($stockArray as $key => $stock) {
                            $resultim = mysqli_query($mysqli, "SELECT image FROM drug where medicine_name = '$stock->medicine_name';");
                            $rowim= mysqli_fetch_array($resultim);
                           $medname = urlencode($stock->medicine_name);
                          
                            echo "<div id=inner_noti>
                                <table>
                                <tr>
                                <td style='padding:5px;'><img  src='$rowim[0]'  style='display: block; margin-left: auto; margin-right: auto; width:35px; height:35px; position: relative; top: -5px;'> </td>   
                                <td><a href='../pharmacist/removeStock2.php?outofstock=$medname'> $stock->medicine_name  $stock->quantity quantity will expire on $stock->expire_date date according to $stock->batch_no batch number</a></td>
                                <tr>
</table>
                                </div>";
                        }
                        ?>
                        
                        <div class="seeAll"><a href="../pharmacist/removeStock2.php?allOutDate=1;">All short expiry</a></div>
                    </div>
                </li>

            </ul>
        </div>

