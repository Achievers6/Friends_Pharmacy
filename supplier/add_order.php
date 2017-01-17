<?php
include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");
                 
                
            
            if(isset($_POST['add'])){
                $med= $_POST['medicine'];
                $sup= $_POST['sup'];
                $dos= $_POST['dos'];
                $amnt= $_POST['amnt'];
                $date =$_POST['date'];
                
                 
                
                $sql1= "INSERT INTO orders (drug,supplier,dosage,amount,date,send) values ('$med','$sup','$dos','$amnt','$date','NO')";
               if(mysqli_query($mysqli,$sql1)){
                    echo "<script>alert('Order added successfully');
                    window.location.href='placeorder.php'</script>";
    
  
}
               
                
            }
            
        
    ?>      
