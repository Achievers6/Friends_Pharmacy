<?php
session_start();
if (isset($_POST["query"])) {
    
    $x = $_POST["query"]-1;
    if($x==0 && sizeof($_SESSION['cart'])==1) {
        $_SESSION['name'] = array('1');
        $_SESSION['cart'] = array('1');
        $_SESSION['qty'] = array('1');
        $_SESSION['dosage'] = array('1');
        $_SESSION['unitprice'] = array('1');
        $_SESSION['amount'] = array();
    }
    
    else {
    
    unset($_SESSION['name'][$x]);
    $_SESSION['name'] = array_values($_SESSION['name']);
    
    unset($_SESSION['cart'][$x]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    
    unset($_SESSION['qty'][$x]);
    $_SESSION['qty'] = array_values($_SESSION['qty']);
    
    unset($_SESSION['dosage'][$x]);
    $_SESSION['dosage'] = array_values($_SESSION['dosage']);
    
    unset($_SESSION['unitprice'] [$x]);
    $_SESSION['unitprice'] = array_values($_SESSION['unitprice']);
    
    unset($_SESSION['amount'][$x]);
    $_SESSION['amount'] = array_values($_SESSION['amount']);

    
    
    
    }
    
    echo array_sum($_SESSION['amount']);
}
?>  
