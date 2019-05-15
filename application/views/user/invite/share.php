<div class="link-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="share-link-block">
                <h4>Enable your customers to see your products and shop online with this link</h4>
                <p>Copy and share link through email, SMS, or share online</p>
                <div class="link" id="referral_link"><input style="width: 100%; border: none;" type="text" id="foo" value="<?php echo BASE_URL.'marketing/'.trim($user_details->first_name).'/'.trim($user_details->referral_code);?>" /></div>
                <div class="btn-grp">
                    <button onclick="location.href = '<?php echo BASE_URL.'u_invite'?>';" class="cancel-btn">Cancel</button>
                    <button id="copy_to_clipboard" onclick="copy('foo')" class="share-btn">Copy To Clipboard</button>
                </div>
            </div>
        </div>
    </div>
</div>