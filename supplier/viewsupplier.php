<html>
    <head>
        <title>View suppliers</title>
        <?php require('../includes/_header.php'); ?>
        <link href="css/viewsupplier.css" type="text/css" rel="stylesheet">
       <script src="js/jquery-3.1.0.min.js"></script>
        <script src="../customer/js/jquery.dataTables.min.js"></script>
         <link href="../customer/css/jquery.dataTables.min.css">
    </head>
<body>
    <h2>View Suppliers</h2>
    <?php require_once("../includes/navigation.php") ?>
    <div id="main">
    <table id="tbl" border="1">
                <thead>
                    <th>Supplier</th>
                    <th>Mobile</th>
                    <th>Telephone</th>
                    <th>Fax</th>
                    <th>Medicine</th>
                    <th>Dosage</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    
<?php
    include '../database/dbconnect.php';
    mysqli_select_db($mysqli,"friends_pharmacy")or die("Couldn't connect database");
    $sql = "SELECT supplier.company_name,supplier.mobile,supplier.telephone,supplier.fax,Drug_price.medicine_name,Drug_price.dosage,Drug_price.price FROM supplier INNER JOIN Drug_price ON supplier.supplier_id= Drug_price.supplier_id";
    
    
    
//echo $sql;

$res=mysqli_query($mysqli,$sql);
while($row=mysqli_fetch_assoc($res)){
    $sup=$row['company_name'];
    $mob=$row['mobile'];
    $tel=$row['telephone'];
    $fax=$row['fax'];
    $med=$row['medicine_name'];
    $dos=$row['dosage'];
    $price=$row['price'];
    


?>
   
                    <tr>
                        <td><?php echo $sup ?></td>
                        <td><?php echo $mob ?> </td>
                        <td><?php echo $tel ?></td>
                        <td><?php echo $fax ?> </td>
                        <td><?php echo $med ?></td>
                        <td><?php echo $dos ?></td>
                        <td><?php echo $price ?></td>
                    </tr>



    
    
<?php
}
?>
                        
                </tbody>
            </table>
    </div>
    </body> 
</html>
<script>
    $(document).ready(function(){
        $('#tbl').DataTable();
    });

</script>