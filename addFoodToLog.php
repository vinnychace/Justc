<?php
session_start();
require_once 'models/database.php'; 
require_once 'models/logmodel.php'; 
require_once 'models/itemmodel.php'; 

$user_radial_button = filter_input(INPUT_POST, "user_radial_button");
//$Type_meal = htmlspecialchars(filter_input(INPUT_POST, "Type_meal"));

if ($user_radial_button === "Breakfast") {
    $Meal = 1;
} elseif ($user_radial_button === "Lunch") {
    $Meal = 2;
} elseif ($user_radial_button === "Dinner") {
    $Meal = 3;
} else {
    // Handle unexpected value or no selection
    $Meal = 0; // or another default value or error handling
}

if (isset($_POST['Myfood_ID'])) {
    $foodItemId = $_POST['Myfood_ID'];
    // Remaining logic...
}

if (isset($_POST['Myfood_ID'])) {
    $foodItemId = $_POST['Myfood_ID'];
    echo "Food ID".$foodItemId;
    
    $foodItem = select_single_fooditem($foodItemId);
    
    $userId = $_SESSION['user_id'] ?? null; // Ensure you have user authentication in place
    
    if ($foodItem && $userId) {
        $date = date('Y-m-d');
        $description = $foodItem['Description'];
        $calories = $foodItem['Calories'];
        $portion = $foodItem['Portion'];
        $unit = $foodItem['Unit'];
    
        
        $thefood = new foodlog($userId, $date, $Meal, $description, $calories, $portion, $unit);
        
        insert_foodlog($thefood);
        
        header('Location: total.php'); // Adjust the redirect as necessary
        exit();
    } else {

        echo "Error: Food item not found or user not logged in.";
    }
} else {

    echo "Error: No food item selected.";
}
