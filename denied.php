<!DOCTYPE html>
<html>
<head>
	<title>403 Forbidden</title>
</head>
<body style="margin-left: 2%; margin-right: 2%;">

<h1>Forbidden</h1>

<p style="font-size: 20px;">You don't have permission to access / on this server</p>
<hr>

<?php 

$server = $_SERVER['SERVER_SOFTWARE'];
$port = $_SERVER['SERVER_PORT'];

echo "$server" . " at friendspharmacy.com " . " port " . "$port";

?>
<br><br><br>
<button style="padding: 8px; cursor: pointer; background-color: #8adb43; color: white; border-color: white;"><b>Sign In</b></button>

</body>
</html>


