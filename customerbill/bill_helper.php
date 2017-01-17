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
    //$mysqli = mysqli_connect("localhost", "root", "", "friends_pharmacy");
    include '../database/dbconnect.php';
    if (!$mysqli) {
        echo "Error";
    }

    $sql = "SELECT * FROM drug_price WHERE id='$medi_id'";

    $result = mysqli_query($mysqli, $sql);

    $row = mysqli_fetch_assoc($result);
    
    $response = array('name'=>$row['medicine_name'], 'dosage'=>$row['dosage'], 'price'=>$row['price']);
    echo json_encode($response);
}

function finishBill() {
    
}

?>