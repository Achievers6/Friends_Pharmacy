
<!--Header content goes here-->
<style>

    #menu{
        display: block;
        text-decoration: none;
        color: white;
    }
</style>
<div class="nav">
    <div class="logo">
        <img  src="../public/image/logo_white.png" class="logo">  
        <script src="../public/js/application.js"></script>
    </div>

    <ul class="mainmenu">
        <li><span><a href="../main/main.php" id="menu">Home</a></span></li>
        
        <li><span><a href="../customer/cust_bill.php" id="menu">Bill</a></span></li>
        
         <li><span><a href="#" id="menu">New Medicine</a></span><div class="messages"></div></li>
        <ul class="submenu">

            <li><span><a href="../pharmacist/AddMedicine.php">Add medicine </a></span></li>
            <li><span><a href="../pharmacist/searchMedicine.php">Update medicine</a></span></li>
            <li><span><a href="../pharmacist/delete.php">Delete medicine</a></span></li>
        </ul>

        <li><span><a href="#" id="menu">Manage Stock</a></span></li>
        <ul class="submenu">

            <li><span><a href="../pharmacist/AddStock.php">Add stock</a></span></li>
            <li><span><a href="../pharmacist/updateStock1.php">Update stock</a></span></li>
            <li><span><a href="../pharmacist/removeStock.php">Delete stock</a></span></li>
            <li><span><a href="../pharmacist/viewStock.php">View stock</a></span></li>
            <li><span><a href="../pharmacist/viewusage.php">View stock usage</a></span></li>
        </ul>

        <li><span><a href="#" id="menu">Customer</a></span></li>
        <ul class="submenu">

            <li><span><a href="../customer/addcustomer1.php">Add customer</a></span></li>
            <li><span><a href="../customer/updatecustomer.php">Update customer</a></span></li>
            <li><span><a href="../customer/inactive.php">Delete customer</a></span></li>
            <li><span><a href="../customer/customerdetails.php">View customer</a></span></li>
            <li><span><a href="../customer/reminder.php">Reminders</a></span></li>
        </ul>


        <li><span><a href="#" id="menu">Supplier</a></span></li>
        <ul class="submenu">

            <li><span><a href="../supplier/addsupplier.php">Add supplier</a></span></li>
            <li><span><a href="../supplier/updatesupplier.php">Update supplier</a></span></li>
            <li><span><a href="../supplier/deletesupplier.php">Delete supplier</a></span></li>
            <li><span><a href="../supplier/viewsupplier.php">View supplier</a></span></li>
        </ul>

        <li><span><a href="#" id="menu">Report</a></span></li>
        <ul class="submenu">
            <li><span><a href="../dailly/p.php">Daily Report</a></span></li>
            <li><span><a href="../medicine/sales.php">Sales of each Medicine</a></span></li>
            <li><span><a href="../cashier/b.php">Cashier Wise Report</a></span></li>

        </ul>
        <li><span><a href="#" id="menu">Reminder</a></span></li>
        <ul class="submenu">
            <li><span><a href="../pharmacist/reminder1.php">Add Reminder</a></span></li>
            <li><span><a href="../pharmacist/sms.php">Message</a></span></li>
        </ul> 
        <li><span><a href="#" id="menu">Web Customer Orders</a></span></li>
        <ul class="submenu">
            <li><span><a href="../pharmacist/cust_orders.php">New Orders</a></span></li>
            <li><span><a href="../pharmacist/confiredOrder.php">Confirmed Orders</a></span></li>
            
        </ul>
    </ul>
</div>



