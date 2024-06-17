<?php
include_once 'config/config.php';
include_once 'class/class.user.php';

/*Define Object*/
$user = new User();

/*Checks if the user inputs (username and password) matches with that of the database */
if(!$user->get_session()){
	header("location: login_register.php");
}

    /*$user_email = $_SESSION['valid'];
    $user_firstname = $_SESSION['user_firstname'];
	$user_lastname = $_SESSION['user_lastname'];*/
    $user_name = $_SESSION['user_name'];
    /*$user_id = $_SESSION['id'];*/

    echo "<div class='user-details'>
        <p>Welcome </p>
        <p> Username: $user_name <br>Email:  </p>

        <a href='logout.php'><button class='btn'>Logout</button></a>
        <a href='index.php'><button class='btn'>Home</button></a>
        </div>";

?>