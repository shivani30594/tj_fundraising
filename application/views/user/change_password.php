<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo ASSETS ?>global/img/favicon.ico"/>
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/bootstrap.min.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/font-awesome.min.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/fonts.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/style.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/responsive.css"><!--bootstrap css-->

</head>
<body>
	<section class="acc-wrapper">
		<div class="acc-container">
			<div class="logo-wrapper"><img src="<?php echo ASSETS ?>global/img/login-logo.png" alt="Logo"></div>
			<div class="reset-wrap">
				<h4>Change Password</h4>
			</div>
			<form id="change_password_form" method="POST">
			    <div class="form-gr">
			      <input type="password" id="password" placeholder="Enter Password" name="password">
			    </div>
                <div class="form-gr">
			      <input type="password" id="retype_password" placeholder="Retype Password" name="retype_password">
			    </div>
			    <button type="submit" class="submit-btn">Submit</button>
			</form>
		</div>
	</section>
</body>
<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS ?>global/scripts/jquery.validate.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/custom.js"></script><!--jquery js-->

</html>