<?php
include_once 'config/config.php';
include_once 'class/class.user.php';

/* Define Object */
$user = new User();

/* Check if the user is already logged in */
if($user->get_session()){
    header("location: index.php");
    exit();
}

if(isset($_REQUEST['login_submit'])){
    extract($_REQUEST);
    $login = $user->check_login($user_identifier, md5($user_password));
    if($login){
        // Set session variable
        $_SESSION['username'] = $user_identifier;
        header("location: index.php");
        exit();
    } else {
        ?>
        <div id='error_box'>
            <div id='error_notif'>Wrong username or password.</div>
        </div>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login - Sugaree Cafe & Gelato</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <div class="background">
        <div class="wrapper">
            <nav class="nav">
                <div class="nav-logo">
                    <img src="img/logo.png" alt="Sugaree Cafe & Gelato Logo" class="logo-img">
                </div>
                <div class="nav-menu-btn">
                    <i class='bx bx-menu' onclick="myMenuFunction()"></i>
                </div>
            </nav>
            <div class="form-box">

                 <div class="login-container" id="login">
                    <div class="top">
                        <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                        <header>Login</header>
                    </div>
                    <form method="POST" action="">
                        <div class="input-box">
                            <input type="text" class="input-field" name="user_identifier" autocomplete="off" placeholder="Enter username or email" required>
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" name="user_password" autocomplete="off" placeholder="Password" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>
                        <div class="input-box">
                            <input type="submit" class="submit" name="login_submit" value="Sign In">
                        </div>
                        <div class="two-col">
                            <div class="one">
                                <input type="checkbox" id="login-check">
                                <label for="login-check"> Remember Me</label>
                            </div>
                            <div class="two">
                                <label><a href="#">Forgot Password?</a> </label>
                            </div>
                        </div>
                    </form>
                </div>
              
                <div class="register-container" id="register">
                    <div class="top">
                        <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                        <header>Sign Up</header>
                    </div>
                    <form method="POST" action="process/process.user.php?action=new">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="input-field" name="firstname" autocomplete="off" placeholder="Firstname" required>
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" name="lastname" autocomplete="off" placeholder="Lastname" required>
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="username" autocomplete="off" placeholder="Username" required>
                        <i class="bx bx-envelope"></i>
                    <div class="input-box">
                        <input type="text" class="input-field" name="email" autocomplete="off" placeholder="Email" required>
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="password" autocomplete="off" placeholder="Password" required>
                        <i class="bx bx-lock-alt"></i>
                        <input type="hidden" value="Not yet reviewed" class="text" name="status" placeholder="Not yet reviewed" readonly>

                        <script>
                            var myInput = document.getElementById("password");
                            var message = document.getElementById("message");
                            var letter = document.getElementById("letter");
                            var capital = document.getElementById("capital");
                            var number = document.getElementById("number");
                            var length = document.getElementById("length");
                            var closeBtn = document.getElementsByClassName("close")[0];

                            // When the user clicks on the password field, show the message box
                            myInput.onfocus = function() {
                                message.style.display = "block";
                            }

                            // When the user clicks on <span> (x), close the modal
                            closeBtn.onclick = function() {
                                message.style.display = "none";
                            }

                            // When the user starts to type something inside the password field
                            myInput.onkeyup = function() {
                                // Validate lowercase letters
                                var lowerCaseLetters = /[a-z]/g;
                                if(myInput.value.match(lowerCaseLetters)) {
                                    letter.classList.remove("invalid");
                                    letter.classList.add("valid");
                                } else {
                                    letter.classList.remove("valid");
                                    letter.classList.add("invalid");
                                }

                                // Validate capital letters
                                var upperCaseLetters = /[A-Z]/g;
                                if(myInput.value.match(upperCaseLetters)) {
                                    capital.classList.remove("invalid");
                                    capital.classList.add("valid");
                                } else {
                                    capital.classList.remove("valid");
                                    capital.classList.add("invalid");
                                }

                                // Validate numbers
                                var numbers = /[0-9]/g;
                                if(myInput.value.match(numbers)) {
                                    number.classList.remove("invalid");
                                    number.classList.add("valid");
                                } else {
                                    number.classList.remove("valid");
                                    number.classList.add("invalid");
                                }

                                // Validate length
                                if(myInput.value.length >= 8) {
                                    length.classList.remove("invalid");
                                    length.classList.add("valid");
                                } else {
                                    length.classList.remove("valid");
                                    length.classList.add("invalid");
                                }
                            }
                        </script>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" name="register_submit" value="Register">
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="register-check">
                            <label for="register-check"> Remember Me</label>
                            <span>Have an account? <a href="#" onclick="index.php">Login</a></span>
                        </div>
                        <div class="two">
                            <label><a href="#">Terms & Conditions</a> </label>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
                        </form>
    <script>
        var loginContainer = document.getElementById("login");
        var registerContainer = document.getElementById("register");
        
        function login() {
            loginContainer.style.left = "0";
            registerContainer.style.left = "100%";
            a.className += 'white-btn';
            b.className = 'btn';
        }
        
        function register() {
            loginContainer.style.left = "-100%";
            registerContainer.style.left = "0";
            a.className = 'btn';
            b.className  += 'white-btn';
        }
        </script>
        

</body>
</html>