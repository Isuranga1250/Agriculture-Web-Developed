<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete bookings</title>
<link rel="stylesheet" href="css/tables.css">
<script>
function confirmDeletion(BID) {
    if (confirm('Are you sure you want to delete this record?')) {
        document.getElementById('deleteForm' + BID).submit();
    }
}
</script>
</head>

<body>
<div class="menu-box">
<form id="form1" name="form1" method="post">
  <p>
    <label>Enter Booking ID:</label>
    <input type="text" name="BID">
  </p>
  <p>
    <input class="btn" type="submit" name="search" value="search">
  </p>
</form>
	<?php
		include('connector.php');
		if(isset($_POST['search'])){
			$BID=$_POST['BID'];
			$sql="SELECT * FROM servicebooking WHERE BID='$BID' AND Status IN ('confirmed','declined')";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('Invalid search or pending booking');window.location='deleteServiceBooking.php';</script>";
			}
			else{
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
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['BID'] . "</td>";
					echo "<td>" . $row['farmer_id']  . "</td>";
					echo "<td>" . $row['SID'] . "</td>";
					echo "<td>" . $row['starting_time']  . "</td>";
					echo "<td>" . $row['bookingdate'] . "</td>";
					echo "<td>" . $row['location']  . "</td>";						
					echo "<td>" . $row['Status']  . "</td>";
					echo "<td>";
					echo "<form id='deleteForm" . $row['BID'] . "' method='post'>
						  <input type='hidden' name='BID' value='" . $row['BID'] . "'>
						  <input type='hidden' name='delete' value='1'>
						  <input class='btndel' type='button' value='delete' onclick='confirmDeletion(" . $row['BID'] . ")'>
						  </form>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	?>
	<?php
		if(isset($_POST['delete']) && $_POST['delete'] == '1'){
			$BID=$_POST['BID'];
			$sqldel="DELETE FROM servicebooking WHERE BID = '$BID'";
			$resultdel=mysqli_query($conn,$sqldel);
			if(!$resultdel){
				echo"<script> alert('Delete failed');window.location='deletebooking.php';</script>";
			}
			else{
				echo"<script> alert('Booking ID $BID is deleted successfully');window.location='deletebooking.php';</script>";
			}
		}
	?>
</div>
</body>
</html>



