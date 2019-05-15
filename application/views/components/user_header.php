<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="logo-wrap">
                    <a href="#"><img src="<?php echo ASSETS ?>global/img/logo.png" alt="Logo"></a>
                </div>
                <div class="social-mobile"><a href="#"><img src="<?php echo ASSETS ?>global/img/share.svg" alt="Logo"></a></div>
                <div class="social-wrap">
                    <ul class="social-nav">
                    <?php $marketing_link = "http://www.facebook.com/sharer.php?u=".urlencode(BASE_URL.'marketing/'.trim($user_details->first_name).'/'.trim($user_details->referral_code))?>
                    <?php $twitter_link = "http://twitter.com/share?text=TJ_fundraising&url=".BASE_URL.'marketing/'.trim($user_details->first_name).'/'.trim($user_details->referral_code);?>
                        <li><a href="javascript:void(0)" onclick="javascript:genericSocialShare('<?php echo $marketing_link ?>')"><img src="<?php echo ASSETS ?>global/img/facebook.svg" alt="Facebook"></a></li>
                        <li><a href="javascript:void(0)" onclick="javascript:genericSocialShare('<?php echo $twitter_link ?>')"><img src="<?php echo ASSETS ?>global/img/twitter.svg" alt="Twitter"></li>
                    </ul>
                </div>
                <div class="mobile-menu"><a href="#"><img src="<?php echo ASSETS ?>global/img/menu.svg" alt="Menu"></a></div>
                <div class="menu-wrap">
                    <ul class="navigation">
                        <?php if($user_details->individual_status != NULL) :?>
                            <li class="<?php echo $this->uri->segment(1) == 'u_dashboard' ? 'active': ''?>"><a href="<?php echo BASE_URL?>u_dashboard">Dashboard</a></li>
                             <!-- <li class="<?php echo $this->uri->segment(1) == 'u_product' ? 'active': ''?>">
                                <div class="btn-group">
                                    <a >Make Money</a>
                                    <div class="dropdown-content dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo BASE_URL?>u_product">View Products</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Set Goal</a>
                                    </div>
                                </div>
                            </li> -->
                             <li class="<?php echo $this->uri->segment(1) == 'u_product' ? 'active': ''?>">
                                <div class="btn-group has-sub">
                                    <a  aria-haspopup="true" aria-expanded="false">
                                        Make Money!
                                    </a>
                                    <div class="sub-menu-wrap" style="background-color:#991e1e">
                                        <a class="dropdown-item" href="<?php echo BASE_URL?>u_product">View Products</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Set Goal</a>
                                    </div>
                                </div>
                            </li>
                            <li class="<?php echo ( $this->uri->segment(1) == 'u_customer' OR  $this->uri->segment(1) == 'u_invite' OR  $this->uri->segment(1) == 'u_customer' OR $this->uri->segment(1) == 'invite' OR $this->uri->segment(1) == 'share')? 'active': ''?>"><a href="<?php echo BASE_URL?>u_customer">Customers</a></li>
                            <li class="<?php echo $this->uri->segment(1) == 'u_order' ? 'active': ''?>"><a href="<?php echo BASE_URL?>u_order">Orders</a></li>
                            <li class="<?php echo $this->uri->segment(1) == 'u_sale' ? 'active': ''?>"><a href="<?php echo BASE_URL?>u_sale">Sales</a></li>
                            <li class="<?php echo ($this->uri->segment(1) == 'u_contact') ? 'active' : ''?>"><a href="<?php echo BASE_URL?>u_contact">contact</a></li>
                        <?php endif;?>
                        <li><a href="<?php echo BASE_URL?>u_logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
