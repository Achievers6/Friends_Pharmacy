
<?php
if(isset($_POST['add'])){
    if(isset($_POST['amnt'])){
        $amnt=$_POST['amnt'];
    }
    if(isset($_POST['data'])){
        $date=$_POST['date'];
    }
    if(isset($_POST['medname'])){
        $med=$_POST['medname'];
    }
    
}

    
    ?>

<html>
<head>
    <title>Place an order</title>
    
    <?php require('../includes/_header.php'); ?>
    <script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
    <link href="css/placeorder.css" type="text/css" rel="stylesheet">

      
</head>
    <body>
        <h2>Place an order</h2>
        <?php require_once("../includes/navigation.php") ?>
        <?php 
    $output='';
    ?>
        
        <div id="d1">
    <form action="placeorder.php" method="post" onsubmit="return validate()">
   <input type="text" id="medname" name="medname" placeholder="Medicine name" autocomplete="off">
    <div id="medList"><?php echo $output?></div>
   <input id="load" type="submit" name="btn" value="Search">
    </form>
      
        </div>
    <div id="d2">
     
            <form action="placeorder.php" method="post">
              <table>
                    <tr height="50">
                        <td>Supplier</td>
                        <td><select>
<!--                            <option>supplier</option>-->
                            <?php
                                if(isset($_POST['medname'])){
                                    include("placeorderdb.php");
                                    $medname=$_POST['medname'];
                                    $query1="SELECT supplier.company_name, drug.supplier_id,drug.generic_name, supplier.supplier_id FROM supplier INNER JOIN drug ON supplier.supplier_id=drug.supplier_id where drug.generic_name='$medname'";
                                    $result1=mysqli_query($connect,$query1);
     
                                    $num=mysqli_num_rows($result1);
                                    while($row=mysqli_fetch_assoc($result1)){
                                        $cname=$row['company_name'];
                                        ?>
                                    <option value="<?php echo $cname;?>"><?php echo $cname;?></option>    
                                    <?php
                        
                                    }
                                }
                                
                                
                            ?>
                        </select></td>
                   </tr>
                   <tr height="50">
                        <td>Amount</td>
                        <td><input type="text" id="amnt" name="amnt"></td>
                   </tr>
                   <tr height="50">
                        <td>Deliver before</td>
                        <td><input type="date" id="date" name="date"></td>
                   </tr>
                  
                  
             </table>  
                <input type="submit" value="Add" name="add" id="add">
            
            
            </form>
        
     
        
    </div>
    <div id="cart">
            <table>
                   <thead>
                       <th>Medicine</th> 
                       <th>Amount</th>
                       <th>Date</th>
                   </thead>
                   <tbody>
                        <td width="100px"><? echo $med ?></td>
                        <td width="100px"><? echo $amnt ?></td>
                        <td width="100px"><? echo $date ?></td>
                       
                   </tbody>
            </table>
            
    
    </div>
        
    </body>


</html>
    <script>
         function validate(){
            var medname=document.getElementById("medname").value;
            
            if(medname =="" ){
                    alert("Please enter a medicine");
                    return false;  
            }
         }

</script>
<script>
$(document).ready(function(){  
      $('#medname').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"placeorderdb.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#medList').fadeIn();  
                          $('#medList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#medname').val($(this).text());  
           $('#medList').fadeOut(); 
           
           
        });  
 });  
 
 </script>