<?php

session_start();
require 'database.php';

// can't access this page if the user isn't an admin
if  ($_SESSION['role'] != 0){
    header("location: dashboard.php");
    exit();
}

$recipeID = $_GET['id'];
$sql = "DELETE FROM Recipes WHERE RecipeID='$recipeID'";

if ($conn->query($sql) === TRUE) {
    header("location: recipes.php");
} 