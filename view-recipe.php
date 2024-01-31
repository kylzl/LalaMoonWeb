<?php
session_start();
require 'database.php';

if(!isset($_SESSION['status'])){
    header("location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM recipes WHERE RecipeID = '$id'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0){
        $recipe = mysqli_fetch_assoc($result);
        $recipeName = $recipe['RecipeName'];
        $description = $recipe['Description'];
        $photo = $recipe['Photo'];
        $prepTime = $recipe['PreparationTime'];
        $cookTime = $recipe['CookTime'];
        $servings = $recipe['Servings'];
        $ingredients = $recipe['Ingredients'];
        $steps = $recipe['Steps'];
    } else {
        echo "Not Found";
        exit();
    }
} else {
    header("location: recipes.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe</title>
    <link rel="stylesheet" href="css/view-recipe.css">
</head>
<body>
    <main>
        
        <img src="uploads/<?php echo $photo; ?>" alt="Recipe Photo">


        
        <div class="content">
            <h1><?php echo $recipeName; ?></h1>
            <div class="description">
                <h3 >Description:</h3>
                <p><?php echo $description; ?></p>
            </div>
            
            <div class="grid">
                <div  class="border">
                    <h3>Preparation Time:</h3>
                    <p><?php echo $prepTime; ?></p>
                </div>
                <div  class="border">
                    <h3>Cook Time:</h3>
                    <p><?php echo $cookTime; ?></p>
                </div>
                <div class="border">
                    <h3>Servings:</h3>
                    <p><?php echo $servings; ?></p>
                </div>
            </div>  
            
            <h3>Ingredients:</h3>
            <p><?php echo $ingredients; ?></p>
            
            <h3>How to Make : <?php echo $recipeName; ?></h3>
            <p><?php echo $steps; ?></p>
        </div>
    </main>
</body>
</html>
