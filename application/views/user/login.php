<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo ASSETS ?>global/img/favicon.ico"/>
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/bootstrap.min.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/font-awesome.min.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/fonts.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/style.css"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/responsive.css"><!--bootstrap css-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/socket.io-file-client@2.0.2/socket.io-file-client.js"></script>
</head>
<body>
	<section class="acc-wrapper">
		<div class="acc-container">
			<div class="logo-wrapper"><img src="<?php echo ASSETS ?>global/img/login-logo.png" alt="Logo"></div>
			<form  id="login_form" class="login-form" action="<?php echo BASE_URL?>security/login" method="post">
                <?php if ($this->session->flashdata("error")) : ?>
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span><?php echo $this->session->flashdata("error");?></span>
                    </div>
                <?php endif;?>
                <?php if ($this->session->flashdata("success")) : ?>
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button>
                        <span><?php echo $this->session->flashdata("success");?></span>
                    </div>
                <?php endif;?>
				<div class="form-gr">
			      <input type="email" id="email" placeholder="User ID / Email" name="email" >
			    </div>
			    <div class="form-gr">
			      <input type="password" id="password" placeholder="Password" name="password" >
			    </div>
			    <div class="form-gr"><a href="<?php echo BASE_URL?>security/forgot" class="other-links frg-link">Forgot Password?</a></div>
			    <button type="submit" class="submit-btn">Submit</button>
			     <div class="form-gr"><a href="<?php echo BASE_URL?>security/register" class="other-links">Don’t have an account? Sign Up</a></div>
			</form>
		</div>
	</section>
	<div class="he_205">
        <div id="siteloader">
	        <iframe src="https://node-live-chatbot.herokuapp.com/" width="100%" height="1000" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>	
</body>
<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS ?>global/scripts/jquery.validate.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/custom.js"></script><!--jquery js-->
<!-- <script type="text/javascript">
// $('#siteloader').load('https://node-live-chatbot.herokuapp.com/');
console.log("HII");
		// $.ajax({
	    //    url: 'http://clientapp.narola.online/SD/chatbot/visitor/visitor/check_status',           
        //    type: 'POST',          
        //    data: { url:window.location.href },          
        //    success: function(response){       
        //    	if(response.status === "yes")
        //    	{
        //    		$('#siteloader').load('https://node-live-chatbot.herokuapp.com/');
        //    	}
        //    	else
        //    	{
		// 		alert("Your website is not enrolled into our system. Would you please check it ?")
        //    	}           
        //   }                     
        // });
</script> -->
</html>