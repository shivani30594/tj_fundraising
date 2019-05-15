<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('components/user_scripts')?>
<body>
	<div class="Tj-page-wrapper ">

        <?php $this->load->view('components/user_header')?>
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
    <?php $this->load->view('components/user_footer')?>
    <!-- Modal --> 
    <div id="myModal" class="modal fade cust-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="set_status_form" action="<?php echo BASE_URL?>user/dashboard/set_status" method="POST">
                    <div class="modal-body">
                        <div class="radio-wrap">
                            <div class="radio-bg-white">
                                <div class="radio">
                                    <label><input type="radio" name="status" checked value="individual">Create a Fundraising Campaign<span class="chk-radio"></span></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="status" value="group">Join a Fundraiser Group<span class="chk-radio"></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown" id="group_active" style="display:none">
                            <select name="group_id" placeholder="Search..." id="active_group" class="search-inputs selectpicker" data-show-subtext="true" data-live-search="true">
                                <option value=''>Please Select...</option>
                                <?php if (isset($active_groups) && !empty($active_groups)) : ?>
                                    <?php foreach($active_groups as $key=>$value) : ?>
                                        <option value="<?php echo $value['group_id']?>"><?php echo $value['group_name']?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                        <div class="button-wrap">
                            <!-- <button type="button" class="btn btn-primary close-btn" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn  save-btn">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="selectGroup" data-backdrop="static" data-keyboard="false" class="modal fade cust-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="set_status_form" action="<?php echo BASE_URL?>user/dashboard/set_status" method="POST">
                    <div class="modal-body">
                        <?php if(isset($is_group_joined) AND $is_group_joined == 0) :?>
                            <div class="dropdown">
                                <select placeholder="Search..." id="active_group" class="search-inputs selectpicker" data-show-subtext="true" data-live-search="true">
                                    <option>Please Select...</option>
                                    <?php if (isset($active_groups) && !empty($active_groups)) : ?>
                                        <?php foreach($active_groups as $key=>$value) : ?>
                                            <option value="<?php echo $value['group_id']?>"><?php echo $value['group_name']?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>
                        <?php else: ?>
                            <p>Your request for group is sent already. You can request for new group after request sent by 24 hours, it group owner doesn't accept it.</p>
                        <?php endif;?>
                        <div class="button-wrap">
                            <a href="<?php echo BASE_URL?>u_logout" class="btn btn-primary close-btn">Close</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html>