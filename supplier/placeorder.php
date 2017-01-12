<html>
<head>
	
    <?php require('../includes/_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="stockStyle.css" />
    <link rel="stylesheet" href="css/selectize.css" />
    <script src="js/selectize.min.js"></script>
    <title>Place order</title>
    
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
  
    function add() {
        var dosage = $('#dosage').val();
        var medi_id = $('#medicine_list').val();
        var date = $('#date').val();
//        var supplier =$('#supplier').val;
        medicines.push(medi_id);

      
        var medi_name;
        var dosage;
      
        $.ajax({
            url:"placeorderdb.php",
            async:false,
            type:"GET",
            data : {
                medi_id: medi_id
             }
        }).done(function(data) {
            data = JSON.parse(data);
            medi_name = data.name;
           
            dosage = data['dosage'];
        });
        
        
        var table = document.getElementById("tbl");
        var row = table.insertRow(-1);
        var supplierCell = row.insertCell(0);
        var medicineCell = row.insertCell(1);
        var dosageCell = row.insertCell(2);
        var quantityCell = row.insertCell(3)
       

        supplierCell.innerHTML = number;
        medicineCell.innerHTML = medi_name;
        dosageCell.innerHTML = dosage;
        quantityCell.innerHTML = quantity;
        
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
           
        
            <table border=1 id="tbl" style="width:100%;border-collapse: collapse;font-weight:100">
                <tr>
                    <th>Supplier</th>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Dosage</th>
                    <th>Date</th>
                    
                </tr>
            </table>
            
        </div>
       

        <div style="float: right; width: 35%">
            <form>
                Medicine Name: 
                <select id='medicine_list'>
<?php
    $conn = mysqli_connect("localhost", "root", "", "friends_pharmacy");
    $sql = "SELECT * FROM drug";
    $result = mysqli_query($conn, $sql);
    while(($row = mysqli_fetch_assoc($result)) != null) {
        echo "<option value='" . $row['id'] . "'>" . $row['generic_name'] . " " .  "</option>";
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
               Dosage : <input type="number" name="dosage" id="dosage" > <br>
                Amount : <input type="number" name="discount" id="discount" /><br>
                Date :<input type="date" name="date" id="date"><br />
                <input type="button" onclick="add()" value="Add"> <input type="reset" value="Clear">
            </form>
           
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
