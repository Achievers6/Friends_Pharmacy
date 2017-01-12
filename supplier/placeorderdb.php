<?php
if (isset($_GET['medi_id'])) {
    sendPrice();
} elseif (isset($_GET['init'])) {
    sendDrugs();
} elseif (isset($_POST['finish'])) {
    finishBill();
}
 
 


function sendPrice() {
    $medi_id = $_GET['medi_id'];
    $conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
    

    $sql = "SELECT * FROM drug WHERE id='$medi_id'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    
    $response = array('name'=>$row['medicine_name'], 'quantity'=>$row['price'], 'dosage'=>$row['dosage']);
    echo json_encode($response);
}


function sendSupplier(){
    $supplier =$_GET['supplier'];
     $conn = mysqli_connect("localhost", "root", "", "friends_pharmacy")or die;
    $sql1 ="SELECT supplier.company_name, drug.id, supplier_supplier.id, drug.supplier_id FROM supplier INNER JOIN drug ON supplier.supplier_id = drug.supplier_id"
}

function finishBill() {
    
}

?>