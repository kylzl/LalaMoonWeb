
<?php

    require 'database.php';
    require 'create-database-table.php';

//  gets form data from signup.php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $firstname       = $_POST["firstname"];
    $lastname        = $_POST["lastname"];
    $photo           = $_FILES["photo"]["name"];
    $gender          = $_POST["gender"];
    $phonenumber     = $_POST["phonenumber"];
    $email           = $_POST["email"];
    $password        = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $hashedPwd       = password_hash($password, PASSWORD_DEFAULT);

if (isset($_FILES["photo"])) {
    $image      = $_FILES["photo"]["name"];
    $temp_image = $_FILES["photo"]["tmp_name"];
    $upload_dir = "uploads/";
    move_uploaded_file($temp_image, $upload_dir . $image);

    $sql = "INSERT INTO users (Photo) VALUES ('$image')";
    if ($conn->query($sql) === TRUE) {
        header("location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($password !== $confirmpassword){    
    header("Location: signup.php?error=password-dont-match"); 
        exit();
}

    $sql = "INSERT INTO users (firstname, 
                               lastname, 
                               photo, 
                               gender, 
                               phonenumber, 
                               email, 
                               Password)
                      VALUES  ('$firstname', 
                               '$lastname', 
                               '$photo', 
                               '$gender', 
                               '$phonenumber', 
                               '$email', 
                               '$hashedPwd')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
