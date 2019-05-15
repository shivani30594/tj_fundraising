<section class="contact-wrap">
    <div class="container-fluid">
        <div class="row">
            <p>Here is the leader-board of your group. List contains the number of sales-man helps you for the fundraising. We have display them based on the leading position from high to low.</p>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Total Amount </th>
                            <th> Total Quantity </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($leader_board) AND count($leader_board) > 0 ) : ?>
                        <?php $i=1;?>
                        <?php foreach($leader_board as $board) : ?>
                            <tr>
                                <td> <?php echo $i; $i= $i+1;?> </td>
                                <td> <?php echo (isset($board) && $board['first_name'] != '' ) ? $board['first_name']  : ''?> </td>
                                <td> <?php echo (isset($board) && $board['last_name'] != '' ) ? $board['last_name']  : '' ?> </td>
                                <td> <?php echo  (isset($board) && $board['total_amount'] != '' ) ? '$'.$board['total_amount']  : '$0.00'?> </td>
                                <td> <?php echo  (isset($board) && $board['total_quantity'] != '' ) ? $board['total_quantity']  : '0'?> </td>
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan=3>Group name: <?php echo $group_details->group_name?></td>
                            
                            <td>Total Amount : $<?php echo $total_amount?></td>
                            <td> Total Quantity : <?php echo $total_quantity?></td>
                        </tr>
                        <?php else:?>    
                            <tr><td colspan="4">There is no member present than the owner.</td></tr>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            
           
        </div>
    </div>
</section>
		   