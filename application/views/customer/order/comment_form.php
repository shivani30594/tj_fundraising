<section class="wrapper review-wrap">
    <div class="container-fluid">
        <!-- <?php if ($this->session->flashdata("error")) : ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("error");?></span>
        </div>
        <?php endif;?> -->
        <?php if ($this->session->flashdata("success")) : ?>
        <div style="font-size:25px;">
            <p>Feedback for this order is already saved. Thank you!</p>
            <a href="<?php echo BASE_URL?>" style="color:#b31818">Click here to setup your own fundraising group </a>
        </div>
        <?php endif;?>
        <?php if (!$this->session->flashdata("success")) : ?>
            <h1>Write your feedback for: <?php echo $order_id?></h1>
            <form action="<?php echo BASE_URL?>customer/order/save" method="POST">
                <input type="hidden" name="order_id" value="<?php echo $order_id?>">
                <div class="stars">
                    <h3>What do you think of this?</h3>
                    <input class="star star-5" id="star-5" name="star_rating" type="radio" value="5"/>
                    <label class="star star-5" for="star-5"></label>
                    <input class="star star-4" id="star-4" name="star_rating" type="radio"  value="4"/>
                    <label class="star star-4" for="star-4"></label>
                    <input class="star star-3" id="star-3" name="star_rating" type="radio"  value="3"/>
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" name="star_rating" type="radio"  value="2"/>
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" name="star_rating" type="radio"  value="1"/>
                    <label class="star star-1" for="star-1"></label>
                </div>
                <div class="form-group"> 
                    <label for="">What would you like to share with us? </label>
                    <textarea name="comment" id="comment" class="form-control" rows=5></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-info" type="submit" value="Submit">Comment</button>
                </div>
            </form>
    <?php endif;?>
        </div>
    </div>
</section>