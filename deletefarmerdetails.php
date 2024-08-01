<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete User</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
<div class="menu-box">
<form id="form1" name="form1" method="post">
  <p>
    <label>Enter User ID:</label>
    <input type="text" name="FID">
  </p>
  <p>
    <input class="btn" type="submit" name="search">
  </p>
</form>
	<?php
		include('connector.php');
		if(isset($_POST['search'])){
			$FID=$_POST['FID'];
			$sql="SELECT * FROM farmer WHERE farmer_id='$FID'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('Search failed');window.location='deletefarmerdetails.php';</script>";
			}
			else{
				
				echo "<table border='1' size='200'>
				<tr>
				<th>Farmer ID</th>
				<th>Farmer Name</th>
				<th>Password</th>
				<th>Action</th>
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['farmer_id']  . "</td>";
					echo "<td>" . $row['farmer_name'] . "</td>";
					echo "<td>" . $row['Password']  . "</td>";
					echo "<td>";
					echo "<form method='post'>
						  <input type='hidden' name='FID' value='" . $row['farmer_id'] . "'>
						  <input type='submit' class='btndel' name='delete' value='Delete'>
						  </form>";
					echo "</td>";
					echo "</tr>";
					echo "</table>";
				}
				
			}
		}
	?>
	<?php
		if(isset($_POST['delete'])){
			$FID=$_POST['FID'];
			$sqldeletebooking = "DELETE FROM servicebooking WHERE farmer_id = '$FID'";
				$resultdeletebooking = mysqli_query($conn, $sqldeletebooking);
				if(!$resultdeletebooking) {
					echo "<script> alert('Failed to delete bookings');window.location='deletefarmerdetails.php'; </script>";
				}
			else{
				$sqldel = "DELETE FROM farmer WHERE farmer_id = '$FID'";
					$resultdel = mysqli_query($conn, $sqldel);
					if(!$resultdel) {
						echo "<script> alert('Failed to delete user');window.location='deletefarmerdetails.php'; </script>";
					}
					else{
						echo"<script> alert('Delete Successful');window.location='deletefarmerdetails.php';</script>";
					}
				
			}
		}
	?>
	</div>
</body>
</html>