<section class="contact-wrap">
    <div class="container-fluid">
        <div class="row">
            <form id="customer_invite_form" method="post" action="<?php echo BASE_URL?>user/customer/send_email_to_cutsomer">
                <div class="field_wrapper">
                    <div class="tg-in" id="email">
                        <div class="tg-input-grp">
                            <label for="tg-email">Email ID :</label>
                            <input type="email" name="email[]" class="tg-input" id="email">
                            <a href="javascript:void(0);" class="add_button add-more" id="add_more">Add More</a>
                        </div>
                    </div>
                </div>
                <div class="tg-input-grp">
                    <label for="tg-org-name">Subject :</label>
                    <input type="text" name="subject" class="tg-input" id="subject">
                </div>
                <div class="tg-input-grp">
                    <label for="tg-org-name">Message :</label>	
                    <textarea rows="4" cols="50" name="message" id="message" value="">Hello! I am raising funds for a great cause. Will you consider supporting me?</textarea>
                </div>
                <div class="btn-grp">
                    <button type="button" class="cancel-btn" onclick="location.href = '<?php echo BASE_URL.'u_invite'?>'">Cancel</button>
                    <button type="submit" class="share-btn">Send</button>
                </div>
            </form>

        </div>
    </div>
</section>