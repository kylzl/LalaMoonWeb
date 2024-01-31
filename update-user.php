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

$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    while ($user = mysqli_fetch_assoc($result)) {
        if(($id = $_GET['userid']) && ($id == $user['UserID'])){
          $updateID          = $user['UserID'];
          $firstname         = $user['FirstName'];
          $lastname          = $user['LastName'];
          $existingPhoto     = $user['Photo'];
          $email             = $user['Email'];
          $phonenumber       = $user['PhoneNumber'];
          $role              = $user['Role'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Info</title>
    <link rel="stylesheet" href="css/add-update.css">
</head>
<body>
  <div class="form-container">
      <form action="save-user.php?userid=<?php echo $updateID ?>" method="post" enctype="multipart/form-data">
        <h2>Edit User Info</h2>
        <div class="image">
              <label for="image">Change Image:</label>
              <input type="file" id="image" name="photo" accept="image/*">
          </div>
          <div class="fullname">
            <div>
              <label for="first name">First Name:</label>
              <input type="text" id="firstname" name="firstname" value="<?php echo $firstname ?>">
            </div>
            <div>
              <label for="first name">Lastname:</label>
              <input type="text" id="lastname" name="lastname" value="<?php echo $lastname ?>">
            </div>
          </div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo $email ?>">
          <label for="role">Change Role:</label>

          <input class="role" type="checkbox" name="adminUser" style="width:20px; margin: 0;">Admin</input>
          <input class="role" type="checkbox" name="regularUser" style="width:20px; margin: 0;">User</input>
  
          
          <div class="button-container">
            <button type="submit">Save Changes</button>
            <button class="back"><a href="users.php">Back</a></button>
          </div>
      </form>
  </div>

</body>
</html>