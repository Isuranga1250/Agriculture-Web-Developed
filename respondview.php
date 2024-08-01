<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Querys</title>
<link rel="stylesheet" href="css/tables.css">
</head>
	
<body>
	<div class="menu-box">
	<?php
		include('connector.php');
			session_start();
			$FarID=$_SESSION['farmer_id'];
			$sql="SELECT FID,feedback,reply FROM feedback WHERE farmer_id='$FarID' AND reply IS NOT NULL ";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('No responds for your Query');window.location='Homepage.php';</script>";
			}
			else{
				echo "<table>
				<tr>
				<th>Query ID</th>
				<th>Query</th>
				<th>Query Reply</th>
				
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['FID'] . "</td>";
					echo "<td>" . $row['feedback'] . "</td>";
					echo "<td>" . $row['reply'] . "</td>";
					echo "</tr>";
				}
				
				echo "</table>";
			}
	?>
	</div>
</body>
</html>