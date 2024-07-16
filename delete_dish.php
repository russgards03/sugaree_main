<?php
include 'config/config.php';
include 'class/class.dish.php';

$dish = new Dish();
$dish_id = isset($_GET['dish_id']) ? $_GET['dish_id'] : '';

if (!$dish_id) {
    echo "No dish ID provided!";
    exit;
}

$result = $dish->delete_dish($dish_id);

if ($result) {
    header("Location: menu.php"); // Redirect back to the menu page after deletion
} else {
    echo "Error deleting dish!";
}
?>