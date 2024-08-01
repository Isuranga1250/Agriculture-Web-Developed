<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Booking Services</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
		include('connector.php');
		$sql=	"SELECT * FROM servicebooking WHERE Status IN ('confirmed','declined')";
		$result = mysqli_query($conn,$sql);

		echo "<table>
		<tr>
		<th>Booking ID</th>
		<th>Farmer ID</th>
		<th>Service ID</th>
		<th>Service Starting Time</th>
		<th>Service Booking Date</th>
		<th>Service Location</th>
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
</div>
</body>
</html>