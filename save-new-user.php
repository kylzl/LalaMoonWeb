<?php
    session_start();
    require 'database.php';

//  getting form data from add-new-user.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname          = $_POST["firstname"];
    $lastname           = $_POST["lastname"];
    $photo              = $_FILES["photo"]["name"];
    $email              = $_POST["email"];
    $role               = isset($_POST['adminUser']) ? 0 : 1;
    $password           = $_POST["password"];
    $confirmpassword    = $_POST["confirmpassword"];
    $hashedPwd          = password_hash($password, PASSWORD_DEFAULT);

if (isset($_FILES["photo"])) {
    $image      = $_FILES["photo"]["name"];
    $temp_image = $_FILES["photo"]["tmp_name"];
    $upload_dir = "uploads/";
    move_uploaded_file($temp_image, $upload_dir . $photo);
    $sql        = "INSERT INTO users (Photo) VALUES ('$photo')";
    if ($conn->query($sql) === TRUE) {
        header("location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}    

if ($password !== $confirmpassword){    
    header("Location: add-user.php?error=password-dont-match"); 
        exit();
}

$sql = "INSERT INTO users (firstname, 
                           lastname, 
                           photo, 
                           email, 
                           role, 
                           Password) 
                   VALUES ('$firstname', 
                           '$lastname', 
                           '$photo',  
                           '$email', 
                           '$role', 
                           '$hashedPwd')";
if ($conn->query($sql) === TRUE) {
    header("Location: users.php?new-user-added"); 
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}
?>
