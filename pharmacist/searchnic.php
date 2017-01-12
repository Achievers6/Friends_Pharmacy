<?php 
include '../database/dbconnect.php'; 

   
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT DISTINCT nic FROM customer WHERE nic LIKE '".$_POST["query"]."%'";  
      $result = mysqli_query($mysqli, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["nic"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>NIC not found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 } 
 
 
 ?>  