<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Service Status</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
	session_start();
	$FarmerID=$_SESSION['farmer_id'];
	include('connector.php');
		$sql=	"SELECT * FROM servicebooking WHERE farmer_id='$FarmerID'";
		$result = mysqli_query($conn,$sql);

		echo "<table border='1' size='200'>
		<tr>
		<th>Booking ID</th>
		<th>Farmer ID</th>
		<th>Service ID</th>
		<th>Starting Time</th>
		<th>Service Performed Date</th>
		<th>Location</th>
		<th>Status</th>
		</tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['BID'] . "</td>";
			echo "<td>" . $row['farmer_id']  . "</td>";
			echo "<td>" . $row['SID'] . "</td>";
			echo "<td>" . $row['starting_time']  . "</td>";
			echo "<td>" . $row['bookingdate'] . "</td>";
			echo "<td>" . $row['location']  . "</td>";
			echo "<td>" . $row['Status']  . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	?>
</body>
</html>