<?php
include 'config/config.php';
include_once 'class/class.user.php';
include_once 'class/class.dish.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';
$dish_id = isset($_GET['dish_id']) ? $_GET['dish_id'] : '';


/* Define Object */
$user = new User();
$dish = new Dish();

/* Checks if the user is logged in */
if(!$user->get_session()){
    $user_identifier = "N/A";
} else {
    $user_identifier = $_SESSION['user_identifier'];
}

$user_id = $user->get_user_id($user_identifier);
$user_role = $user->get_user_role($user_id);


if(!$user == 'Admin'){
    header("location: menu.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
  
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
   
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    
    <link rel="stylesheet" href="css/style3.css">
    
</head>

<body>

    <section style="background-image: url(assets/images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                            <p class="sec-sub-title mb-3">Admin - Add Dish</p>
                            <h2 class="h2-title">Add a Dish</span></h2>
                            <div class="sec-title-shape mb-4">
                                <img src="assets/images/title-shape.svg" alt="">
                                <a href="menu.php" class="button">Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-tab-wp">
                    <div class="row">
                        <div class="col-lg-12 m-auto">
                            
                        </div>
                    </div>
                </div>

                <input type="file" name="image" required />
                <button type="submit" name="submit">Upload Photo</button>

                
        <form action="process/process.dish.php?action=new" method="post">
        <div class="review-box">
            <br>
                <h3>Fill in the details</h3>
            <div>
                <label>Dish Name: </label>  
                <input type="text" class="input-field" name="dish_name" autocomplete="off" placeholder="Ex. Pepperoni Pizza" required>
            </div>
            <br>
            <div>
                <label>Choose Category: </label>  
                <select name="dish_category" class="input-field" required>
                    <option value="">Select a category</option>
                    <option value="Appetizers">Appetizers</option>
                    <option value="Donuts">Donuts</option>
                    <option value="Sandwiches">Sandwiches</option>
                </select>
            </div>
            <br>
            <div>
                <label>Choose Popularity: </label>  
                <select name="dish_popularity" class="input-field" required>
                    <option value="">Put in main page?</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <br>
            <div>
                <label>Dish Description: </label>  
                <input type="text" class="input-field" name="dish_description" autocomplete="off" placeholder="Ex. Pepperoni Pizza" required>
            </div>
            <br>
            
            <div><input type="submit" name="add_dish" value="Add Dish"></div>
        </form>
        </div>
   
            </div>
        </div>
    </section>
</body>
</html>