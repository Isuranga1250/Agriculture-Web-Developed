<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Bookings</title>
<link rel="stylesheet" href="css/tables.css">
<script>
function showAlert(message) {
    alert(message);
}
</script>
</head>
<body>
	<?php
		include('connector.php');

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$BID = $_POST['BID'];
			$status = "";
			$alertMessage = "";

			if (isset($_POST['confirm'])) {
				$status = 'confirmed';
				$alertMessage = "Booking with ID $BID was confirmed.";
			} else if (isset($_POST['decline'])) {
				$status = 'declined';
				$alertMessage = "Booking with ID $BID was declined.";
			}

			if ($status !== "") {
				$sql = "UPDATE servicebooking SET Status='$status' WHERE BID='$BID'";
				if (mysqli_query($conn, $sql)) {
					echo "<script>showAlert('$alertMessage');</script>";
				} else {
					echo "Error updating record: " . mysqli_error($conn);
				}
			}
		}

		$sql = "SELECT * FROM servicebooking WHERE Status ='pending'";
		$result = mysqli_query($conn, $sql);

		echo "<div class='menu-box'>";
		echo "<table border='1' size='200'>
		<tr>
		<th>Booking ID</th>
		<th>Farmer ID</th>
		<th>Service ID</th>
		<th>Service Starting Time</th>
		<th>Service Booking Date</th>
		<th>Service Location</th>
		<th>Status</th>
		<th>Action</th>
		</tr>";

		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['BID'] . "</td>";
			echo "<td>" . $row['farmer_id'] . "</td>";
			echo "<td>" . $row['SID'] . "</td>";
			echo "<td>" . $row['starting_time'] . "</td>";
			echo "<td>" . $row['bookingdate'] . "</td>";
			echo "<td>" . $row['location'] . "</td>";
			echo "<td>" . $row['Status'] . "</td>";
			echo "<td>";
			echo "<form method='post'>
				  <input type='hidden' name='BID' value='" . $row['BID'] . "'>
				  <input type='submit' class='btndel' name='confirm' value='confirm'>
				  <input type='submit' class='btndel' name='decline' value='decline'>
			      </form>";
			echo "</td>";
			echo "</tr>";
		}

		echo "</table>";
		echo "</div>";
		mysqli_close($conn);
	?>
</body>
</html>
