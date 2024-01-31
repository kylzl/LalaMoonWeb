<?php
session_start();
require 'database.php';
if(!isset($_SESSION['status'])){
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="css/recipes.css">


<body>
    <aside>
        <div>
        <div class="brand">
                <a href="index.html"><img src="images/lalamoon-brand-name.png" alt="lalamoon-brand-name"></a>
            </div>
        
            <a href="dashboard.php"> <div class="nav-item" id="dashboard">Dashboard</div></a>
            <a href="recipes.php"><div class="nav-item" id="recipes">Recipes</div></a>
            <?php echo ($_SESSION['role'] == 0) ? '<a href="users.php"><div class="nav-item" id="users">Users</div></a>
                                                <a href="#"><div class="nav-item" id="unpublished-posts">Unpublished Posts</div></a>' : ''; ?>

            <a href="#"><div class="nav-item">Settings</div></a>
        </div>
        <a href="logout.php"class="log-out">Log Out</a>
    </aside>
    <main>
    <h3>
        <p>All Recipes</p>
        <?php
            if($_SESSION['role'] == 0){
                echo '<a href="add-recipe.php" class="add">Add New Recipe</a>';
            }
        ?>
        </h3>
<?php

$sql    = "SELECT * FROM recipes;";
$result = mysqli_query($conn, $sql);
if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($recipe = mysqli_fetch_assoc($result)) {
                $id           = $recipe['RecipeID'];
                $recipeName   = $recipe['RecipeName'];
                $description  = $recipe['Description'];
                $photo        = $recipe['Photo'];
                $prepTime     = $recipe['PreparationTime'];
                $cookTime     = $recipe['CookTime'];
                $servings     = $recipe['Servings'];
                $ingredients  = $recipe['Ingredients'];
                $steps        = $recipe['Steps'];
?>
<a href="view-recipe.php?id=<?php echo $recipe['RecipeID']?>">
    <div class="categories">
        <div class="recipe-item">
            <div><?php echo '<img src="uploads/' . $photo . '" alt="Recipe Photo"><br>';?></div>
            <div class="description">
                <h4><?php echo $recipeName; ?></h4>
                <h5><?php echo $description; ?></h5>
        </div>
    </div>

    <?php
        if($_SESSION['role'] == 0){
            echo '<div class="edit">
                    <a href="update-recipe.php?id=' . $recipe['RecipeID'] . '" class="blue-button">Update</a>
                    <a href="delete-recipe.php?id=' . $recipe['RecipeID'] . '"onclick="return confirm(\'Are you sure you want to delete this recipe?\')"' . 'class="delete">Delete</a>
                </div>';
        }
        ?>
    </a>
    </div>
    <?php
    }}
    ?>
    </main>
</body>
</html>