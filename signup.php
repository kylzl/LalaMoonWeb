<?php

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
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>

    <main>
        <img src="images/adobo.jfif" class="img">
            
        <div class="container">
            <div>
                <div class="brand">
                    <a href="index.html"><img src="images/lalamoon-brand-name.png" class="brandlogo" alt="lalamoon-brand-name"></a>
                </div>
                <div class="text">
                    <h3>Sign Up</h3>
                </div>
                <div class="signup-container">
    
                <form action="signup-process.php" method="POST" enctype="multipart/form-data">
                    <div class="username">
                        <input type="text" name="firstname" placeholder="First Name" required>
                        <input type="text" name="lastname" placeholder="Last Name" required>
                    </div>
                    <input type="file" name="photo" id="photo" accept="image/*" required>
                    <p>Select Gender:</p>
                    <select name="gender" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" name="phonenumber" placeholder="Phone Number" value="+63" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" required>

                    <div style="color: #911300; padding: 0 0 10px 0;">
                    <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo "Password doesn't match! Try again";
                        }
                    ?>
                    </div>

                    <button type="submit" name="submit">Sign Up</button>
    
                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </form>
                </div>
            </div>

        </div>
</main>
</body>
</html>