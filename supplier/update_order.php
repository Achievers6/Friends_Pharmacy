<?php
include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");

            if(isset($_POST['add'])){
                //$med= $_POST['med'];
                $sup= $_POST['sup'];
                $dos= $_POST['dos'];
                $amnt= $_POST['amnt'];
                $date =$_POST['date'];
                echo $date;
                
                
                //echo $sql1;
                
                $sql = "select * from orders order by order_id desc limit 1";
                $res = mysqli_query($mysqli,$sql);
                while($row=mysqli_fetch_assoc($res)){
                    $oid = $row["order_id"];
                    
                    $sql2 = "update orders SET amount = '$amnt', supplier = '$sup' , date = '$date' , dosage = '$dos' where order_id = $oid ";
                    eh
                    
                    $result= mysqli_query($mysqli,$sql2);                    
                    
                }
                
                
                

            }
?>
