<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Booking</title>
<link rel="stylesheet" type="text/css" href="css/bookingstyle.css">
<script type="text/javascript">
function formValidation(){
    var location = document.seats.location;
    var date = document.seats.day;
    if(Emptyfield(location, date)) {
        if(allnumeric(location)) {
            return true;
        }
    }
    return false;
}

function Emptyfield(location, date){ 
    var location_len = location.value.length;
    var date_len = date.value.length;
    if (location_len == 0 || date_len == 0) {
        alert("Fields should not be empty");
        return false;
    } else {
        return true;
    }
}   

function allnumeric(location){ 
    var letters = /^[A-Za-z]+$/;
    if(location.value.match(letters)) {
        return true;
    } else {
        alert('Please add letters only');
        location.focus();
        return false;
    }
}
</script>
</head>
<body>
    <form name="seats" class="fbox" method="post" onSubmit="return formValidation();">
    <?php
    session_start();
    include("connector.php");
    $SID = $_GET['SID'];
    $FarmerID = $_SESSION['farmer_id'];
    $uname = $_SESSION['username'];
    $sqlm = "SELECT * FROM services WHERE SID='$SID'";
    $resultm = mysqli_query($conn, $sqlm);
    $rowm = mysqli_fetch_assoc($resultm);
    echo '<img src="Servicespics/'.$rowm["Img"].'">';
    ?>
    
        <div class="form-group">
            <h3 class="title">The Service Time is</h3>
            <input type="text" readonly class="input-box" name="starting_time" value="<?php echo $rowm['starting_time']; ?>">
        </div>
        <div class="form-group">
            <h3 class="title">The Service Date is</h3>
            <input type="text" readonly class="input-box" name='date' value="<?php echo $rowm['date']; ?>">
        </div>
        <div class="form-group">
            <h3 class="title">The Location is</h3>
            <input type="text" readonly class="input-box" name="location" value="<?php echo $rowm['location']; ?>">
        </div>

        <div class="form-group">
            <h3 class="title">Description</h3>
            <p><?php echo $rowm['Description']; ?></p>
        </div>
        
        <div class="form-group">
            <input type="submit" name="confirm" value="Confirm Booking" class="btn">
        </div>
    </form>
    <?php
    if(isset($_POST['confirm'])){
        $location = $_POST['location'];
        $starting_time = $_POST['starting_time'];
        $date = date('Y-m-d', strtotime($_POST['date']));
        
        
        $sqlinsert = "INSERT INTO servicebooking (farmer_id, SID, starting_time, bookingdate, location) 
                      VALUES ('$FarmerID', '$SID', '$starting_time', '$date', '$location')";
        $resultinsert = mysqli_query($conn, $sqlinsert);
        if(!$resultinsert){
            die('Booking Failed');
        } else {
            echo "<script> alert('Service Booking Confirmation is processing!');window.location='Homepage.php';</script>";
        }
    }   
    ?>
</body>
</html>
