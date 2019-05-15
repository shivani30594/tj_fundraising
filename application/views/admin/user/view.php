<div class="page-content">
    <h3 class="page-title"> User
        <small>User Management</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="<?php echo BASE_URL?>a_user">User</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>View User</span>
            </li>
        <ul>
    </div>
    <?php if($this->session->flashdata('success')):?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>Success!</strong> <?php echo $this->session->flashdata('success') ?>
        </div>
    <?php endif;?>
    <?php if($this->session->flashdata('danger')):?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>Error!</strong> <?php echo $this->session->flashdata('danger') ?>
        </div>
    <?php endif;?>
    <?php if($this->session->flashdata('warning')):?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>Warning!</strong> <?php echo $this->session->flashdata('warning') ?>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="col-md-6">
            <div class="portlet light ">
                <div class="portlet-body">
                    <h4>User Information</h4>
                    <hr>
                    <p><span class="text text-info">First Name: </span><span id="last_name"><?php echo isset($user_details) ? $user_details->first_name : ''?></span></p>
                    <p><span class="text text-info">Last Name: </span><span id="last_name"><?php echo isset($user_details) ? $user_details->last_name : ''?></span></p>
                    <p><span class="text text-info">Email: </span><span id="email"><?php echo isset($user_details) ? $user_details->email : ''?></span></p>
                    <p><span class="text text-info">Contact Phone: </span><span id="status"><?php echo isset($user_details) ? $user_details->contact_phone : ''?></span></p>
                </div>
            </div>
        </div>
    </div>