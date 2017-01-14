<html>
<head>
	
    <?php require('../includes/_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="stockStyle.css" />
    <link rel="stylesheet" href="css/selectize.css" />
    <script src="js/selectize.min.js"></script>
    <title><?php echo $title; ?></title>
    
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
    var number = 1;
    var medicines = [];
    var total = 0;
    function add() {
        var quantity = $('#quantity').val();
        var medi_id = $('#medicine_list').val();
        var discount = $('#discount').val();
        medicines.push(medi_id);

        var unitprice;
        var medi_name;
        var dosage;
        // Get unit price and name and dosage
        $.ajax({
            url:"bill_helper.php",
            async:false,
            type:"GET",
            data : {
                medi_id: medi_id
             }
        }).done(function(data) {
            data = JSON.parse(data);
            console.log(data);
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
        var numberCell = row.insertCell(0);
        var medicineCell = row.insertCell(1);
        var dosageCell = row.insertCell(2);
        var unitPriceCell = row.insertCell(3);
        var quantityCell = row.insertCell(4);
        var totalPriceCell = row.insertCell(5);

        var totalPrice = parseInt(unitprice) * parseInt(quantity);
        // apply discount
        totalPrice = totalPrice - (totalPrice * parseInt(discount)/100);

        numberCell.innerHTML = number;
        medicineCell.innerHTML = medi_name;
        dosageCell.innerHTML = dosage;
        unitPriceCell.innerHTML = unitprice;
        quantityCell.innerHTML = quantity;
        totalPriceCell.innerHTML = totalPrice;

        total += totalPrice;
        number += 1;
        document.getElementById("total").innerHTML = total;
    }

    function finish() {
        var customerNic = document.getElementById("customer_nic").value;
        $.ajax({
            url: "bill_helper.php",
            async: true,
            type: "POST",
            data: {
                total: total,
                customer_nic: customerNic,
                // NOT DONE HERE
            }
        }).done(function() {

        })
    }
    
    function printTable() {
        $('.nav').hide();
        $('#input_panel').hide();
    	var divToPrint = document.getElementById("div_to_print");
    	newWin = window.open("");
    	newWin.document.write(divToPrint.outerHTML);
    	newWin.print();
    	newWin.close();
    }
    
    </script>

    <style>
    .selectize-control {
        width: 50%;
    }
    </style>
</head>

<body>
    
    <?php require_once("../includes/navigation.php") ?>
    
    <!--content goes here -->
    <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">
        
        <div id="div_to_print" style="float: left; width: 60%">
            <div style="width:100%; text-align:center; font-weight:100">
                <h2 style="font-weight:100">Friends Pharmacy</h2>
                <h3 style="margin-top:-16px;font-weight:100">Kirulapana</h3>
                <div id='date'>ad</div>
                <script>
                $(function() {
                    var now = new Date();
                    var date = document.getElementById("date");
                    var formatted = (now.getMonth()+1) + "/" + now.getDate() + "/" + now.getFullYear();
                    console.log(formatted);
                    date.innerHTML = formatted;
                });                    
                </script>
            </div>
        
            <table border=1 id="tbl" style="width:100%;border-collapse: collapse;font-weight:100">
                <tr>
                    <th>Number</th>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Dosage</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </table>

            <h3 style="width:100%; text-align:center">Total: Rs.<span id="total"></span></h3>

        </div>
        <button onclick='printTable()'>Print</button>

        <div id="input_panel" style="float: right; width: 35%">
            <form>
                Medicine Name: 
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
                </script>
                <br>
                Quantity : <input type="number" name="quantity" id="quantity" > <br>
                Discount : <input type="number" name="discount" id="discount" /> %<br />
                <input type="button" onclick="add()" value="Add"> <input type="reset" value="Clear">
            </form>
            <input type="button" onclick="finish()" value="Finish">
        </div>
    </div>		
    
    <?php require_once('../includes/_footer.php') ?>
    
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
