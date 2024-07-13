<?php
include 'config/config.php';
include 'class/class.dish.php';

$dish = new Dish();
$dish_id = isset($_GET['dish_id']) ? $_GET['dish_id'] : '';

if(!$dish_id){
    echo "No dish ID provided!";
    exit;
}

echo "Dish ID: " . $dish_id . "<br>"; // Debugging line to check the dish_id

$dish_details = $dish->get_dish($dish_id);

if(!$dish_details){
    echo "Dish not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dish</title>
</head>
<body>
    <form action="process/edit.dish.php?action=update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="dish_id" value="<?php echo $dish_details['dish_id']; ?>">
        <div class="review-box">
            <br>
            <h3>Edit Dish Details</h3>
            <div>
                <label>Dish Name: </label>  
                <input type="text" class="input-field" name="dish_name" autocomplete="off" placeholder="Ex. Pepperoni Pizza" value="<?php echo $dish_details['dish_name']; ?>" required>
            </div>
            <br>
            <div>
                <label>Choose Category: </label>  
                <select name="dish_category" class="input-field" required>
                    <option value="">Select a category</option>
                    <option value="Appetizers" <?php if($dish_details['dish_category'] == 'Appetizers') echo 'selected'; ?>>Appetizers</option>
                    <option value="Donuts" <?php if($dish_details['dish_category'] == 'Donuts') echo 'selected'; ?>>Donuts</option>
                    <option value="Sandwiches" <?php if($dish_details['dish_category'] == 'Sandwiches') echo 'selected'; ?>>Sandwiches</option>
                </select>
            </div>
            <br>
            <div>
                <label>Choose Popularity: </label>  
                <select name="dish_popularity" class="input-field" required>
                    <option value="">Put in main page?</option>
                    <option value="Yes" <?php if($dish_details['dish_popularity'] == 'Yes') echo 'selected'; ?>>Yes</option>
                    <option value="No" <?php if($dish_details['dish_popularity'] == 'No') echo 'selected'; ?>>No</option>
                </select>
            </div>
            <br>
            <div>
                <label>Dish Description: </label>  
                <input type="text" class="input-field" name="dish_description" autocomplete="off" placeholder="Ex. Pepperoni Pizza" value="<?php echo $dish_details['dish_description']; ?>" required>
            </div>
            <br>
            <div>
                <label>Dish Image: </label>
                <input type="file" name="dish_image">
                <?php if($dish_details['dish_image']) { ?>
                    <img src="uploads/<?php echo $dish_details['dish_image']; ?>" alt="<?php echo $dish_details['dish_name']; ?>" width="100">
                <?php } ?>
            </div>
            <br>
            <div>
                <input type="submit" name="update_dish" value="Update Dish">
            </div>
        </div>
    </form>
</body>
</html>
