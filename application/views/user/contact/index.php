<section class="contact-wrap">
    <div class="container-fluid">
        <div class="row">
            <form id="customer_invite_form" method="post" action="<?php echo BASE_URL?>user/contact/save">
                <div class="field_wrapper">
                    <div class="tg-in" id="email">
                        <div class="tg-input-grp">
                            <label for="tg-email">Email ID :</label>
                            <input type="email" name="email" class="tg-input" id="email">
                        </div>
                    </div>
                </div>
                <div class="tg-input-grp">
                    <label for="tg-org-name">Subject :</label>
                    <input type="text" name="subject" class="tg-input" id="subject">
                </div>
                <div class="tg-input-grp">
                    <label for="tg-org-name">Message :</label>	
                    <textarea rows="4" cols="50" name="message" id="message"></textarea>
                </div>
                <div class="btn-grp">
                    <button type="button" class="cancel-btn" onclick="location.href = '<?php echo BASE_URL.'u_invite'?>'">Cancel</button>
                    <button type="submit" class="share-btn">Send</button>
                </div>
            </form>

        </div>
    </div>
</section>