<?php

  session_start();
  require 'database.php';

// getting form data from login.php
  $email     = $_POST['email'];
  $password  = $_POST['password'];

  $sql = "SELECT * FROM users WHERE Email ='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while($user = $result->fetch_assoc()) {
        if(password_verify($password, $user['Password'])){
          $_SESSION['userid']      = $user['UserID'];
          $_SESSION['firstname']   = $user['FirstName'];
          $_SESSION['lastname']    = $user['LastName'];
          $_SESSION['userphoto']   = $user['Photo'];
          $_SESSION['email']       = $user['Email'];
          $_SESSION['phonenumber'] = $user['PhoneNumber'];
          $_SESSION['role']        = $user['Role'];
          $_SESSION['status']      = "Active";
          header("Location: dashboard.php");

        } else {
          header('location: login.php?error=password');
        }
      }
  } else {
    header('location: login.php?error=no-user-found');
  }

