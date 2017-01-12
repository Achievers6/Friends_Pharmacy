<?php 
include '../database/dbconnect.php';

   
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM supplier WHERE company_name LIKE '".$_POST["query"]."%'";  
      $result = mysqli_query($mysqli, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li id="lisup">'.$row["company_name"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>supplier not found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 } 
 
 
 ?>  