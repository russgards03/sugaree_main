<?php
include '../class/class.dish.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'new':
        create_new_dish();
        break;
    case 'update':
        update_dish();
        break;
    case 'delete':
        delete_dish();
        break;
}

function create_new_dish(){
    $dish = new Dish();
    
    // Check if the keys exist in $_POST before accessing them
    if(isset($_POST['dish_name'], $_POST['dish_popularity'], $_POST['dish_category'], $_POST['dish_description'])){
        $dish_name = $_POST['dish_name'];
        $dish_popularity = $_POST['dish_popularity'];
        $dish_category = $_POST['dish_category'];
        $dish_description = $_POST['dish_description'];

        // Call the new_dish method
        $dish->new_dish($dish_name, $dish_popularity, $dish_category, $dish_description);
    } else {
        echo "Error: Missing form data.";
    }
}

function update_dish() {
    $dish = new Dish();
    
    $dish_id = $_POST['dish_id'];
    $dish_name = $_POST['dish_name'];
    $dish_popularity = $_POST['dish_popularity'];
    $dish_category = $_POST['dish_category'];
    $dish_description = $_POST['dish_description'];
    
    $result = $dish->update_dish($dish_id, $dish_name, $dish_popularity, $dish_category, $dish_description);
    
    if ($result) {
        header("Location: ../menu.php");
        exit();
    } else {
        echo "Failed to update dish!";
    }
}
?>
