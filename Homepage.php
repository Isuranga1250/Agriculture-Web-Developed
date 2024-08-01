<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="homepagestyle.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<div class="wrapper">
	
	<?php
	session_start();
	include("connector.php");
	?>
		<div class="top">
		<h2>**OrgFarm**</h2>
		
		<ul>
	<?php
		if(isset($_SESSION['username'])) {
			echo "<li><a href=Servicebookingstatus.php>Service Booking Status</a></li>";
			echo "<li><a href=logout.php>Logout</a></li>";
			echo "<li><a href=Querysubmit.php>Query</a></li>";
			echo "<li><a href=respondview.php>Query Responds</a></li>";
			echo "<li>Hello Welcome ".$_SESSION['username']."</li>";
		} else {
			echo "<li><a href=login.html>Login</a></li>";
			echo "<li><a href=signinreg.html>Register</a></li>";	
		}	
	?>
		</ul>
		</div>
		<div class="bottom">
			
	<form action="" method="post">
		<ul>
		<li><label>Select Category:</label></li>
		<li class="select-wrapper"><select name="category">
		<option value="all" <?php if(isset($_POST['category']) && $_POST['category'] == 'all') echo 'selected'; ?>>All</option>
		<option value="Workshops" <?php if(isset($_POST['category']) && $_POST['category'] == 'Workshops') echo 'selected'; ?>>Workshops</option>
		<option value="Meetings" <?php if(isset($_POST['category']) && $_POST['category'] == 'Meetings') echo 'selected'; ?>>Meetings</option>
		<option value="Trainings" <?php if(isset($_POST['category']) && $_POST['category'] == 'Trainings') echo 'selected'; ?>>Trainings</option>
		<option value="Summer Camps" <?php if(isset($_POST['category']) && $_POST['category'] == 'Summer Camps') echo 'selected'; ?>>Summer Camps</option>
		</select></li>
		<li><input type="submit" name="filter" value="Filter" class="button"></li>
		</ul>
	</form>

	<div class="search-bar-division">
		<form action="" method="get" class="menu-list-item-search-bar-main">
    	<li class="menu-list-item-search-bar-main"> <menu> <input type="text" name="search"  class="menu-list-item-search-bar" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"> </menu> </li>
    	<li type="submit" class="menu-list-item-searching-icon-button"> <button type="submit" 	class="search-menu-icon-button"> <i class="search-menu-icon fas fa-search"></i> </button> </li>
  	</form>
	</div>

	</div>
	</div>
	<div class="container">
	<?php
		if (isset($_POST['category'])) {
			$category = $_POST['category'];
		} else {
			$category = 'all';
		}

		$search = isset($_GET['search']) ? $_GET['search'] : '';

		if (empty($search) && isset($_GET['search'])) {
			echo "<p class='search-guidance-text'>Dear User, Please enter a search term!</p>";
		} else {
			$sql = "SELECT * FROM services WHERE 1=1";

			if ($category != 'all') {
				$sql .= " AND Category='$category'";
			}

			if (!empty($search)) {
				$sql .= " AND (SName LIKE '%$search%' OR Category LIKE '%$search%' OR Description LIKE '%$search%')";
			}

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					?>
					<div class="Services-card">
					<img src="Servicespics/<?php echo $row["Img"]; ?>">
					<div class="Services-info">
						<h3><?php echo $row["SName"]; ?></h3>
						<b><p><strong>Category : </strong><?php echo $row["Category"]; ?></p></b>
						<p><strong>Duration : </strong><?php echo $row["duration"]; ?></p>
						<p><strong>Description : </strong><?php echo $row["Description"]; ?></p>
						<?php
						if (isset($_SESSION['username'])) {
							echo "<a href='booking.php?SID=" . $row["SID"] . "'>Book</a>";
						}
						?>
					</div>
					</div>
					<?php
				}
			} else {
				echo "<p class='search-guidance-text'>No services found matching your search criteria.</p>";
			}
		}
	?>
</div>
<footer class="footer">
        <button class="about-button" onclick="window.location.href='aboutus.html'">About Us</button>
</footer>
</body>
</html>

