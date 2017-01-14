<html>
<head>
    	
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="customerStyle.css" />
    <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
    <script src="js/jquery-2.0.0.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
        
        <script>
            $(function(){
                loadcustomers();
                $("#medicine-form").hide();
            });
            function loadcustomers(){
                $.ajax({
                    url:"rest3.php",
                    async:true,
                    type:"GET",
                    data : {
                        type: "search",
                        nic: $('#nic').val(),
                        limit: $('#limit').val()
                     },
                })
                .done(function(data){
                    var records = JSON.parse(data);
                    var tbl_bdy = document.getElementById("table_body");
                    tbl_bdy.innerHTML = '';
                    for(var i=0; i < records.length; i++){
                        var name = records[i].first_name + " " + records[i].last_name;
                        var row = "<tr onclick='loadDetails(";
                        row += records[i].nic + ",\""; 
                        row += name + "\",\"";
                        row += records[i].email + "\",";
                        row += records[i].contact_number + ")'>";
                        row += "<td>" + records[i].nic +"</td>";
                        row += "<td>" +  records[i].first_name + "</td>";
                        row += "<td>" +  records[i].last_name + "</td>";
                        row +="<td>" + records[i].email + "</td>";
                        row +="<td>" + records[i].contact_number + "</td>";
                        row += "</tr>";
                        tbl_bdy.innerHTML += row;
                        // console.log(row);
                    }
                    
                    $('#customer_table').DataTable();
                });
            }
            
            // function loadDetails(nic, name, email, tp) {
            //     $("#medicine-form").show();
            //     $.ajax({
            //         url: "rest3.php",
            //         async: true,
            //         type: "GET",
            //         data: {
            //             type: "details",
            //             nic: nic
            //         }
            //     })
            //     .done(function(data) {
                    
            //         var records = JSON.parse(data);
            //         document.getElementById("cnic").innerHTML = "NIC: " + nic;
            //         document.getElementById("cname").innerHTML = "Name: " + name;
            //         document.getElementById("cemail").innerHTML = "Email: " + email;
            //         document.getElementById("ctp").innerHTML = "Contact: " + tp;
            //         var medtbl = document.getElementById("ctbl");
            //         medtbl.innerHTML = '';
            //         for(var i=0; i < records.length; i++) {
            //             var tbl = "<tr>" ;
            //             tbl += "<td>" + records[i].medicine_name + "</td>";
            //             tbl += "<td>" + records[i].duration  + "</td>";
            //             tbl += "<td>" + records[i].start_date + "</td>";
            //             tbl += "<td>" + records[i].end_date + "</td>";
            //             tbl += "</tr>";
            //             medtbl.innerHTML += tbl;
            //         }
            //     });
            // }
        </script>
	
    <?php require('../includes/_header.php'); ?>
	
</head>

<body>
         <?php require_once("../includes/navigation.php") ?>
    
    <!--content goes here -->
    <h2 style="position:relative;top:70px; left: 100px ">View Customer Details</h2>
    <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">
        
        
        
        <fieldset style="border: 2px solid rgb(106,184,42);">
        <div class="top bar">
        <div class="left-float" style="padding-top:5px;">
            <!--<div style="float:left">-->
            <!--NIC-->
            <!--<input type="text" name="nic" id="nic" placeholder="search" oninput="loadcustomers()"/>-->
            <!--</div>-->

            <!--<div style="float: right">-->
            <!--Show-->
            <!--<select id='limit' onchange="loadcustomers()">-->
                <!--<option value="20">20</option>-->
                <!--<option value="all">All</option>-->
            <!--</select> results-->
            <!--</div>-->
        
            <div class="left-float" style="float:left">
            <span class="icon" onclick="loadcustomers()">
                
            </div>
            </div>
        </div>
        <br>
        
        <div class="content">
            <table id="customer_table" border="1" style='width:60%; float:left;'>
                <thead>
                    <tr>
                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                    </tr>
                </thead>
                <tbody id="table_body"></tbody>
            </table>
            
            <div id="medicine-form" style="text-align:left; float:left;">
                <div id="cnic"></div>
                <div id="cname"></div>
                <div id="cemail"></div>
                <div id="ctp"></div>
                <table border="0" style="width:100%">
                <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Duration</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>    
                </thead>
                <tbody id="ctbl">
                </tbody>
                </table>
            </div>
        
        <?php // echo $content; ?>
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
     </fieldset>   
        </div>             

</body>

</html>
