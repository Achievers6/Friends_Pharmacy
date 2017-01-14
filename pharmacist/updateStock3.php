<?php

    
    $id = ($_GET["update"]);
    include '../database/dbconnect.php';
    $query = "SELECT * FROM stock WHERE id LIKE ($id)";
    
     $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    $row = mysqli_fetch_array($result);
    mysqli_close($mysqli);
        
        
        $medicineName = $row[1];
        $batchNumber =$row[2];
        $quantity = $row[3];
        $entry_date = $row[4];
        $production_date = $row[5];
        $EXP_date = $row[6];
  
  $content = $content."
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


include 'template.php';
?>
