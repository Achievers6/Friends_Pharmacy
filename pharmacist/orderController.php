<script>
//Display a confirmation box when trying to delete an object

    function showConfirm2(no)
    {
        // build the confirmation box
        var c = confirm("Confirm the order!");

        // if true, delete item and refresh
        if (c)
            window.location = "cust_orders.php?confirmed=" + no;
    }
    function removeConfirm(no)
    {
        // build the confirmation box
        var c = confirm("You wish to remove the order?");

        // if true, delete item and refresh
        if (c)
            window.location = "confiredOrder.php?confirmed=" + no;
    }
    function showConfirm1(no)
    {
        var span = document.getElementsByClassName("close")[0];
        confirmBox.style.display = "block";
        span.onclick = function() {
            confirmBox.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == confirmBox) {
                confirmBox.style.display = "none";
            }
        }
        document.getElementById("no").value = no;
    }
</script>
<?php

class orderController {

    function orderListTable($no) {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM cust_orders_items where order_no = $no";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h3 style='text-align:center;'>Order List - $no<h3>
        <table class='sortable'>
                <tr>
                   
                    <th><b>Medicine name</b></th>
                    <th><b>Dosage</b></th>
                    <th><b>unit price (Rs)</b></th>
                    <th><b>Quantity</b></th>
                    <th><b>Amount (Rs)</b></th>
                </tr>";
        while ($row = mysqli_fetch_array($resultq)) {
            $queryp = "SELECT price FROM stock where medicine_name = '$row[1]' and dosage = '$row[2]' ";
            $resultp = mysqli_query($mysqli, $queryp) or die(mysqli_error($mysqli));
            $rowp = mysqli_fetch_array($resultp);
            $amount = $row[3] * $rowp[0];
            $result = $result . "
                <tr>
                    
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$rowp[0]</b></td>
                    <td><b>$row[3]</b></td>
                    <td><b>$amount</b></td>
                </tr>
";
        }
        $result = $result . "</table>";
        return $result;
    }

    function orderTable($st) {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM cust_orders where status = '$st'";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h3 style='text-align:center;'>New orders List<h3>
        
          <table class='sortable'>
                <tr>
                    <th><b>Order number</b></th>
                    <th><b>Customer email</b></th>
                    <th><b>Date</b></th>
                    <th><b>Total (Rs)</b></th>
                </tr>";
        while ($row = mysqli_fetch_array($resultq)) {
            $result = $result . "
                <tr>
                    <td><b>$row[0]</b></td>
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$row[3]</b></td>
                    <td><a href='cust_orders.php?order_no=$row[0]' >List items</td>
                    <td><a href='#' onClick=showConfirm1($row[0])><img  class='confirm' src='../public/image/reject.png' style='width: 25px; height: 25px;'></a></td>
                    <td><a href='#' onClick=showConfirm2($row[0])><img  class='confirm' src='../public/image/OK.png' style='width: 25px; height: 25px;'></a></td>
                 </tr>
";
        }
        $result = $result . "</table>";
        return $result;
    }

    function confirmOrder($no) {
        include '../database/dbconnect.php';
        $query = "update cust_orders set status='confirmed' where order_no = $no";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        mysqli_close($mysqli);
    }

    function reject($no, $msg) {
        include '../database/dbconnect.php';
        $query = "update cust_orders set status='pending',msg='$msg' where order_no = $no";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        mysqli_close($mysqli);
    }

    function orderConfirmTable($st) {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM cust_orders where status = '$st'";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h3 style='text-align:center;'>New orders List<h3>
        
          <table class='sortable'>
                <tr>
                    <th><b>Order number</b></th>
                    <th><b>Customer email</b></th>
                    <th><b>Date</b></th>
                    <th><b>Total (Rs)</b></th>
                </tr>";
        while ($row = mysqli_fetch_array($resultq)) {
            $result = $result . "
                <tr>
                    <td><b>$row[0]</b></td>
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$row[3]</b></td>
                    <td><a href='cust_orders.php?order_no=$row[0]' >List items</td>
                    <td><a href='#' onClick=removeConfirm($row[0])><img  class='confirm' src='../public/image/remove.png' style='width: 25px; height: 25px;'></a></td>
                    <td><a href='#'><img  class='confirm' src='../public/image/bill.png' style='width: 40px; height: 40px;'></a></td>

                 </tr>
";
        }
        $result = $result . "</table>";
        return $result;
    }

    function removeOrder($no) {
        include '../database/dbconnect.php';
        $query = "update cust_orders set status='removed' where order_no = $no";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        mysqli_close($mysqli);
    }

    function searchMail($mail) {
        include '../database/dbconnect.php';
        if ($mail == '') {
            $query = "SELECT * FROM cust_orders where status='confirmed'";
        } else {

            $query = "SELECT * FROM cust_orders where status='confirmed' and cust_email LIKE '" . $mail . "%'";
        }
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h3 style='text-align:center;'>New orders List<h3>
        
          <table class='sortable'>
                <tr>
                    <th><b>Order number</b></th>
                    <th><b>Customer email</b></th>
                    <th><b>Date</b></th>
                    <th><b>Total (Rs)</b></th>
                </tr>";

        while ($row = mysqli_fetch_array($resultq)) {
            $result = $result . "
                <tr>
                    <td><b>$row[0]</b></td>
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$row[3]</b></td>
                    <td><a href='cust_orders.php?order_no=$row[0]' >List items</td>
                    <td><a href='#' onClick=removeConfirm($row[0])><img  class='confirm' src='../public/image/remove.png' style='width: 25px; height: 25px;'></a></td>
                    <td><a href='#'><img  class='confirm' src='../public/image/bill.png' style='width: 40px; height: 40px;'></a></td>

                 </tr>
";
        }

        $result = $result . "</table>";
        return $result;
    }

}
?>
