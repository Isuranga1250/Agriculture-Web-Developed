<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass='';
$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
if(!$conn){
	die('could not connect : '.mysqli_error($conn));
}
$db = mysqli_select_db($conn,'organic_food_product');
if(!$db){
	echo 'Selcet database first';
}
?>
<body>
</body>
</html>