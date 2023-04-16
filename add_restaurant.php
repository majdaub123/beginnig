<!DOCTYPE html>
<html>
<head>
	<title>Add Menu Item</title>
	<link rel="stylesheet" type="text/css" href="add_restaurant.css">
</head>
<body>
	<h1 class="heading">Add Menu Item</h1>
	<div class="form-container">
		<form method="post" action="">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>
			<label for="price">Price:</label>
			<input type="number" id="price" name="price" min="0" step="0.01" required>
            <label for="description"> Description: </label>
            <input type="text" id="description" name="description" required>
            <label for="type"> Type: </label>
            <input type="text" id="type" name="type" required>
			<input type="submit" value="Add Item" name="submit">
            <button type="button" onclick="window.location='restaurant_it.php'" class="cancel-button">Cancel</button>
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
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
	$type = mysqli_real_escape_string($conn, $_POST['type']);
	$sql = "INSERT INTO menu (name, price,description,type) VALUES ('$name', '$price','$description','$type')";
	if (mysqli_query($conn, $sql)) {
		header('Location: restaurant_it.php');

	} else {
		echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
	}
}

$conn->close();
?>
