<div class="page-content">
    <h3 class="page-title"> Group
        <small>Fundraiser Groups</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="<?php echo BASE_URL?>a_group">Group</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Edit Group</span>
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
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Edit Group</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Group Info</a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <!-- PERSONAL INFO TAB -->
                        <div class="tab-pane active" id="tab_1_1">
                            <form role="form" method="POST" id="edit_group_form" action="<?php echo BASE_URL?>admin/group/save" >
                                <input type="hidden" name="user_id" value="<?php echo isset($group_details) ? $group_details->user_id : ''?>">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control" id="group_id" name="group_id" placeholder="Enter Group Name" value=<?php echo isset($group_details) ? $group_details->group_id : ''?>>
                                            <div class="form-group">
                                                <label class="control-label">Group Name</label>
                                                    <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" value=<?php echo isset($group_details) ? $group_details->group_name : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Contact Person</label>
                                                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter Contact Person Name" value=<?php echo isset($group_details) ? $group_details->contact_person : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Contact Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value=<?php echo isset($group_details) ? $group_details->email : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value=<?php echo isset($group_details) ? $group_details->address : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Contact Phone</label>
                                                    <input type="tel" class="form-control" id="contact_phone" name="contact_phone" placeholder="Enter Last Name" value=<?php echo isset($group_details) ? $group_details->contact_phone : ''?>>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Project Start:</label>
                                                    <input type="date" class="form-control" id="project_start" name="project_start" placeholder="Enter First Name" value=<?php echo isset($group_details) ? $group_details->project_start : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Project End:</label>
                                                    <input type="date" class="form-control" id="project_end" name="project_end" placeholder="Enter Last Name" value=<?php echo isset($group_details) ? $group_details->project_end : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Delivery Method</label>
                                                    <select class="form-control" name="delivery_method" id="delivery_method">
                                                        <option value="" >--Select--</option>
                                                        <option value="pick_up" <?php echo (isset($group_details) AND $group_details->delivery_method == 'pick_up') ? 'selected' : '' ?>>Pick Up</option>
                                                        <option value="ship" <?php echo (isset($group_details) AND $group_details->delivery_method == 'ship' )? 'selected' : '' ?>>Ship</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Delivery Location</label>
                                                    <input type="text" class="form-control" id="delivery_location" name="delivery_location" placeholder="Enter Delivery Location" value=<?php echo isset($group_details) ? $group_details->delivery_location : ''?>>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn green"> Save Changes </button>
                                    <a href="<?php echo BASE_URL?>a_user" class="btn default"> Cancel </a>
                                </div>
                            </form>
                        </div>
                        <!-- END PERSONAL INFO TAB -->
                        <!-- CHANGE AVATAR TAB -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                   