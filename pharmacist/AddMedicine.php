
<script>

    function delete_row(no)
    {
        document.getElementById("row" + no + "").outerHTML = "";
        var table = document.getElementById("data_table");

    }

    function add_row()
    {
        var new_name = document.getElementById("new_name").value;
        var new_country = document.getElementById("new_country").value;
//                var new_age = document.getElementById("new_age").value;

        var table = document.getElementById("data_table");
        var table_len = (table.rows.length) - 1;
        var row = table.insertRow(table_len).outerHTML =
                "<tr id='row" + table_len + "'>\n\
                            <td id='name_row" + table_len + "'><input type='text' name=dosage" + table_len + " value=" + new_name + "></td>\n\
                            <td id='country_row" + table_len + "'><input type='text' name=price" + table_len + " value=" + new_country + "></td>\n\
                            <td><input type='button' value='Delete' class='delete' onclick='delete_row(" + table_len + ")'></td></tr>";



        document.getElementById("new_name").value = "";
        document.getElementById("new_country").value = "";
        //document.getElementById("new_age").value = "";
    }

    function validateForm2() {
        var u = document.forms["myForm2"]["addcat"].value;
        if (u == null || u == "") {
            alert("category name must be filled out");
            return false;
        }
    }


    function validateForm() {
        var x = document.forms["myForm"]["txtBrandName"].value;
        var y = document.forms["myForm"]["txtGenericName"].value;
        var z = document.forms["myForm"]["type"].value;
        var p = document.forms["myForm"]["category"].value;
        var q = document.forms["myForm"]["supplier"].value;
        if (x == null || x == "") {
            alert("Medicine name must be filled out");
            return false;
        }
        if (!isNaN(x)) {
            alert("Medicine name sould not have numerics");
            return false;
        }
        if (y == null || y == "") {
            alert("Genaric name be filled out");
            return false;
        }
        if (!isNaN(y)) {
            alert("Genaric name sould not have numerics");
            return false;
        }
        if (z == null || z == "") {
            alert("Type must be filled out");
            return false;
        }
        if (p == null || p == "") {
            alert("category must be filled out");
            return false;
        }
        if (q == null || q == "") {
            alert("supplier must be filled out");
            return false;
        }
    }

    function myFunction() {// Get the modal
        var modal = document.getElementById('myModal');
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
            document.getElementById("mybtn2").style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>
<?php
$title = "";

$content = "<h2 style='text-align:center;'>Add New Medicine</h2>
    <form name='myForm' action='AddMedicine.php' method ='post' onsubmit='return validateForm()' enctype='multipart/form-data'>
        <fieldset>
            <label for='Brand Name'>Brand Name: </label>
            <input type='text' class='inputField' name='txtBrandName' autocomplete='off' placeholder='Ex: Amoxil'/><br/>
            <p></p>
            <label for='name'>Generic Name: </label>
            <input type='text' class='inputField' name='txtGenericName' autocomplete='off' placeholder='Ex: amoxicillin' /><br/>
            <p></p>
            <label for='Type'>Type: </label>
            <select class = 'type' name='type'>
            <option value='Tablets'>Tablets</option>
            <option value='Capsules'>Capsules</option>
            <option value='liquid<'>liquid</option>
            </select></br>
            <p></p>
            <label for='Category'>Category: </label>
            <input type='text' class='inputField' name='category' id='category' autocomplete='off' placeholder='Ex: Antibiotic'/><br/>
            <div id='categoryList'></div> 
            <p></p>
            <label for='group'>Group: </label>
            <select class = 'type' name='group'>
            <option value='OC'>Over the counter</option>
            <option value='two_ii'>Two ii</option>
            <option value='Narcotics'>Narcotics</option>
            </select></br>
            <p></p>
            <label for='Supplier'>Supplier: </label>
            <input type='text' class='inputField' id='supplier' name='supplier' autocomplete='off'/><br/>
            <div id='supplierList'></div> 
            <p></p>
            <label for='content'>content: </label>
            <textarea cols='37' rows='12' name='txtContent'></textarea></br>
            <p></p>			
            <label for='image'>Add image: </label>
            <input type='file' name='fileToUpload' id='fileToUpload'>
            <p></p>
            

            
            <label for='image' style=padding-top:30px;'>Add Dosage: </label>
            number of dasages: <input type='number' name='dcount' id='dcount' style='margin-top:30px; width:40px;'>
            <div id='wrapper' style=padding-top:30px;'>
            <table cellspacing=1 cellpadding=3 id='data_table' border=1 style='display:none;'>
                <tr>
                    <th>Dosage(Ex: 250mg)</th>
                    <th>Price(MRP)</th>
                </tr>
                

               

            </table>
        </div>
        

            
            <label for='image' style=padding-top:30px;'> </label>
            <p> .</p>
            <input type='submit' name = 'btnSubmit' location.href = 'AddMedicine.php'><br/> 
            <p></p>
        </fieldset>
    </form>
   
    <button id='myBtn' onclick='myFunction()' style='position:absolute; top:310px; right:210px; background-color: rgb(106,184,42); color: white;
    padding: 5px 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;'>New Category</button><br/>
    

    <div id='myModal' class='modal'>
        <div class='modal-content'>
          <span class='close'>x</span>
          <h3 style='text-align:center;'>Add category</h3>

          <form name='myForm2' action='AddMedicine.php'  method ='post' onsubmit='return validateForm2()'>

          <label >Category: </label>
          <input type='text' class='inputField' name='addcat' autocomplete='off' placeholder='Ex:Antibiotic'/><br/>
          <p></p>
          <input type='submit' name = 'btnSubmitcat'>
          </form>
        </div>

     </div>";













if (isset($_POST['btnSubmitcat'])) {
    $cat = $_POST["addcat"];
    include '../database/dbconnect.php';

    if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM category WHERE category_name ='$cat'"))) {
        echo '<script language="javascript">';
        echo 'alert("category is already added")';
        echo '</script>';
    } else {
        $query = "INSERT INTO category
            (category_name)
             VALUES
             ('$cat')";

        mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        mysqli_close($mysqli);


        echo '<script language="javascript">';
        echo 'alert("Successfully added")';
        echo '</script>';
    }
}

if (isset($_POST['btnSubmit'])) {



    $brand_name = $_POST["txtBrandName"];
    $generic_name = $_POST["txtGenericName"];
    $type = $_POST["type"];
    $category = $_POST["category"];
    $supplier_name = $_POST["supplier"];
    $discription = $_POST["txtContent"];
    $group = $_POST["group"];
    $image = "../public/image/drug/" . basename($_FILES["fileToUpload"]["name"]);

    include '../database/dbconnect.php';


    if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM drug WHERE medicine_name ='$brand_name'"))) {
        echo '<script language="javascript">';
        echo 'alert("Stock is already added")';
        echo '</script>';
    } elseif (!mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM supplier WHERE company_name ='$supplier_name'"))) {
        echo '<script language="javascript">';
        echo 'alert("Supplier is not found")';
        echo '</script>';
    } elseif (!mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM category WHERE category_name ='$category'"))) {
        echo '<script language="javascript">';
        echo 'alert("Category is not found")';
        echo '</script>';
    } else {
        $q = "select supplier_ID from supplier where company_name='$supplier_name'";
        $result = mysqli_query($mysqli, $q) or die(mysqli_error($mysqli));
        $row = mysqli_fetch_array($result);

        $supplier_id = $row[0];




        //specifies the directory where the file is going to be placed
        $target_dir = "../public/image/drug/";


        //specifies the path of the file to be uploaded
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        //check whether the file already exists in the "uploads" folder.
        $uploadOk = 1;


        //holds the file extension of the file
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // check a file to upload is selected or not
        if (empty($_FILES["fileToUpload"]["name"])) {
            $query = "INSERT INTO drug
            (medicine_name,generic_name,type,category,supplier_id,discription,group_name)
             VALUES
             ('$brand_name','$generic_name','$type','$category','$supplier_id','$discription','$group')";
            mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
            echo '<script language="javascript">';
            echo 'alert("Medicine is added successfully")';
            echo '</script>';
        }

        //check the file is already exist or no
        // Check file size
        // Allow certain file cairo_format_stride_for_width(format, width)
        // Check if $uploadOk is set to 0 by an error
        // if everything is ok, try to upload file

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO drug
            (medicine_name,generic_name,type,category,supplier_id,discription,image,group_name)
             VALUES
             ('$brand_name','$generic_name','$type','$category','$supplier_id','$discription','$image','$group')";
            mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

//            $q = "SELECT id FROM drug WHERE medicine_name ='$brand_name'";
//            $result = mysqli_query($mysqli, $q) or die(mysqli_error($mysqli));
//            $rowy = mysqli_fetch_array($result);
//
//            $idm = $rowy[0];
            if (isset($_POST['dcount'])) {
                $x = $_POST['dcount'];
                for ($i = 1; $i <= $x; $i++) {
                    $d = "dosage" . $i;
                    $p = "price" . $i;

                    if (!empty($_POST[$d])) {


                        $dosa = $_POST[$d];
                        $pri = $_POST[$p];
                        $queryd = "INSERT INTO drug_price
            (medicine_name,dosage,price)
             VALUES
             ('$brand_name','$dosa','$pri')";
                        mysqli_query($mysqli, $queryd) or die(mysqli_error($mysqli));
                    }
                }
            }
            mysqli_close($mysqli);
            echo '<script language="javascript">';
            echo 'alert("Medicine is added successfully")';
            echo '</script>';
        }
//        else {
//            $message = "Sorry, there was an error uploading your file.";
//            echo "<script type='text/javascript'>alert('$message');</script>";
//            // echo "Sorry, there was an error uploading your file.";
//        }
    }
}
include './MedicineTemplate.php';
?>
<script>
    $(document).ready(function() {
        $('#supplier').keyup(function() {
            var query = $(this).val();
            if (query != '')
            {
                $.ajax({
                    url: "supplierSearch.php",
                    method: "POST",
                    data: {query: query},
                    success: function(data)
                    {
                        $('#supplierList').fadeIn();
                        $('#supplierList').html(data);
                    }
                });
            }
        });
        $(document).on('click', '#lisup', function() {
            $('#supplier').val($(this).text());
            $('#supplierList').fadeOut();


        });
    });

    $(document).ready(function() {
        $('#category').keyup(function() {
            var query = $(this).val();
            if (query != '')
            {
                $.ajax({
                    url: "categorySearch.php",
                    method: "POST",
                    data: {query: query},
                    success: function(data)
                    {
                        $('#categoryList').fadeIn();
                        $('#categoryList').html(data);

                    }
                });
            }
        });
        $(document).on('click', '#licat', function() {
            $('#category').val($(this).text());
            $('#categoryList').fadeOut();

        });
    });

    $(document).ready(function() {
        $('#dcount').keyup(function() {
            var no = $(this).val();

            var table = document.getElementById("data_table");
            var i = 0;

            if (no != '')
            {
                $('#data_table').show();
                for (i = 1; i <= no; i++) {

                    var row = table.insertRow(1).outerHTML =
                            "<tr id='row" + i + "'>\n\
                            <td id='name_row" + i + "'><input type='text' name=dosage" + i + "></td>\n\
                            <td id='country_row" + i + "'><input type='text' name=price" + i + "></td>\n\
             </tr>";
                }
            }
            else {
                var len = (table.rows.length);

                for (i = 1; i < len; i++) {
                    document.getElementById("data_table").deleteRow(1);

                }
                $('#data_table').hide();
            }


        });

    });

</script>


