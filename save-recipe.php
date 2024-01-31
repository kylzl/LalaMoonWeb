<?php

session_start();
require 'database.php';

//  checks the recipeID from the url
//  gets form data from update-recipe.php
if(isset($_GET['updateID'])){
  $id          = $_GET['updateID'];  
  $recipeName  = $_POST['recipeName'];
  $description = $_POST['description'];
  $photo       = $_FILES['photo']['name'];
  $prepTime    = $_POST['prepTime'];
  $cookTime    = $_POST['cookTime'];
  $servings    = $_POST['servings'];
  $ingredients = $_POST['ingredients'];
  $steps       = $_POST['steps'];


$sql = "SELECT Photo FROM recipes WHERE RecipeID = $id";
$result = mysqli_query($conn, $sql);
$existingPhoto = mysqli_fetch_assoc($result)['Photo'];

if ($_FILES['photo']['name']) {
  $photo = $_FILES['photo']['name'];
} else {
  $photo = $existingPhoto;
}

$sql = "UPDATE recipes SET RecipeName       = '$recipeName', 
                           Description      = '$description',
                           Photo            = '$photo',
                           PreparationTime  = '$prepTime',
                           CookTime         = '$cookTime',
                           Servings         = '$servings',
                           Steps            = '$steps'
                     WHERE RecipeID         = '$id'";

if($conn->query($sql)){
  header("location: recipes.php?recipe-updated");
}

  if (!$conn->query($sql)) {
    $error_message = $conn->error;
}
}