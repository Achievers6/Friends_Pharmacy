

<html>
<head>
    <title>Customer Bill</title>
    <?php require('../includes/_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="stockStyle.css" />
    <link rel="stylesheet" href="css/selectize.css" />
    <link rel="stylesheet" href="style.css" media="all" />
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
    var quantities = [];
    var total = 0;
    function add() {
        var quantity = $('#quantity').val();
        var medi_id = $('#medicine_list').val();
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
        var dosageCell = row.insertCell(2)
        var unitPriceCell = row.insertCell(3);
        var quantityCell = row.insertCell(4);
        var totalPriceCell = row.insertCell(5);

        var totalPrice = parseInt(unitprice) * parseInt(quantity);

        numberCell.innerHTML = number;
        medicineCell.innerHTML = medi_name;
        dosageCell.innerHTML = dosage;
        unitPriceCell.innerHTML = unitprice;
        quantityCell.innerHTML = quantity;  totalPriceCell.innerHTML = totalPrice;

        total += totalPrice;
        number += 1;
        document.getElementById("total").innerHTML = total;
        
        discountCalculation();
    }
        
    function discountCalculation() {
        var rate = $('#discount').val();
        if (rate == 0) {
            document.getElementById("final_price").innerHTML = total;
            return;
        }
        var final_price = total * rate / 100;
        document.getElementById("final_price").innerHTML = final_price;
    }

    function finish() {
        var packet = {};
        packet['medicines'] = medicines;
        packet['quantities'] = quantities;
        packet['total'];
        $.ajax({
            url: "bill_helper.php",
            async: true,
            type: "POST",
            data: JSON.stringify(packet)
        }).done(function(data) {
            
        });
    }
    
    function printTable() {
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
     <div id="div_to_print" style="float: left; width: 120%; margin-left:50px;">
               
    <header class="clearfix">
      <div id="logo">
        <img src="../public/image/logo_green.png">
      </div>
      <div id="company">
        <h2 class="name">Friends Pharmacy</h2>
        <div>Kirulapana</div>
        <div>(+94)519-0450</div>
        <div>Reg No:A5SH1120GB21</div>
        <div><a href="mailto:company@example.com">friendsPharmacy@gmail.com</a></div>
      </div>
        
    </header>
      
    <main>
      <div id="details" class="clearfix">
        <div id="invoice">
          
          <div class="date">Date of Invoice: </div>
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
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="dosage">DOSAGE</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">AMOUNT</th>
          </tr>
        </thead>
          
        <tbody id="tbl">

        </tbody>
          
        <tfoot>
          <tr>
            <td colspan="1"></td>
            <td colspan="4">SUBTOTAL</td>
            <td id="total">Rs 0.00</td>
          </tr>
            
          <tr>
            <td colspan="2"></td>
            <td colspan="3">DISCOUNT</td>
            <td><input type="number" name="discount" id="discount" value="0" max="100" min="0" onchange="discountCalculation()" style="width:50px;">%</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="3">GRAND TOTAL</td>
              <td><p id="final_price">Rs.0.00</p></td>
          </tr>
        </tfoot>
      </table>
        
      <div id="thanks">Thank you!</div>
        <a title="Print Screen" onclick="window.print();" target="_blank" style="cursor:pointer;">PRINT</a>
    </main>
    <!--<footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>-->
    
<!--
    <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">
        
        <div id="div_to_print" style="float: left; width: 60%">
            <div style="width:100%; text-align:center; font-weight:100">

            </div>
        

           
        </div>
-->

        <div style="float: right; width: 35%; position: fixed; top:86px; right: -138px;">
            <form>
                Medicine Name: 

                <select id='medicine_list'>
<?php
    $conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
    $sql = "SELECT * FROM drug_price";
    $result = mysqli_query($conn, $sql);
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
