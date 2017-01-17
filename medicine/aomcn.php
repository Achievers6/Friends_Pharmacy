<!DOCTYPE html>
<?php
if ($_POST['submitReport']) {

    $name = $_POST['name'];
    $dates = $_POST['dates'];
    $dates2 = $_POST['dates2'];

    include '../database/dbconnect.php';
    //$con = mysqli_connect("localhost", "root", "", "friends_pharmacy");

    $sql1 = "  SELECT distinct(selling_table.medicine_name) AS medicine,
                                    sum(selling_table.quantity) AS quantity,selling_table.dosage,
                                    sum(selling_table.quantity * selling_table.unit_price) AS amount FROM bill_table,selling_table
                                    WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND
                                    bill_table.bill_number=selling_table.bill_number GROUP BY selling_table.medicine_name,selling_table.dosage;";

    $result1 = mysqli_query($mysqli, $sql1);
            
            if (mysqli_num_rows($result1) == 0) {
                echo '<script>alert("Data is not allowed")</script>';
                        echo '<script>window.location="sales.php"</script>';
            }
}
?>
<html>
    <head id="headTag">
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
                background-color: #F1F8E9;
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

            div.net {
                border-radius: 5px;

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
                align-self: right;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                text-align: center;
                position: relative;
                left: 160px;
                background-color: rgb(229, 249, 212);

            }
            .center {
                text-align: center;

            }




            th, td {
                text-align: center;
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
                background: #F1F8E9;
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
                left: 160px;
            }



        </style>
    </head>
    <body>
        <?php require_once("../includes/navigation.php") ?>
        <div class="medium" id='printContent' style="position: relative; left: 225px; top: 60px;">
            <div class='center'>
                <h2>SALES MEDICINE REPORT</h2>
            </div>

            <div class="net">
                <form action="#" method="POST">


                    <div class="above" style="text-align: center;  font-size: 25px; position: relative; top:-30px; left: 130px;">
                        Medicine Name : <?php echo $_POST["name"]; ?> <br><br>
                    </div>

                    <h4>Date From : <?php echo $_POST["dates"]; ?></h4> 
                    <h4>Date To : <?php echo $_POST["dates2"]; ?></h4>



                    <?php
                    $name = $_POST['name'];
                    //$cashier_name=$_POST['cashier_name'];

                    $dates = $_POST['dates'];
                    $dates2 = $_POST['dates2'];

                    include '../database/dbconnect.php';
                    //$con = mysqli_connect("localhost", "root", "", "friends_pharmacy");
                    if ($name == 'all') {
                        $sql1 = "  SELECT distinct(selling_table.medicine_name) AS medicine,
                                    sum(selling_table.quantity) AS quantity,selling_table.dosage,
                                    sum(selling_table.quantity * selling_table.unit_price) AS amount FROM bill_table,selling_table
                                    WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND
                                    bill_table.bill_number=selling_table.bill_number GROUP BY selling_table.medicine_name,selling_table.dosage;";

                        $result1 = mysqli_query($mysqli, $sql1);

                        if (mysqli_num_rows($result1) > 0) {
                            $rw = mysqli_num_rows($result1);
                            

                            /* $price1 = mysqli_query($con,"SELECT SUM(selling_table.quantity * selling_table.unit_price) FROM bill_table,selling_table WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND bill_table.bill_number=selling_table.bill_number;");
                              $result = mysqli_fetch_array($price1); */



                            echo "<table>";
                            echo "<tr><th>Medicine Name</th><th>Quantity</th><th>Dosage</th><th>Amount<br>(Rs)</th></tr>";
                            //$ar=array();
                            $medicine = array();
                            $price = array();
                            $counttotal = 0;
                            while ($row = mysqli_fetch_array($result1)) {
                                array_push($medicine, $row['medicine']);

                                //if(count(array_keys($ar, $row ['date']))==1){ 
                                array_push($price, $row['amount']);
                                /* if($counttotal != 0) {
                                  echo "<tr><td>"."</td><td>"."TOTAL AMOUNT (Rs)" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td><hr/>".number_format($counttotal,2,'.','')."<hr/><hr/></td><tr>";


                                  array_push($price,$counttotal);

                                  } */
                                echo"<tr><td>" . $row ['medicine'] . "</td><td>" . $row ['quantity'] . "</td><td>" . $row ['dosage'] . "</td><td>" . "Rs&nbsp&nbsp&nbsp" . $row ['amount'] . "</td></tr>";
                                $counttotal+=$row['amount'];

                                //}
                                /* else{
                                  echo"<tr><td>".""."</td><td>".$row ['medicine_name']."</td><td>".$row ['bill_number']."</td><td>".$row ['quantity']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['unit_price']."</td><td>".$row ['dosage']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['amount']."</td></tr>";
                                  $counttotal+=$row['amount'];


                                  } */




                                //echo "<br>ID : ".$row{'m_code'}."m_name : ".$row{'m_name'}."com_name : ".$row{'com_name'}."shelf_no :".$row{'shelf_no'};
                            }
                            echo "<tr><td>" . "TOTAL AMOUNT " . "</td><td>" . "</td><td>" . "</td><td><hr/>" . "Rs&nbsp&nbsp&nbsp" . number_format($counttotal, 2, '.', '') . "<hr/><hr/></td><tr>";


                            //array_push($price,$counttotal);


                            /* echo "<tr><td>"."</td><td>"."TOTAL AMOUNT" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$result['SUM(selling_table.quantity * selling_table.unit_price)']."</td><tr>"; */



                            echo "</table>";

                            /* print_r($medicine);
                              print_r($price); */
                            ?>
                            <div class="graph" style="position: relative; left: 180px; top: 60px">
                                <?php include("index.php"); ?>

                            </div>
                            <?php
                        } else {
                            echo '<script>alert("Data is not allowed")</script>';
                            echo '<script>window.location="sales.php"</script>';
                        }
                    } else {
                        $sql2 = "  SELECT distinct(selling_table.medicine_name) AS medicine,
                                    sum(selling_table.quantity) AS quantity,selling_table.dosage,
                                    sum(selling_table.quantity * selling_table.unit_price) AS amount FROM bill_table,selling_table
                                    WHERE bill_table.date BETWEEN '$dates' AND '$dates2' AND selling_table.medicine_name='$name'
                                    AND bill_table.bill_number=selling_table.bill_number GROUP BY selling_table.medicine_name,selling_table.dosage;";

                        $result1 = mysqli_query($mysqli, $sql2);


                        //$price2 = mysqli_query($con," SELECT SUM(quantity * selling_price) FROM selling WHERE medicine_id='$name';");
                        //$result = mysqli_fetch_array($price2);


                        if (mysqli_num_rows($result1) > 0) {
                            echo "<table>";
                            echo "<tr><th>Medicine Name</th><th>Quantity</th><th>Dosage</th><th>Amount<br>(Rs)</th></tr>";
                            //$ar=array();
                            $medicine = array();
                            $price = array();
                            $counttotal = 0;
                            while ($row = mysqli_fetch_array($result1)) {
                                array_push($medicine, $row['medicine']);

                                //if(count(array_keys($ar, $row ['date']))==1){ 
                                array_push($price, $row['amount']);
                                /* if($counttotal != 0) {
                                  echo "<tr><td>"."</td><td>"."TOTAL AMOUNT (Rs)" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td><hr/>".number_format($counttotal,2,'.','')."<hr/><hr/></td><tr>";


                                  array_push($price,$counttotal);

                                  } */
                                echo"<tr><td>" . $row ['medicine'] . "</td><td>" . $row ['quantity'] . "</td><td>" . $row ['dosage'] . "</td><td>" . "Rs&nbsp&nbsp&nbsp" . $row ['amount'] . "</td></tr>";
                                $counttotal+=$row['amount'];

                                //}
                                /* else{
                                  echo"<tr><td>".""."</td><td>".$row ['medicine_name']."</td><td>".$row ['bill_number']."</td><td>".$row ['quantity']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['unit_price']."</td><td>".$row ['dosage']."</td><td>"."Rs &nbsp&nbsp&nbsp".$row ['amount']."</td></tr>";
                                  $counttotal+=$row['amount'];


                                  } */




                                //echo "<br>ID : ".$row{'m_code'}."m_name : ".$row{'m_name'}."com_name : ".$row{'com_name'}."shelf_no :".$row{'shelf_no'};
                            }
                            echo "<tr><td>" . "TOTAL AMOUNT " . "</td><td>" . "</td><td>" . "</td><td><hr/>" . "Rs&nbsp&nbsp&nbsp" . number_format($counttotal, 2, '.', '') . "<hr/><hr/></td><tr>";


                            //array_push($price,$counttotal);


                            /* echo "<tr><td>"."</td><td>"."TOTAL AMOUNT" ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$result['SUM(selling_table.quantity * selling_table.unit_price)']."</td><tr>"; */



                            echo "</table>";

                            /* print_r($medicine);
                              print_r($price); */
                        }  else {
                            echo '<script>alert("Data is not allowed")</script>';
                            echo '<script>window.location="sales.php"</script>';
                            
                        }
                    }
                    ?>


                </form>

            </div>
            
            <div class="net" >
            <iframe id="prt" name="prt" style="display:none;"></iframe>
            <button style="vertical-align:middle;  position: relative; left: -500px; top: -10px; background-color: rgb(106,184,42);" onclick="myFunction();"><span>Print </span></button>
            <script>
                function myFunction() {
                    /*
                    var mywindow = window.open('', 'my div', 'height=800,width=1200');
                    //window.frames['prt'].document.write("<div class=\"medium\" style=\"position: relative; left: 225px; top: 60px;\">" + document.getElementById("printContent").innerHTML + "</div>");
                    mywindow.document.write('<head><link rel="stylesheet" href="aboutStyle.css" type="text/css" /> </head>')
                    mywindow.document.write("<body><div class=\"medium\" style=\"position: relative; left: 225px; top: 60px;\">" + document.getElementById("printContent").innerHTML + "</div></body>");
                    //mywindow.document.getElementsByClassName("location")[0].setAttribute("style", "padding:0px 180px;");
                    //mywindow.document.getElementsBytagName("tableNormal td")[0].setAttribute("style","text-align: center;");
                    //mywindow.print();
                    //mywindow.close();
                    //window.print();*/
                    document.getElementsByClassName("nav")[0].style.display = "none";
                    document.getElementById("headerdiv").style.display = "none";
                    window.print();
                    document.getElementsByClassName("nav")[0].style.display = "block";
                    document.getElementById("headerdiv").style.display = "block";
                }
            </script>
        </div>
        </div>
        <!--<iframe src="index2.php?date=$date&price=$price" style="height: 500px; width: 50%; position: absolute;"></iframe>-->
        


        <?php require_once('../includes/_footer.php') ?>
    </body>
</html>