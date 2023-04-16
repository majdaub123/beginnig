<?php
session_start();
require_once "connect.php";
if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["status"]!="it"){
    header("location: dashboard_".$_SESSION['status'].".php");
}else if($_SESSION["status"]==null){
 header("location: Login.php");
}

if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "DELETE FROM menu WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Menu item deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting menu item: " . mysqli_error($conn) . "');</script>";
    }
}

$conn->close();
header("Location: restaurant_it.php");
exit();
?>
