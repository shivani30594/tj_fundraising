<div class="heading"><img src="<?php echo ASSETS?>global/img/heading-1.png" alt="Start a Fundraiser TODAY!"></div>
<div class="childern-bg"></div>
<div class="registration-wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="register-content">
					<form id="create_campaign_form" action="<?php echo BASE_URL?>user/campaign/create_campaign" method="POST" enctype="multipart/form-data">
						<div class="col-md-4 col-sm-4">
							<div class="tg-input-grp">
								<label for="tg-org-name">Organization/Intividual</label>
								<input type="text" name="group_name" class="tg-input">
							</div>
							<div class="tg-input-grp">
								<label for="tg-email">Email</label>
								<input type="email" name="email" class="tg-input">
							</div>
							<div class="tg-input-grp">
								<label for="tg-add">Address</label>
								<input type="text" name="address" id="address" class="tg-input">
							</div>
							<div class="tg-input-grp">
								<label for="tg-cntp">Contact person</label>
								<input type="text" name="contact_person" id="contact_person" class="tg-input">
							</div>
							<div class="tg-input-grp">
								<label for="tg-cnt">Contact Phone</label>
								<input type="tel" name="contact_phone" id="contact_phone" class="tg-input" style="width: 430px;">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 middle-section">
							<div class="tg-input-grp">
								<label class="chk-lb">
									<input type="checkbox" name="disclaimers" id="disclaimers">
									<div class="chk_check"></div>
								</label>
									<div class="dis-text">Disclaimers</div>
									<div class="dis-content">Disclaimers</div>
							
							</div>
							<div class="tg-input-grp">
								<!-- <a href="#" class="tg-btn-submit">Submit</a> -->
								<button style="background: rgba(254,143,30,0.5);
								display: block;
								height: 59px;
								text-align: center;
								line-height: 60px;
								font-family: 'Britannic';
								color: #ffffff;
								font-size: 35px;
								font-weight: 600;
								margin-top: 50px;
								width: 100%;" type="submit" class="btn tg-btn-submit"> Submit </button>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="tg-input-grp tg-input-date">
								<label for="tg-date">Project Start</label>
								<input type="date" name="project_start" class="tg-input">
							</div>
							<div class="tg-input-grp tg-input-date">
								<label for="tg-date">Project Finish</label>
								<input type="date" name="project_end" class="tg-input">
							</div>
							<div class="tg-input-grp">
								<label for="tg-file">Tax Exempt?</label>
								<input type="text" name="tax_document_name" class="tg-input" id="tax_document_name" placeholder="If yes, then upload document">
								<input type="file" name="tax_document" id="tax_document">
							</div>
							<div class="tg-input-grp">
								<label for="tg-date">Delivery Method</label>
								<div class="dropdown">
									<input type="text" id="delivery_method" class="del-method tg-input" name="delivery_method">
									<div class="dropdown-content">
										<ul>
											<li><a href="javascript:void(0);">Pick Up</a></li>
											<li><a href="javascript:void(0);">Ship</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="tg-input-grp">
								<label class="chk-lb add-lb">
									<input type="checkbox" id="same_address">Same as ‘Address’
									<div class="chk_check"></div>
								</label>
								<label style="    color: #e65322;
    display: block;
    font-size: 22px;
    font-family: 'Britannic';
    font-weight: 600;
    line-height: 26px;
    margin-bottom: 10px;">Delivery Location</label>
								<input type="text" id="delivery_location" name="delivery_location" class="tg-input">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>