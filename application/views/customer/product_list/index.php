
<section class="product-listing">
    <div class="container-fluid">
        <!-- <?php if ($this->session->flashdata("error")) : ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata("error");?></span>
            </div>
        <?php endif;?>
        <?php if ($this->session->flashdata("success")) : ?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata("success");?></span>
            </div>
        <?php endif;?> -->
        <div class="row">
            <div class="text-right" style="float:left">
            <?php if(isset($search_keyword) AND $search_keyword != ''):?>
                <div class="notify-message"> You are looking for <?php echo $search_keyword;?></div>
            <?php endif;?>
            </div>
            <div class="text-right" style="float:right">
                <!-- <a href="" id="product_listing" style="width:200px !important; margin-bottom:10px">My Orders</a> -->
            </div>
        </div>
        <div class="row">
            <ul class="product-list">
                <?php if(isset($product_details)) : ?>
                    <?php foreach($product_details as $product):?>
                        <li>
                            <div class="pr-content-left">
                                <div class="img-wrap">
                                    <a href="<?php echo BASE_URL.'product_view/'.$product['product_id']?>"><img src="<?php echo ASSETS.'uploads/products/'.$product['product_image']?>" alt="Food Item" height="210px" width="210px"></a>
                                </div>
                                <div class="pr-content">
                                    <h1><a href="<?php echo BASE_URL.'product_view/'.$product['product_id']?>"><?php echo $product['product_name']?></a></h1>
                                    <div class="pr-det">upc/sku#: <?php echo $product['product_sku']?></div>
                                    <div class="pr-review"><span>Description:</span></div>
                                    <div class="pr des"><?php echo strlen($product['product_description']) > 180 ? substr( $product['product_description'],0,180). '...' : $product['product_description'] ?></div>
                                </div>
                            </div>
                            <div class="pr-content-right">
                                <form action="<?php echo BASE_URL?>customer/customer/add_prod" method="post">
                                    <div class="pr-price">$<span id="<?php echo 'price_'.$product['product_id']?>" ><?php echo number_format((float)$product['product_price'], 2, '.', '')?></span></div>
                                    <div class="add-cart"> 
                                        <input type="hidden" name="id" value="<?php echo $product['product_id']?>">
                                        <input type="hidden" name="name" value="<?php echo $product['product_name']?>">
                                        <input type="hidden" name="price" value="<?php echo number_format((float)$product['product_price'], 2, '.', ''); ?>">
                                        <button class="add-to-cart-btn btn" style="line-height: 20px !important;" type="submit"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                    <div class="pr-qyt">
                                        <select class="pr-qyt-num" id="quantity" name="quantity">
                                        <?php for($i=1;$i<=10;$i++):?>
                                                <option value="<?php echo $i?>"><?php echo $i?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
        <div class="row">
            <div id="pagination" class="col-sm-offset-4 text-right text-center-xs">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    <?php foreach ($links as $key=>$link) {
                        echo "<li>". $link."</li>";
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</section>