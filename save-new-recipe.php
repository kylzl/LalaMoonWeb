<?php

require 'database.php';

//  getting form data from add-recipe.php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $recipeName  = $_POST["recipeName"];
    $description = $_POST["description"];
    $photo       = $_FILES["photo"]["name"];
    $prepTime    = $_POST["prepTime"];
    $cookTime    = $_POST["cookTime"];
    $servings    = $_POST["servings"];
    $ingredients = $_POST["ingredients"];
    $steps       = $_POST["steps"]; 
}

if (isset($_FILES["photo"])) {
    $photo       = $_FILES["photo"]["name"];
    $temp_image  = $_FILES["photo"]["tmp_name"];
    $upload_dir  = "uploads/";
    move_uploaded_file($temp_image, $upload_dir . $photo);
    $sql         = "INSERT INTO recipes (Photo) VALUES ('$photo')";
}
$sql = "INSERT INTO recipes (
            RecipeName, 
            Description, 
            Photo, 
            PreparationTime, 
            CookTime, 
            Servings, 
            Ingredients, 
            Steps) 
        VALUES (
            '$recipeName', 
            '$description', 
            '$photo', 
            '$prepTime', 
            '$cookTime', 
            '$servings', 
            '$ingredients', 
            '$steps')";
$conn->query($sql) === TRUE ? header("location: recipes.php?new-recipe-added") : die("Error: " . $sql . "<br>" . $conn->error);



$conn->close();