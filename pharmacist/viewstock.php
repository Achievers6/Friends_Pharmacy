<html>
<head>
        <script src="../public/js/sort.js"></script>
	<link rel="stylesheet" href="css/stockstyles.css"/>
		<link rel="stylesheet" href="css/jquery.dataTables.min.css" />
        <script src="js/jquery-2.0.0.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script>
            
        $(function() {
            loadStock(); 
        });
        function loadStock() {
            $.ajax({
                url: "rest.php",
                async:true,
                type:"GET",
                data : {
                    medtype : $('#medtype').val(),
                    search : $('#search').val()
                },
            })
            .done(function(data){
                var records = JSON.parse(data);
                var tbl_body = document.getElementById("table-body");
                tbl_body.innerHTML = '';
                for (var i=0; i < records.length; i++) {
                    var row = "<tr>";
                    row += "<td>" + records[i].medicine_name + "</td>";
                    row += "<td>" + records[i].batch_no + "</td>";
                    row += "<td>" + records[i].category + "</td>";
                    row += "<td>" + records[i].supplier_id + "</td>";
                    row += "<td>" + records[i].quantity + "</td>";
                    row += "<td>" + records[i].entry_date + "</td>";
                    row += "<td>" + records[i].production_date + "</td>";
                    row += "<td>" + records[i].expire_date + "</td>";
                    row += "</tr>";
                    tbl_body.innerHTML += row;
                }
                
                $("#stock_table").DataTable();
            });
        }
        </script>
    <?php require('../includes/_header.php'); ?>
        
</head>

<body>
    
    <?php require_once("../includes/navigation.php") ?>
    
    <!--content goes here -->
    <div class="customer_template_container">
        
        <h2>View Stock</h2>


<!--
        <div class="top-bar">
            <div class="left-float" style="padding-top:5px;">
                Search By:
                <select name="medtype" id="medtype">
                    <option value="1">Medicine Name</option>
                    <option value="2">Batch Number</option>
                    <option value="3">Category</option>
                </select>
                <input type="text" name="search" id="search" placeholder="Search" oninput='loadStock()'/>
            </div>
            <div class="left-float">
                <span class="icon" onclick="loadStock()"><img src="img/Zoom-icon.png" height="40" width="40" /></span>
            </div>
            <div>
                
            </div>
        </div>
-->

        <h2 style="text-align:center; margin-top:56px;">View stock</h2>
        <div class="content" style="margin-top:10px; padding-right:40px; padding-left:40px;">
            <table id="stock_table" border="0">
                <thead>
                    <tr>
                        <th>Medicine Name</th>                   
                        <th>Batch Number</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Entry Date</th>
                        <th>Production Date</th>
                        <th>Expire Date</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
        <?php // echo $content; ?>
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
</body>

</html>
