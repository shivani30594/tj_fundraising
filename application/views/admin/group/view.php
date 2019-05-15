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
                <span>View Group</span>
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
                    <h4><b><?php echo isset($group_details) ? $group_details->group_name : ''?></b></h4>
                    <p><span class="text text-info">Owner Name: </span><span id="last_name"><?php echo isset($group_details) ? $group_details->contact_person : ''?></span></p>
                    <p><span class="text text-info">Email: </span><span id="email"><?php echo isset($group_details) ? $group_details->email : ''?></span></p>
                    <p><span class="text text-info">Address: </span><span id="status"><?php echo isset($group_details) ? $group_details->address : ''?></span></p>
                    <p><span class="text text-info">Contact Phone: </span><span id="status"><?php echo isset($group_details) ? $group_details->contact_phone : ''?></span></p>
                    <p><span class="text text-info">Project Started At: </span><span id="status"><?php echo isset($group_details) ? $group_details->project_start : ''?></span></p>
                    <p><span class="text text-info">Project Ended at: </span><span id="status"><?php echo isset($group_details) ? $group_details->project_end : ''?></span></p>
                    <p><span class="text text-info">Delivery Method: </span><span id="status"><?php echo isset($group_details) ? $group_details->delivery_method : ''?></span></p>
                    <p><span class="text text-info">Delivery Location: </span><span id="status"><?php echo isset($group_details) ? $group_details->delivery_location : ''?></span></p>
                    <p><span class="text text-info">Tax Document: </span></p>
                    <?php if( isset($group_details) AND $group_details->tax_document_name != '' ) :?>
                        <img src="<?php echo ASSETS.'uploads/tax_documents/'.$group_details->tax_document_name;?>">
                    <?php else:?>
                        <p><span class="text text-warning">NOTE : No tax document is uploaded by Fundraiser group owner.</span></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portlet light ">
                <div class="portlet-body">
                <div class="mt-element-list">
                        <div class="mt-list-head list-simple font-white bg-red">
                            <div class="list-head-title-container">
                                <div class="list-date"><?php echo isset($group_details) ? date('M-d,Y', strtotime($group_details->created)) : ''?></div>
                                <h3 class="list-title">Group Members List</h3>
                            </div>
                        </div>
                        <div class="mt-list-container list-simple">
                            <ul>
                            <?php if(isset($group_member_details) AND count($group_member_details) > 0 AND $group_member_details[0]['user_id'] != '') : ?>
                                <?php foreach($group_member_details as $group_member_detail) : ?>
                                    <li class="mt-list-item">
                                    <div class="list-icon-container done">
                                                        <i class="icon-check"></i>
                                                    </div>
                                        <div class="list-datetime"> <a  href="<?php echo BASE_URL.'admin/user/view/'.$group_member_detail['user_id'] ?> "class="info">View</a> </div>
                                        <div class="list-item-content">
                                            <h3 class="capitalize">
                                                <a><?php echo $group_member_detail['first_name'] .' '. $group_member_detail['last_name']; ?></a>
                                            </h3>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            <?php else:?>    
                                    There is no member present than the owner.
                            <?php endif;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>