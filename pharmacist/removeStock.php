<script>
function searchForm() {
    var x = document.forms["myForm"]["txtMedicinedName"].value;
   
    if (x == null || x == "") {
        alert("Medicine name must be filled out");
        return false;
    }
}

</script>
<?php

$title = "Remove Stock";

$content="
    <h2 style='text-align:center;'>Remove Stock</h2>
    <form action='removeStock2.php' method ='post' onsubmit='return searchForm()'  name='myForm'>
    
      <fieldset>
        <label class='lblf' for='medicineName'>Medicine name: </label>
        <input type ='text' id='medicine' class='drugBox' name='txtMedicinedName' autocomplete='off' />
        <div id='medicineList'style='position: fixed;'></div> 
        
        <p></p>
        <input type='submit' name = 'btnView' value='View' >
      </fieldset>
</form> 
";

include 'template.php';
?>
