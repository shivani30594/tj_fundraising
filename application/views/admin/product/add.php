<div class="page-content">
    <h3 class="page-title"> Products
        <small>Inventory Management </small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Add Product</span>
            </li>
        <ul>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Add Product:</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form enctype='multipart/form-data' id="add_product_from" class="form-horizontal" role="form" method="POST" action="<?php echo BASE_URL?>admin/product/save">
                        <input type="hidden" class="form-control" id="product_id" name="product_id" value="<?php echo isset($product_details) ? $product_details->product_id : ''?>">
                        <input type="hidden" class="form-control" id="product_image_before" name="product_image_before" value="<?php echo isset($product_details) ? $product_details->product_image : ''?>">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">UPC/SKU:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="Enter UPC/SKU" value="<?php echo isset($product_details) ? $product_details->product_sku : ''?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  id="product_name" name="product_name" placeholder="Enter name" value="<?php echo isset($product_details) ? $product_details->product_name : ''?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description:</label>
                                <div class="col-md-9">
                                    <textarea rows="5" class="form-control"  id="product_description"  name="product_description" placeholder="Enter description"><?php echo isset($product_details) ? $product_details->product_description : ''?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nutrition Facts:</label>
                                <div class="col-md-9">
                                    <textarea rows="5" class="form-control"  id="nutrition_facts"  name="nutrition_facts" placeholder="Enter nutrition facts"><?php echo isset($product_details) ? $product_details->nutrition_facts : ''?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Category:</label>
                                <div class="col-md-9">
                                    <select name="category_id" id="category_id"  class="form-control">
                                        <option value="">--Select--</option>
                                        <?php if(isset($category_list)) : ?>
                                            <?php foreach($category_list as $category) : ?>
                                                <option value="<?php echo $category->category_id?>"  <?php echo (isset($product_details) and $product_details->category_id == $category->category_id ) ? 'selected' : ''?>><?php echo $category->category_name?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Price  $:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="product_price"  name="product_price" placeholder="Enter price" value="<?php echo isset($product_details) ? $product_details->product_price : ''?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Stock:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="product_stock"  name="product_stock" placeholder="Enter stock quantity" value="<?php echo isset($product_details) ? $product_details->product_stock : ''?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Availibility:</label>
                                    <div class="col-md-9 radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="is_available" id="optionsRadios4" value="Yes" checked>Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="is_available" id="optionsRadios5" value="No"> No </label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-md-3 control-label"> Image:</label>
                                <div class="col-md-9">
                                    <input type="file" id="product_image" name="product_image" accept="image/jpg, image/png, image/jpeg, image/gif" <?php echo isset($product_details) ? '' : 'required'?>>
                                    <div>
                                    <?php if(isset($product_details)):?>
                                        <img src="<?php echo ASSETS.'uploads/products/'.$product_details->product_image?>" alt="" height="150px" weight="150px">
                                    <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="reset" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>