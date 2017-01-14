<?php 


include '../database/dbconnect.php';
mysqli_select_db($mysqli,"friends_pharmacy") or die ("Couldn't connect to database");

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM drug WHERE generic_name LIKE '".$_POST["query"]."%'";  
      $result = mysqli_query($mysqli, $query);  
        
      if(mysqli_num_rows($result) > 0)  
      {  
          $output = '<table id="us_table"><tr><th>Medicine name</th></tr><ul>';
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<tr><td><li id="lim">'.$row["generic_name"].'</li></td></tr>';  
           }  
      }  
      else  
      {  
           $output .= '<li id="notfound">Medicine not found</li>';  
      }  
      $output .= '</ul></table>';  
      echo $output;  
 } 
?>