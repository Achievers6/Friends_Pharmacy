<?php
$title = "";
$content = "<h2 style='text-align:center;'>Update Medicine</h2>
    <form action='SearchMedicine.php' method ='post'>
    
      <fieldset>
        <label for='Search' style='font-size:20px;'>Search: </label>
        <input type ='text' id='medicine' class='drugBox' name ='txtMedicineID' autocomplete='off' required>
        <div id='medicineList'></div> 
        <p></p>
        <input type='submit' name = 'btnSearch' id='b' value='OK' ></span><br/> 
      
      </fieldset>
</form> ";

if(isset($_POST['btnSearch'])){
    
    $medicine_id = $_POST["txtMedicineID"];
  
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());
    
     if (!mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM drug WHERE medicine_name ='$medicine_id'")))
    {	
        echo '<script language="javascript">';
        echo 'alert("Medicine is not found")';
        echo '</script>';
    }
    else {
    
    
    
    $query = "SELECT * FROM drug WHERE medicine_name LIKE '$medicine_id'";
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    $row = mysqli_fetch_array($result);
    mysqli_close($mysqli);
    
  $medicine_id=$row[0];
  $brand_name =$row[1];
  $generic_name = $row[2];
  $type = $row[3];
  $category = $row[4];
  $supplier_id =$row[5];
  $discription = $row[6];
  $group = $row[8];
  $image  =$row[7];
  
  $content = "<h2 style='text-align:center;'>Update Medicine</h2>
    <form action='searchMedicine.php?id=$medicine_id' method ='post'>
    
      <fieldset>
        <label for='medicine Name'>Medicine Name: </label>
        <input type ='text' class='inputField' name ='txtBrandName' autocomplete='off'  value='$brand_name'><br/>
	<p></p>
        <label for='name'>Generic Name: </label>
	<input type='text' class='inputField' name='txtGenericName' autocomplete='off'  value='$generic_name'/><br/>
        <p></p>
        <label for='Type'>Type: </label>
        <select class = 'type' name='types'>
          <option value='$type'>$type</option>
          <option value='Tablets'>Tablets</option>
          <option value='Capsules'>Capsules</option>
          <option value='liquid'>liquid</option>
        </select></br>
        <p></p>
        
        
        <label for='Category'>Category: </label>
        <input type='text' class='inputField' name='category' autocomplete='off'  value='$category'/><br/>
        <p></p>

        
        <label for='group'>Group: </label>
        <select class = 'type' name = 'groups'>
          <option value='$group'>$group</option>
          <option value='OC'>Over the counter drug</option>
          <option value='Two ii'>Two ii drug</option>
          <option value='Narcootics'>Narcootics</option>
        </select></br>
        <p></p>
                                
        <label for='Supplier'>Supplier: </label>
        <input type='text' class='inputField' name='suppliers' autocomplete='off'  value='$supplier_id'/><br/>
        <p></p>   

        <label for='content'>content: </label>
	<textarea cols='33' rows='12' name='txtContent'>$discription</textarea></br>
	<p></p>			
         
        <label for='image'>Add image: </label>
        <input type='file' name='pic' accept='image/*'>
        <p></p>
        
        <input type='submit' name = 'btnUpdate' value='update' ></span><br/> 
        </fieldset>
</form> ";
    }
}
if(isset($_GET["id"])) {
    
  $medicine_id =  $_GET["id"];
  $brand_name =$_POST["txtBrandName"];
  $generic_name = $_POST["txtGenericName"];
  $type = $_POST["types"];
  $category = $_POST["category"];
  $supplier_id =$_POST["suppliers"];
  $discription = $_POST["txtContent"];
  $group = $_POST["groups"];
  $image  =$_POST["pic"];
    
  $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());
      
  
   if (mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM drug WHERE medicine_name ='$brand_name' AND id!=$medicine_id ")))
    {	
        echo '<script language="javascript">';
        echo 'alert("Medicine name is exist")';
        echo '</script>';
    }
  
  else {
  $query="UPDATE drug
            SET medicine_name='$brand_name', generic_name='$generic_name',type='$type',category='$category',supplier_id='$supplier_id',discription='$discription',group_name='$group',image='$image'
            WHERE id='$medicine_id'";
	

    mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    
    //header("Location:searchMedicine.php");
    echo '<script language="javascript">';
    echo 'alert("Successfully updated")';
    echo '</script>';
}
}

include './MedicineTemplate.php';
?>

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
      $(document).on('click', '#lim', function(){  
           $('#medicine').val($(this).text());  
           $('#medicineList').fadeOut(); 
           
           
        });  
 }); 
 
 
 </script>