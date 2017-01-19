<?php

$host = "localhost";
$user = "root";
$passwd = "";
$database = "friends_pharmacy";
//create connection
$mysqli=mysqli_connect($host, $user, $passwd, $database) or die(mysqli_error());

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>