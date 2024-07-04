<?php
/*Include Review Class File */
include '../class/class.review.php';

/*Parameters for switch case*/
$action = isset($_GET['action']) ? $_GET['action'] : '';

/*Switch case for actions in the process */
switch($action){
	case 'new':
        create_review();
	break;
    case 'update':
        update_review();
	break;
    case 'delete':
        delete_review();
    break;
}

/*Main Function Process for creating a review */
function create_review(){
    $review = new Review();
    /*Receives the parameters passed from the creation page form */
    $user_id = $_POST['UserID'];
    $user_content = ucfirst($_POST['content']);
    $user_rating = $_POST['Rating'];

        /* Pass the parameters to the class function */
        $result = $review->new_review($user_id,$user_content,$user_rating);
        $result2 = $review->update_user_status($user_id);
        if($result){
            header("location: ../profile.php?subpage=review");
    }
}

/*Main Function Process for updating an admin */
function update_review(){  
    $review = new Review();
    /*Receives the parameters passed from the profile updating page form */
    $user_id = $_POST['UserID'];
    $user_content = ucfirst($_POST['contentUP']);
    $user_rating = $_POST['RatingUP'];
    
    /*Passes the parameters to the class function */
    $result = $review->update_review($user_id,$user_content,$user_rating);
    if($result){
        header("location: ../profile.php?subpage=review");
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