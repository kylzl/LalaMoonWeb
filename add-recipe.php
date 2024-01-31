<?php

session_start();

//  if status = not active - redirect to login page)
if (!isset($_SESSION['status'])){
    header("location: login.php");
    exit();
}

// can't access this page if the user isn't an admin
if  ($_SESSION['role'] != 0){
    header("location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="css/add-update.css">
</head>
<body>

    <main>
        <div class="form-container">
              <div class="signup-container">
                    <form action="save-new-recipe.php" method="POST" enctype="multipart/form-data">
                        <div class="text">
                            <h2>Add Recipe</h2>
                        </div>
                        <div class="image">
                            <label for="image">Add Image:</label>
                            <input type="file" id="image" name="photo" accept="image/*" required>
                        </div>
                        <label for="name">Recipe Name:</label>
                        <input type="text" id="recipeName" name="recipeName" required>
                        <div>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="3" required></textarea>
                        </div>
                       
                        <div class="time">
                            
                            <div>
                            <label for="prepTime">Prep Time:</label>
                            <input type="text" id="prepTime" name="prepTime" placeholder="10 minutes" required>
                            </div>

                            <div>
                            <label for="cookTime">Cook Time:</label>
                            <input type="text" id="cookTime" name="cookTime" placeholder="30 minutes" required>
                            </div>
                        </div>

                        <label for="servings">Servings:</label>
                        <input type="number" id="servings" name="servings" required>

                        <div>
                        <label for="ingredients">Ingredients:</label>
                        <textarea id="ingredients" name="ingredients" rows="3" required></textarea>
                        <label for="steps">Steps:</label>
                        <textarea id="steps" name="steps" rows="3" required></textarea>
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
