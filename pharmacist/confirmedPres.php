<?php

require 'presController.php';
$title = "Prescription orders";
$presController = new presController();


if (isset($_GET["pres_no"])) {

    $presListTable = $presController->presListTable($_GET["pres_no"]);

    $content = $presListTable . "<a href='confirmedPres.php'><img  class='confirm' src='../public/image/back.png' style='width: 100px;; height: 35px; position: relative; right:-129px; top:80px;'></a>";
} else if (isset($_GET["del"])) {
    $presController->reject($_GET["del"]);
    $conPresTable = $presController->conPresTable();
    $content = $conPresTable;
} else if (isset($_GET["smsemail"])) {
    $msg = "your prescription order is ready. prescription order number is: " . $_GET['presNo'];
    $presController->sendSms($_GET["smsemail"],$msg);
    $conPresTable = $presController->conPresTable();
    $content = $conPresTable;
} else {
    $conPresTable = $presController->conPresTable();
    $content = $conPresTable;
}
include 'template.php';
?>
