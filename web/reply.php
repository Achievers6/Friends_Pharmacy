<?php

	//$conn = mysqli_connect('localhost', 'root', '', 'friends_pharmacy') or die(mysqli_error());
	include '../database/dbconnect.php';
	$post_id = $_POST['post_id'];
	$reply = $_POST['reply'];
	$day = date("Y-m-d");

	$reply_query = mysqli_query($mysqli, "INSERT INTO reply (comment_id, reply, day) VALUES('$post_id', '$reply', '$day')");

?>