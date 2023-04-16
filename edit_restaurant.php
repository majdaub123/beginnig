<?php
session_start();
require_once "connect.php";
session_start();
require_once "connect.php";
if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["status"]!="it"){
    header("location: dashboard_".$_SESSION['status'].".php");
}else if($_SESSION["status"]==null){
 header("location: Login.php");
}

if(isset($_GET['id'])) {
    // Get the menu item's ID from the URL parameter
    $id = $_GET['id'];

    // Retrieve the menu item's details from the database
    $sql = "SELECT name, price, description, type FROM menu WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Update the menu item's details
    if(isset($_POST['update'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = mysqli_real_escape_string($conn, $_POST['description']); // Escape special characters
        $type = $_POST['type'];

        $sql = "UPDATE menu SET name='$name', price='$price', description='$description', type='$type' WHERE id='$id'";
        if(mysqli_query($conn, $sql)) {
            // If the update was successful, redirect back to the menu page
            header("Location: restaurant_it.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Display the menu item's details and allow editing
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Menu Item</title>
        <link rel="stylesheet" type="text/css" href="edit_restaurant.css">
    </head>
    <body>
        <h1 class="heading">Edit Menu Item</h1>
        <form method="POST" action="">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>

            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>"><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo $row['description']; ?></textarea><br>

            <label for="type">Type:</label><br>
            <input type="text" id="type" name="type" value="<?php echo $row['type']; ?>"><br>

            <input type="submit" name="update" value="Update">
            <a href="restaurant_it.php">Cancel</a>
        </form>
    </body>
    </html>
    <?php
} else {
    // If no menu item ID was provided, redirect back to the menu page
    header("Location: restaurant_it.php");
    exit();
}
?>

