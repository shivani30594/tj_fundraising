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
        <div class="col-md-6">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Product Category Details</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Category Info</a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <!-- PERSONAL INFO TAB -->
                        <div class="tab-pane active" id="tab_1_1">
                            <form role="form" method="POST" id="add_category_from" action="<?php echo BASE_URL?>admin/category/save" enctype ="multipart/form-data" >
                                <input type="hidden" name="category_id" value="<?php echo isset($category_details) ? $category_details->category_id : ''?>">
                                <input type="hidden" name="image_name" value="<?php echo isset($category_details) ? $category_details->category_image : ''?>">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label"> Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="<?php echo isset($category_details) ? $category_details->category_name : ''?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> Description</label>
                                        <textarea rows='10' class="form-control" id="category_description" name="category_description" placeholder="Enter Description" value=""><?php echo isset($category_details) ? $category_details->category_name : ''?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Image</label>
                                        <input type="file" <?php echo isset($category_details) ? '' : 'required';?> class="form-control" id="category_image" name="category_image" value="" accept=".png, .jpg, .jpeg">
                                        <?php if(isset($category_details)) : ?>
                                            <img src="<?php echo ASSETS.'uploads/catgeory/'.$category_details->category_image?>" alt="" height="150px" width="150px">
                                        <?php endif;?>
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
                                   