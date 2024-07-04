<form method="post" action="process/process.user.php?action=update">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="userid"></label>
                                <input type="text" id="userid" class="text" name="userid" value="<?php echo $user_id?>" hidden><br>

                                <label for="username">Username: </label>
                                <input type="text" id="username" class="text" name="username" value="<?php echo $user_name?>" disabled><br>

                                <label for="email">Email Address: </label>
                                <input type="text" id="email" class="text" name="email" value="<?php echo $user_email?>" disabled><br>

                                <label for="firstname">First Name: </label>
                                <input type="text" id="firstname" class="text" name="firstname" value="<?php echo $user_firstname?>" placeholder="Enter First Name" required><br>

                                <label for="lastname">Last Name: </label>
                                <input type="text" id="lastname" class="text" name="lastname" value="<?php echo $user_lastname?>" placeholder="Enter Last Name" required><br>
                            </div>
                    </div>
                    <input type="submit" class="profile-edit-btn" value="Update"/>
                    </div>
                </div>
</form>