<?php

$dbname = "lalamoonDB";
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $dbname";

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

$conn = new mysqli($servername, $dbusername, $dbpassword);


$tableOne = "users";
$sqlCreateTableUsers = "CREATE TABLE IF NOT EXISTS $tableOne (
    UserID INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(30) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    Photo VARCHAR(255) NOT NULL,
    Gender VARCHAR(30) DEFAULT 'other',
    PhoneNumber VARCHAR(15) DEFAULT ' ',
    Email VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role INT(1) DEFAULT 1
)";

$tableTwo = "recipes";
$sqlCreateTableRecipes = "CREATE TABLE IF NOT EXISTS $tableTwo (
    RecipeID INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    RecipeName VARCHAR(255) unique NOT NULL,
    Description text NOT NULL,
    Photo VARCHAR(255) NOT NULL,
    PreparationTime VARCHAR(15) NOT NULL,
    CookTime VARCHAR(15) NOT NULL,
    Servings VARCHAR(11) NOT NULL,
    Ingredients text NOT NULL,
    Steps text NOT NULL
)";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!$conn->query($sqlCreateDatabase) === TRUE) {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db($dbname);

if (!$conn->query($sqlCreateTableUsers) === TRUE) {
    echo "Error creating table users: " . $conn->error;
}

if (!$conn->query($sqlCreateTableRecipes) === TRUE) {
    echo "Error creating table users: " . $conn->error;
}