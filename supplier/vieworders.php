<html>
    <head>
        <title>View order</title>
        <?php require('../includes/_header.php'); ?>
    <link href="css/vieworders.css" type="text/css" rel="stylesheet">
        
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="../customer/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="../customer/css/jquery.dataTables.min.css" >
    </head>
    
    <body>
        <?php require_once("../includes/navigation.php") ?>
        <h2>View Orders</h2>
        
        <div id="main">
        <table id="tbl" border="1">
            <thead id="thead" >
        
                <th>Supplier</th>
                <th>Medicine</th>
                <th>Dosage</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Send Email</th>
                <th>Cancel</th>
                <th>Status</th>
        
            </thead>
            
    <?php 
            include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");
            
            $sql="SELECT * FROM orders";
            $res = mysqli_query($mysqli,$sql);
	       while($row = mysqli_fetch_assoc($res)){
        ?>
            <tbody>
            
                <tr class="result_row">
                     <td> <?php echo $row['supplier'] ?></td>
                     <td> <?php echo $row['drug'] ?></td>
                     <td> <?php echo $row['dosage'] ?></td>
                     <td> <?php echo $row['amount'] ?></td>
                     <td> <?php echo $row['date'] ?></td>
                     <td> <?php echo $row['send'] ?></td>
                    <td><form method="post" action="get_mail.php" >
                           
                            <input type="hidden" name="supplier_name" value="<?php echo $row['supplier']; ?>">
                            <input type="hidden" name="drug" value="<?php echo $row['drug']; ?>">
                            <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
                            <input type="hidden" name="dosage" value="<?php echo $row['dosage']; ?>">
                            <input type="hidden" name="date" value="<?php echo $row['date']; ?>">
                            
                            <input type="submit" name="email" id="email" value="Email">
                           
                        </form>
                    </td>
                    <td><form method="post" action="get_mail.php">
                            <input type="hidden" name="del_id" value="<?php echo $row['order_id']; ?>">
                            <input type="hidden" name="del_sup" value="<?php echo $row['supplier']; ?>">
                            <input type="hidden" name="del_drug" value="<?php echo $row['date']; ?>">
                            <input type="hidden" name="del_amnt" value="<?php echo $row['amount']; ?>">
                            <input type="hidden" name="del_dos" value="<?php echo $row['dosage']; ?>">
                            <input type="hidden" name="del_date" value="<?php echo $row['date'];?>">
                            <input type="submit" name="cancel" id="cancel" value="Cancel" >
                            
                            
                            </form>
                    
                    
                        
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