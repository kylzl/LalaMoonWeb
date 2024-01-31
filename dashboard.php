<?php

session_start();
require 'database.php';

//  if status = not active - redirect to login page)
if (!isset($_SESSION['status'])){
    header("location: login.php");
    exit();
}

//  retrieve data from $_SESSION
if(isset($_SESSION['userid'])){
    $id = $_SESSION["userid"];
}
if(isset($_SESSION['firstname'])){
    $firstname = $_SESSION['firstname'];
}
if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}
if(isset($_SESSION['userphoto'])){
    $photo = $_SESSION['userphoto'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

  <aside>
    <div>
    <div class="brand">
            <a href="index.html"><img src="images/lalamoon-brand-name.png" alt="lalamoon-brand-name"></a>
        </div>
        <div class="nav-item" id="dashboard">Dashboard</div></a>
        <a href="recipes.php"><div class="nav-item" id="recipes">Recipes</div></a>
            <?php echo ($role == 0) ? '<a href="users.php"><div class="nav-item" id="users">Users</div></a>
                                       <a href="#"><div class="nav-item" id="unpublished-posts">Unpublished Posts</div></a>' 
                                       : ''; ?>
            <a href="#"><div class="nav-item">Settings</div></a>
    </div>
</div>
    <div><a href="logout.php"><div class="nav-item">Log Out</div></a>
</aside>

<div class="container">
  <header>
    <h1>
        <?php 
            if ($role == 0) {
                echo 'Admin Dashboard';
            }
            else {
                echo 'User Dashboard';
            }
        ?>
    </h1>
  </header>


        <div class="weladmin">
        <h2 class="username">Hi <?php echo $firstname . "!" ; ?></h2>
        <?php
                $sql = "SELECT Photo FROM users WHERE UserID = $id";
                $result = $conn->query($sql);
            
                if (!$result) {
                    die('Error: ' . mysqli_error($conn));
                }
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<img src="uploads/' . $row["Photo"] . '" alt="Profile Photo"><br>';
                    }
                } else {
                    echo "There's no Image for this User";
                }
            
                $result->close();
            $conn->close();
        ?>
            
    
</div>

</body>
</html>