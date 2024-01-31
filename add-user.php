<?php

session_start();
require 'database.php';

//  if status = not active - redirect to login page)
if(!isset($_SESSION['status'])){
  header('location: login.php');
  exit();
} 

// can't access this page if the user isn't an admin
if($_SESSION['role'] !=0){
  header("location: dashboard.php");
  exit();
}
 
//

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/add-update.css">

</head>
<body>
<div class="form-container">
      <form action="save-new-user.php" method="POST" enctype="multipart/form-data">

        <h2>Add A New User</h2>
          <div class="name">
            <div>
              <label for="first name">First Name:</label>
              <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
            </div>
            <div>
              <label for="first name">Last Name:</label>
              <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
            </div>
          </div>
          <input type="file" name="photo" id="photo" accept="image/*" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Email" required>
          <label for="password">Choose a Password: </label>
          <input type="password" id="password" name="password" placeholder="Type your password here..." required>
          <input type="password" name="confirmpassword" placeholder="Confirm Password..." required>

          <div style="color: #911300; padding: 0 0 10px 0; font-size: 13px; text-align: center;">
                    <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo "Password doesn't match! Try again";
                        }
                    ?>
                    </div>

          <div class="role">
          <label for="role">Change Role:</label>
            <input class="role" type="checkbox" name="adminUser" style="width:20px; margin: 0;">Admin</input>
            <input class="role" type="checkbox" name="regularUser" style="width:20px; margin: 0;">User</input>
          </div>
          
          
            <div class="button-container">
            <button type="submit">Submit</button>
            <button class="back"><a href="users.php">Back</a></button>
          </div>
      </form>
  </div>
</body>
</html>