<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>testlogin</title>
</head>
<?php
	session_start();
	if(isset($_POST['submit'])){
		include ("connector.php");
		$farmername = $_POST['farmername'];
		$password = $_POST['pass'];
		if($farmername=='Admin'&&$password=='12345'){
			echo"<script> alert('Welcome to The Admin Menu');window.location='adminmenu.html';</script>";
		}elseif($farmername=='FieldOfficers'&&$password=='12345'){
			echo"<script> alert('Welcome to The Field Officer Menu');window.location='Fieldofficer.html';</script>";
		}else{
			$sqlsearch = "SELECT * FROM farmer WHERE farmer_name ='$farmername' AND Password='$password'";
			$result=mysqli_query($conn,$sqlsearch);
			$row=mysqli_fetch_assoc($result);
			if(mysqli_num_rows($result)>0){
				session_start();
				$_SESSION['username']=$farmername;
				$_SESSION['farmer_id']=$row['farmer_id'];
				echo"<script> alert('Welcome');window.location='Homepage.php';</script>";
			}else{
				echo"<script> alert('Invalid username and password');window.location='login.html';</script>";
			}
		}
		
	}else{
		echo"Your form is not submitted yet please fill the form and visit again";
	}
?>
<body>
	
</body>
</html>