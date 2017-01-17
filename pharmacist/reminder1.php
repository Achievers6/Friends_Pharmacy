<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php require("../includes/_header.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/reminder.css" />
        <title>Reminders</title>
        <style>
            #medicineList {
                background-color: white;
                width: 280px;
                position: relative;
                left: 160px;
                top: -15px;
                list-style: none;

            }
        </style>
        <script>
            $(document).ready(function() {
                $("#ch1").click(function() {
                    $(".weekdays").hide();
                    $(".day").toggle();
                });
                $("#ch2").click(function() {
                    $(".day").hide();
                    $(".weekdays").toggle();
                });
                $("#t1").click(function() {
                    $(".ts1").toggle();

                });

                $("#t2").click(function() {
                    $(".ts1").toggle();
                    $(".ts2").toggle();

                });
                $("#t3").click(function() {
                    $(".ts1").toggle();
                    $(".ts2").toggle();
                    $(".ts3").toggle();
                });

            });
            $(document).ready(function() {
                $('#txtmedname').keyup(function() {
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
                    $('#txtmedname').val($(this).text());
                    $('#medicineList').fadeOut();


                });
            });

            $(document).ready(function() {
                $('#nic').keyup(function() {
                    var query = $(this).val();
                    if (query != '')
                    {
                        $.ajax({
                            url: "searchnic.php",
                            method: "POST",
                            data: {query: query},
                            success: function(data)
                            {
                                $('#nicList').fadeIn();
                                $('#nicList').html(data);
                            }
                        });
                    }
                });
                $(document).on('click', '#lin', function() {
                    $('#nic').val($(this).text());
                    $('#nicList').fadeOut();


                });
            });


        </script>
    </head>
    <body>
        <?php require_once("../includes/navigation.php") ?>
        <div class="customer_template_container" style=" padding-left:13px; padding-top:70px;">
            <h2 style="text-align:center;">Reminders</h2>
            <form name="myForm" action="#" method ="post">
                <fieldset>
                    <label>Medicine Name: </label>
                    <input type="text" class="inputField" name="txtmedname" id='txtmedname' autocomplete="off" placeholder="Ex: Amoxil"/><br/>
                    <div id='medicineList'></div> 
                    <p></p>
                    <label>Customer NIC: </label>
                    <input type="text" class="inputField" name="txtnic" id="nic" class="nic" autocomplete="off" placeholder="Ex: XXXXXXXXXV"/><br/>
                    <div id='nicList'></div> 
                    <p></p>
                    <label>Contact number: </label>
                    <input type="text" class="inputField" name="txtcontact" autocomplete="off" placeholder="Ex: 071XXXXXXX"/><br/>
                    <p></p>
                    <label>Instruction: </label>
                    <select class = "type" name="ins">
                        <option value="Take before meal">Take before meal</option>
                        <option value="Take after meal">Take after meal</option>
                        <option value="Take during meal">Take during meal</option>
                        <option value="Take on an empty stomach">Take on an empty stomach</option>
                        <option value="Take with milk">Take with milk</option>
                    </select></br>
                    <p></p>
                    <label>Quantity: </label>
                    <input type="number" class="inputField" name="qty" autocomplete="off"/><br/>
                    <p></p>
                    <label >Schedule type: </label><br>
                    <input type="checkbox" name="daybox" id="ch1" value="Every Days"> Every Days<br>
                    <input type="checkbox" name="weekdaybox" id="ch2" value="Every Weekdays"> Every Weekdays
                    <p></p>
                    <div class="day">
                        <label>Frequency: </label>
                        <select class = "type" name="frq">
                            <option value="1">Every 1 day</option>
                            <option value="2">Every 2 day</option>
                            <option value="3">Every 3 day</option>
                            <option value="4">Every 4 day</option>
                            <option value="5">Every 5 day</option>
                            <option value="1">Every 6 day</option>
                            <option value="2">Every 7 day</option>
                            <option value="3">Every 14 day</option>
                            <option value="4">Every 21 day</option>
                            <option value="5">Every 30 day</option>
                            <option value="5">Every 60 day</option>
                        </select></br>
                        <div class="timeselect">
                            <input type="checkbox"  name="time1" value="time1" id="t1" />One time <br>
                            <input type="checkbox"  name="time2" value="time2"id="t2"/>Two times <br>
                            <input type="checkbox"  name="time3" value="time3" id="t3"/>Three times <br>
                            <p></p>
                        </div>
                        <table>

                            <tr>

                                <td><label>Time(24 hour):</label><td>
                            </tr>
                            <tr>   
                                <td></td>
                                <td><div class="ts1">
                                        hours<select id="time1" name="daytime1">
                                            <option value="0">00</option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                        </select>
                                    </div></td>
                                <td><div class="ts1">
                                        minutes:<input type="number" min="0" max="60" name="min1"  />
                                    </div></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><div class="ts2">
                                        hours<select id="time2" name="daytime2">
                                            <option value="0">00</option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                        </select>
                                    </div></td>
                                <td><div class="ts2">
                                        minutes:<input type="number" min="0" max="60" name="min2"  />
                                    </div></td>
                            </tr>
                            <tr>
                                <th></th>    
                                <td><div class="ts3">
                                        hours<select id="time3" name="daytime3">
                                            <option value="0">00</option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                        </select><br>
                                    </div></td>
                                <td><div class="ts3">
                                        minutes:<input type="number" min="0" max="60" name="min3"  />
                                    </div></td>
                            </tr>
                        </table>
                        <p></p>
                    </div>
                    <div class="weekdays">
                        <label>Week Days: </label>
                        <input type="checkbox"  name="monday" value="monday" />MONDAY <br />
                        <input type="checkbox"  name="tuesday" value="tuesday" />TUESAY <br />
                        <input type="checkbox"  name="wednesday" value="wednesday" />WEDNESDAY <br />
                        <div class='ch1'>
                            <input type="checkbox"  name="thursday" value="thursday" />THURSDAY <br />
                            <input type="checkbox"  name="friday" value="friday" />FRIDAY <br />
                            <input type="checkbox"  name="saturday" value="saturday" />SATURDAY <br />
                            <input type="checkbox"  name="sunday" value="sunday" />SUNDAY <br />
                        </div>
                        <p></p>
                        <table>
                            <tr>
                                <td style="position: relative; right:5px; widtd: 200px;"><label>time(24 hour):</label></td>
                                <td style="position: relative; right:5px;">hour:</td>

                            <div class="ts1">
                                <td style="position: relative; right:5px;">
                                    <select id="time" name="weektime" >
                                        <option value="0">00</option>
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                    </select>
                            </div></td>
                            <td style="position: relative; left:25px;">minutes</td>
                            <td style="position: relative; left:25px;"><input type="number" min="0" max="60" name="min"  /></td>
                            </tr>
                        </table> 

                        <p></p>
                        <label>Start Date: </label>
                        <input type="date" id="entryDate" class="inputField" name="startdate"  /><br/>
                        <p></p>
                        <label>End Date: </label>
                        <input type="date" id="entryDate" class="inputField" name="enddate" /><br/>

                    </div>

                    <input type='submit' name = 'btnsubmitrem'><br/> 
                </fieldset>
            </form>
        </div>		
        <?php require_once("../includes/_footer.php") ?>
    </body>
</html>
<?php
if (isset($_POST['btnsubmitrem'])) {
    include '../database/dbconnect.php';
    $nic = $_POST["txtnic"];
    $contactno = $_POST["txtcontact"];
    $medname = $_POST["txtmedname"];
    $instruction = $_POST["ins"];
    $quantity = $_POST["qty"];
    $startdate = $_POST["startdate"];
    $time1 = 100;
    $time2 = 100;
    $time3 = 100;
    $min1 = 100;
    $min2 = 100;
    $min3 = 100;
    if (!(mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM drug WHERE medicine_name ='$medname'")))) {
        echo '<script language="javascript">';
        echo 'alert(" please enter valid medicine name")';
        echo '</script>';
    } else if (!(mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM customer WHERE nic ='$nic'")))) {
        echo '<script language="javascript">';
        echo 'alert(" please enter valid NIC")';
        echo '</script>';
    } 
    else if (!isset($_POST["txtcontact"]) or strlen($contactno) != 10) {
        echo '<script language="javascript">';
        echo 'alert(" please enter valid contact number")';
        echo '</script>';
    }else if ($quantity==NULL) {
        echo '<script language="javascript">';
        echo 'alert(" please enter valid quantity")';
        echo '</script>';
    } else {


        if (isset($_POST["daybox"])) {

            if (isset($_POST["time1"])) {
                $time1 = $_POST["daytime1"];
                $min1 = $_POST["min1"];
            }
            if (isset($_POST["time2"])) {
                $time1 = $_POST["daytime1"];
                $time2 = $_POST["daytime2"];
                $min1 = $_POST["min1"];
                $min2 = $_POST["min2"];
            }
            if (isset($_POST["time3"])) {
                $time1 = $_POST["daytime1"];
                $time2 = $_POST["daytime2"];
                $time3 = $_POST["daytime3"];
                $min1 = $_POST["min1"];
                $min2 = $_POST["min2"];
                $min3 = $_POST["min3"];
            }

            $dayadd = $_POST["frq"];


            $query = "INSERT INTO reminderday
            (nic, contactno,medname, instruction, quantity, time1,time2,time3, startdate, enddate,min1,min2,min3)
             VALUES
             ('$nic', '$contactno','$medname', '$instruction', '$quantity', '$time1','$time2','$time3', CURDATE(), CURDATE()+ $dayadd,'$min1','$min2','$min3')";


            if (mysqli_query($mysqli, $query)) {
                echo '<script language="javascript">';
                echo 'alert(" Day reminder is added Successfully")';
                echo '</script>';
            }
        } else {

            $time = $_POST["weektime"];
            $startdate = $_POST["startdate"];
            $enddate = $_POST["enddate"];
            $min = $_POST["min"];
            $Monday = 0;
            $Tuesday = 0;
            $Wednesday = 0;
            $Thursday = 0;
            $Friday = 0;
            $Satday = 0;
            $Sunday = 0;



            if (isset($_POST["monday"])) {
                $Monday = 1;
            }
            if (isset($_POST["tuesday"])) {
                $Tuesday = 1;
            }
            if (isset($_POST["wednesday"])) {
                $Wednesday = 1;
            }
            if (isset($_POST["thursday"])) {
                $Thursday = 1;
            }
            if (isset($_POST["friday"])) {
                $Friday = 1;
            }
            if (isset($_POST["satday"])) {
                $Satday = 1;
            }
            if (isset($_POST["sunday"])) {
                $Sunday = 1;
            }

            $query = "INSERT INTO reminderweekday
            (nic, contactno,medname, instruction, quantity,time,startdate,enddate,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,min)
             VALUES
             ('$nic', '$contactno','$medname', '$instruction', '$quantity','$time','$startdate','$enddate','$Monday','$Tuesday','$Wednesday','$Thursday','$Friday','$Satday','$Sunday',$min)";


            if (mysqli_query($mysqli, $query)) {
                echo '<script language="javascript">';
                echo 'alert(" week reminder is added Successfully")';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert(" please enter valid data")';
                echo '</script>';
            }
        }
    }



    mysqli_close($mysqli);
}
?>

