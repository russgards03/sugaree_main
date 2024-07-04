<?php if($user_status == 'Not yet reviewed'){
?>

<div class="container">
    <div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="process/process.review.php?action=new" method="post" id="reviewForm">
        <div class="review-box">
                <h3>Leave a review!</h3>
            <div>
                <label>Comment</label>  
                <textarea class="form-control review-textarea" name="content" value="<?php echo $user_review?>" required></textarea>
            </div>
            <span class='result'>Rating: <?php echo $user_rating?></span>
            <div class="rateyo" id="Rating" value="<?php $user_rating?>" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
            <input type="hidden" name="Rating">
            <input type="hidden" value="<?php echo $user_id?>" name="UserID" readonly>
            <div><input type="submit" name="update_review" class="btn btn-primary btn-lg" value="Post Review"></div>
        </form>
        </div>
    </div>
    </div>
</div>

<?php
}else{?>

<div class="container">
    <div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="process/process.review.php?action=update" method="post" id="reviewForm">
        <div class="review-box">
                <h3>Your Review</h3>
            <div>
                <label>Comment</label>  
                <textarea class="form-control review-textarea" name="contentUP" required><?php echo $user_review?></textarea>
            </div>
            <span class='result'>Rating: <?php echo $user_rating?></span>
            <div class="rateyo" id="RatingUP" data-rateyo-rating="<?php echo $user_rating?>" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
            <input type="hidden" name="RatingUP">
            <input type="hidden" value="<?php echo $user_id?>" name="UserID" readonly>
            <div><input type="submit" name="update_review" class="btn btn-primary btn-lg" value="Update Review" ></div>
        </form>
        </div>
    </div>
    </div>
</div>

<?php 
} 
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
$(function () {
    $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
        var rating = data.rating;
        $(this).parent().find('.result').text('Rating: ' + rating);
        var hiddenInput = $(this).parent().find('input[name=RatingUP], input[name=Rating]');
        hiddenInput.val(rating);
    }).rateYo("option", "rating", function () {
        return $(this).data("rateyo-rating");
    });
});
</script>