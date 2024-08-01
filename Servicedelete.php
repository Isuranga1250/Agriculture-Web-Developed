<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Services</title>
<link rel="stylesheet" href="css/tables.css">
<script type="text/javascript">
function confirmDelete(SID) {
	if (confirm("Are you sure you want to delete this record?")) {
		var form = document.createElement('form');
		form.method = 'post';
		form.action = '';

		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'SID';
		input.value = SID;

		var deleteInput = document.createElement('input');
		deleteInput.type = 'hidden';
		deleteInput.name = 'delete';
		deleteInput.value = 'delete';

		form.appendChild(input);
		form.appendChild(deleteInput);

		document.body.appendChild(form);
		form.submit();
	}
}
</script>
</head>
<body>
	<div class="menu-box">
	<form id="form1" name="form1" method="post">
		<p>
			<label>Enter Service ID:</label>
			<input type="text" name="SID">
		</p>
		<p>
			<input type="submit" class="btn" name="search" value="search">
		</p>
	</form>
	<?php
		include('connector.php');
		if(isset($_POST['search'])){
			$SID=$_POST['SID'];
			$sql="SELECT * FROM services WHERE SID='$SID'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('Invalid search');window.location='Servicedelete.php';</script>";
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
				<th>Action</th>
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
					echo "<td>";
					echo "<button class='btndel' onclick='confirmDelete(" . $row['SID'] . ")'>delete</button>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	?>
	<?php
		if(isset($_POST['delete'])){
			$SID=$_POST['SID'];
			$sqldel="DELETE FROM services WHERE SID = '$SID'";
			$resultdel=mysqli_query($conn,$sqldel);
			if(!$resultdel){
				echo"<script> alert('Delete failed');window.location='Servicedelete.php';</script>";
			}
			else{
				echo"<script> alert('Service with ID $SID is deleted successfully');window.location='Servicedelete.php';</script>";
			}
		}
	?>
	</div>
</body>
</html>




