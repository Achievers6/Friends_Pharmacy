<html>
<head>
    <?php require('../includes/_header.php'); ?>
    <script src="../public/js/sort.js"></script>
	<link rel="stylesheet" href="css/stockstyles.css"/>
	<link rel="stylesheet" href="css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="css/selectize.css"/>
    <script src="js/jquery-2.0.0.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/selectize.min.js"></script>
    
    <style>
        .selectize-control {
            width: 250px;
        }
    </style>
    <script>
        $(function() {
            $('select').selectize({
                persist: true,
                createOnBlur: true,
            });    
        });
        
        function getUsage() {
            var packet = {};
            packet['medicine'] = $('#drug').val();
            packet['duration'] = $('#duration').val();
            $.ajax({
                url: "getusage_rest.php",
                async: true,
                type: "GET",
                data: packet
            })
            .done(function(data) {
                console.log(JSON.stringify(data));
            });
        }
        
    </script>
        
</head>

<body>
    
    <?php require_once("../includes/navigation.php") ?>
    
    <!--content goes here -->
    <div class="customer_template_container">
        
        <h2>View Usage</h2>

        <h2 style="text-align:center;">View Usage</h2>
        <div class="content" style="margin-top:10px; padding-right:40px; padding-left:40px;">
            <table>
                <td>
                Search <select id="drug" onchange="getUsage()">
            <?php
            include '../database/dbconnect.php';
            $sql = "SELECT * FROM drug";
            $result = mysqli_query($mysqli, $sql);

            while (($row = mysqli_fetch_assoc($result)) != null) {
                echo "<option value='" . $row['id'] . "'>" . $row['generic_name'] . "</option>";
            }
            ?>
                    </select>
                </td><td>
                Duration <select id="duration" onchange="getUsage()">
                                <option value="1">One day</option>
                                <option value="7">One week</option>
                                <option value="30">One month</option>
                                <option value="365">One year</option>

                            </select>
            </td>
            </table>
        </div>
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

            
        </div>
        <?php // echo $content; ?>
    </div>		
	
    
    <?php require_once('../includes/_footer.php') ?>
    
</body>

</html>
