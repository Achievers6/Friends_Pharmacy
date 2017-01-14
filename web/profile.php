<!DOCTYPE html>
<html>
    <head>
        <title>My Account</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../public/css/web/profileStyle.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <?php
        session_start();
//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysql_error());
        include '../database/dbconnect.php';

        $email = $_SESSION['email'];
        $view_query = mysqli_query($mysqli, "SELECT * FROM customer WHERE email='$email'");
        $numrows = mysqli_num_rows($view_query);

        if ($numrows == 1) {
            while ($row = mysqli_fetch_array($view_query)) {
                $nic = $row['nic'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $email = $row['email'];
                $contact_number = $row['contact_number'];
            }
        } else {
            echo'<script>alert("Error loading profile."); window.location.href="index.php";</script>';
        }
        ?>
        <?php require '../includes/customer_header.php'; ?>

        <div class="profile">
            <h2 style="text-align: center; margin-bottom: -2px;"><?php echo $first_name ?> <?php echo $last_name ?> </h2>
            <i style="margin-left: 560px;"><?php echo $email ?></i>
            <hr style="margin-bottom: 3%; width: 1000px;">

            <form action="" method="POST">
                <label>NIC</label> <input style="margin-left: 5%;" type="text" name="nic" value="<?php echo $nic ?>" readonly ><br>
                <label>First Name</label> <input type="text" name="fname" value="<?php echo $first_name ?>"><br>
                <label>Last Name</label> <input style="margin-left: 2px;" type="text" name="lname" value="<?php echo $last_name; ?>"><br>
                <label>Email</label> <input style="margin-left: 34px;" type="email" name="email" value="<?php echo $email; ?>"><br>
                <label>Contact Number</label> <input style="margin-left: -4%;" type="text" name="contact" value="<?php echo $contact_number; ?>"><br><br>
                <input type="submit" name="submit" value="Save Changes" class="btn">
            </form>
        </div>


<?php
if (isset($_POST['submit'])) {
    //$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysql_error());
    include '../database/dbconnect.php';
    $nicN = $_POST['nic'];
    $first_nameN = $_POST['fname'];
    $last_nameN = $_POST['lname'];
    $emailN = $_POST['email'];
    $contact_numberN = $_POST['contact'];

    $update_query = "UPDATE customer SET nic='$nicN', first_name='$first_nameN', last_name='$last_nameN', email='$emailN', contact_number='$contact_numberN' WHERE nic='$nic'";

    if (mysqli_query($mysqli, $update_query)) {
        echo'<script>alert("Changes are saved successfully"); window.location.href="profile.php";</script>';
    } else {
        echo '<script>alert("Error updating your details");window.location.href="profile.php";</script>';
    }
}
?>
        <?php require '../includes/customer_footer.php'; ?>
    </body>
</html>
