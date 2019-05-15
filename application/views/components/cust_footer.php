<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?php echo ASSETS ?>global/scripts/intlTelInput.min.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/custom.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/scripts/jquery.validate.js"></script><!--jquery js-->
<script src="<?php echo ASSETS?>global/plugins/jquery-ui/jquery-ui.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/scripts/sweetalert2.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/scripts/datatables.min.js"></script><!--jquery js-->

<?php (isset($script)) ? $this->load->view($script) : ''?>
<script>
    jQuery(document).ready(function(){
        $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    });
</script>