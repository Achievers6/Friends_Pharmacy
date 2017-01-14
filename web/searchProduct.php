<?php

include '../database/dbconnect.php';
include ("../Entities/drugEntity.php");
include ("../Entities/stockEntity.php");
include 'drugcon.php';
if (isset($_POST["query"])) {

    $query = "SELECT * FROM drug where medicine_name LIKE '" . $_POST["query"] . "%'";

    $drugArray = array();
    $result = "";

    $resultx = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($resultx)) {


        $id = $row[0];
        $medicine_name = $row[1];
        $generic_name = $row[2];
        $type = $row[3];
        $category = $row[4];
        $supplier_id = $row[5];
        $discription = $row[6];
        $image = $row[7];
        $group_name = $row[8];


        $drug = new drugEntity($id, $medicine_name, $generic_name, $type, $category, $supplier_id, $discription, $image, $group_name);
        array_push($drugArray, $drug);
    }

    foreach ($drugArray as $key => $drug) {

        $result = "<table class = 'drugTable'>
        <tr>

            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$drug->image' /></th>

            <th width = '75px' >Brand: </th>
            <td>$drug->medicine_name</td>
        </tr>

        <tr>
            <th>Generic: </th>
            <td>$drug->generic_name</td>
        </tr>

        <tr>
            <th>Group: </th>
            <td>$drug->group_name</td>
        </tr>

        <tr>
            <th>Type: </th>
            <td>$drug->type</td>
        </tr>

        <tr>
            <th>Category: </th>
            <td>$drug->category</td>
        </tr>

        <tr>
            <td colspan='2' >$drug->discription </td>
        </tr>   
        </table>




    <a href='otc.php?id=$drug->id'>
        <img src='../public/image/addCart.png' style='width: 200px; height: 110px; position: relative; left: 570px; top:-40px;' >
    </a>";
        echo $result;
    }
}
?>




