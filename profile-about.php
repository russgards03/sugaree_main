
<h1>Profile</h1>
<div id="container">
    <div class="box-pic">
        <form method="POST" action="process/process.upload_image.php" enctype="multipart/form-data">
            <div class="profile-img">
                <?php
                $res = mysqli_query($con, "SELECT user_image FROM tbl_users WHERE user_id=$user_id");
                while($row = mysqli_fetch_assoc($res)) {
                    $file_path = 'img/' . $row['user_image'];
                    $alt_image = 'img/rom.jpg';
                    // Check if the main image exists
                    if (file_exists($file_path)) {
                        // If the main image exists, use its alt text
                        $alt_text = 'Uploaded Image';
                    } else {
                        // If the main image doesn't exist, use the alternative image name
                        $alt_text = $alt_image;
                    }
                 }
                ?>
                    <img src="<?php echo $file_path ?>" alt="<?php echo htmlspecialchars($alt_image); ?>" />
            </div>
            <input type="file" name="image" required />
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div class="box-form">
        <h2>Hello There <br><?php echo $user_firstname . ' ' . $user_lastname; ?>!</h2>
        <form method="post" action="process/process.user.php?action=update">
            <div class="form-container">
                <div class="form-left">
                    <div class="input-box">
                        <label for="userid"></label>
                        <input type="text" id="userid" class="text" name="userid" value="<?php echo $user_id?>" hidden><br>
                    </div>
                                
                    <div class="input-box">
                        <label for="username">Username: </label><br>
                        <input type="text" id="username" class="text" name="username" value="<?php echo $user_name?>" disabled><br>
                    </div>

                    <div class="input-box">
                        <label for="firstname">First Name: </label><br>
                        <input type="text" id="firstname" class="text" name="firstname" value="<?php echo $user_firstname?>" placeholder="Enter First Name" required><br>
                    </div>

                    <div class="input-box">
                        <label for="password">New Password: </label><br>
                        <input type="password" id="role" class="text" name="role" value="<?php echo $user_role?>" required><br>
                    </div>
                </div>

                <div class="form-right">
                    <br>
                    <div class="input-box">
                        <label for="email">Email Address: </label><br>
                        <input type="text" id="email" class="text" name="email" value="<?php echo $user_email?>" disabled><br>
                    </div>

                    <div class="input-box">
                        <label for="lastname">Last Name: </label><br>
                        <input type="text" id="lastname" class="text" name="lastname" value="<?php echo $user_lastname?>" placeholder="Enter Last Name" required><br>
                    </div>

                    <div class="input-box">
                        <label for="cpassword">Confirm Password </label><br>
                        <input type="password" id="role" class="text" name="role" placeholder="Re-enter password" required><br>
                    </div>
                </div>
            </div>
            <input type="submit" class="update-button" value="Update"/>
        </form>
    </div>
</div>
