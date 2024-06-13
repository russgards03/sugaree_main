<?php
include_once 'config/config.php';

session_unset();
session_destroy();

header("Location: login_register.php");
exit();
?>