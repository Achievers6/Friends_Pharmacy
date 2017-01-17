
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php require('../includes/_header.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/stock2.css" />
        <link href="../public/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title><?php echo $title; ?></title>
        <script>
            function showConfirm(qty)
            {

                if (isNaN(qty))
                {
                    alert("Must input numbers");
                    return false;
                }
            }


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
