<div class="page-content">
    <h3 class="page-title"> Product
        <small>Inventory Management</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="<?php echo BASE_URL?>a_product">Product</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>View Product Info</span>
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
                    <h4>Product Information</h4>
                    <hr>
                    <p><span class="text text-info">UPS/SKU: </span><span ><?php echo isset($product_details) ? $product_details->product_sku : ''?></span></p>
                    <p><span class="text text-info">Name: </span><span ><?php echo isset($product_details) ? $product_details->product_name : ''?></span></p>
                    <p><span class="text text-info">Description: </span><span><?php echo isset($product_details) ? $product_details->product_description : ''?></span></p>
                    <p><span class="text text-info">Nutrition Facts: </span><span><?php echo isset($product_details) ? $product_details->nutrition_facts : ''?></span></p>
                    <p><span class="text text-info">Price: </span><span ><?php echo isset($product_details) ? $product_details->product_price."$" : ''?></span></p>
                    <p><span class="text text-info">Stock: </span><span ><?php echo isset($product_details) ? $product_details->product_stock : ''?></span></p>
                    <p><span class="text text-info">Availible for sale: </span><span ><?php echo (isset($product_details) AND $product_details->is_available == '0' ) ? 'No' : 'Yes'?></span></p>
                    <p><span class="text text-info">Image: </span></p>
                    <img src="<?php echo ASSETS.'uploads/products/'.$product_details->product_image ?>" alt="" height="200px" weight="200px">
                </div>
            </div>
        </div>
    </div>