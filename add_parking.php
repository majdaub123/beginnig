<!DOCTYPE html>
<html>
<head>
	<title>Add Parking Spot</title>
	<link rel="stylesheet" type="text/css" href="add_parking.css">
</head>
<body>
	<h1 class="heading">Add Parking Spot</h1>
	<div class="form-container">
		<form method="post" action="">
			<label for="number_place">Number of Parking Place:</label>
			<input type="number" id="number_place" name="number_place" min="1" required>
			<label for="status_place">Status:</label>
			<select id="status_place" name="status_place" required>
			  <option value="available">Available</option>
			  <option value="unavailable">Unavailable</option>
			</select>
			<label for="price">Price:</label>
			<input type="number" id="price" name="price" min="0" step="0.01" required>
			<input type="submit" value="Add Parking" name="submit">
            <button type="button" onclick="window.location='parking_it.php'" class="cancel-button">Cancel</button>
		</form>
	</div>
</body>
</html>

<?php
session_start();
require_once "connect.php";
if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["status"]!="it"){
    header("location: dashboard_".$_SESSION['status'].".php");
}else if($_SESSION["status"]==null){
 header("location: Login.php");
}

if (isset($_POST['submit'])) {
	$number_place = mysqli_real_escape_string($conn, $_POST['number_place']);
	$status_place = mysqli_real_escape_string($conn, $_POST['status_place']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$sql = "INSERT INTO garage (number_place, status_place, price) VALUES ('$number_place', '$status_place', '$price')";
	if (mysqli_query($conn, $sql)) {
		header('Location: parking_it.php');

	} else {
		echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
	}
}


?>
