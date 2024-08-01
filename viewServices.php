<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Services</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
		include('connector.php');
		$sql="SELECT * FROM services ";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0){
			echo"<script> alert('Error');window.location='viewServices.php';</script>";
		}
		else{
			echo "<table border='1' size='200'>
			<tr>
			<th>Service ID</th>
			<th>Service Name</th>
			<th>Category</th>
			<th>Duration</th>
			<th>Starting Time</th>
			<th>Date</th>
			<th>Location</th>
			<th>Description</th>
			<th>Image Name</th>
			</tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>" . $row['SID'] . "</td>";
				echo "<td>" . $row['SName']  . "</td>";
				echo "<td>" . $row['Category'] . "</td>";
				echo "<td>" . $row['duration']  . "</td>";
				echo "<td>" . $row['starting_time']  . "</td>";
				echo "<td>" . $row['date']  . "</td>";
				echo "<td>" . $row['location']  . "</td>";
				echo "<td>" . $row['Description'] . "</td>";
				echo "<td>" . $row['Img']  . "</td>";
			}

			echo "</tr>";
			echo "</table>";
		}
	?>
	</div>
</body>
</html>