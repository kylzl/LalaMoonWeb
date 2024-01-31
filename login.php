<?php

session_start();
require 'database.php';

//  if the session is currently existing then this page can't be accessed
if(isset($_SESSION['status'])){
    header('location: dashboard.php'); 
    exit();
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <main>
        <img src="images/adobo.jfif" class="img">
            
        <div class="container">
            <div>
                <div class="brand">
                <div class="text">
                    <a href="index.html"><img src="images/lalamoon-brand-name.png" class="brandlogo" alt="lalamoon-brand-name"></a>
                    </div>
                    <h3>Log In</h3>
                </div>
               
                <div class="login-container">

                 <form action="login-process.php" method="post">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <?php 

                        if(isset($_GET['error'])){
                            echo "<p style='color:red; font-size:12px; margin: 0 0 10px 0; padding: 0;'>Incorrect Input. Try Again.</p>";
                        }
                    ?>

                    <button type="submit">Log In</button>
                    <p>Don't have an account? <a href="signup.php">Join Now</a></p>
                </form> 
                </div>
            </div>

        </div>
    </main>

</body>
</html>
