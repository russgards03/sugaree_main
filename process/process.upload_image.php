<?php
include_once '../config/config.php';
include_once '../class/class.user.php';

$user = new User();

if (!$user->get_session()) {
    header("location: login_register.php");
    exit();
}

if (isset($_POST['submit'])) {
    if (!isset($_SESSION['username'])) {
        echo "<h2>Session error: Username not set</h2>";
        exit();
    }

    $user_identifier = $_SESSION['username'];

    $user_id = $user->get_user_id($user_identifier);

    // Ensure a file is uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        echo "<h2>Error: No file uploaded or there was an upload error</h2>";
        exit();
    }

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = '../img/' . $file_name;

    if (!move_uploaded_file($tempname, $folder)) {
        echo "<h2>Error: Failed to move uploaded file</h2>";
        exit();
    }

    $stmt = $con->prepare("UPDATE tbl_users SET user_image = ? WHERE user_id = ?");
    $stmt->bind_param("si", $file_name, $user_id);

    if ($stmt->execute()) {
        header("location: ../profile.php"); 
    } else {
        header("location: ../profile.php");
    }

    $stmt->close();
}
?> 
