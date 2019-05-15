<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>TJ's Pizza-Fundraising Company</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL?>global/img/favicon.ico"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo ASSETS?>global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo BASE_URL?>a_login">
                <img src="<?php echo ASSETS?>global/img/logo.png" alt="" height="210px" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?php echo BASE_URL?>admin/security/login" method="post">
                <h3 class="form-title font-green">Sign In</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
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
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Login</button>
                    <!-- <label class="rememberme check">
                        <input type="checkbox" name="remember" value="1" />Remember </label> -->
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
           <form class="forget-form" method="POST" action="<?php echo BASE_URL?>admin/security/forgetPassword">
                <h3 class="font-green">Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright"> 2014 © Metronic. Admin Dashboard Template. </div>
        <!--[if lt IE 9]>
<script src="<?php echo ASSETS?>global/plugins/respond.min.js"></script>
<script src="<?php echo ASSETS?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo ASSETS?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo ASSETS?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo ASSETS?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo ASSETS?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo ASSETS?>pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>