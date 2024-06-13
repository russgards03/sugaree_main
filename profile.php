<?php
include_once 'config/config.php';

if (isset($_SESSION['valid'])) {
    $user_email = $_SESSION['valid'];
    $user_firstname = $_SESSION['user_firstname'];
	$user_lastname = $_SESSION['user_lastname'];
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['id'];

    echo "<div class='user-details'>
        <p>Welcome $user_firstname $user_lastname</p>
        <p> Username: $user_name <br>Email: $user_email </p>

        <a href='logout.php'><button class='btn'>Logout</button></a>
        <a href='index.php'><button class='btn'>Home</button></a>
        </div>";
} else {
    header("Location: login_register.php");
    exit();
}
?>