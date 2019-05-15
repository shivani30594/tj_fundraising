
<style>
.morecontent span {
    display: none;
}
</style>
<section class="product-listing">
    <div class="container-fluid">
       
        <?php if ($this->session->flashdata("error")) : ?>
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
        <?php endif;?>
        <div class="row">
            <ul class="product-list diff-user-listing">
                <?php if(isset($product_details)) : ?>
                    <?php foreach($product_details as $product):?>
                        <li>
                            <div class="pr-content-left">
                                <div class="img-wrap">
                                    <img src="<?php echo ASSETS.'uploads/products/'.$product['product_image']?>" alt="Food Item" height="210px" width="210px">
                                </div>
                                <div class="pr-content">
                                    <h1><a><?php echo $product['product_name']?></a></h1>
                                    <div class="pr-det">upc/sku#: <?php echo $product['product_sku']?></div>
                                    <div class="pr-review"><span>Description:</span></div>
                                    <div class="pr des"><?php echo "<span class='more'>".$product['product_description']."</span>"?></div>
                                    <div class="pr-review"><span>Nutrition facts:</span></div>
                                    <div class="pr des"><?php echo "<span class='more'>".$product['nutrition_facts']."</span>" ?></div>
                                </div>
                            </div>
                            <div class="pr-content-right">
                                <div class="pr-price">$<span id="<?php echo 'price_'.$product['product_id']?>" ><?php echo number_format((float)$product['product_price'], 2, '.', '')?></span></div>
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