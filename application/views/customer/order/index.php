
<section class="order-details">
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3><span>Your Order History are as below:</span></h3>
        </div>
        <div class="col-sm-offset-9 text-left">
            <a href="<?php echo BASE_URL.'display_product'?>" id="product_listing">Product Listing</a>
        </div>
    </div>
        <div class="row">
            <div class="order-table">
                <div class="responsive-table">
                    <table id="orderTable" class="responsive ">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Number of items</th>
                                <th>Order Total</th>
                                <th>Delivery Method</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Action</th>	
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(count($order_details) > 0):?>
                                <?php foreach($order_details as $order):?>
                                    <tr>
                                        <td><?php echo isset($order) ? $order->order_id : ''?></td>
                                        <td><?php echo isset($order) ? $order->order_quantity : ''?></td>
                                        <td><?php echo isset($order) ? $order->order_total : ''?></td>
                                        <td><?php echo isset($order) ? ucfirst($order->delivery_option) : ''?></td>
                                        <td><?php echo isset($order) ? ucfirst($order->order_status) : ''?></td>
                                        <td><?php echo isset($order) ? date('d/m/Y', strtotime($order->order_date)) : ''?></td>
                                        <td><?php echo isset($order) ? date('d/m/Y', strtotime($order->delivery_date)) : ''?></td>
                                        <td><a href="<?php echo BASE_URL.'cancel/'.$order->order_id?>" class="add-to-cart-btn btn" style="line-height:unset">Cancel</a></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>