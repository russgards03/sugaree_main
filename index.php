<?php
include 'config/config.php';
include_once 'class/class.user.php';

$user = new User();

$user_identifier = $_SESSION['user_identifier'];
$user_id = $user->get_user_id($user_identifier);
$user_firstname = $user->get_user_fname($user_id);

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtSpecialties = $pdo->query("SELECT * FROM tbl_specialties");
    $specialties = $stmtSpecialties->fetchAll(PDO::FETCH_ASSOC);

    $stmtDishes = $pdo->prepare("SELECT * FROM tbl_dishes WHERE dish_popularity = :popularity");
    $stmtDishes->execute(['popularity' => 'popular']);
    $dishes = $stmtDishes->fetchAll(PDO::FETCH_ASSOC);

    $stmtImages = $pdo->query("SELECT * FROM tbl_images");
    $images = $stmtImages->fetchAll(PDO::FETCH_ASSOC);

    $stmtReviews = $pdo->query("SELECT r.*, u.user_firstname, u.user_lastname 
                                  FROM tbl_review r 
                                  INNER JOIN tbl_users u ON r.user_id = u.user_id");
    $review = $stmtReviews->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

$apiKey = 'AIzaSyAMlZBObSXdu1YYL6w2bq5JxLrJkGEd71s';
$videoId = '48bVT1KD78I';

$apiUrl = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$videoId}&key={$apiKey}";
$videoData = json_decode(file_get_contents($apiUrl), true);

if (!empty($videoData['items'])) {
    $videoTitle = $videoData['items'][0]['snippet']['title'];
    $videoDescription = $videoData['items'][0]['snippet']['description'];
    $videoThumbnail = $videoData['items'][0]['snippet']['thumbnails']['high']['url'];
    $videoEmbedUrl = "https://www.youtube.com/embed/{$videoId}";
} else {
    $videoTitle = 'Video not found';
    $videoDescription = '';
    $videoThumbnail = '';
    $videoEmbedUrl = '';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sugaree Cafe & Gelato</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">

        <script src="js/script.js"></script>
    </head>
    <body>
        <header>
            <a href="#" class="logo"><img src="img/logo.png" alt="Sugaree Logo">Sugaree</a>
            <nav class="navbar">
                <a class="active" href="#home">Home</a>
                <a href="#dishes">Dishes</a>
                <a href="#about">About</a>
                <a href="#gallery">Gallery</a>
                <a href="#review">Review</a>
                <div class="dropdown">
                    <a href="#" class="dropbtn">Order</a>
                    <div class="dropdown-content">
                        <a href="#"><img src="img/grab.png" alt="Grab Logo" class="logo"> Grab</a>
                        <a href="#"><img src="img/foodpanda.png" alt="FoodPanda Logo" class="logo"> FoodPanda</a>
                        <a href="https://www.facebook.com/EboyRiderOfficialPage" target="_blank"><img src="img/eboy.jpg" alt="Eboy Logo" class="logo"> Eboy</a>
                    </div>
                </div>
            </nav>

            <div class="icons">
                <i class="fas fa-bars" id="menu-bars"></i>
                <i class="fas fa-search" id="search-icon"></i>
                <a href="#" class="fas fa-heart"></a>
                <a href="profile.php" id="loginLink" class="fas fa-user"></a> 
                <button id="profileButton" class="fas fa-user" style="display:none; border: none; background: none; cursor: pointer;"></button>
            </div>
        </header>

        <form action="" id="search-form">
            <input type="search" name="" id="search-box">
            <label for="search-box" placeholder="Search here..." class="fas fa-search"></label>
            <i class="fas fa-times" id="close"></i>
        </form>

        <section class="home" id="home">
            <div class="swiper-container home-slider">
                <div class="swiper-wrapper wrapper">
                    <?php 
                    if (!empty($specialties)) {
                        foreach ($specialties as $specialties): 
                    ?>
                    <div class="swiper-slide slide">
                        <div class="content">
                            <span> Our specialty </span>
                            <h3><?php echo $specialties['specialty_title']; ?></h3>
                            <p><?php echo $specialties['specialty_desc']; ?></p>
                            <a href="menu.php" class="btn">Order Now</a>
                        </div>
                        <div class="image">
                            <img src="<?php echo $specialties['specialty_img']; ?>" alt="<?php echo $slide['specialty_title']; ?>">
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    } else {
                        echo '<p>No specialties found.</p>';
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <section class="dishes" id="dishes">
        <h3 class="sub-heading"> Our Dishes </h3>
        <h3 class="heading"> Popular Dishes </h3>

            <div class="box-container">
                <?php foreach ($dishes as $dish): ?>
                <div class="box">
                    <img src="<?php echo htmlspecialchars($dish['dish_img']); ?>" alt="">
                    <h3><?php echo htmlspecialchars($dish['dish_name']); ?></h3>
                    <span>₱ <?php echo number_format($dish['dish_price'], 2); ?></span>
                    <a href="menu.php?category=<?php echo urlencode($dish['dish_category']); ?>" class="btn">Go to Menu</a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

<section class="about" id="about">
        <h3 class="sub-heading"> About Sugaree </h3>
        <h1 class="heading"> Why choose Sugaree? </h1>

        <div class="row">
            <div id="youtube-player">
            </div>

<script>

    // Function called when the YouTube IFrame API is ready
    function onYouTubeIframeAPIReady() {
        // Create a new YouTube player instance
        const player = new YT.Player('youtube-player', {
            height: '750',
            width: '1500',
            videoId: 'oC5KWOCHb7g', 
            playerVars: {
                'autoplay': 0, 
                'loop': 1,     
                'controls': 1, 
                'rel': 0       
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });

        // Function to start the video when player is ready
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // Function to loop the video when it ends
        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                event.target.seekTo(0); // Seek to the beginning
                event.target.playVideo(); // Play the video again
            }
        }
    }

</script>

<div class="content">
    <h3>The only one on Bacolod that serves Gelato</h3>
    <p>It has been the dream of Mrs. Eylonah Strauss to have her very own bakery. Her true passion of creating tasty sweets
        for people to eat. Right now, we introduce a new journey for us both, creating outside the lines of our comfort zones
        with a concept of coffee, gelato, bakery, pizza, and cafe. We are excited to join the amazing hospitality & business community
        here in Bacolod. </p>
    <p>
        Pair your gelato with our specialty coffee brewed to perfection, and you have a match made in dessert heaven. 
    Whether you're catching up with friends or treating yourself to a moment of bliss, 
    Sugaree Cafe and Gelato promises a sweet escape you won't soon forget. </p>

    <div class="icons-container">
        <div class="icons">
            <i class="fas fa-shipping-fast"></i>
            <span>available for delivery</span>
        </div>
        <div class="icons">
            <i class="fas fa-dollar-sign"></i>
            <span>easy payments</span>
        </div>
        <div class="icons">
            <i class="fas fa-headset"></i>
            <span>fast service</span>
        </div>
    </div>
    <a href="#" class="btn">learn more</a>

</div>
</div>
    </section>

    <section class="gallery" id="gallery">
        <input type="radio" name="Photos" id="check1" checked>
        <input type="radio" name="Photos" id="check2">
        <input type="radio" name="Photos" id="check3">
        <input type="radio" name="Photos" id="check4">

        <div class="container">
            <h1> Our Photo Gallery</h1>
            <div class="top-content">
                <h3>Photo Gallery</h3>
                <label for="check1">All</label>
                <label for="check2">Crew</label>
                <label for="check3">Place</label>
                <label for="check4">Food</label>
            </div>

            <div class="photo-gallery">
                <?php
                if (!empty($images)) {
                    foreach ($images as $image) {
                        echo '<div class="pic ' . $image['image_category'] . '">';
                        echo '<img src="' . $image['image_src'] . '" alt="' . $image['image_alt'] . '">';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No images found.</p>';
                }
                ?>
            </div>

        </div>
    </section>

    <script>

            function handleRadioChange() {
            const picsContainer = document.querySelector('.pics-container');
            const radioButtons = document.querySelectorAll('input[name="Photos"]:checked');

            if (radioButtons.length === 0) {
                return;
            }

            const category = radioButtons[0].id.replace('check', ''); // Extract category number

            const allPics = document.querySelectorAll('.pic');
            allPics.forEach(pic => {
                pic.style.display = 'none'; // Hide all images initially
            });

            if (category === '1') {
            // Show all images when 'All' is selected
            allPics.forEach(pic => {
                pic.style.display = 'block';
                });
            } else if (category === '2') {
                // Show only 'Crew' images when 'Crew' is selected
                const crewPics = document.querySelectorAll('.pic.crew');
                crewPics.forEach(pic => {
                    pic.style.display = 'block';
                });
            } else if (category === '3') {
                // Show only 'Place' images when 'Place' is selected
                const placePics = document.querySelectorAll('.pic.place');
                placePics.forEach(pic => {
                    pic.style.display = 'block';
                });
            } else if (category === '4') {
                // Show only 'Food' images when 'Food' is selected
                const foodPics = document.querySelectorAll('.pic.food');
                foodPics.forEach(pic => {
                    pic.style.display = 'block';
                });
            }
        }

            const radioButtons = document.querySelectorAll('input[name="Photos"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', handleRadioChange);
            });

            handleRadioChange();
    </script>

<section class="review" id="review">
        <h3 class="sub-heading">People's Reviews</h3>
        <h1 class="heading">What They Think</h1>
        <div class="swiper-container review-slider">
            <div class="swiper-wrapper">
                <?php foreach ($review as $review): ?>
                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <!-- You can customize the user info based on your database structure -->
                            <img src="img/user.jpg" alt="">
                            <div class="user-info">
                                <h3><?php echo htmlspecialchars($review['user_firstname']); ?></h3>
                                <div class="stars">
                                    <?php 
                                    // Assuming review_rating is a float from 1 to 5
                                    $rating = floatval($review['review_rating']);
                                    
                                    // Determine whole stars (integer part)
                                    $wholeStars = floor($rating);
                                    
                                    // Determine fractional star (if any)
                                    $fractionalStar = $rating - $wholeStars;
                                    
                                    // Display whole stars
                                    for ($i = 1; $i <= $wholeStars; $i++) {
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    
                                    // Display fractional star if needed
                                    if ($fractionalStar > 0) {
                                        echo '<i class="fas fa-star-half-alt"></i>'; // or any other half star icon
                                    }
                                    
                                    // Display remaining empty stars (if any)
                                    $emptyStars = 5 - ceil($rating); // ceil to get the number of empty stars needed
                                    for ($i = 1; $i <= $emptyStars; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <p><?php echo htmlspecialchars($review['review_content']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<section class="footer">


    <div class="box-container">
        <div class="box">
            <h3>locations</h3>
            <a href="#">Bacolod City</a>

        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#">Home</a>
            <a href="#">Dishes</a>
            <a href="#">About</a>
            <a href="#">Gallery</a>
            <a href="#">Review</a>
        </div>
        <div class="box">
            <h3>Contact info</h3>
            <a href="#">09218127464</a>
            <a href="#">09695213199</a>
            <a href="#">+123-456-7890</a>
            <a href="#">+113-136-7394</a>
            <a href="#">+143-176-7240</a>
            
        </div>
        <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/profile.php?id=61555400134289" target="_blank"><img src="img/facebook.png" alt="Facebook Logo" class="logo"> Facebook</a>
            <a href="https://www.instagram.com/yourpage" target="_blank"><img src="img/instagram.png" alt="Instagram Logo" class="logo"> Instagram</a>
            <a href="https://www.youtube.com/yourchannel" target="_blank"><img src="img/youtube.png" alt="YouTube Logo" class="logo"> YouTube</a>
        </div>
    </div>
</div>

<div class="credit"> copyright @ 2024 by <span>iBento Creatives - Dyne-Russ-Romeo </span></div>

    </div>

</section>

</section>

</section>

</section>

</section>

    </head>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

</body>
</html>