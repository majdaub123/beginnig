<?php
 require_once "connect.php";
 session_start();
 if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["status"]!="it"){
     header("location: dashboard_".$_SESSION['status'].".php");
 }else if($_SESSION["status"]==null){
  header("location: Login.php");
 }
 




 
 // Get the ID of the parking place to edit
 if (!isset($_GET['id'])) {
     header('Location: parking_it.php');
     exit;
 }
 $id = mysqli_real_escape_string($conn, $_GET['id']);
 
 // Fetch the parking place from database
 $sql = "SELECT * FROM garage WHERE ID = '$id'";
 $result = mysqli_query($conn, $sql);
 if (!$result) {
     die('Error fetching parking place: ' . mysqli_error($conn));
 }
 $place = mysqli_fetch_assoc($result);
 
 // Process the form data if submitted
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Get the submitted data
     $status = mysqli_real_escape_string($conn, $_POST['status']);
     $price = mysqli_real_escape_string($conn, $_POST['price']);
 
     // Update the parking place in database
     $sql = "UPDATE garage SET status_place = '$status', price = '$price' WHERE ID = '$id'";
     $result = mysqli_query($conn, $sql);
     if (!$result) {
         die('Error updating parking place: ' . mysqli_error($conn));
     }
 
     // Redirect to the parking  page
     header('Location: parking_it.php');
     exit;
 }
 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
     <title>Edit Parking Place</title>
     <link rel="stylesheet" href="edit_parking.css">
   
 </head>
 <body>
     <h1>Edit Parking Place</h1>
     <form method="POST">
         <label>Status:</label>
         <select name="status">
             <option value="available" <?php if ($place['status_place'] === 'available') echo 'selected'; ?>>Available</option>
             <option value="unavailable" <?php if ($place['status_place'] === 'unavailable') echo 'selected'; ?>>Unavailable</option>
         </select>
         <br>
         <label>Price:</label>
         <input type="text" name="price" value="<?php echo htmlspecialchars($place['price']); ?>">
         <br>
         <input type="submit" value="Submit">
         <a href="parking_it.php" class="cancel">Cancel</a>
     </form>
 </body>
 </html>
 