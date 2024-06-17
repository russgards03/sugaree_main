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

    $password = md5($user_password);

    /*$verify_query = mysqli_query($con, "SELECT user_email FROM tbl_users WHERE user_email='$user_email'");*/

    /* Check if the username or email already exists */
    if ($user->user_exists($user_name, $user_email)) {
        echo "<div id='error_box'><div id='error_notif'>Username or email already exists.</div></div>";
        header("location: ../login_register.php");
    } else {
        /* Pass the parameters to the class function */
        $result = $user->new_user($user_firstname,$user_lastname,$user_name,$user_email,$password);
        if($result){
            header("location: ../index.php");
        }
    }
}

/*Main Function Process for updating an admin */
function update_user(){  
    $admin = new User();
    /*Receives the parameters passed from the profile updating page form */
    $username = $_POST['adm_username'];
    $password = $_POST['adm_password'];
    $email = $_POST['adm_email'];
    $fname = ucfirst($_POST['adm_fname']);
    $lname = ucfirst($_POST['adm_lname']);
    $cnumber = $_POST['adm_cnumber'];
    $access = $_POST['adm_access'];
    
    $password = md5($password);

    /*Passes the parameters to the class function */
    $result = $admin->update_admin($username,$password,$email,$fname,$lname,$cnumber,$access);
    if($result){
        header('location: ../index.php?page=admins&subpage=records&id='.$username);
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


?>