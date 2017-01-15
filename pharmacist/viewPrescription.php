
<html>
   
    <head>

        <?php require('../includes/_header.php'); ?>
        <script src="js/jquery-2.0.0.js"></script>
        <script src="js/jquery-ui.js"></script>


        <script>
            $(document).ready(function() {
                $('#txtMedicineName').keyup(function() {
                    var query = $(this).val();
                    if (query != '')
                    {
                        $.ajax({
                            url: "Search.php",
                            method: "POST",
                            data: {query: query},
                            success: function(data)
                            {
                                $('#medicineList').fadeIn();
                                $('#medicineList').html(data);
                            }
                        });
                        $.ajax({
                            url: "dropdowndosage.php",
                            method: "POST",
                            data: {query: query},
                            success: function(data)
                            {
                                $('#dosageList').fadeIn();
                                $('#dosageList').html(data);
                            }
                        });
                    }
                    else if (query == '') {

                        $('#medicineList').hide();
                        $('#dosageList').hide();

                    }

                });
                $(document).on('click', '#lim', function() {
                    $('#txtMedicineName').val($(this).text());
                    $('#medicineList').fadeOut();


                });
            });




            function delete_row(no)
            {
                document.getElementById("row" + no + "").outerHTML = "";
            }

            function add_row()
            {
                var med_name = document.getElementById("txtMedicineName").value;
                var dosage = document.getElementById("dosagedr").value;
                var qty = document.getElementById("txtqty").value;

                var table = document.getElementById("data_table");
                var table_len = (table.rows.length);


                var row = table.insertRow(table_len).outerHTML = "<tr id='row" + table_len + "'>\n\
                        <td><input type=text  class=sinput name='med_row" + table_len + "' value=" + med_name + "></td>\n\
                     <td><input type=text  class=sinput name=dosage" + table_len + " value=" + dosage + "></td>\n\
                      <td><input type=text  class=sinput name=qty" + table_len + " value=" + qty + "></td>\n\
                        <td><input type=text  class=sinput name=uprice" + table_len + " value=" + qty * 2 + "></td>\n\
                        <td><input type=text class=sinput name=amount" + table_len + " value=" + qty * 5 + "></td>\n\
                        <td><input type='button' value='Delete' class='delete' onclick='delete_row(" + table_len + ")'></td>\n\
                        <input type='hidden' name='len' value='" + table_len + "'>\n\
                </tr>";

                document.getElementById("myform").reset();
                $('#dosageList').hide();



            }
            function validateForm() {
                var table = document.getElementById("data_table");
                var table_len = (table.rows.length);

                if (table_len == 1) {
                    alert("No item is selected");
                    return false;
                }

            }
            function showConfirm(id)
            {
                // build the confirmation box
                var c = confirm("Are you sure you wish to reject this prescription?");

                // if true, delete item and refresh
                if (c)
                    window.location = "prescription.php?reject=" + id;
            }
        </script>


        <style>
            #btnr {
                width: 100px;
                height: auto;
                position: absolute;
                left: 620px;
                top:270px;

                background-color: rgb(106,184,42);
                color: white;
                padding: 10px 10px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            #btnsubmit {
                width: 100px;
                height: auto;
                position: absolute;
                left: 620px;
                top:345px;

                background-color: rgb(106,184,42);
                color: white;
                padding: 10px 10px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;

            }
            .sinput {
                width: 70px;
            }
            h2 {
                text-align:center; 
                color: #777777; 
                font-family: SourceSansPro;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 50px 0;
                top:100px;
            }
            #image {
                position: absolute;
                left: 840px;
                width: 300px;
                height: 400px;
            }

            #data_table {
                position: relative;
                top:40px;
                left: -250px;
                width: 480px;
            }
            fieldset{
                border: none;
                width: 400px;
                position: relative;
                left: -250px;
                height: auto;
                margin:auto;

                border: 2px solid rgb(106,184,42);
                background-color: rgb(229, 249, 212);

            }
            #medicineList {
                background-color: white;
                width: 170px;
                left: 300px;
                position: relative;
                left: 500px;
                top:-3px;
                left:124px;

            }
            ul {
                list-style-type: none;
                list-style-position: inside;
                margin: 0 0 0px 0;

            }
            .ltd {
                width: 116px;
            }

        </style>

        <title>View Prescription</title>
    </head>
    <body>
        <?php require_once("../includes/navigation.php") ?>


        <div class="customer_template_container" >
            <h2>.</h2>

            <?php
            include '../database/dbconnect.php';

            $content = "";

            $id = $_GET['prescription_id'];

            $sql = "SELECT * FROM Prescription WHERE prescription_id='$id'";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo "
		<h2> Prescription ID - " . $id . " </h2>
		<div class='image'>
			<img id='image' src='../customer/uploads/" . $row['image'] . "'>
		</div>
		";
            }
            ?>
            <fieldset>
                <form id='myform'>
                    <table>
                        <tr>
                            <td class='ltd'>
                                <label class='lblf' for='name'>Medicine Name: </label>
                            </td>
                            <td>
                                <input type ='text' id='txtMedicineName' class='inputField' name ='txtMedicineName' autocomplete='off'>
                            </td>
                        </tr>
                    </table>
                    <div id='medicineList'></div> 

                    <table>
                        <tr>
                            <td class='ltd'>
                                <label class='lblf' >Dosage : </label>
                            </td>
                            <td>


                                <div id='dosageList' style='top:-8px;'>.</div> 



                            </td>
                        </tr>
                        <tr>
                            <td class='ltd'>
                                <label class='lblf' >Quantity : </label>
                            </td>
                            <td>
                                <input type ='text' id='txtqty' class='inputField' name ='txtqty' autocomplete='off'>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="button" class="add" onclick="add_row();" value="Add Row">
                            </td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <div id="tcon">
                <form name='myForm' action='prescription.php' method ='post' autocomplete='off' onsubmit='return validateForm()'>
                    <table align='center' cellspacing=2 cellpadding=5 id="data_table" border=1>
                        <tr>
                            <th>Medicine name</th>
                            <th>Dosage</th>
                            <th>Quantity</th>
                            <th>Unit Price(Rs)</th>
                            <th>Amount(Rs)</th>

                        </tr>


                    </table>
                    <input type='hidden' name = 'presid' value='<?php echo $id ?>' ><br/> 
                    <input type='submit' class='btn' id='btnsubmit' name = 'btnSubmit' value='Submit List'><br/> 
                    <input type="button" class="btn" id='btnr' onclick="showConfirm(<?php echo $id; ?>);" value="Reject">
                </form>
            </div>

        </div>		


        <?php require_once('../includes/_footer.php') ?>


    </body>
</html>

