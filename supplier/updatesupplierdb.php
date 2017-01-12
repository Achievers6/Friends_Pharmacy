<?php 

//$con=mysqli_connect("localhost","root","") or die("Couldn't connect sql");
include '../database/dbconnect.php';
mysqli_select_db($mysqli,"friends_pharmacy") or die ("Couldn't connect to database");

  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM supplier WHERE company_name LIKE '".$_POST["query"]."%'";  
      $result = mysqli_query($mysqli, $query);  
        
      if(mysqli_num_rows($result) > 0)  
      {  
          $output = '<table id="us_table"><tr><th>Company Name</th></tr><ul>';
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<tr><td><li>'.$row["company_name"].'</li></td></tr>';  
           }  
      }  
      else  
      {  
           $output .= '<li id="notfound">Supplier not found</li>';  
      }  
      $output .= '</ul></table>';  
      echo $output;  
 } 
 
 
 ?>  

