<script>
function validateForm2() {
    var u = document.forms["myForm2"]["addcat"].value;
    if (u == null || u == "") {
        alert("category name must be filled out");
        return false;
    }
}    
    
function validateForm() {
    var x = document.forms["myForm"]["txtBrandName"].value;
    var y = document.forms["myForm"]["txtGenericName"].value;
    var z = document.forms["myForm"]["type"].value;
    var p = document.forms["myForm"]["category"].value;
    var q = document.forms["myForm"]["supplier"].value;
    
    
    
    
    if (x == null || x == "") {
        alert("Medicine name must be filled out");
        return false;
    }
    if (y == null || y == "") {
        alert("Batch number must be filled out");
        return false;
    }
    if (z == null || z == "") {
        alert("Type must be filled out");
        return false;
    }
    if (p == null || p == "") {
        alert("category must be filled out");
        return false;
    }
    if (q == null || q == "") {
        alert("supplier must be filled out");
        return false;
    }
 }
 
function myFunction() {// Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
        document.getElementById("mybtn2").style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
</script>
<style>
/* The Modal (background) */
.btnaddcat {
    display: none;
}
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    height: 20%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<?php

$title = "";

$content = "<h2 style='text-align:center;'>Add New Medicine</h2>
    <form name='myForm' action='AddMedicine.php' method ='post' onsubmit='return validateForm()'>
        <fieldset>
            <label for='Brand Name'>Brand Name: </label>
            <input type='text' class='inputField' name='txtBrandName' autocomplete='off' placeholder='Ex: Amoxil'/><br/>
            <p></p>
            <label for='name'>Generic Name: </label>
            <input type='text' class='inputField' name='txtGenericName' autocomplete='off' placeholder='Ex: amoxicillin' /><br/>
            <p></p>
            <label for='Type'>Type: </label>
            <select class = 'type' name='type'>
            <option value='Tablets'>Tablets</option>
            <option value='Capsules'>Capsules</option>
            <option value='liquid<'>liquid</option>
            </select></br>
            <p></p>

            <label for='Category'>Category: </label>
            <input type='text' class='inputField' name='category' id='category' autocomplete='off' placeholder='Ex: Antibiotic'/><br/>
            <div id='categoryList' style='position: absolute; left:540px;'></div> 
            <p></p>

            <label for='group'>Group: </label>
            <select class = 'type' name='group'>
            <option value='OC'>Over the counter</option>
            <option value='two_ii'>Two ii</option>
            <option value='Narcotics'>Narcotics</option>
            </select></br>
            <p></p>

            <label for='Supplier'>Supplier: </label>
            <input type='text' class='inputField' id='supplier' name='supplier' autocomplete='off'/><br/>
            <div id='supplierList'style='position: absolute; left:540px;'></div> 
            <p></p>

            <label for='content'>content: </label>
            <textarea cols='33' rows='12' name='txtContent'></textarea></br>
            <p></p>			

            <label for='image'>Add image: </label>
            <input type='file' name='pic' accept='image/*'>
            <p></p>

            <input type='submit' name = 'btnSubmit' location.href = 'AddMedicine.php'></span><br/> 
            <p></p>



     </fieldset>
</form>
<button id='myBtn' onclick='myFunction()' style='position:absolute; top:300px; right:270px; '>New</button><br/>
<div id='myModal' class='modal'>

                
                <div class='modal-content'>
                  <span class='close'>x</span>
                  <h3 style='text-align:center;'>Add catogery</h3>
                  
                  <form name='myForm2' action='AddMedicine.php'  method ='post' onsubmit='return validateForm2()'>
                  
                  <label >Category: </label>
                  <input type='text' class='inputField' name='addcat' autocomplete='off' placeholder='Ex:Antibiotic'/><br/>
                  <p></p>
                  <input type='submit' name = 'btnSubmitcat'>
                  
                </div>

              </div>";

if(isset($_POST['btnSubmitcat'])) {
    $cat = $_POST["addcat"];
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());
    
    if (mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM category WHERE category_name ='$cat'")))
    {	
        echo '<script language="javascript">';
        echo 'alert("category is already added")';
        echo '</script>';
    }
    else {
        $query = "INSERT INTO category
            (category_name)
             VALUES
             ('$cat')";
        
        mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    
   
    echo '<script language="javascript">';
    echo 'alert("Successfully added")';
    echo '</script>';
    }
    
    
    
    
}

if(isset($_POST['btnSubmit'])){
  
  $brand_name =$_POST["txtBrandName"];
  $generic_name = $_POST["txtGenericName"];
  $type = $_POST["type"];
  $category = $_POST["category"];
  $supplier_name =$_POST["supplier"];
  $discription = $_POST["txtContent"];
  $group = $_POST["group"];
  $image  =$_POST["pic"];
    
   $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error()); 
    
    
    if (mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM drug WHERE medicine_name ='$brand_name'")))
    {	
        echo '<script language="javascript">';
        echo 'alert("Stock is already added")';
        echo '</script>';
    }
    else {
   $q = "select supplier_ID from supplier where company_name='$supplier_name'";
   $result = mysqli_query($mysqli,$q) or die(mysqli_error($mysqli));
   $row = mysqli_fetch_array($result);
   
   $supplier_id=$row[0];
   
   
   $query = "INSERT INTO drug
            (medicine_name,generic_name,type,category,supplier_id,discription,image,group_name)
             VALUES
             ('$brand_name','$generic_name','$type','$category','$supplier_id','$discription','$image','$group')";

    
    mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    
   
    echo '<script language="javascript">';
    echo 'alert("Successfully added")';
    echo '</script>';
    
    
}
}
include './MedicineTemplate.php';
?>
<script>
$(document).ready(function(){  
      $('#supplier').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"supplierSearch.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#supplierList').fadeIn();  
                          $('#supplierList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '#lisup', function(){  
           $('#supplier').val($(this).text());  
           $('#supplierList').fadeOut(); 
           
           
        });  
 });  
 
 $(document).ready(function(){  
      $('#category').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"categorySearch.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#categoryList').fadeIn();
                          $('#categoryList').html(data);  
                          
                     }  
                });  
           }  
      });  
      $(document).on('click', '#licat', function(){  
           $('#category').val($(this).text());  
           $('#categoryList').fadeOut();  
           
         });  
 });  
 
 </script>