<!DOCTYPE html>
<html>
<head>
	<title>Prescription Details</title>
	<link rel="stylesheet" type="text/css" href="../public/css/customer/prescription.css">
	<script src="../public/js/selectize.min.js"></script>

	<script>
    function searchForm() {
        var x = document.forms["myForm"]["txtMedicinedName"].value;
        if (x == null || x == "" ) {
            alert("field must be filled out");
            return false;
        }
    }
    </script>

	<script>
	
    var medicines = [];
    var total = 0;
    function add() 
    {
        var quantity = $('#quantity').val();
        var medi_id = $('#medicine_list').val();
        medicines.push(medi_id);

        var unitprice;
        var medi_name;
        var dosage;
        // Get unit price and name and dosage
        $.ajax({
            url:"../customer/bill_helper.php",
            async:false,
            type:"GET",
            data : {
                medi_id: medi_id
             }
        }).done(function(data) {
            data = JSON.parse(data);
            medi_name = data.name;
            unitprice = data['price'];
            dosage = data['dosage'];
        });
        
        if (unitprice === '-1') {
            alert("Medicine does not exist");
            return;
        }

        var table = document.getElementById("tbl");
        var row = table.insertRow(-1);        
        var medicineCell = row.insertCell(0);
        var quantityCell = row.insertCell(1);
        var dosageCell = row.insertCell(2)
        var unitPriceCell = row.insertCell(3);
        var totalPriceCell = row.insertCell(4);

        var totalPrice = parseInt(unitprice) * parseInt(quantity);

        medicineCell.innerHTML = medi_name;
        quantityCell.innerHTML = quantity;
        dosageCell.innerHTML = dosage;
        unitPriceCell.innerHTML = unitprice;
        totalPriceCell.innerHTML = totalPrice;

        total += totalPrice;
        
        document.getElementById("total").innerHTML = total;
    }
    </script>

</head>
<body>
<?php

	include '../database/dbconnect.php';

	$content = "";

	$id = $_GET['prescription_id'];

	$sql = "SELECT * FROM Prescription WHERE prescription_id='$id'";
	$result = mysqli_query($mysqli, $sql);
	while ($row = mysqli_fetch_array($result)) 
	{
		echo "
		<div class='image'>
			<img src='../customer/uploads/".$row['image']."'>
		</div>
		";
	}
?>

<div class="mid">
	<form >
		Search Medicine:		
		<select id='medicine_list'>
            <?php
                include '../database/dbconnect.php';
                //$conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
                $sql = "SELECT * FROM drug_price";
                $result = mysqli_query($mysqli, $sql);
                while(($row = mysqli_fetch_assoc($result)) != null) {
                    echo "<option value='" . $row['id'] . "'>" . $row['medicine_name'] . " " . $row['dosage'] . "</option>";
                }
            ?>
        </select>

        <script>
        $('#medicine_list').selectize({
            persist: false,
            createOnBlur: true,
        });
        </script><br><br>
        Quantity : <input type="number" name="quantity" id="quantity" > <br><br>
        <input type="button" onclick="add()" value="Add"> <br><br>
        <input type="button" onclick="finish()" value="Finish">

	</form>
</div>

<div class="right" id="div_to_print">
	<table border=1 id="tbl" style="width:100%;border-collapse: collapse;font-weight:100">
        <tr>        
            <th>Medicine Name</th>
            <th>Quantity</th>
            <th>Dosage</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>
    </table>
</div>

</body>
</html>

<script>
$(document).ready(function(){  
      $('#medicine').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"Search.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#medicineList').fadeIn();  
                          $('#medicineList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#medicine').val($(this).text());  
           $('#medicineList').fadeOut(); 
           
           
        });  
 });  
 
 </script>