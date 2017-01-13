<?php

require 'presController.php';
$title = "Customer orders";
$presController = new presController();

if (isset($_GET["id"])) {
    $newPresView = $presController->newPresView($_GET["id"]);
    $content = $newPresView;
} else {
    $newPresTable = $presController->newPresTable();
    $content = $newPresTable;
}
include 'template.php';	
?>
