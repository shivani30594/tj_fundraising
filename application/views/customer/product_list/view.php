<section class="product-view">
	<div class="container-fluid">
		<div class="row">
			<div class="pr-view-wrap">
				<div class="pr-looking">Looking for <?php echo isset($product_details) ? $product_details->product_name : ''?></div>
				<div class="pr-view-left">
					<div class="img-wrap">
						<!-- <div class="pr-first">
							<a href="<?php echo BASE_URL.'product_view/'. $product_details->product_id?>"><img src="<?php echo ASSETS?>global/img/food-1.png" alt="Food"></a>
							<a href="<?php echo BASE_URL.'product_view/'. $product_details->product_id?>"><img src="<?php echo ASSETS?>global/img//food-2.png" alt="Food"></a>
						</div>
						<div class="pr-second">
							<a href="<?php echo BASE_URL.'product_view/'. $product_details->product_id?>"><img src="<?php echo ASSETS?>global/img/food-3.png" alt="Food"></a>
						</div> -->
						<div style="border: 4px solid #b31818; width: 100%;"><img src="<?php echo ASSETS.'uploads/products/'.$product_details->product_image?>" alt="Food Item"></div>
							<form action="<?php echo BASE_URL?>customer/customer/add_prod" method="post">
								<input type="hidden" name="id" value="<?php echo $product_details->product_id?>">
								<input type="hidden" name="name" value="<?php echo $product_details->product_name?>">
								<input type="hidden" name="price" value="<?php echo $product_details->product_price?>">
								<div class="div-wrap">
									<div class="add-cart"><button class="add-to-cart-btn btn" style="line-height: 20px !important;" type="submit"><i class="fa fa-shopping-cart"></i> Add to Cart</button></div>
									<div class="pr-qyt">
										<select class="pr-qyt-num" id="quantity" name="quantity">
											<?php for($i=1;$i<=10;$i++):?>
												<option value="<?php echo $i?>"><?php echo $i?></option>
											<?php endfor;?>
										</select>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="pr-view-right">
						<div class="pr-content">
							<h1><a href="<?php echo BASE_URL.'product_view/'. $product_details->product_id?>"><?php echo isset($product_details) ? $product_details->product_name : ''?></a></h1>
							<div class="pr-det">upc/sku#: <?php echo isset($product_details) ? $product_details->product_sku : ''?></div>
							<div class="pr-price">
								Price :- <span>$<span id="<?php echo 'price_'.$product_details->product_id?>" ><?php echo isset($product_details) ? number_format((float)$product_details->product_price, 2, '.', '') : ''?></span></span>
							</div>
							<div class="pr-review">
							<?php
								for($x=1;$x<=$starNumber;$x++) {
									echo '<i class="fa fa-star"></i>';
								}
								if (strpos($starNumber,'.')) {
									echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
									$x++;
								}
								while ($x<=5) {
									echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
									$x++;
								}
								?>
						
								<span><?php echo isset($total_reviews) ? $total_reviews.' Reviews' : ''?></span>
							</div>
							<div class="pr des">
								<div class="abt-pr">
									<h3>About Product</h3>
									<p><?php echo isset($product_details) ? $product_details->product_description : ''?></p>
								</div>
								<div class="nut-pr">
									<h3>Nutritional facts</h3>
									<p><?php echo isset($product_details) ? $product_details->nutrition_facts : ''?></p>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>