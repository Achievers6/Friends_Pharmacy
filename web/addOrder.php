<?php

session_start();
include '../database/dbconnect.php';
$email = $_SESSION["email"];
$name = $_SESSION['name'];
$stockid = $_SESSION['cart'];
$qty = $_SESSION['qty'];
$doage = $_SESSION['dosage'];

$total = array_sum($_SESSION['amount']);
$quary0 = "SELECT order_no FROM cust_orders ORDER BY order_no DESC LIMIT 1";
$result = mysqli_query($mysqli, $quary0);
$row = mysqli_fetch_row($result);
$order_no = $row[0] + 1;



$query1 = "INSERT INTO cust_orders
            (order_no,cust_email,date,total,status)
             VALUES
             ('$order_no','$email', CURDATE(),'$total','not confirmed')";

mysqli_query($mysqli, $query1);

foreach ($name as $index => $val) {
    $query3 = "INSERT INTO cust_orders_items
            (order_no,medicine_name,dosage,qty)
             VALUES
             ('$order_no','$val', '$doage[$index]','$qty[$index]]')";
    if (mysqli_query($mysqli, $query3)) {
        
    }
}

mysqli_close($mysqli);
unset($_SESSION['name']);
unset($_SESSION['cart']);
unset($_SESSION['qty']);
unset($_SESSION['dosage']) ;
unset($_SESSION['unitprice']) ;
unset($_SESSION['amount']);
echo '<script language="javascript">';
echo 'alert("Order is added successfully! we will notify you when the order is ready");';
echo 'document.location.href = "otc.php";';
echo '</script>';
?>
