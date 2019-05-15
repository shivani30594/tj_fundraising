<section class="wrapper review-wrap">
    <div class="container-fluid">
        <h1>Write your feedback for: <?php echo $order_id?></h1>
        <form action="<?php echo BASE_URL?>customer/order/send_cancel_request" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $order_id?>">
            <div class="form-group"> 
                <label for="">Shall we know the reason for cancellation? </label>
                <textarea name="reason" id="reason" class="form-control" rows=5></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-info" type="submit" value="Submit">Send</button>
            </div>
        </form>
    </div>
</section>