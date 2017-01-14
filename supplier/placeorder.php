
<?php
include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");

$output='';

?>
<html>
        <head>
            <title>Place order</title>
              <?php require('../includes/_header.php'); ?>
            <link href="css/placeorder.css" rel="stylesheet" type="text/css">
             <script type="text/javascript"></script>
             <script src="js/jquery-3.1.0.min.js"></script>
        </head>
    <body>
            <h2>Place order</h2>
         <?php require_once("../includes/navigation.php") ?>
        <div id="tbl1">
            <table class="sortable" id="tbl" >
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Medicine</th>
                            <th>Dosage</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
            
            </table>
        
         </div>
        <div id="srch">
        <form method="post" action="">
            <?php if(isset($_POST['search'])){ $medname=$_POST['med'];} else {$medname = '';} ?>
            <input type="text" id="med" name="med" placeholder="Medicine name" value = "<?php echo $medname; ?>" autocomplete="off">
             <div id="medList"><?php echo $output ?></div><br><br>
            <input type="submit" id="search" value="Search" name="search">
        </form>
        </div>
        <div id="frm">
        <form action="placeorder.php" method="post">
              <table>
                    <tr height="50">
                        <td>Supplier</td>
                        <td><select>

                            <?php
                                if(isset($_POST['search'])){
                                    
                                    $med = $_POST["med"];
                                    echo $med;
                                    
                                    include("placeorderdb.php");
                                    $medname=$_POST['med'];
                                    $query1="SELECT supplier.company_name, drug.supplier_id,drug.generic_name, supplier.supplier_id FROM supplier INNER JOIN drug ON supplier.supplier_id=drug.supplier_id where drug.generic_name='$medname'";
                                    $result1=mysqli_query($mysqli,$query1);
     
                                    $num=mysqli_num_rows($result1);
                                    while($row=mysqli_fetch_assoc($result1)){
                                        $cname=$row['company_name'];
                                        ?>
                                    <option value="<?php echo $cname;?>" id="sup"><?php echo $cname;?></option>    
                                    <?php
                        
                                    }
                                    
                                }
                                
                                
                                
                            ?>
                        </select></td>
                   </tr>
                   <tr height="50">
                        <td>Dosage</td>
                        <td><input type="text" id="dos" name="dos"></td>
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
                <input type="submit" value="Add" name="add" id="add" onclick="return addData();">
            
            
            </form>
    </div>
    </body>
</html>
    <script>
    
            function addData(){
             
                var raws ="";
                var supplier= document.getElementById('sup').value;
                var amount = document.getElementById('amnt').value;
                var date =document.getElementById('date').value;
                var med =document.getElementById('med').value;
                var dos =document.getElementById('dos').value;
                
                
                raws += "<tr><td>" + supplier + "</td><td>" + med + "</td><td>"+ dos + "</td><td>" + amount + "</td><td>" +date+"</td><td><a href='mailto:'><img  class='confirm' src='../public/image/msg.png' style='width: 25px; height: 25px;'></a></td> <td><a href=''><img class='confirm' src='../public/image/reject.png' style='width: 25px; height: 25px;'></a></td> </tr>" ;
              $(raws).appendTo("#tbl tbody");
                
                return false;
       
            }
   
    
    
    </script>
<script>
    $(document).ready(function() {
        $('#med').keyup(function() {
            var query = $(this).val();
            if (query != '')
            {
                $.ajax({
                    url: "placeorderdb.php",
                    method: "POST",
                    data: {query: query},
                    success: function(data)
                    {
                        $('#medList').fadeIn();
                        $('#medList').html(data);
                    }
                });
            }
        });
        $(document).on('click', '#lim', function() {
            $('#med').val($(this).text());
            $('#medList').fadeOut();


        });

    });

</script>