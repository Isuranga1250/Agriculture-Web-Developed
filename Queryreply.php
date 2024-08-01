<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reply Query</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
		include('connector.php');
			$sql="SELECT * FROM feedback WHERE reply IS NULL";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('No Query available');window.location='adminmenu.html';</script>";
			}
			else{
				echo "<table>
				<tr>
				<th>Query ID</th>
				<th>Farmer ID</th>
				<th>Query</th>
				<th>Query Reply</th>
				
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['FID'] . "</td>";
					echo "<td>" . $row['farmer_id']  . "</td>";
					echo "<td>" . $row['feedback'] . "</td>";
					echo "<td>";
					echo "<form method='post'>
						  <textarea name='reply' placeholder='Enter reply' cols='50' rows='5'></textarea><br>
						  <input type='hidden' name='FID' value='" . $row['FID'] . "'>
						  <input type='submit' class='btndel' name='update' value='Update'>
						  </form>";
					echo "</td>";
					echo "</tr>";
				}
				
				echo "</table>";
			}
	?>
	<?php
		if(isset($_POST['update'])){
			$FID=$_POST['FID'];
			$reply=$_POST['reply'];
			$sqldel="UPDATE feedback SET reply='$reply' WHERE FID='$FID'";
			$resultdel=mysqli_query($conn,$sqldel);
			if(!$resultdel){
				echo"<script> alert('Update failed');window.location='Queryreply.php';</script>";
			}
			else{
				echo"<script> alert('Update successful');window.location='Queryreply.php';</script>";
			}
		}
	?>
	</div>
</body>
</html>