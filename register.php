<?php/*
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
}*/
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
		<form method="POST" action="processes/process.user.php?action=new">
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
			<input type="password" class="input" name="password" autocomplete="off" placeholder="Enter password" required/>
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