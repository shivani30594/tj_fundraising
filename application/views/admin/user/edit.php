<div class="page-content">
    <h3 class="page-title"> Users
        <small>User Management </small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Edit User</span>
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
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Personal Info</a>
                        </li>
                        <li class="">
                            <a href="#tab_1_2" data-toggle="tab" aria-expanded="false">Change Avatar</a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <!-- PERSONAL INFO TAB -->
                        <div class="tab-pane active" id="tab_1_1">
                            <form role="form" method="POST" id="edit_user_from" action="<?php echo BASE_URL?>admin/user/save" >
                                <input type="hidden" name="user_id" value="<?php echo isset($user_details) ? $user_details->user_id : ''?>">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value=<?php echo isset($user_details) ? $user_details->first_name : ''?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value=<?php echo isset($user_details) ? $user_details->last_name : ''?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value=<?php echo isset($user_details) ? $user_details->email : ''?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                            <select class="form-control" id="status" name="is_active">
                                                <option value='Yes' <?php echo ( isset($user_details) AND $user_details->is_active == 'Yes') ? 'selected' : '' ?>>Active</option>
                                                <option value='No' <?php echo ( isset($user_details) AND $user_details->is_active == 'No') ? 'selected' : '' ?>>In-active</option>
                                            </select>
                                    </div>
                                    <button type="submit" class="btn green"> Save Changes </button>
                                    <a href="<?php echo BASE_URL?>a_user" class="btn default"> Cancel </a>
                                </div>
                            </form>
                        </div>
                        <!-- END PERSONAL INFO TAB -->
                        <!-- CHANGE AVATAR TAB -->
                        <div class="tab-pane" id="tab_1_2">
                            <form action="<?php echo BASE_URL?>admin/user/change_avatar" role="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo isset($user_details) ? $user_details->user_id : ''?>">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="<?php echo $user_details->picture?>" alt="" style="width: 200px !important; height: 150px !important;"> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="picture"  accept="image/png, image/jpeg, image/jpg" > </span>
                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="margin-top-10">
                                    <button type="submit" class="btn green"> Submit </button>
                                    <a href="<?php echo BASE_URL?>a_user" class="btn default"> Cancel </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                   