
<?php
include '../database/dbconnect.php';
mysqli_select_db($mysqli, "friends_pharmacy") or die("Couldn't connect to database");

$output='';

?>
<html>
        <head>
             <?php require('../includes/_header.php'); ?>
             <title>Place order</title>
           
             <link href="css/placeorder.css" rel="stylesheet" type="text/css">
             <script type="text/javascript"></script>
             <script src="js/jquery-3.1.0.min.js"></script>
        </head>
    <body>
        <?php require_once("../includes/navigation.php") ?>
            <h2>Place order</h2>
<!--         -->
       
        <div id="srch">
            
        <form method="post" action="placeorder.php">
            <?php if(isset($_POST['search'])){ $medname=$_POST['med'];} else {$medname = '';} ?>
            <input type="text" id="med" name="med" placeholder="Medicine name" value = "<?php echo $medname; ?>" autocomplete="off">
             <div id="medList"><?php echo $output ?></div><br><br>
            <input type="submit" id="search" value="Search" name="search">
        </form>
        </div>
        
        <div id="frm">
            <fieldset>
        <form action="add_order.php" method="post">
              <table>
                    <tr>
                        <td>Medicine</td>
                        <td><input class="input" type="text" name="medicine" value="<?php echo $medname ; ?>"></td></tr>
                    <tr height="50">
                        <td>Supplier</td>
                        <td><select name="sup">

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
                        <td><input class="input"type="text" id="dos" name="dos" placeholder="EX:20mg"></td>
                   </tr>
                  
                   <tr height="50">
                        <td>Amount</td>
                        <td><input class="input" type="text" id="amnt" name="amnt"></td>
                   </tr>
                   <tr height="50">
                        <td>Deliver before</td>
                        <td><input class="input" type="date" id="date" name="date"></td>
                   </tr>
                  
                  
             </table>  
                <input type="submit" value="Add" name="add" id="add" >
            
            </form>
                </fieldset>
    </div>
        
    </body>
</html>
   
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
//        $('.sortable tr:last ').click(function(){
//         $('.sortable tr').hide();
//            });
    });

</script>