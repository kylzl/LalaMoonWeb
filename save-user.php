<?php

session_start();
require 'database.php';

//  checks the userID from the url
//  gets form data from update-user.php
if(isset($_GET['userid'])){
  $id            = $_GET['userid'];  
  $lastname      = $_POST['lastname'];
  $firstname     = $_POST['firstname'];
  $photo         = $_FILES['photo']['name'];
  $newEmail      = $_POST['email'];
  $role          = isset($_POST['adminUser']) ? 0 : 1;
}

$sql = "SELECT Photo FROM users WHERE UserID = $id";
  $result = mysqli_query($conn, $sql);
  $existingPhoto = mysqli_fetch_assoc($result)['Photo'];

if ($_FILES['photo']['name']) {
  $photo = $_FILES['photo']['name'];
} else {
  $photo = $existingPhoto;
}


$sql = "UPDATE users SET LastName ='$lastname', 
                         FirstName='$firstname', 
                         Photo    ='$photo',
                         Email    ='$newEmail', 
                         Role     ='$role' 
        WHERE            UserID   ='$id'";

if($conn->query($sql)){
  header("location:users.php");
}

