<?php
//$con= mysqli_connect("localhost", "root", "", "friends_pharmacy");
include '../database/dbconnect.php';
if(!$mysqli) {
    die("Connection failed");
}
$sid='';
switch ($_GET['type']) {
    case 'get' : {
      $search = $_GET['search'];

$sql = "SELECT stock.medicine_name,max(entry_date),drug.medicine_name,drug.supplier_id,supplier.fax,supplier.supplier_id,supplier.company_name,supplier.telephone,stock.dosage,stock.price,
supplier.mobile
FROM stock
INNER JOIN drug ON stock.medicine_name=drug.medicine_name
INNER JOIN supplier ON drug.supplier_id=supplier.supplier_id
WHERE stock.medicine_name='%$search%'";
        
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res_data, $row);
        
        
        }
        }
    

    echo (json_encode($res_data)); 
    }


       
?>

        