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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/users.css">
  <title>Users</title>
</head>
<body>

  <aside>
    <div>
    <div class="brand">
            <a href="index.html"><img src="images/lalamoon-brand-name.png" alt="lalamoon-brand-name"></a>
        </div>
    
        <a href="dashboard.php"> <div class="nav-item" id="dashboard">Dashboard</div></a>
        <a href="recipes.php"><div class="nav-item" id="recipes">Recipes</div></a>
        <a href="users.php"><div class="nav-item" id="users">Users</div></a>
        <a href="#"><div class="nav-item" id="unpublished-posts">Unpublished Posts</div></a>
        <a href="#"><div class="nav-item">Settings</div></a>
    </div>
    <a href="logout.php"class="log-out">Log Out</a>
  </aside>

<div class="container">

    <div class="grid">
      <div class="profile"> 
        <div class="add">
        <h1>Users</h1>
        <a href="add-user.php">Add a new user</a>
        </div>
     <table>
     <tr>
        <th>User Photo</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Email</th>               
        <th>Role</th>               
        <th>Action</th>               
      </tr>                             
        <?php
        
          $sql = "SELECT * FROM users;";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
              while ($user = mysqli_fetch_assoc($result)) {
                    $id          = $user['UserID'];
                    $firstname   = $user['FirstName'];
                    $lastname    = $user['LastName'];
                    $photo       = $user['Photo'];
                    $email       = $user['Email'];
                    $role        = $user['Role'];
        ?>
                    <tr>
                       <th class="user-profile"><?php echo '<img src="uploads/' . $photo . '" alt="Profile Photo"><br>';?></th>
                       <th><?php echo  $lastname;?></th>
                       <th><?php echo $firstname;?></th>
                       <th><?php echo $email;?></th>
                       <th>
                        <?php
                              if (isset($_GET['id'])) {
                                echo ($id == "0") ? "Admin" : "User";
                              }else{
                                if ($role == "0") {
                                  echo "Admin";
                              } else {
                                  echo "User";
                              }
                              }
                            ?>
                      </th>
                      <th><a href="update-user.php?userid=<?php echo($user['UserID'])?>" class="update">Update</a>
                          <a href="delete-user.php?userid=<?php echo($user['UserID']) . '"onclick="return confirm(\'Are you sure you want to delete this user?\')"'?>" class="delete">Delete</a></th>
                    </tr>
                    
           <?php         
              }
            }
        ?>
     </table>
      </div>


    </div>
  </div>
</div>

</body>
</html>
