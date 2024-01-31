<?php

session_start();
require 'database.php';

//  if status = not active - redirect to login page)
if(!isset($_SESSION['status'])){
    header('location: login.php');
    exit();
  } 
  
// can't access this page if the user isn't an admin
if($_SESSION['role'] !=0){
    header("location: dashboard.php");
    exit();
}

        $sql         = "SELECT * FROM recipes;";
        $result      = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);


        if ($resultCheck > 0) {
            while ($recipe = mysqli_fetch_assoc($result)) {
                if($id = $_GET['id'] == $recipe['RecipeID']){
                  $id           = $recipe['RecipeID'];
                  $recipeName   = $recipe['RecipeName'];
                  $description  = $recipe['Description'];
                  $photo        = $recipe['Photo'];
                  $prepTime     = $recipe['PreparationTime'];
                  $cookTime     = $recipe['CookTime'];
                  $servings     = $recipe['Servings'];
                  $ingredients  = $recipe['Ingredients'];
                  $steps        = $recipe['Steps'];
            }
        }
    }else{
        header("location: recipes.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Recipe</title>
    <link rel="stylesheet" href="css/add-update.css">
</head>
<body>

    <main>
        <div class="form-container">
                <div class="signup-container">
                    <form action="save-recipe.php?updateID=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="text">
                            <h2>Update Recipe</h2>
                        </div>
                        <div id="current-image">
                            <img src="uploads/<?php echo $photo; ?>" name="photo" alt="Recipe Image">
                        </div>

                        <div class="image">
                            <label for="image">Change Image:</label>
                            <input type="file" id="image" name="photo" accept="image/*">
                        </div>
                        </div>
                        <label for="name">Recipe Name:</label>
                        <input type="text" id="recipeName" name="recipeName" value="<?php echo $recipeName;?>" required>
                        <div>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="3" required><?php echo $description;?></textarea>
                        </div>
                       
                        <div class="time">
                            
                            <div>
                            <label for="prepTime">Prep Time:</label>
                            <input type="text" id="prepTime" name="prepTime" value="<?php echo $prepTime;?>"  required>
                            </div>

                            <div>
                            <label for="cookTime">Cook Time:</label>
                            <input type="text" id="cookTime" name="cookTime" value="<?php echo $cookTime;?>" required>
                            </div>
                        </div>

                        <label for="servings">Servings:</label>
                        <input type="number" id="servings" name="servings" value="<?php echo $servings;?>" required>

                        <div>
                        <label for="ingredients">Ingredients:</label>
                        <textarea id="ingredients" name="ingredients" rows="3" required> <?php echo $ingredients;?></textarea>
                        <label for="steps">Steps:</label>
                        <textarea id="steps" name="steps" rows="3" required> <?php echo $steps;?></textarea>
                        </div>

                        <div class="button-container">
                            <button type="submit">Submit Recipe</button>
                            <button class="back"><a href="recipes.php">Back</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
