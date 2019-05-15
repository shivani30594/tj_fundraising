<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo ASSETS ?>global/img/favicon.ico"/>
  <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/bootstrap.min.css"><!--bootstrap css-->
  <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/font-awesome.min.css"><!--bootstrap css-->
  <link rel="stylesheet" href="<?php echo ASSETS ?>global/plugins/bootstrap/css/fonts.css"><!--bootstrap css-->
  <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/style.css"><!--bootstrap css-->
  <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/intlTelInput.css"><!--Input tel css-->
  <link rel="stylesheet" href="<?php echo ASSETS ?>global/css/responsive.css"><!--bootstrap css-->
</head>
<body>
	<section class="acc-wrapper">
		<div class="acc-container create-acc">
			<div class="logo-wrapper"><img src="<?php echo ASSETS ?>global/img/login-logo.png" alt="Logo"></div>
			<form action="<?php echo BASE_URL?>security/signup" method="POST" id="register_form">
					<div class="form-gr">
			      <input type="text" id="first_name" placeholder="First Name" name="first_name">
			    </div>
					<div class="form-gr">
			      <input type="text" id="last_name" placeholder="Last Name" name="last_name">
			    </div>
			    <div class="form-gr">
			      <input type="tel" id="phnum" placeholder="Phone Number" name="contact_phone" style="width:400px; margin-bottom:10px">
			    </div>
				<div class="form-gr">
			      <input type="email" id="email" placeholder="Email" name="email">
						<div style="display:none; color:red; padding:3px;" id="email_error">Email is already taken.Try another.</div>
			    </div>
			  
			    <div class="form-gr">
			      <input type="password" id="password" placeholder="Password" name="password">
			    </div>
			    <button type="submit" class="submit-btn">Submit</button>
			     <div class="form-gr"><a href="<?php echo BASE_URL?>" class="other-links">Already have an account? Sign IN</a></div>
			     <div class="or">or</div>
			     <a href="<?php echo $login_url;?>" class=" submit-btn fb-btn">SIGN IN WITH FACEBOOK</a>
			     <a href="<?php echo BASE_URL?>security/google_login" class="submit-btn gmail-btn">SIGN IN WITH GMAIL</a>
          	<!-- <button href="<?php $login_url;?>" class="btn submit-btn fb-btn">SIGN IN WITH FACEBOOK</button>
			     <button href="<?php echo BASE_URL?>security/google_login" class="submit-btn gmail-btn">SIGN IN WITH GMAIL</button> -->
			</form>
		</div>
	</section>
</body>
<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS ?>global/scripts/jquery.validate.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/intlTelInput.min.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/scripts/custom.js"></script><!--jquery js-->
<<script>
  jQuery(document).ready(function(){
    $("#phnum").intlTelInput({
          hiddenInput: "full_number",
          utilsScript: "../assets/global/scripts/utils.js"
        });
    $(document).on('change', '#email', function() {
      jQuery.ajax({
          url : '<?php echo BASE_URL?>security/validate_email',
          method: 'post',
          dataType: 'json',
          data: {email: $("#email").val()},
          success: function(response){
            if(response.status == 'found')
            {
							$("#email_error").show();
							$("#email").val('');
            }
						else
						{
							$("#email_error").hide();
              document.getElementById("email-error").style.display = 'none';
            }
          }
      });
    });

  });
</script>
</html>