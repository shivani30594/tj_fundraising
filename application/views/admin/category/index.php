<div class="page-content">
    <h3 class="page-title"> Product Category
        <small>Category Management </small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Product Category</span>
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
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="<?php echo BASE_URL?>admin/category/add" id="sample_editable_1_new" class="btn sbold green"> Add New
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="category_datatable">
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>