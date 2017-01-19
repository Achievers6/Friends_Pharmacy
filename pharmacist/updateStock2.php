<!--to table sortble-->
<script src="../public/js/sort.js"></script>
<?php
require 'stockController.php';
$title = "Update Stock";
//create instance of stockController
$stockController = new stockController();

if (isset($_POST['btnView'])) {
    $medicine_Name = $_POST["txtMedicinedName"];
    //create conection
    include '../database/dbconnect.php';
    //check the medicine is in the stock
    if (!mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM stock WHERE medicine_name ='$medicine_Name'"))) {
        echo '<script language="javascript">';
        echo 'alert("Stock is not found")';
        echo '</script>';

        $content = "
    <h2 style='text-align:center;'>Update Stock</h2>
    <form action='updateStock2.php' method ='post' onsubmit='return searchForm()'  name='myForm' >
    
      <fieldset>
        <label class='lblf' for='medicineName'>Medicine name: </label>
        <input type ='text' class='inputField' id='medicine' class='drugBox' name='txtMedicinedName' autocomplete='off' ><br/>
        <div id='medicineList'></div> 
        <p></p>
        <input type='submit' name = 'btnView' value='View' >
      </fieldset>
    </form> 
    ";
    } else {
        //creat the table
        $stockTable = $stockController->UpdateStockTables($medicine_Name);
        $content = $stockTable;
    }
}


include 'template.php';
?>
