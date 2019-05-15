<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>TJ's Pizza-Fundraising Company</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="shortcut icon" type="image/png" href="<?php echo ASSETS ?>global/img/favicon.ico"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo ASSETS?>global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo ASSETS?>global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo ASSETS?>global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS ?>global/css/sweetalert2.min.css" rel="stylesheet"><!--bootstrap css-->

        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo ASSETS?>layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo ASSETS?>layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="<?php echo ASSETS?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>pages/css/profile.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo ASSETS?>global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo ASSETS?>global/css/intlTelInput.css"><!--Input tel css-->
        <link rel="shortcut icon" href="favicon.ico" />
        <style>
            .error {
                color: #b32025;
                font-size: 14px;
                font-weight: normal;
                font-style: italic;
            }

            .page-header.navbar .menu-toggler.sidebar-toggler {
                float: right;
                margin: 23px 0 0;
                position: absolute;
                top: 0px;
                right: 10px;
            }

            .page-header.navbar .page-logo>.logo-image, .page-header.navbar .page-logo>a {
                display: block;
                float: unset;
            }
        </style>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
        <!-- BEGIN HEADER -->
        <?php  $this->load->view('components/admin_header');?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php $this->load->view('components/admin_sidebar')?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                    <?php  $this->load->view($subview);?>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
      
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
      <?php $this->load->view('components/admin_footer')?>