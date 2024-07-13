<?php
/*Include User Class File */
include '../class/class.user.php';

/*Parameters for switch case*/
$action = isset($_GET['action']) ? $_GET['action'] : '';

/*Switch case for actions in the process */
switch($action){
	case 'new':
        create_new_user();
	break;
    case 'update':
        update_user();
	break;
    case 'delete':
        delete_user();
    break;
}

/*Main Function Process for creating an user */
function create_new_user(){
    $user = new User();
    /*Receives the parameters passed from the creation page form */
    $user_firstname = ucfirst($_POST['firstname']);
    $user_lastname = ucfirst($_POST['lastname']);
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $user_status = $_POST['status'];
    $user_role = "Customer";

    $password = md5($user_password);

    /*$verify_query = mysqli_query($con, "SELECT user_email FROM tbl_users WHERE user_email='$user_email'");*/

    /* Check if the username or email already exists */
    if ($user->user_exists($user_name, $user_email)) {
        echo "<div id='error_box'><div id='error_notif'>Username or email already exists.</div></div>";
        header("location: ../login_register.php");
    } else {
        /* Pass the parameters to the class function */
        $result = $user->new_user($user_firstname,$user_lastname,$user_name,$user_email,$password,$user_status,$user_role);
        if($result){
            header("location: ../login_register.php");
        }
    }
}

/*Main Function Process for updating an admin */
function update_user(){  
    $user = new User();
    /*Receives the parameters passed from the profile updating page form */
    $user_id = $_POST['userid'];
    $user_firstname = ucfirst($_POST['firstname']);
    $user_lastname = ucfirst($_POST['lastname']);
    
    /*Passes the parameters to the class function */
    $result = $user->update_user($user_id,$user_firstname,$user_lastname);
    if($result){
        header("location: ../profile.php");
    }
}

/*Main Function Process for deleting an admin */
function delete_admin(){
    if (isset($_POST['adm_username'])) {
        $admin = new Admin();
        $id = $_POST['adm_username'];
        $result = $admin->delete_admin($id);
        if ($result) {
            header("location: ../index.php?page=admins");
        } 
    }
}

function update_user_image(){
    $user = new User();
    /*Receives the parameters passed from the profile updating page form*/
    $user_id = $_POST['userid'];
    $user_image = $_POST['image'];

    /*Passes the parameters to the class function*/
    $result = $user->update_user($user_id,$user_image);
    if($result){
        header("location: ../profile.php");
    }
}


?>