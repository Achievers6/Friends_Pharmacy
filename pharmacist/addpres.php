<?php

if (isset($_POST['len'])) {
    include '../database/dbconnect.php';
    $c = $_POST['len'];
    $preid = $_POST['presid'];
    for ($i = 1; $i <= $c; $i++) {
        $med = "med_row".$i;
        $dosage = "dosage" . $i;
        $qty = "qty".$i;

        if (!empty($_POST[$qty])) {
            
            $meddb = $_POST[$med];
            $dosagedb = $_POST[$dosage];
            $qtydb = $_POST[$qty];
            $queryd = "INSERT INTO prescription_items
            (pres_id,medicine_name,dosage,qty)
             VALUES
             ('$preid','$meddb','$dosagedb','$qtydb')";
           
            mysqli_query($mysqli, $queryd) or die(mysqli_error($mysqli));
        }
      
    }
      mysqli_close($mysqli);
            echo '<script language="javascript">';
            echo 'alert("Medicine is added successfully")';
            echo '</script>';
} 
?>

