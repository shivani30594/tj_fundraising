<div class="loader_m" style="display:none">
    <div class="loader-content">
        <p class="image-bg"></p>
        <p class="spinner"></p>
    </div>
</div>
<div id="exampleModal" class="modal fade cust-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="set_goal_form" action="<?php echo BASE_URL?>u_setgoal" method="POST">
                <div class="modal-body">
                    <div class="radio-wrap">
                        <div class="radio-bg-white">
                            <div class="tg-input-grp">
                                <label> What is the $ (dollar amount) that you want to raise</label><input style="border: 0;border-bottom: 1px solid;" class="tg-input" type="text" name="amount" id="amount" <?php echo (isset($user_details) AND $user_details->set_amount != 0 ) ? "disabled" : ''?> value="<?php echo isset($user_details) ? $user_details->set_amount : ''?>"> ?
                            </div>
                            <div class="tg-input-grp">
                                <label>  How many items do you think that you can sell during this fundraiser</label> <input style="border: 0;border-bottom: 1px solid;" class="tg-input" type="text" name="quantity" id="quantity" <?php echo (isset($user_details) AND $user_details->set_quantity != 0 ) ? "disabled" : ''?> value="<?php echo isset($user_details) ? $user_details->set_quantity : ''?>"> ?
                            </div>
                        </div>
                    </div>
                    <div class="button-wrap">
                        <button type="button" class="btn save-btn" data-dismiss="modal">Back</button>
                        <button type="submit" class="btn  save-btn" <?php echo (isset($user_details) AND $user_details->set_amount != 0 AND $user_details->set_quantity != 0) ? "disabled" : ''?>>Set Goal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?php echo ASSETS ?>global/scripts/intlTelInput.min.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/datatables.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/scripts/custom.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/scripts/jquery.validate.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/scripts/sweetalert2.min.js"></script><!--jquery js-->

<?php (isset($script)) ? $this->load->view($script) : ''?>
<script type="text/javascript">
function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
</script>
<script>
    jQuery(document).ready(function(){
        $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
        jQuery(".has-sub").on("click",function(){
            jQuery(this).find(".sub-menu-wrap").toggleClass("open-sub");
        });
    });
    <?php if ($user_details->individual_status == NULL ):?>
        jQuery(document).ready(function(){
            $('#myModal').modal({
			    backdrop: 'static'
            });
            $('#myModal').modal('show');
        });
    <?php endif;?>
    <?php if ($user_details->individual_status == 'group'):?>
        <?php if (isset($ia_already_accepted) AND $ia_already_accepted == false) : ?>
        jQuery(document).ready(function(){
            $('#selectGroup').modal({
			    backdrop: 'static'
            });
           $('#selectGroup').modal('show');
        });
        <?php endif;?>
    <?php endif;?>
</script>

