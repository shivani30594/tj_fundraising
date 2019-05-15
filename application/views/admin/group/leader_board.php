<!-- <?php echo "<pre>";
print_r($leader_board);
?> -->

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
                <span>Leader-Board</span>
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
            <div class="clearfix">
                <h4 class="block">With Tables</h4>
                <div class="panel panel-success">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Leader-Board of: <b><?php echo $group_details->group_name?></b></h3>
                    </div>
                    <div class="panel-body">
                        <p>We are listing which users/salesperson in the fundraising group has the most sales of products in $, and listing their name and sales as ranking 1st. Then in ascending order we will list the people with the second most sales in second place, 3rd place and so.</p>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Total Amount </th>
                                <th> Total Quantity </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($leader_board) AND count($leader_board) > 0 ) : ?>
                            <?php $i=1;?>
                            <?php foreach($leader_board as $board) : ?>
                                <tr>
                                    <td> <?php echo $i; $i= $i+1;?> </td>
                                    <td> <?php echo (isset($board) && $board['first_name'] != '' ) ? $board['first_name']  : ''?> </td>
                                    <td> <?php echo (isset($board) && $board['last_name'] != '' ) ? $board['last_name']  : '' ?> </td>
                                    <td> <?php echo  (isset($board) && $board['total_amount'] != '' ) ? $board['total_amount']  : '0.00'?> </td>
                                    <td> <?php echo  (isset($board) && $board['total_quantity'] != '' ) ? $board['total_quantity']  : '0'?> </td>
                                </tr>
                            <?php endforeach;?>
                            <?php else:?>    
                                <tr><td colspan="4">There is no member present than the owner.</td></tr>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>