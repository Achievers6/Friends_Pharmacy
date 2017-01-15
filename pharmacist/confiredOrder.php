
<?php
require 'orderController.php';
$title = "Customer orders";
$orderController = new orderController();

if (isset($_GET["confirmed"])) {
    $orderController->removeOrder($_GET["confirmed"]);
    $orderTable = $orderController->orderConfirmTable("confirmed");
    $content = "<div style='float:left'>
        <h2 style='text-align:center; position:relative; left:100px;'>Confirmed orders List<h2>
        <table style='position:relative; left:30px;'>
        <tr>
            <td><div style=' font-size: 1.25em;'>Email</div></td>
            <td>
            <div class='container-1'>
            <span class='icon'><i class='fa fa-search'></i></span>
            <input type='text' name='email' id='email' placeholder='search' oninput='loadcustomers()'/>
            </td>
            </div>
            <tr>
            </table>
            <div id='List' style='position:relative; left:120px; top:40px;'>$orderTable</div> 
            </div>";
} 
else if(isset($_GET["smsemail"])) {
    $msg = "your order is ready.Order number is: ".$_GET['orderNo'];
    $orderController->sendSms($_GET["smsemail"],$msg);
    $orderTable = $orderController->orderConfirmTable("confirmed");
    $content = "<div style='float:left'>
        <h2 style='text-align:center; position:relative; left:100px;'>Confirmed orders List<h2>
        <table style='position:relative; left:30px;'>
        <tr>
            <td><div style=' font-size: 1.25em;'>Email</div></td>
            <td>
            <div class='container-1'>
            <span class='icon'><i class='fa fa-search'></i></span>
            <input type='text' name='email' id='email' placeholder='search' oninput='loadcustomers()'/>
            </td>
            </div>
            <tr>
            </table>
            <div id='List' style='position:relative; left:120px; top:40px;'>$orderTable</div> 
            </div>";
}
else {
    $orderTable = $orderController->orderConfirmTable("confirmed");
    $content = "<div style='float:left'>
        <h2 style='text-align:center; position:relative; left:100px;'>Confirmed orders List<h2>
        <table style='position:relative; left:30px;'>
        <tr>
            <td><div style=' font-size: 1.25em;'>Email</div></td>
            <td>
            <div class='container-1'>
            <span class='icon'><i class='fa fa-search'></i></span>
            <input type='text' name='email' id='email' placeholder='search' oninput='loadcustomers()'/>
            </td>
            </div>
            <tr>
            </table>
            <div id='List' style='position:relative; left:120px; top:40px;'>$orderTable</div> 
            </div>";
}
include 'template.php';
?>
<script>
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

</script>