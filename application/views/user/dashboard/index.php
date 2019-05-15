		 <!-- <?php if(isset($group_details) AND !empty($group_details)) : ?> 
			<div class="other-info">
					<ul>
						<li>Average of 2 items sold per day</li>
						<li>$70 in sales remains until goal is reached</li>
					</ul>
				</div>
		<?php endif;?>   -->
		<div class="other-info">
			<ul>
				<li>Average of <?php echo isset($avg_items) ? $avg_items: '0'?> items sold per day</li>
				<li>$<?php echo isset($user_details->set_amount) ? $user_details->set_amount - $sales_total : '0';?> in sales remains until goal is reached</li>
			</ul>
		</div>
		<?php if(isset($group_details) AND !empty($group_details)) : ?>
			<div class="dashboard-exp">
				<h3>Dashboard - <span><?php echo (isset($group_details) AND !empty($group_details) ) ?ucfirst( $group_details['group_name']) : 'ex. Group Name'?></span></h3>
			</div>
		<?php endif;?>
		<div class="greeting-section">
			<div class="container-fluid">
				<div class="row">
					<div class="greet-wrap">
						<div class="main-head">
							<h4>Hi!</h4>
							<p class="name"> <?php echo ucfirst($user_details->first_name);?></p>
						</div>
						<p style="width:60%">TJ’s Pizza’s digital marketing and sales tool can help boost your sales and increase the funds raised by your organization. Managing customer data, tracking orders, and easily monitoring sales goals will help your success! 
							<?php if($own_group_details) : ?>
		 						<a href="<?php echo BASE_URL.'u_leader_board/'.$own_group_details[0]['group_id']?>">Click here to see leaderboard</a>
							<?php else:?>
		 						<a href="<?php echo BASE_URL.'security/register'?>">Click here to create new campaign</a>
							<?php endif;?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboad-wrap">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="orders-wrap dash-bx">
							<ul>
								<li><img src="<?php echo ASSETS?>global/img/pizza.png" alt="Order Images"></li>
								<li><img src="<?php echo ASSETS?>global/img/cookies.png" alt="Order Images"></li>
								<li><img src="<?php echo ASSETS?>global/img/pie.png" alt="Order Images"></li>
							</ul>
							<div class="dashhead"><a href="<?php echo BASE_URL?>u_order"><h3>Orders</h3></a></div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="person-wrap dash-bx">
							<ul>
								<li><img src="<?php echo ASSETS?>global/img/people1.png" alt="Person Images"></li>
								<li><img src="<?php echo ASSETS?>global/img/people2.png" alt="Person Images"></li>
							</ul>
							<div class="dashhead"><a href="<?php echo BASE_URL?>u_customer"><h3>Customers</h3></a></div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="sales-wrap dash-bx">
							<ul>
								<li>
									<div class="sale-box item-bx"></div>
									<p>Items Sold - <span>#<?php echo isset($item_sold) ? $item_sold : '0'?></span></p>
								</li>
								<li>
									<div class="sale-box total-bx"></div>
									<p>Total Sales - <span>$<?php echo isset($sales_total) ? number_format((float)$sales_total, 2, '.', '') : '0.00'?></span></p>
								</li>
							</ul>
							<div class="dashhead"><a href="<?php echo BASE_URL?>u_sale"><h3>Sales ($)</h3></a></div>
						</div>
					</div>
				</div>
			</div>
		</div>

