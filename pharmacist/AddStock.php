<script>

</script>

<?php
$title = "Add Stock";

$content = " 
         <h2 style='text-align:center;'>Add New Stock</h2>
        <fieldset>
            <form name='myForm' action='AddStock.php' method ='post' autocomplete='off' onsubmit='return validateForm()'>
                <table>
                    <tr>
                        <td>
                            <label class='lblf' for='name'>Medicine Name: </label>
                        </td>
                        <td>
                            <input type ='text' id='txtMedicineName' class='inputField' name ='txtMedicineName' autocomplete='off'>
                        </td>
                        <td>
                            <a href='AddMedicine.php'>
                                <img src='../public/image/AddMed.PNG' >
                            </a>
                        </td>
                    </tr>
                </table>
                <div id='medicineList' style='top:-8px;'></div> 

                <table>
                    <tr>
                        <td>
                            <label class='lblf' >Dosage : </label>
                        </td>
                        <td>
                            <div id='dosageList' style='top:-8px;'>.</div> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class='lblf' >Retail price(Rs) : </label>
                        </td>
                        <td>
                            <input type='number' class='inputField' name='price' autocomplete='off' /><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class='lblf' for='batch_number'>Batch Number: </label>
                        </td>
                        <td>
                            <input type='text' class='inputField' name='txtbatchNumber' autocomplete='off'/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class='lblf' for='quantity'>Quantity: </label>
                        </td>
                        <td>
                            <input type='number' class='inputField' name='txtQuantity' autocomplete='off' /><br/>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <label class='lblf' for='Entry_date'>Entry Date: </label>
                        </td>
                        <td>
                            <input type='date' id='entryDate' class='inputField' name='entry_date'  /><br/>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <label class='lblf' for='production_date'>Production Date: </label>
                        </td>
                        <td>
                            <input type='date' id='entryDatep' class='inputField' name='production_date' /><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class='lblf' for='expire_date'>EXP Date: </label>
                        </td>
                        <td>
                            <input type='date' id='entryDate' class='inputField' name='EXP_date' /><br/>
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <input type='submit' name = 'btnSubmit'></span><br/> 
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>

";

if (isset($_POST['btnSubmit'])) {

    $MedicineName = $_POST["txtMedicineName"];
    $batchNumber = $_POST["txtbatchNumber"];
    $quantity = $_POST["txtQuantity"];
    $entry_date = $_POST["entry_date"];
    $production_date = $_POST["production_date"];
    $EXP_date = $_POST["EXP_date"];
    $dosage = $_POST["txtdosage"];
    $price = $_POST['price'];

    // Create connection
    include '../database/dbconnect.php';
    //check medicine is in the db
    if (!mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM drug WHERE medicine_name ='$MedicineName'"))) {
        echo '<script language="javascript">';
        echo 'alert("Medicine is not found")';
        echo '</script>';
    }
    //check stock is already in th db
    elseif (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM stock WHERE medicine_name ='$MedicineName' AND batch_no='$batchNumber'"))) {
        echo '<script language="javascript">';
        echo 'alert("Stock is already added")';
        echo '</script>';
    } else {
        //insert stock to the db
        $query2 = "INSERT INTO stock
    (medicine_name,batch_no,quantity,entry_date,production_date,expire_date,dosage,price)
    VALUES
    ('$MedicineName','$batchNumber','$quantity','$entry_date','$production_date','$EXP_date','$dosage','$price')";

        mysqli_query($mysqli, $query2) or die(mysqli_error($mysqli));
        //colse the connection
        mysqli_close($mysqli);
        //header("Location:AddStock.php");
        //notify stock is added
        echo '<script language="javascript">';
        echo 'alert("Successfully added")';
        echo '</script>';
    }
}

include 'template.php';
?>
<script>
    //set current date to the entry feild
    $(document).ready(function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        //if day is less then 10 the add 0 to the front 
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        var today =  yyyy + "-" + mm + "-" + dd;
        document.getElementById("entryDate").defaultValue = yyyy + "-" + mm + "-" + dd;
       
        
            
        //alert(s);
        

    });

    function showConfirm(qty)
    {

        if (isNaN(qty))
        {
            alert("Must input numbers");
            return false;
        }
    }
</script>