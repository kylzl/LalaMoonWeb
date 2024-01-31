<?php

session_start();
require 'database.php';

// can't access this page if the user isn't an admin
if($_SESSION['role'] !=0){
    header("location: dashboard.php");
    exit();
}

$userid = $_GET['userid'];
$sql = "DELETE FROM users WHERE UserID='$userid'";

if ($conn->query($sql) === TRUE) {
    header("location: users.php");
} 