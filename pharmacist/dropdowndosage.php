<?php

include '../database/dbconnect.php';


if (isset($_POST["query"])) {
    $output = '';
    $query = "SELECT * FROM drug_price WHERE medicine_name LIKE '" . $_POST["query"] . "%'";
    $result = mysqli_query($mysqli, $query);
    $output = '<select name="txtdosage" id="dosagedr">';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .='<option value='.$row["dosage"].'>'. $row["dosage"].' (MRP: Rs '. $row["price"].')</option>';
        }
    }

    $output .= '</select>';  
    echo $output;
}
?>  