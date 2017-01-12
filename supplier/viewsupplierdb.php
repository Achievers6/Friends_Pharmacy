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

$sql = "SELECT supplier.company_name ,supplier.mobile,supplier.telephone,supplier.fax,drug_price.medicine_name,drug_price.dosage,drug_price.price FROM supplier INNER JOIN drug_price WHERE supplier.supplier_id = drug_price.supplier_id AND drug_price.medicine_name LIKE '%$search%'";
        
        $result = mysqli_query($mysqli, $sql);
        $res_data = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res_data, $row);
        
        
        }
        }
    

    echo (json_encode($res_data)); 
    }


       
?>

        