<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Forgot Password</title>
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
				<h4>Reset Your Password</h4>
				<p>Enter your email id and we will help you to reset your password.</p>
			</div>
			<form id="forgot_form" action="<?php echo BASE_URL?>security/forgot_password" method="POST">
			    <div class="form-gr">
			      <input type="email" id="email" placeholder="Email" name="email">
			    </div>
			    <button type="submit" class="submit-btn">Submit</button>
			     <div class="form-gr"><a href="<?php echo BASE_URL?>" class="other-links frg-link">Back to Login</a></div>
			</form>
		</div>
	</section>
</body>
<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS ?>global/scripts/jquery.validate.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/custom.js"></script><!--jquery js-->

</html>