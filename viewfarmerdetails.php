<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Farmer details</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
		include('connector.php');
		$sql=	"SELECT * FROM farmer";
		$result = mysqli_query($conn,$sql);

		echo "<table border='1' size='200'>
		<tr>
		<th>Farmer ID</th>
		<th>Farmer Name</th>
		<th>Password</th>
		</tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['farmer_id']  . "</td>";
			echo "<td>" . $row['farmer_name'] . "</td>";
			echo "<td>" . $row['Password']  . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	 ?>
	</div>
</body>
</html>