<html>
    <head>
        <?php require('../includes/_header.php'); ?>
        <title>View supplier details</title> 
        <link href="css/viewsupplier.css" type="text/css" rel="stylesheet">
        <!--<script src="js/jquery-3.1.0.min.js"></script>-->
        <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script>


            $(function() {
                getsuppliers();
            })

            function getsuppliers() {
                $.ajax({
                    url: "viewsupplierdb.php",
                    async: true,
                    type: "GET",
                    data: {
                        type: "get",
                        search: $('#search').val()
                    }
                })
                        .done(function(data) {
                    var records = JSON.parse(data);
                    var tbl = document.getElementById("tbl");
                    tbl.innerHTML = '';


                    for (var i = 0; i < records.length; i++) {
                        var row = "<tr>";
                        row += "<td >" + records[i].company_name + "</td>";
                        row += "<td>" + records[i].mobile + "</td>";
                        row += "<td>" + records[i].telephone + "</td>";
                        row += "<td>" + records[i].fax + "</td>";
                        row += "<td>" + records[i].medicine_name + "</td>";
                        row += "<td>" + records[i].dosage + "</td>";
                        row += "<td>" + records[i].price + "</td>";
                        row += "</tr>";
                        tbl.innerHTML += row;
                    }
                });
            }
        </script>

    </head>
    <body >
        <?php require_once("../includes/navigation.php") ?>
        <h2 style="position: relative; left:-490px;">Supplier details</h2>

        <div id="d1" style="position: relative; left:40px;">
            <form action="viewsupplier.php" method="post">
                <input type="text"  id="search" name="search" oninput=" return getsuppliers()" placeholder="Medicine name" ><br><br>
                <center>

                    <div class="d2">  
                        <table border="1" id="tbl3">
                            <thead>
                            <th >Company name</th>

                            <th>Mobile number</th>
                            <th>Land number</th>
                            <th>Fax</th>
                            <th>Medicine</th>

                            <th>Dosage(mg)</th>
                            <th>Price(Rs.)</th>
                            </thead>
                            <tbody id="tbl">
                            </tbody>
                        </table>


                    </div>

                </center>

            </form>
        </div>
        <script>
            $(document).ready(function() {
                $('#tbl3').DataTable();
            });



        </script>

        <?php require_once('../includes/_footer.php') ?>

    </body>
</html>