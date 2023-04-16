<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
     require_once "connect.php";
     
     if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["status"]!="it"){
          header("location: dashboard_".$_SESSION['status'].".php");
     }else if($_SESSION["status"]==null){
       header("location: Login.php");
     }
    
    
   
    
     ?>
     

     
     
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
       <link href="dashboard.css" rel="stylesheet"/>
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/>
        <link href="restaurant_it.css" rel="stylesheet"/>


    </head>
<body>
<div class="main-container d-flex">
  <div class="sidebar" id="side_nav">
    <div class="header-box px-2 pt-2 pb-4 d-flex">
    <h1 class="fs-2"><span class="bg-white text-dark rounded shadow px-2 me-2">Ho</span><span class="text-white">It Hotel</span></h1>
    <button onclick="dispearBar(this)" class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
    </div>
    <ul class="list-unstyled px-3">
    <li  onclick="setActive(this)"><a href="dashboard_<?php echo $_SESSION["status"];?>.php" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-home"></i> Home</a></li>
    <li onclick="setActive(this)" ><a href="Event_<?php echo $_SESSION["status"];?>.php" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-calendar-exclamation"></i> Events</a></li>
    <li onclick="setActive(this)" ><a href="parking_<?php echo $_SESSION["status"];?>.php" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-parking"></i> Parking</a></li>
    <li onclick="setActive(this)"><a href="#" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-file-user"></i> Accounts</a></li>
    <li onclick="setActive(this)"class = "active"><a href="restaurant_<?php echo $_SESSION["status"];?>.php"class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-utensils-alt"></i> Restaurant</a></li>
    <li onclick="setActive(this)"><a href="#" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-page-break"></i> Content</a></li>
    <li onclick="setActive(this)"><a href="#" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-comments-alt"></i> feedBack</a></li>
    <li onclick="setActive(this)"><a href="#" class="text-decoration-none px-3 py-2 d-block fs-4"><i class="fas fa-sliders-h-square"></i> Settings</a></li>
</ul>   
<div class="dropdown position-fixed border-top border-light p-3 justify-content-center d-flex" style="width:300px;bottom:10px;">
<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
       <?php
       $sql="SELECT img From it where ID=".$_SESSION["id"]."";
       $re=mysqli_query($conn,$sql);
       $img = mysqli_fetch_assoc($re)["img"];
       ?>
        <img src="<?php echo $img;?>" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?php echo $_SESSION["username"];?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="Log-out.php">Sign out</a></li>
      </ul>
    </div>
  </div>
  <div class="content">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
   <div class="d-flex justifty-content-between">
   <button onclick="setSideBar(this)"class="btn d-block close-btn px-2 py-2 d-md-none d-block"><i class="fal fa-stream"></i> </button>
  </div>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item">
     <a class="nav-link active" aria-current="page" href="#">Profile</a>
    </li>
    </ul>
  </div>
  </div>
  </nav>

  <div class="container text-center">



    

  <h1 class="heading">Menu Items</h1>
<table class="menu-table">
    <tr>
        <td colspan="6" style="text-align:center;">
            <a class="add-link" href="add_restaurant.php">Add new item</a>
        </td>
    </tr>
    <tr>
        <th class="table-header">Name</th>
        <th class="table-header">Price</th>
        <th class="table-header">Description</th>
        <th class="table-header">Type</th>
        <th class="table-header">Edit</th>
        <th class="table-header">Delete</th>
    </tr>
    <?php
        require_once "connect.php";

        // Select data from menu table
        $sql = "SELECT id, name, price, description, type FROM menu";
        $result = mysqli_query($conn, $sql);

        // Display data on webpage
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='table-cell'>" . $row["name"] . "</td>";
                echo "<td class='table-cell'>" . $row["price"] . "</td>";
                echo "<td class='table-cell'>" . $row["description"] . "</td>";
                echo "<td class='table-cell'>" . $row["type"] . "</td>";
                echo "<td class='table-cell'><a class='edit-link' href='edit_restaurant.php?id=" . $row["id"] . "&name=" . $row["name"] . "&price=" . $row["price"] . "&description=" . $row["description"] . "&type=" . $row["type"] . "'>Edit</a></td>";
                echo "<td class='table-cell'><a class='delete-link' href='delete_menu_item.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this item?\")'><img  src='icon/close_edit_event.jpg' alt='Delete' style = width:40px;
				height: 40px;
				border-radius:50px;
				margin:10px;></a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td class='table-cell' colspan='6'>No menu items found.</td></tr>";
        }
    ?>
</table>
