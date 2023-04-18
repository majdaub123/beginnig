<?php
session_start();
require_once "connect.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && $_SESSION["status"] != "it") {
    header("location: dashboard_".$_SESSION['status'].".php");
} else if($_SESSION["status"] == null){
    header("location: Login.php");
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete the parking place from the database
    $sql = "DELETE FROM garage WHERE ID = '$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: parking_it.php');
    } else {
        echo "<script>alert('Error deleting parking place: " . mysqli_error($conn) . "');</script>";
    }
} else {
    header('Location: parking_it.php');
}

$conn->close();
?>
