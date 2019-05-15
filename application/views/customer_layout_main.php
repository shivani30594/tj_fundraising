<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('components/cust_scripts')?>
<body>
	<div class="Tj-page-wrap">
        <?php $this->load->view('components/cust_header')?>
        <?php if ($this->session->flashdata("error")) : ?>
        <div class="alert alert-danger error-message" id="success-alert">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("error");?></span>
        </div>
        <?php endif;?>
        <?php if ($this->session->flashdata("success")) : ?>
        <div class="alert alert-success error-message" id="success-alert">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("success");?></span>
        </div>
        <?php endif;?>
        <?php $this->load->view($subview);?>
	</div>
</body>
<?php $this->load->view('components/cust_footer');?>
</html>
