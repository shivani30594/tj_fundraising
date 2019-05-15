<div class="heading detail-wrap">
    <h3><span><?php echo isset($order_details) ? count($order_details) : '0' ?></span> orders need to be delivered in person</h3>
    <p>Click on name below to mark when the order has been delivered</p>
</div>
<section class="order-details">
    <div class="container-fluid">
        <div class="row">
            <div class="order-table">
                <div class="responsive-table">
                    <table id="orderTable" class="responsive ">
                        <thead>
                            <tr>
                                <th><input name="select_all" value="1" type="checkbox" id="select_all"></th>
                                <th>Order Number</th>
                                <th>Number of items</th>
                                <th>customer Name</th>
                                <th>Delivery Address</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($order_details) > 0): ?>
                                <?php foreach ($order_details as $order): ?>
                                    <tr>
                                        <td><input name="select[]" id="<?php echo isset($order) ? $order['order_id'] : '' ?>" class="checkbox_select" type="checkbox"></td>
                                        <td><?php echo isset($order) ? $order['order_id'] : '' ?></td>
                                        <td><?php echo isset($order) ? $order['order_quantity'] : '' ?></td>
                                        <td><?php echo isset($order) ? $order['first_name'] . ' ' . $order['last_name'] : '' ?></td>
                                        <td><?php echo isset($order) ? $order['street'] .','. $order['state'].','.$order['city'].','.$order['zip']: '' ?></td>
                                        <td><?php echo isset($order) ? $order['order_status'] : '' ?></td>
                                        <td><?php echo isset($order) ? date('m/d/Y', strtotime($order['order_date'])) : '' ?></td>
                                        <td><?php echo isset($order) ? date('m/d/Y', strtotime($order['delivery_date'])) : '' ?></td>
                                        <td><button class="btn share-btn"  data-toggle="modal" data-target="#exampleModal1" name="message_button" data-reason='<?php echo isset($order) ? $order['reason'] : 'No message found from the customer' ?>'>Message</button></td>
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

<div id="exampleModal1" class="modal fade cust-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="set_goal_form" action="<?php echo BASE_URL ?>u_setgoal" method="POST">
                <div class="modal-body">
                    <div class="radio-wrap">
                        <div class="radio-bg-white">
                            <div class="tg-input-grp">
                                <label>Reason received at : <?php echo isset($order) ? date('M-d, Y H:i a', strtotime($order['created'])) : '' ?></label>
                                <p><?php echo isset($order) ? $order['reason'] : 'No message found from the customer' ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="button-wrap">
                        <button type="button" class="btn save-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>