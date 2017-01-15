<?php  
    include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");

  if(isset($_POST['email'])){
      $sup= $_POST["supplier_name"];
      $date = $_POST["date"];
      $dosge = $_POST["dosage"];
      $drug =$_POST["drug"];
      $amount=$_POST["amount"];
      //echo $sup;
  
$get="SELECT * FROM supplier WHERE company_name='$sup'";

$result  = mysqli_query($mysqli,$get);
while($row=mysqli_fetch_assoc($result)){
    $email = $row["email"];
    echo $email;
    
    
    
    $to = $email;
    $from = "info@friendspharmacy.esy.es";
    $subject = "Order Details";
    $body = "We need".$amount."amount from".$drug."of ".$dosage. "before ".$date."Thank you!" ;
    mail($to, "$subject",$body,"From".$from);
    
    header("vieworders.php");
    
    
}
  }


?>