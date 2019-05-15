<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-4">
                <div class="logo-wrap">
                    <a href="#"><img src="<?php echo ASSETS?>global/img/new-logo.png" alt="Logo"></a>
                </div>
            </div>
            <div class="col-md-offset-3 col-md-6 col-sm-9 col-xs-8">
                <form action="<?php echo BASE_URL?>display_product" method="post">
                    <?php if($this->uri->segment(1) != 'my_orders'):?>
                    <div class="search-cart-wrap">
                            <div class="input-grp">
                                <input type="text" class="search-text-box" name="search_keyword" value="<?php echo isset($search_keyword) ? $search_keyword : ''?>">
                                <button type="submit" class="btn" name="submit" value="submit"> <i class="fa fa-search"></i></button>
                            </div>
                        <div class="cart-wrap">
                            <a href="<?php echo BASE_URL?>cart_details" class="cart-link">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <div class="item-count"><span id=""><?php echo isset($total_amount) ? $total_product : '0'?></span></div>
                            </a>
                        </div>
                        <span class="search-text">Total Amount $<span id=""><?php echo (isset($total_amount) AND $total_amount > 0) ? $total_amount : '0.00'?></span></span>
                    </div>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>
</header>