<?php
$title = "";
$content = "<h2 style='text-align:center;'>Update Medicine</h2>
    <form action='SearchMedicine2.php' method ='post'>
    
      <fieldset>
        <label for='Search' style='font-size:20px;'>Search: </label>
        <input type ='text' id='medicine' class='drugBox' name ='txtMedicineID' autocomplete='off' required>
        <div id='medicineList'></div> 
        <p></p>
        <input type='submit' name = 'btnSearch' id='b' value='OK' ></span><br/> 
      
      </fieldset>
</form> ";

if (isset($_POST['btnSearch'])) {

    $medicine_id = $_POST["txtMedicineID"];
    include '../database/dbconnect.php';

    if (!mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM drug WHERE medicine_name ='$medicine_id'"))) {
        echo '<script language="javascript">';
        echo 'alert("Medicine is not found")';
        echo '</script>';
    } else {



        $query = "SELECT * FROM drug WHERE medicine_name LIKE '$medicine_id'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        $row = mysqli_fetch_array($result);
        mysqli_close($mysqli);

        $medicine_id = $row[0];
        $brand_name = $row[1];
        $generic_name = $row[2];
        $type = $row[3];
        $category = $row[4];
        $supplier_id = $row[5];
        $discription = $row[6];
        $group = $row[8];
        $image = $row[7];

        $content = "<h2 style='text-align:center;'>Update Medicine</h2>
    <form action='searchMedicine.php?id=$medicine_id' method ='post' enctype='multipart/form-data'>
    
      <fieldset>
        <label for='medicine Name'>Medicine Name: </label>
        <input type ='text' class='inputField' name ='txtBrandName' autocomplete='off'  value='$brand_name'><br/>
	<p></p>
        <label for='name'>Generic Name: </label>
	<input type='text' class='inputField' name='txtGenericName' autocomplete='off'  value='$generic_name'/><br/>
        <p></p>
        <label for='Type'>Type: </label>
        <select class = 'type' name='types'>
          <option value='$type'>$type</option>
          <option value='Tablets'>Tablets</option>
          <option value='Capsules'>Capsules</option>
          <option value='liquid'>liquid</option>
        </select></br>
        <p></p>
        
        
        <label for='Category'>Category: </label>
        <input type='text' class='inputField' name='category' autocomplete='off'  value='$category'/><br/>
        <p></p>

        
        <label for='group'>Group: </label>
        <select class = 'type' name = 'groups'>
          <option value='$group'>$group</option>
          <option value='OC'>Over the counter drug</option>
          <option value='Two ii'>Two ii drug</option>
          <option value='Narcootics'>Narcootics</option>
        </select></br>
        <p></p>
                                
        <label for='Supplier'>Supplier: </label>
        <input type='text' class='inputField' name='suppliers' autocomplete='off'  value='$supplier_id'/><br/>
        <p></p>   

        <label for='content'>content: </label>
	<textarea cols='33' rows='12' name='txtContent'>$discription</textarea></br>
	<p></p>			
         
        <label for='image' >Add image: </label>
        <img src='$image'  style='width: 100px; height: 110px;>
        
       
        <label for='im ' ></label>
        <td><input type='file' name='fileToUpload' id='fileToUpload'></td>
        
        <p></p>
        
        <input type='submit' name = 'btnUpdate' value='update' ></span><br/> 
        </fieldset>
</form> ";
    }
}
if (isset($_GET["id"])) {

    $medicine_id = $_GET["id"];
    $brand_name = $_POST["txtBrandName"];
    $generic_name = $_POST["txtGenericName"];
    $type = $_POST["types"];
    $category = $_POST["category"];
    $supplier_id = $_POST["suppliers"];
    $discription = $_POST["txtContent"];
    $group = $_POST["groups"];
    $image = "../public/image/drug/" . basename($_FILES["fileToUpload"]["name"]);

    include '../database/dbconnect.php';


    if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM drug WHERE medicine_name ='$brand_name' AND id!=$medicine_id "))) {
        echo '<script language="javascript">';
        echo 'alert("Medicine name is exist")';
        echo '</script>';
    } else {

        if (empty($_FILES["fileToUpload"]["name"])) {
            $query = "UPDATE drug
            SET medicine_name='$brand_name', generic_name='$generic_name',type='$type',category='$category',supplier_id='$supplier_id',discription='$discription',group_name='$group'
            WHERE id='$medicine_id'";
            mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
            mysqli_close($mysqli);

            echo '<script language="javascript">';
            echo 'alert("Successfully empty image updated")';
            echo '</script>';
        } else {
            $target_dir = "../public/image/drug/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if ($_FILES["fileToUpload"]["size"] > 1000000) {
                $message = "Sorry, your file is too large.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                // echo "Sorry, your file is too large.<br>";
                $uploadOk = 0;
            }

            // Allow certain file cairo_format_stride_for_width(format, width)
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $message = "Sorry, your file was not uploaded.";
                echo "<script type='text/javascript'>alert('$message');</script>";

                // echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $query = "UPDATE drug
            SET medicine_name='$brand_name', generic_name='$generic_name',type='$type',category='$category',supplier_id='$supplier_id',discription='$discription',group_name='$group',image='$image'
            WHERE id='$medicine_id'";


                    mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
                    mysqli_close($mysqli);

                    //header("Location:searchMedicine.php");
                    echo '<script language="javascript">';
                    echo 'alert("Successfully updated")';
                    echo '</script>';
                } else {
                    $message = "Sorry, there was an error uploading your file.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    // echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
}

include './MedicineTemplate.php';
?>

<script>
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