
<?php
require 'orderController.php';
$title = "Customer orders";
//create instencr orderController of orderController
$orderController = new orderController();
//if order is select to confirm,then set it status to confirmed
if (isset($_GET["confirmed"])) {
    $orderController->removeOrder($_GET["confirmed"]);
    $orderTable = $orderController->orderConfirmTable("confirmed");
    $content = "<div style='float:left'>
            <h2 style='text-align:center; position:relative; left:100px;'>Confirmed orders List</h2>
            <table style='position:relative; left:30px;'>
                <tr>
                    <td><div style=' font-size: 1.25em;'>Email</div></td>
                    <td>
                        <div class='container-1'>
                            <span class='icon'><i class='fa fa-search'></i></span>
                            <input type='text' name='email' id='email' placeholder='search' oninput='loadcustomers()'/>
                    </td>

                <tr>
            </table>
            <div id='List' style='position:relative; left:120px; top:40px;'>$orderTable</div> 
        </div>";
//send the sms
} else if (isset($_GET["smsemail"])) {
    $msg = "your order is ready.Order number is: " . $_GET['orderNo'];
    $orderController->sendSms($_GET["smsemail"], $msg);
    $orderTable = $orderController->orderConfirmTable("confirmed");
    $content = "<div style='float:left'>
            <h2 style='text-align:center; position:relative; left:100px;'>Confirmed orders List</h2>
            <table style='position:relative; left:30px;'>
                <tr>
                    <td><div style=' font-size: 1.25em;'>Email</div></td>
                    <td>
                        <div class='container-1'>
                            <span class='icon'><i class='fa fa-search'></i></span>
                            <input type='text' name='email' id='email' placeholder='search' oninput='loadcustomers()'/>
                    </td>
                <tr>
            </table>
            <div id='List' style='position:relative; left:120px; top:40px;'>$orderTable</div> 
        </div>";
}
//else list the confirmed order list
else {
    $orderTable = $orderController->orderConfirmTable("confirmed");
    $content = "
        <div style='float:left'>
            <h2 style='text-align:center; position:relative; left:100px;'>Confirmed orders List</h2>
            <table style='position:relative; left:30px;'>
                <tr>
                    <td><div style=' font-size: 1.25em;'>Email</div></td>
                    <td>
                        <div class='container-1'>
                            <span class='icon'><i class='fa fa-search'></i></span>
                            <input type='text' name='email' id='email' placeholder='search' oninput='loadcustomers()'/>
                    </td>
                <tr>
            </table>
            <div id='List' style='position:relative; left:120px; top:40px;'>$orderTable</div> 
        </div>";
}
include 'template.php';
?>
