<script>
//Display a confirmation box when trying to delete an object
function showConfirm()
{
    // build the confirmation box
    var c = confirm("Are you sure you wish to Delete this medicine?");
    
    // if true, delete item and refresh
    if(c)
        return true;
    else {
        return false;
    }
}
</script>
<?php

$title = "";

$content = "<h2 style='text-align:center;'>Delete Medicine</h2>
    <form action='delete.php' method ='post'>
    
      <fieldset>
        <label for='medicineName' style='font-size:20px;'>Medicine name: </label>
        <input type ='text' id='medicine' class='drugBox' name ='txtBrandName' autocomplete='off' required><br/>
        <div id='medicineList'></div> 
        <p></p>
        <input type='submit' name = 'btnView' value='View' >
        
      </fieldset>
</form> ";

if(isset($_POST['btnView'])){
    
     $medicine_Name =  $_POST["txtBrandName"];
  
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());
    
     if (!mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM drug WHERE medicine_name ='$medicine_Name'")))
    {	
        echo '<script language="javascript">';
        echo 'alert("Medicine is not found")';
        echo '</script>';
    }
    else {
    
        $query = "SELECT * FROM drug WHERE medicine_name LIKE '$medicine_Name'";
        $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
        $coffeeArray = array();
        $row = mysqli_fetch_array($result);
        mysqli_close($mysqli);

        $medicine_id=$row[0];
        $brand_name =$row[1];
        $generic_name = $row[2];
        $type = $row[3];
        $category = $row[4];
        $supplier_id =$row[5];
        $content = $row[6];
        $group = $row[8];
        $image  =$row[7];

        $content = "<h2 style='text-align:center;'>Delete Medicine</h2>
        <form action='#' method ='post' onsubmit='return showConfirm()'>

          <fieldset>
            <label for='Brand Name'>Brand Name: </label>
            <input class='inputField' name ='txtBrandName' value='$brand_name' readonly/><br/>

            <p></p>
            <label for='name'>Generic Name: </label>
            <input type='text' class='inputField' name='txtGenericName' value='$generic_name' readonly/><br/>
            <p></p>


            <label for='Type'>Type: </label>
            <input type='text' class='inputField' name='txttype' value='$type' readonly/><br/>
            <p></p>


            <label for='Category'>Category: </label>
            <input type='text' class='inputField' name='txtGenericName' value='$category' readonly/><br/>
            <p></p>


            <label for='group'>Group: </label>
            <input type='text' class='inputField' name='txtgroup' value='$group' readonly/><br/>
            <p></p>

            <label for='Supplier'>Supplier: </label>
            <input type='text' class='inputField' name='txtsupplier' value='$supplier_id' readonly/><br/>
            <p></p>

            <label for='content'>content: </label>
            <textarea cols='33' rows='12' name='txtContent' readonly>$content</textarea></br>
            <p></p>			

            <input type='submit' name = 'btnDelete' value='Delete' ></span><br/> 
            </fieldset>
        </form> ";
        }
}

   

else if(isset($_POST['btnDelete'])){
    $brand_name =  $_POST["txtBrandName"];
  
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $database = "friends_pharmacy";
    $mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());
    
    $query = "delete FROM drug WHERE medicine_name LIKE '$brand_name'";
    mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    mysqli_close($mysqli);
    
   
        echo '<script language="javascript">';
        echo 'alert("Successfully deleted")';
        echo '</script>';
    
    
    
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