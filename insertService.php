<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	if(isset($_POST['submit'])){
		include "connector.php";
		$Sname = $_POST['Sname'];
		$description = $_POST['description'];
		$imgName = $_FILES['image']['name'];
		$category = $_POST['categories'];
		$duration = $_POST['duration'];
		$date = $_POST['date'];
		$starting_time = $_POST['starting_time'];
		$location = $_POST['location'];

		$sqlsearch = "SELECT * FROM services WHERE SName = '$Sname'";
		$result1=mysqli_query($conn,$sqlsearch);

		if(mysqli_num_rows($result1)>0){
				die('Service already exist');
		}
		else{
			$target = "Servicespics/".basename($imgName);

			$sql = "INSERT INTO services (SName, description,Img, category, duration, date, starting_time, location) VALUES ('$Sname','$description','$imgName', '$category' ,'$duration', '$date', '$starting_time', '$location')";
			$results = mysqli_query($conn, $sql);

			if(!$results) {
				die('Could not enter data: ' . mysqli_error($conn));
			}
			else{
				echo "<script> alert('Entered details successfully');</script>";
			}								  		
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				echo "<script> alert('Image Uploaded successfully');</script>";
			}
			else{
				echo "<script> alert('Image upload failed!');</script>";				
			}
		}
	 } else{
		echo "<script> alert('Your form is not submitted yet please fill the form and visit again');</script>";
	} 
?>	

</body>
</html>