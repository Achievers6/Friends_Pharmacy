<!DOCTYPE html>
<?php
if ($_POST['submitReport']) {

    $dates = $_POST['dates'];
    $dates2 = $_POST['dates2'];


    $con = mysqli_connect("localhost", "root", "", "friends_pharmacy");

    $sql1 = "SELECT distinct(concat_ws(' ',staff.first_name,staff.last_name)) AS cashier,sum(bill_table.total) AS amount
                            FROM staff,bill_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND
                            staff.member_id=bill_table.staff_ID GROUP BY staff_ID; ";

    $result1 = mysqli_query($con, $sql1);

    if (mysqli_num_rows($result1) == 0) {
        echo '<script>alert("Data is not allowed")</script>';
        echo '<script>window.location="b.php"</script>';
    }
}
?>

<html>
    <head>
        <title>Add Supplier</title>
        <?php require('../includes/_header.php'); ?>
        <style>
            input[type=text], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 5px 8px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }



            div.net {
                border-radius: 5px;

                padding: 20px;
                width:1000px;

            }
            div.graph {
                border-radius: 5px;
                position: absolute;
                left: 300px;

                padding: 20px;
                width:1000px;

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
            }
            table {
                border-collapse: collapse;
                width: 70%;
                text-align: center;
                position: relative;
                left: 220px;
                background-color: rgb(229, 249, 212);



            }
            .center {
                text-align: center;

            }




            th, td {
                text-align: right-center;
                padding: 0px;
                border-bottom: 1px solid #ddd;
            }



            th {
                background-color: #4CAF50;
                color: white;
                width: 50px;
            }
            body {
                font-family: "Open Sans", Arial;
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
                position: relative;
                right: 140px;
            }
            h4 {
                position: relative;
                left: 230px;
            }


        </style>
    </head>
    <body>



        <?php require_once("../includes/navigation.php") ?>
        <div class="medium" style="position: relative; left: 225px;  top: 60px;">
            <div class="center">
                <h2>CASHIER WISE REPORT</h2>
            </div>

            <div class="net">
                <form action="#" method="POST">


                    <div class="above" style="text-align: center; font-size: 25px; position: relative; top:-30px; left:30px;">
                        Cashier Name : <?php echo "ALL"; ?> <br><br>
                    </div>

                    <h4>Date From : <?php echo $_POST["dates"]; ?></h4>
                    <h4>Date To : <?php echo $_POST["dates2"]; ?></h4>



                    <?php
                    //$cname = $_POST['cname'];

                    /* $cashier_name=$_POST['cashier_name']; */

                    $dates = $_POST['dates'];
                    $dates2 = $_POST['dates2'];


                    $con = mysqli_connect("localhost", "root", "", "friends_pharmacy");

                    $sql1 = "SELECT distinct(concat_ws(' ',staff.first_name,staff.last_name)) AS cashier,sum(bill_table.total) AS amount
                            FROM staff,bill_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND
                            staff.member_id=bill_table.staff_ID GROUP BY staff_ID; ";

                    $result1 = mysqli_query($con, $sql1);



                    /* $price1 = mysqli_query($con,"SELECT SUM(bill_table.total)AS amount FROM staff,bill_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2'AND
                      staff.member_id=bill_table.staff_ID GROUP BY staff_ID;");
                      $result = mysqli_fetch_array($price1); */


                    if (mysqli_num_rows($result1) > 0) {
                        echo "<table>";
                        echo "<tr><th>Cashier Name</th><th>Total (Rs)</th></tr>";

                        //$ar=array();
                        $name = array();
                        $price = array();
                        $counttotal = 0;
                        while ($row = mysqli_fetch_array($result1)) {
                            array_push($name, $row['cashier']);
                            array_push($price, $row['amount']);

                            //if(count(array_keys($ar, $row ['date']))==1){ 
                            //array_push($date, $row['date']);
                            /* if($counttotal != 0) {

                              //echo "<tr><td>"."TOTAL AMOUNT (Rs)" ."</td><td><hr/>".number_format($counttotal,2,'.','')."<hr/><hr/></td><tr>";


                              array_push($price,$counttotal);

                              } */
                            //array_push($price,$counttotal);
                            //$counttotal=$row['amount'];
                            echo"<tr><td>" . $row ['cashier'] . "</td><td style='text-align:center; position:reletive;'>" . "Rs &nbsp&nbsp&nbsp" . $row ['amount'] . "</td></tr>";
                            $counttotal+=$row['amount'];

                            //}
                            /* else{
                              echo"<tr><td>".""."</td><td>".$row ['cashier']."</td><td>".$row ['total']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['discount']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['amount']."</td></tr>";
                              $counttotal+=$row['amount'];


                             */


                            //echo"<tr><td>".$row ['cashier']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['amount']."</td></tr>";
                            //echo "<br>ID : ".$row{'m_code'}."m_name : ".$row{'m_name'}."com_name : ".$row{'com_name'}."shelf_no :".$row{'shelf_no'};
                        }

                        echo "<tr><td>" . "TOTAL AMOUNT " . "</td><td><hr/>" . "Rs &nbsp&nbsp&nbsp" . number_format($counttotal, 2, '.', '') . "<hr/><hr/></td><tr>";


                        //array_push($price,$counttotal);


                        /* echo "<tr><td>"."</td><td>"."TOTAL AMOUNT" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$result['SUM(selling_table.quantity * selling_table.unit_price)']."</td><tr>"; */



                        echo "</table>";

                        /* print_r($name);
                          print_r($price); */
                        ?>

                        <div  class="graph" style="position: relative; right: 150px; top: 30px">
                            <?php include("index.php");
                            ?>
                        </div>
                        <?php
                    } else {
                        echo '<script>alert("Data is not allowed")</script>';
                        echo '<script>window.location="b.php"</script>';
                    }
                    ?>



                </form>

            </div>
        </div>
        <div class="net" >
            <iframe id="prt" name="prt" style="display:none;"></iframe>
            <button style="vertical-align:middle" onclick="myFunction();"><span>Print </span></button>
            <script>
                function myFunction() {
                    var mywindow = window.open('', 'my div', 'height=800,width=1200');
                    //window.frames['prt'].document.write(document.getElementById("printContent").innerHTML);
                    mywindow.document.write('<link rel="stylesheet" href="aboutStyle.css" type="text/css" />	')
                    mywindow.document.write(document.getElementById("printContent").innerHTML);
                    mywindow.document.getElementsByClassName("location")[0].setAttribute("style", "padding:0px 180px;");
                    //mywindow.document.getElementsBytagName("tableNormal td")[0].setAttribute("style","text-align: center;");
                    mywindow.print();
                    mywindow.close();
                    //window.print();
                }
            </script>
        </div>


        <?php require_once('../includes/_footer.php') ?>
    </body>
</html>