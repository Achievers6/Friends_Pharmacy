<?php
	$n = "Sandu";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../public/css/customer/prescription.css">

	<script>
		function add()
		{
			var medi_name = "piriton";
			var quantity = 10;
			var dosage = 5;
			var unitprice = 3;
			var totalPrice = 30;

			var table = document.getElementById("tbl");
			var row = table.insertRow(-1);
			var medicineCell = row.insertCell(0);
	        var quantityCell = row.insertCell(1);
	        var dosageCell = row.insertCell(2);
	        var unitPriceCell = row.insertCell(3);
	        var totalPriceCell = row.insertCell(4);

	        var totalPrice = parseInt(unitprice) * parseInt(quantity);

	        medicineCell.innerHTML = medi_name;
	        quantityCell.innerHTML = quantity;
	        dosageCell.innerHTML = dosage;
	        unitPriceCell.innerHTML = unitprice;
	        totalPriceCell.innerHTML = totalPrice;

	        
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
		<h2> Prescription ID - ".$id." </h2>
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
        <input type="button" onclick="add()" value="Add"> 
        <br><br>
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