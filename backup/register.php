<?php
include_once 'config/config.php';


if(isset($_POST['submit'])){
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    $verify_query = mysqli_query($con, "SELECT user_email FROM tbl_users WHERE user_email='$user_email'");

    if(mysqli_num_rows($verify_query) != 0){
        echo "<div class='message'>
            <p> This email is already in use. Try another one. </p>
            </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
    } else {
        $insert_query = "INSERT INTO tbl_users(user_firstname, user_lastname, user_name, user_email, user_password) VALUES('$user_firstname', '$user_lastname', '$user_name', '$user_email', '$user_password')";
        
        if(mysqli_query($con, $insert_query)){
            echo "<div class='message'>
                <p> Registration complete! </p>
                </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login here</button></a>";
        } else {
            echo "Error Occurred: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUGAREE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
    <title>REGISTER</title>
</head>
<body>
	<div class="container"></div>
	<div class="box form-box"></div>

	<div id="login-block">
		<h3>REGISTER</h3>
		<form method="POST" action="">
        <div class="field input">
			<label for="firstname">First Name</label>
			<input type="text" class="input" name="firstname" autocomplete="off" placeholder="Enter first name" required/>
		</div>
        <div class="field input">
			<label for="lastname">Last Name</label>
			<input type="text" class="input" name="lastname" autocomplete="off" placeholder="Enter last name" required/>
		</div>
		<div class="field input">
			<label for="username">Username</label>
			<input type="text" class="input" name="username" autocomplete="off" placeholder="Enter username" required/>
		</div>
        <div class="field input">
			<label for="email">Email</label>
			<input type="email" class="input" name="email" autocomplete="off" placeholder="Enter email" required/>
		</div>
		<div class="field input">
			<label for="password">Password</label>
			<input type="password" id="password" class="input" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter password.." required/>
            </br><h7> Password should be more than 8 characters and should contain 1 capital letter and 1 number. </h7>

            <script>
                var myInput = document.getElementById("password");
                var letter = document.getElementById("letter");
                var capital = document.getElementById("capital");
                var number = document.getElementById("number");
                var length = document.getElementById("length");

                // When the user clicks on the password field, show the message box
                myInput.onfocus = function() {
                    document.getElementById("message").style.display = "block";
                }

              // When the user clicks outside of the password field, hide the message box
              myInput.onblur = function() {
                document.getElementById("message").style.display = "none";
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
              // Disable form submission for non-managers
                var accessLevel = document.getElementById("access");
                accessLevel.addEventListener("change", function() {
                    var selectedValue = accessLevel.options[accessLevel.selectedIndex].value;
                    if (selectedValue !== "Manager") {
                        var form = document.forms["Userpage"];
                        form.onsubmit = function() {
                            alert("Only the manager can access this form.");
                            return false;
                        };
                    } else {
                        document.forms["Userpage"].onsubmit = null;
                    }
                });
            </script>
		</div>
		<div class="field">
			<input type="submit" name="submit" value="Register"/>
		</div>
		<div class="links">
			Already have an account?<br><a href="login.php">Login Here</a>

		</div>
		</form>
	</div>
    </div>
</body>
</html>