<?php
include '../class/class.news.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'new':
        create_new_news();
        break;
    case 'update':
        update_news();
        break;
    case 'delete':
        delete_news();
        break;
}

function create_new_news(){
    $news = new News();
    
    // Check if the keys exist in $_POST before accessing them
    if(isset($_POST['news_title'], $_POST['news_description'])){
        $news_title = $_POST['news_title'];
        $news_description = $_POST['news_description'];

        // Call the new_news method
        $result = $news->new_news($news_title, $news_description);

        if ($result) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Failed to update announcement!";
        }
    } else {
        echo "Error: Missing form data.";
    }
}

function update_news() {
    $news = new News();
    
    $news_id = $_POST['nes_id'];
    $news_title = $_POST['news_title'];
    $news_description = $_POST['news_description'];
    
    $result = $news->update_news($news_id, $news_title, $news_description);
    
    if ($result) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Failed to update announcement!";
    }
}

?>
