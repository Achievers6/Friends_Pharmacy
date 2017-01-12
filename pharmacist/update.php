<?php

  
  $medicine_id =  $_GET["id"];
  $brand_name =$_POST["txtBrandName"];
  $generic_name = $_POST["txtGenericName"];
  $type = $_POST["types"];
  $category = $_POST["category"];
  $supplier_id =$_POST["suppliers"];
  $discription = $_POST["txtContent"];
  $group = $_POST["groups"];
  $image  =$_POST["pic"];
    
    
    $query="UPDATE drug
            SET medicine_name='$brand_name', generic_name='$generic_name',type='$type',category='$category',supplier_id='$supplier_id',discription='$discription',group_name='$group',image='$image'
            WHERE id='$medicine_id'";
	

    include '../database/dbconnect.php';
    mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    
    //header("Location:searchMedicine.php");
   


?>
