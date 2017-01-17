
<html>
    <head>
        <script>
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
                            url: "Search.php",
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
  
        </script>

        <?php require('../includes/_header.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/med.css" />
        <title><?php echo $title; ?></title>
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



