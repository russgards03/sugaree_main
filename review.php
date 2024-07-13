<?php if($user_status == 'Not yet reviewed'){
?>

<h1>Review</h1>
<div id="container-rev">
        <form action="process/process.review.php?action=new" method="post" id="reviewForm">
            <h2>How are you liking Sugaree so far?</h2>
            <h3>Leave a review below!</h3>
            <div class="review-profile-container">
                <div class="review-img">
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
                
                <div class="review-profile">
                    <div id="review-name">
                        <p><?php echo $user_firstname . ' ' . $user_lastname; ?></p>
                    </div>
                    <div id="review-disclaimer">
                        <p>Reviews are public and will be displayed including your account information.</p>
                    </div>
                </div>
            </div>

            <span class='result'>Rating: <?php echo $user_rating?></span>
            <div class="rateyo" id="Rating" value="<?php $user_rating?>" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
            <input type="hidden" name="Rating">
            <div class="rating-container">
                    <input type="hidden" name="RatingUP">
            <div class="input-box">
                <label>Comment</label><br>
                <textarea class="form-control review-textarea" name="content" placeholder="Describe your experience." required></textarea>
                <input type="hidden" value="<?php echo $user_id?>" name="UserID" readonly>
                <br>
                <input type="submit" name="update_review" class="review-button" value="Post Review">
            </div>
            
            
        </form>
</div>

<?php
}else{?>

<h1>Review</h1>
<div id="container-rev">
        <form action="process/process.review.php?action=update" method="post" id="reviewForm">
            <h2>How are you liking Sugaree so far?</h2>
            <h3>Leave a review below!</h3>
            <div class="review-profile-container">
                <div class="review-img">
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
                
                <div class="review-profile">
                    <div id="review-name">
                        <p><?php echo $user_firstname . ' ' . $user_lastname; ?></p>
                    </div>
                    <div id="review-disclaimer">
                        <p>Reviews are public and will be displayed including your account information.</p>
                    </div>
                </div>
            </div>

                <span class='result'>Rating: <?php echo $user_rating?></span>
                <div class="rateyo" id="RatingUP" data-rateyo-rating="<?php echo $user_rating?>" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                <div class="rating-container">
                    <input type="hidden" name="RatingUP">
                
            <div class="input-box">
                <label>Comment</label><br>  
                <textarea name="contentUP" placeholder="Describe your experience." required ><?php echo $user_review?></textarea>
                <input type="hidden" value="<?php echo $user_id?>" name="UserID" readonly>
                <br>
                <input type="submit" name="update_review" class="review-button" value="Update Review" >
            </div>
        </form>
</div>

<?php 
} 
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
$(function () {
    $(".rateyo").rateYo({
        starWidth: "60px",
        ratedFill: "#FFCE86"
    }).on("rateyo.change", function (e, data) {
        var rating = data.rating;
        $(this).parent().find('.result').text('Rating: ' + rating);
        var hiddenInput = $(this).parent().find('input[name=RatingUP], input[name=Rating]');
        hiddenInput.val(rating);
    }).rateYo("option", "rating", function () {
        return $(this).data("rateyo-rating");
    });
});
</script>
