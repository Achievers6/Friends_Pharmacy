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
    include '../database/dbconnect.php';
    //$conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
    if (!$mysqli) {
        echo "Error";
    }

    $sql = "SELECT * FROM drug_price WHERE id='$medi_id'";

    $result = mysqli_query($mysqli, $sql);

    $row = mysqli_fetch_assoc($result);
    
    $response = array('name'=>$row['medicine_name'], 'price'=>$row['price'], 'dosage'=>$row['dosage']);
    echo json_encode($response);
}

function finishBill() {
    
}

?>