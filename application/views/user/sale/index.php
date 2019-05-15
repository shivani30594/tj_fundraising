        <div class="heading cust-head">
            <?php echo ucfirst( $user_details->first_name)?>'s Fundraising Site
        </div>
		<div class="links-wrapper">
			<div class="container-fluid">
				<div class="row">
					<!-- <div class="edit-web">Edit your digital website</div> -->
					<!-- <p class="links">Marketing Link: <a href="#">>>https://DigitalSales.TJsPizza.com/JenniferAustin</a><a href="#">&lt;Click to copy&gt;</a></p> -->
					<p class="tips-text">Tip: Good business is knowing what’s been ordered, approved, and when it’s scheduled for delivery!</p>
				</div>
			</div>
		</div>

		<div class="dashboad-wrap">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 col-sm-12">
						<div class="order-stack profile-bx">
							<ul>
								<li><div class="order-del"><?php echo ( isset($order_details) AND count($order_details) > 0 ) ? count($order_details) : '0'  ?></div><span>Orders need to be delivered</span></li>
								<li><div class="order-del"><?php echo isset($total_sale) ? $total_sale : '0'?></div><span>Sales this week</span></li>
							</ul>
						</div>
						<div class="news-stack profile-bx">
							<div class="s-head">News</div>
							<ul>
								<?php if(isset($notifications) AND count($notifications) > 0):?>
									<?php foreach($notifications as $notification) :?>
										<li><?php echo ucfirst($notification['description'])?></li>
									<?php endforeach;?>
								<?php else:?>
									<div class="sale-head"><h1>No News Found</h1></div>
								<?php endif;?>
							</ul>
						</div>
						<div class="comment-stack profile-bx">
							<div class="s-head">Customer Comments</div>
							<ul>
								<?php if(isset($comments) AND count($comments) > 0):?>
									<?php foreach($comments as $comment) :?>
										<li><?php echo ucfirst($comment['comment'])?></li>
									<?php endforeach;?>
								<?php for($i=0;$i<3-count($comments);$i++) :?>
								<br>
								<?php endfor;?>
								<?php else:?>
									<div class="sale-head"><h1>No Comments Found</h1></div>
								<?php endif;?>
								
							</ul>
						</div>
					
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="delivery-wrap profile-bx ">
							<div class="delivery-table">
								<table>
									<thead>
										<tr>
											<th></th>
											<th>Name</th>
											<th></th>
											<th>Order Date</th>
										</tr>
									</thead>
									<tbody>
                                        <?php if(isset($order_details) AND count($order_details) > 0):?>
                                            <?php foreach($order_details as $order) : ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo isset($order_details) ? ucfirst($order['first_name']) .' '. $order['last_name'] : ' '?></td>
                                                    <td>-</td>
                                                    <td><?php echo isset($order_details) ?  date( 'm/d/Y', strtotime($order['order_date'])) : '' ?></td>
                                                </tr>
                                            <?php endforeach;?>
										<?php else:?>
											<tr><td style="text-align:center" colspan="4">No Orders available</td></tr>
                                        <?php endif;?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="sales-wrap profile-bx">
							<ul>
								<li>
									<div class="sale-head">Sales<br> by Product</div>
								</li>
								<!-- <div class="sale-img"><img src="<?php echo ASSETS?>global/img/sale-by-product.png" alt="Sale by Product"></div> -->
								<?php if(isset($sale_of_the_week) AND count($sale_of_the_week) >0 ):?>
									<div id="chartContainer" class="sale-img" ></div>
								<?php else:?>
									<div class="sale-head"><h1>No Items Sold</h1></div>
								<?php endif;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>