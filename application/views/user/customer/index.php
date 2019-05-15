<div class="heading cust-head">
    <?php echo $user_details->first_name?>'s Fundraising Site
</div>
<div class="links-wrapper">
    <div class="container-fluid">
        <div class="row">
            <a href="<?php echo BASE_URL?>u_invite" class="btn">Invite Now</a>
        </div>
    </div>
</div>
<section class="order-details">
    <div class="container-fluid">
        <div class="row">
            <div class="order-table">
                <div class="responsive-table">
                    <table id="orderTable" class="responsive ">
                    <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Delivery Address</th>
                                <th>Phone Number</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(count($customer_details) > 0):?>
                                <?php foreach($customer_details as $customer):?>
                                    <tr>
                                        <td><?php echo isset($customer) ? $customer['first_name'].' '. $customer['last_name'] : ''?></td>
                                        <td><?php echo isset($customer) ? $customer['email_id'] : ''?></td>
                                        <td><?php echo (isset($customer) AND $customer['street'] != '' AND $customer['zip'] != '' AND $customer['state'] != '' AND $customer['city'] != ''    ) ? $customer['street'].','. $customer['city'].','. $customer['state'].','. $customer['zip'] : 'Shipped/Pick Up'?></td>
                                        <td><?php echo isset($customer) ? $customer['phone_number'] : ''?></td>
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
