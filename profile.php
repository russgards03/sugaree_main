<?php
include_once 'config/config.php';
include_once 'class/class.user.php';

/* Define Object */
$user = new User();

/* Checks if the user is logged in */
if(!$user->get_session()){
    header("location: login_register.php");
    exit();
}

/*Parameter variables for the navbar*/
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';

/* Get user logged in details */
$user_identifier = $_SESSION['user_identifier'];
$user_id = $user->get_user_id($user_identifier);
$user_name = $user->get_user_name($user_id);
$user_email = $user->get_user_email($user_id);
$user_firstname = $user->get_user_fname($user_id);
$user_lastname = $user->get_user_lname($user_id);
$user_review = $user->get_user_review($user_id);
$user_rating = $user->get_user_rating($user_id);
$user_status = $user->get_user_status($user_id);
$user_role = $user->get_user_role($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="css/styleprofile.css"> <!-- Ensure this path is correct -->
</head>
<body>
<nav>
    <img src="img/logo.png">
    <label class="logo">Sugaree</label>
        <div class="center">
            <div class="prof_nav">
                <ul>
                    <div class="nav-options">
                        <li><button><a href="profile.php?subpage=profile">Profile</a></button></li>
                        <li><button><a href="profile.php?subpage=review">Review</a></button></li>
                    </div>
                </ul>
            </div>
        </div>
        <div class="main_nav">
            <ul>
                <li><span class="home"><button><a href="index.php">Home</a></button></span></li>
                <li><span class="logout"><button><a href="logout.php">Logout</a></button></span></li>
            </ul>
        </div>
</nav>
    
<?php
switch($subpage){
    case 'profile':
        require_once 'profile-about.php';
    break;
    case 'review':
        require_once 'review.php';
    break;
    default:
        require_once 'profile-about.php';
    break;
}
?>

<h4>Copyright @ 2024 By Ibento Creatives</h4>

</body>
</html>