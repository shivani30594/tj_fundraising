<section class="product-listing">
    <div class="container-fluid">
        <div class="row">
            <div id="items_avialable">
                <div id="products_cart_wrapper">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($cart_info) > 0) :?>
                                    <?php foreach( $cart_info as $id => $cart):?>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL.'product_view/'.$cart['id'] ?>"><?php echo $cart['name']?></a></td>
                                        <td><?php echo number_format((float)$cart['price'], 2, '.', '');?></td>
                                        <td><?php echo $cart['qty']?></td>
                                        <td><?php echo number_format((float)$cart['subtotal'], 2, '.', '');?></td>
                                        <td><a href="<?php echo BASE_URL.'customer/customer/delete_prod/'.$cart['rowid']?>" style="color: #b31818"  data-productid="1" class="delete-btn" name="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td></td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                <tr>
                                    <td colspan="5">Your shopping cart is empty.</td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bottom-wrapper">
                        <p>Total Amount:<span><?php echo isset($total_amount) ? $total_amount : '0.00'?></span></p>
                        <div id="checkout_btn_grp">
                            <button onclick="location.href = '<?php echo (isset($cart_info) AND count($cart_info) > 0 ) ?  BASE_URL.'checkout' :  BASE_URL.'cart_details' ?>'" id="paynow_btn">Pay Now</button>
                            <a href="<?php echo BASE_URL?>display_product" id="product_listing">Back to Product Listing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>