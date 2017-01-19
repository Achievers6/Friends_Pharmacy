<script src="../public/js/sort.js"></script>
<?php
require 'stockController.php';
$title = "Remove Stock";
//create instance of stockController
$stockController = new stockController();

if (isset($_POST['btnView'])) {
    $medicine_Name = $_POST["txtMedicinedName"];
    //create connection
    include '../database/dbconnect.php';
    //check new stock is already in stock
    if (!mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM stock WHERE medicine_name ='$medicine_Name'"))) {
        echo '<script language="javascript">';
        echo 'alert("Stock is not found")';
        echo '</script>';

        $content = "
                    <h2 style='text-align:center;'>Remove Stock</h2>
                    <form action='removeStock2.php' method ='post' onsubmit='return searchForm()'  name='myForm'>

                        <fieldset>
                          <label class='lblf' for='medicineName'>Medicine name: </label>
                          <input type ='text' id='medicine' class='drugBox' name='txtMedicinedName' autocomplete='off' />
                          <div id='medicineList'></div> 

                          <p></p>
                          <input type='submit' name = 'btnView' value='View' >
                        </fieldset>
                      </form> ";
    } else {


        $stockTable = $stockController->CreateStockTables($medicine_Name);
        $content = $stockTable;
    }
}
//delete the stock
if (isset($_GET["delete"])) {
    $medicine_Name = $stockController->DeleteStock($_GET["delete"]);
    echo '<script language="javascript">';
    echo 'alert("Deleted successfully")';
    echo '</script>';
    $stockTable = $stockController->CreateStockTables($medicine_Name);
    $content = $stockTable;
}
//out of stock table
if (isset($_GET["outofstock"])) {
    $stockTable = $stockController->CreateStockTables($_GET["outofstock"]);
    $content = $stockTable;
}
//get all short spiry
if (isset($_GET["allOutDate"])) {
    $stockTable = $stockController->allOutDate();
    $content = $stockTable;
}

include 'template.php';
?>
