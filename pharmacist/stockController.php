<script>
//Display a confirmation box when trying to delete an object
    function showConfirm(id)
    {
        // build the confirmation box
        var c = confirm("Are you sure, you wish to Delete this item?");

        // if true, delete item and refresh
        if (c)
            window.location = "removeStock2.php?delete=" + id;
    }
    function showConfirm2(no)
    {
        // build the confirmation box
        var c = confirm("Confirm the order!");

        // if true, delete item and refresh
        if (c)
            window.location = "cust_orders.php?confirmed=" + no;
    }
</script>
<?php
include ("../Entities/stockEntity.php");

class stockController {

    function CreateStockTables($medicine_Name) {
        include '../database/dbconnect.php';

        $query = "SELECT * FROM stock WHERE medicine_name LIKE '$medicine_Name'";

        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        $stockArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $medicineName = $row[1];
            $batchNumber = $row[2];
            $quantity = $row[3];
            $entry_date = $row[4];
            $production_date = $row[5];
            $EXP_date = $row[6];
            $dosage = $row[7];
            $price = $row[8];


//Create stock objects and store them in an array.
            $stock = new StockEntity($id, $medicineName, $batchNumber, $quantity, $entry_date, $production_date, $EXP_date, $dosage, $price);
            array_push($stockArray, $stock);
        }
        mysqli_close($mysqli);
        $result = "";
        $result = "
       <h2 style='text-align:center;'>$medicine_Name<h2>
          <table class='sortable'>
                <tr>
                    
                    <th></th>
                    <th><b>batch_no</b></th>
                    <th><b>quantity</b></th>
                    <th><b>dosage</b></th>
                    <th><b>price (Rs)</b></th>
                    <th><b>entry_date</b></th>
                    <th><b>expire_date</b></th>
                    <th><b>production_date</b></th>
                </tr>";

        foreach ($stockArray as $key => $stock) {
            $result = $result . "
                    
               
                <tr>
                    
                    <td><a href='#' onClick=showConfirm($stock->id) style='color:red;'>DELETE</td>
                    <td><b>$stock->batch_no</b></td>
                    <td><b>$stock->quantity</b></td>
                    <td><b>$stock->price</b></td>
                    <td><b>$stock->quantity</b></td>    
                    <td><b>$stock->entry_date </b></td>
                    <td><b>$stock->expire_date</b></td>
                    <td><b>$stock->production_date</b></td>
                    
                </tr>

";
        }
        $result = $result . "</table>";
        return $result;
    }

    function orderListTable($no) {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM cust_orders_items where order_no = $no";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h3 style='text-align:center;'>Order List - $no<h3>
        <table class='sortable'>
                <tr>
                    <th></th>
                    <th><b>Medicine name</b></th>
                    <th><b>Dosage</b></th>
                    <th><b>Quantity</b></th>
                    
                </tr>";
        while ($row = mysqli_fetch_array($resultq)) {
            $result = $result . "
                <tr>
                    <td><a href='#' >Edit</td>
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$row[3]</b></td>
                </tr>
";
        }
        $result = $result . "</table>";
        return $result;
    }

    function orderTable() {
        include '../database/dbconnect.php';
        $query = "SELECT * FROM cust_orders where status = 'not confirmed'";
        $resultq = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $result = "";
        $result = "
       
       <h3 style='text-align:center;'>New orders List<h3>
        
          <table class='sortable'>
                <tr>
                    <th><b>Order number</b></th>
                    <th><b>Customer email</b></th>
                    <th><b>Date</b></th>
                    <th><b>Total</b></th>
                </tr>";
        while ($row = mysqli_fetch_array($resultq)) {
            $result = $result . "
                <tr>
                    <td><b>$row[0]</b></td>
                    <td><b>$row[1]</b></td>
                    <td><b>$row[2]</b></td>
                    <td><b>$row[3]</b></td>
                    <td><a href='cust_orders.php?order_no=$row[0]' >List items</td>
                    <td><a href='#' >Notify</td>
                    <td><a href='#' onClick=showConfirm2($row[0])><img  class='confirm' src='../public/image/OK.png' style='width: 35px; height: 35px;'></a></td>
                 </tr>
";
        }
        $result = $result . "</table>";
        return $result;
    }

    function UpdateStockTables($medicine_Name) {
        include '../database/dbconnect.php';


        $query = "SELECT * FROM stock WHERE medicine_name LIKE '$medicine_Name'";

        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        $stockArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $medicineName = $row[1];
            $batchNumber = $row[2];
            $quantity = $row[3];
            $entry_date = $row[4];
            $production_date = $row[5];
            $EXP_date = $row[6];
            $dosage = $row[7];
            $price = $row[8];

//Create stock objects and store them in an array.
            $stock = new StockEntity($id, $medicineName, $batchNumber, $quantity, $entry_date, $production_date, $EXP_date, $dosage, $price);
            array_push($stockArray, $stock);
        }
        mysqli_close($mysqli);
        $result = "";
        $result = "
       
       <h2 style='text-align:center;'>$medicine_Name<h3>
        
          <table class='sortable'>
                <tr>
                    
                    <th></th>
                    <th><b>batch no</b></th>
                    <th><b>quantity</b></th>
                    <th><b>dosage</b></th>
                    <th><b>price (Rs)</b></th>
                    <th><b>entry date</b></th>
                    <th><b>expire date</b></th>
                    <th><b>production date</b></th>
                    
                </tr>";
        foreach ($stockArray as $key => $stock) {
            $result = $result . "
                    
                
                <tr>
                    
                        <td><a href='updateStock1.php?update=$stock->id' style='color:blue;'>UPDATE</td>
                    <td><b>$stock->batch_no</b></td>
                    <td><b>$stock->quantity</b></td>
                    <td><b>$stock->dosage</b></td>
                    <td><b>$stock->price</b></td>
                    <td><b>$stock->entry_date </b></td>
                    <td><b>$stock->expire_date</b></td>
                    <td><b>$stock->production_date</b></td>
                    
                </tr>
               

";
        }

        $result = $result . "</table>";
        return $result;
    }

    function DeleteStock($id) {
        include '../database/dbconnect.php';
        $query = "select medicine_name from stock where id=$id";
//Execute query and close connection
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        $row = mysqli_fetch_array($result);
        mysqli_close($mysqli);

        $medicineName = $row[0];


        $query = "DELETE FROM stock WHERE id = $id";
        $this->PerformQuery($query);
        $query = "ALTER TABLE stock DROP COLUMN id ";
        $this->PerformQuery($query);
        $query = "ALTER TABLE stock ADD COLUMN id INT(50) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
        $this->PerformQuery($query);

        return $medicineName;
    }

    function PerformQuery($query) {
        $host = "localhost";
        $user = "root";
        $passwd = "";
        $database = "friends_pharmacy";
        $mysqli = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());

//Execute query and close connection
        mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        mysqli_close($mysqli);
    }

    function allOutDate() {
        include '../database/dbconnect.php';

        $query = "SELECT * FROM stock where 21>DATEDIFF(expire_date,CURDATE()) and 0<DATEDIFF(expire_date,CURDATE());";

        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        $stockArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $medicineName = $row[1];
            $batchNumber = $row[2];
            $quantity = $row[3];
            $entry_date = $row[4];
            $production_date = $row[5];
            $EXP_date = $row[6];
            $dosage = $row[7];
            $price = $row[8];


//Create stock objects and store them in an array.
            $stock = new StockEntity($id, $medicineName, $batchNumber, $quantity, $entry_date, $production_date, $EXP_date, $dosage, $price);
            array_push($stockArray, $stock);
        }
        mysqli_close($mysqli);
        $result = "";
        $result = "
       <h2 style='text-align:center;'>Short Expiry medicines<h2>
          <table class='sortable'>
                <tr>
                    
                    <th></th>
                    <th><b>batch_no</b></th>
                    <th><b>quantity</b></th>
                    <th><b>dosage</b></th>
                    <th><b>price (Rs)</b></th>
                    <th><b>entry_date</b></th>
                    <th><b>expire_date</b></th>
                    <th><b>production_date</b></th>
                </tr>";

        foreach ($stockArray as $key => $stock) {
            $result = $result . "
                    
               
                <tr>
                    
                    <td><a href='#' onClick=showConfirm($stock->id) >Delete</td>
                    <td><b>$stock->batch_no</b></td>
                    <td><b>$stock->quantity</b></td>
                    <td><b>$stock->price</b></td>
                    <td><b>$stock->quantity</b></td>    
                    <td><b>$stock->entry_date </b></td>
                    <td><b>$stock->expire_date</b></td>
                    <td><b>$stock->production_date</b></td>
                    
                </tr>

";
        }
        $result = $result . "</table>";
        return $result;
    }

}
?>
