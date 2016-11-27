<script>
    function searchForm() {
        var x = document.forms["myForm"]["txtMedicinedName"].value;

        if (x == null || x == "") {
            alert("Medicine name must be filled out");
            return false;
        }
    }

</script>
<?php
$title = "Update Stock";

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

if (isset($_GET["update"])) {

    $id = ($_GET["update"]);
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());

    $query = "SELECT * FROM stock WHERE id LIKE ($id)";

    $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

    $row = mysqli_fetch_array($result);
    mysqli_close($mysqli);


    $medicineName = $row[1];
    $batchNumber = $row[2];
    $quantity = $row[3];
    $entry_date = $row[4];
    $production_date = $row[5];
    $EXP_date = $row[6];

    $content = $content . "
    <form action='updateStock1.php?update2=$id' method ='post' '>
    
      <fieldset>
        <label class='lblf' for='name'>Medicine Name:</label>
        <label class='lblr' for='name'>$medicineName</label><br/>
        <p></p>
        <label class='lblf' for='batch_number'>Batch Number:</label>
        <label class='lblr' for='batch_number'>$batchNumber</label></br>
        <p></p>
        <label class='lblf'for='quantity'>Quantity: </label>
	<input type='number' class='inputField' name='txtQuantity' value ='$quantity' autocomplete='off' required/><br/>
        <p></p>
        <label class='lblf'f for='Entry_date'>Entry Date: </label>
	<input type='date' id='entryDate' class='inputField' name='entry_date' value ='$entry_date' required/><br/>
        <p></p>
        <label class='lblf'f for='production_date'>Production Date: </label>
	<input type='date' id='entryDate' class='inputField' name='production_date' value ='$production_date' /><br/>
        <p></p>
        <label class='lblf'f for='expire_date'>EXP Date: </label>
	<input type='date' id='entryDate' class='inputField' name='EXP_date' value ='$EXP_date'/><br/>
        <p></p>
        
       <input type='submit' name = 'btnSubmit' onclick='showConfirm($quantity)'><br/> 
         <p></p>

         
      
     </fieldset>
</form> ";
}
if (isset($_GET["update2"])) {
    $id = $_GET["update2"];

    $quantity = $_POST["txtQuantity"];
    $entry_date = $_POST["entry_date"];
    $production_date = $_POST["production_date"];
    $EXP_date = $_POST["EXP_date"];

    $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());



    $query = "UPDATE stock
            SET quantity=$quantity,entry_date='$entry_date',production_date='$production_date',expire_date='$EXP_date'
            WHERE id='$id'";




    mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    echo '<script language="javascript">';
    echo 'alert("Updated successfully")';
    echo '</script>';
}

include 'template.php';
?>
<script>
    function showConfirm(qty)
    {

        if (isNaN(qty))
        {
            alert("Must input numbers");
            return false;
        }
    }

</script>>