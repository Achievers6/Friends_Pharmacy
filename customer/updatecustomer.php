<html>
<head>
    
	
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
    
    <script src="js/jquery-2.0.0.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
        
        <script>
            $(function(){
                $('#popup').hide();
                loadcustomers();
                $("#medicine-form").hide();
            });
            function loadcustomers(){
                console.log("loadcustomers");
                $.ajax({
                    url:"rest3.php",
                    async:true,
                    type:"GET",
                    data : {
                        type: "search",
                        nic: $('#nic').val(),
                        search: $('#search').val()
                     },
                })
                .done(function(data){
                    var records = JSON.parse(data);
                    var tbl_bdy =
                    document.getElementById("table_body");
                    tbl_bdy.innerHTML = '';
                    for(var i=0; i < records.length; i++){
                        var name = records[i].first_name + " " + records[i].last_name;
                        var row = "<tr class='records' onclick='loadDetails(\"";
                        row += records[i].nic + "\",\""; 
                        row += records[i].first_name + "\",\"";
                        row += records[i].last_name + "\",\"";
                        row += records[i].email + "\",";
                        row += records[i].contact_number + ")'>";
                        row += "<td>" + records[i].nic +"</td>";
                        row += "<td>" +  records[i].first_name + "</td>";
                        row += "<td>" +  records[i].last_name + "</td>";
                        row +="<td>" + records[i].email + "</td>";
                        row +="<td>" + records[i].contact_number + "</td>";
                        row += "</tr>";
                        console.log(row);
                        tbl_bdy.innerHTML += row;
                    }

                    $('#customer_table').DataTable();   
                });
            }

            function close() {
                console.log("close");
                $("#popup").fadeOut(500);
//                $(".customer_template_container").fadeOut(500);
            }
            
            function loadDetails(nic, fname, lname, email, tp) {
                console.log("loadDetails");
                $("#medicine-form").show();
                
                $("#popup").fadeIn(500);
                //$(".customer_template_container").fadeTo(500, 0.1).css('display', 'block');
                $.ajax({
                    url: "rest3.php",
                    async: true,
                    type: "GET",
                    data: {
                        type: "details",
                        nic: nic
                    }
                })
                .done(function(data) {
                    console.log(JSON.stringify(data));
                    var records = JSON.parse(data);
                    $("#cnic").html(nic);
                    $("#fname").val(fname);
                    $("#lname").val(lname)
                    $("#cemail").val(email);
                    $("#ctp").val(tp);
                    var medtbl = document.getElementById("ctbl");
                    medtbl.innerHTML = '';
                    for(var i=0; i < records.length; i++) {
                        var tbl = "<tr>" ;
                        tbl += "<td class='reminder_ids'>" + records[i].reminder_id + "</td>";
                        tbl += "<td><input type='text' name='medname' class='mednames' value='" + records[i].medicine_name + "'></td>";
                        tbl += "<td><input type='text' name='duration' class='durations' value='" + records[i].duration  + "'></td>";
                        tbl += "<td><input type='text' name='start_date' class='start_dates' value='" + records[i].start_date + "'></td>";
                        tbl += "<td><input type='text' name='end_date' class='end_dates' value='" + records[i].end_date + "'></td>";
                        tbl += "</tr>";
                        medtbl.innerHTML += tbl;
                    }
                });
            }

            function update() {
                var nic = $('#cnic').html();
                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var email = $('#cemail').val();
                var tp = $('#ctp').val();
                console.log(nic + "," + fname + "," + lname + "," + email + "," + tp);
                // Customer details
                var packet = {};
                packet["type"] = "update";
                packet["nic"] = nic;
                packet["fname"] = fname;
                packet["lname"] = lname;
                packet["email"] = email;
                packet["tp"] = tp;
                
                // Reminders update
                var reminder_ids = document.getElementsByClassName("reminder_ids");
                var mednames = document.getElementsByClassName("mednames");
                var durations = document.getElementsByClassName("durations");
                var start_dates = document.getElementsByClassName("start_dates");
                var end_dates = document.getElementsByClassName("end_dates");
                var items = [];
                for(var i=0; i < mednames.length; i++) {
                    var item = {};
                    item['reminder_id'] = $(reminder_ids[i]).html();
                    item['medicine_name'] = $(mednames[i]).val();
                    item['duration'] = $(durations[i]).val();
                    item['start_date'] = $(start_dates[i]).val();
                    item['end_date'] = $(end_dates[i]).val();
                    items.push(item);
                }
                packet["reminders"] = items;

                $.ajax({
                    url: "updatecustomerdb.php",
                    async: true,
                    type: "GET",
                    data: packet
                })
                .done(function(data) {});
                /**
                {
                    nic: <nic>,
                    fname: <fname>,
                    lname: <lname>,
                    email: <email>,
                    tp: <tp>,
                    reminders: [{},{}]
                }
                */
                alert("Updated");
                location.reload();
            }
        </script>
        <style>
        input {width:auto;}
  
        
        </style>
	
    <?php require('../includes/_header.php'); ?>
	
</head>

<body>

    <div id="popup">
    <input type='button' id="close" onclick="$('#popup').fadeOut(500);" style="position:absolute;right:10px; top:10px" value="X">
    <div id="medicine-form" style="text-align:left; margin">
        <p>NIC:</p> <div id="cnic"></div>
        First Name: <input type='text' name='fname' id="fname" /> <br>
        Last Name: <input type='text' name='lname' id='lname' /> <br>
        Email: <input type='text' name='email' id="cemail" /> <br>
        Contact Number: <input type='tel' name='tp' id="ctp" /> <br>
        <table border="0" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Duration</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>    
            </thead>
            <tbody id="ctbl">
            </tbody>
            </table>
            <input type="button" onclick="update()" value = "Update" style="width:100px"/>
        </div>
    </div>
         <?php require_once("../includes/navigation.php") ?>
    <style>
        
    </style>
    <!--content goes here -->
    <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">
        
        <h2>Update Customer Details</h2>
        <fieldset style=" border: 2px solid rgb(106,184,42); background-color: rgb(229, 249, 212); width: 800px; position:relative; left:150px;">
        <div class="top bar">
        <div class="left-float" style="padding-top:5px;">
            <div style="margin-top:20px;">
            <!--NIC:-->
            <!--<input type="text" name="nic" id="nic" placeholder="search" oninput="loadcustomers()"/>-->
            
            </div>
        
            <div class="left-float" style="float:left">
            
            </div>
            </div>
        </div>
        <br>
        
        <div class="content">
            <table id="customer_table" border="1" style='width:500px; margin: 0 auto; width: 700px;'>
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
            
           </fieldset>  

            
        
        <?php // echo $content; ?>
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
        
        </div>             

</body>

</html>