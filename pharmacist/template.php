
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php require('../includes/_header.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/stock2.css" />
        <link href="../public/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title><?php echo $title; ?></title>
        <script>
            function validateForm() {
                var x = document.forms["myForm"]["txtMedicineName"].value;
                var y = document.forms["myForm"]["txtbatchNumber"].value;
                var z = document.forms["myForm"]["txtQuantity"].value;
                var p = document.forms["myForm"]["entry_date"].value;
                var q = document.forms["myForm"]["EXP_date"].value;
                var s = document.forms["myForm"]["production_date"].value;


//                var EnteredDate = document.forms["myForm"]["production_date"].value;//for javascript
//
//                var EnteredDate = $("#entryDatep").val(); // For JQuery
//
//                var date = EnteredDate.substring(0, 2);
//                var month = EnteredDate.substring(3, 5);
//                var year = EnteredDate.substring(6, 10);
//
//                var myDate = new Date(year, month - 1, date);
//
//                var today = new Date();
//                 alert(myDate);
//                if (myDate > today) {
//                    alert("Entered date is greater than today's date ");
//                }
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                var today1 =  yyyy + "-" + mm + "-" + dd;
               
                if(today1<s){
                    alert("error");
                };
                if (x == null || x == "") {
                    alert("Medicine name must be filled out");
                    return false;
                }
                if (y == null || y == "") {
                    alert("Batch number must be filled out");
                    return false;
                }
                if (z == null || z == "") {
                    alert("Quantity number must be filled out");
                    return false;
                }
                if (p == null || p == "") {
                    alert("Entry date must be filled out");
                    return false;
                }
                if (q == null || q == "") {
                    alert("EXP date must be filled out");
                    return false;
                }
                if (s == null || s == "") {
                    alert("Production date must be filled out");
                    return false;
                }
                if (q < s) {
                    alert("EXP date must be greater than producton date");
                    return false;
                }


            }
            function myFunction() {
                window.location = "AddMedicine.php";
            }

            $(document).ready(function() {
                $('#txtMedicineName').keyup(function() {
                    //get the antry value
                    var query = $(this).val();
                    //check input is not empty
                    if (query != '')
                    {
                        $.ajax({
                            url: "Search.php",
                            method: "POST",
                            data: {query: query},
                            success: function(data)
                            {
                                //fill the med list
                                $('#medicineList').fadeIn();
                                $('#medicineList').html(data);
                            }
                        });
                        $.ajax({
                            //to get data from database to dropdowm list
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
                });
                $(document).on('click', '#lim', function() {
                    $('#txtMedicineName').val($(this).text());
                    $('#medicineList').fadeOut();


                });
            });





            function searchForm() {
                var x = document.forms["myForm"]["txtMedicinedName"].value;


                if (x == null || x == "") {
                    alert("feild must be filled out");
                    return false;
                }
            }

            $(document).ready(function() {
                $('#medicine').keyup(function() {
                    var query = $(this).val();
                    if (query != '')
                    {
                        $.ajax({
                            url: "SearchMed.php",
                            method: "POST",
                            data: {query: query},
                            success: function(data)
                            {
                                $('#medicineList').fadeIn();
                                $('#medicineList').html(data);
                            }
                        });
                    }
                });
                $(document).on('click', '#lim', function() {
                    $('#medicine').val($(this).text());
                    $('#medicineList').fadeOut();


                });
            });

            $(document).ready(function() {
                $('#email').keyup(function() {
                    var query = $(this).val();
                    $.ajax({
                        url: "searchMail.php",
                        method: "POST",
                        data: {query: query},
                        success: function(data)
                        {
                            $('#sortable').fadeIn();
                            $('#List').html(data);
                        }
                    });

                });

            });




            function searchForm() {
                var x = document.forms["myForm"]["txtMedicinedName"].value;

                if (x == null || x == "") {
                    alert("Medicine name must be filled out");
                    return false;
                }
            }
            var modal = document.getElementById('myModal');

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

        </script>
    </head>

    <body>

        <?php require_once("../includes/navigation.php") ?>

        <!--content goes here -->
        <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">

            <?php echo $content; ?>

        </div>		
        <?php require_once('../includes/_footer.php') ?>
    </body>

</html>
