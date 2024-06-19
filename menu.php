<?php
include 'config/config.php';

// Get the category from the query parameter
$category = isset($_GET['category']) ? $_GET['category'] : '';

try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtCategoryDishes = $pdo->prepare("SELECT * FROM tbl_dishes WHERE dish_category = :category");
    $stmtCategoryDishes->execute(['category' => $category]);
    $categoryDishes = $stmtCategoryDishes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <nav class="navbar">
        <a class="active" href="#dishes">All Dishes</a>
        <a href="">Pastry</a>
        <a href="">Coffee</a>
        <a href="">Pizza</a>
        <a href="">Gelato</a>
        <a href="index.php"> Home </a>
    </nav>
    </header>

<section class="menu" id="menu">
    <h3 class="sub-heading"> Category: <?php echo htmlspecialchars($category); ?> </h3>
    <h3 class="heading"> Dishes </h3>

    <div class="box-container">
        <?php foreach ($categoryDishes as $dish): ?>
        <div class="menu-images">
            <img src="<?php echo htmlspecialchars($dish['dish_img']); ?>" alt="">
            <h3><?php echo htmlspecialchars($dish['dish_name']); ?></h3>
            <span>₱ <?php echo number_format($dish['dish_price'], 2); ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>