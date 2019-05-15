<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php echo ($this->uri->segment(1) == 'a_dashboard') ? 'active' : ''?> open">
                <a href="<?php echo BASE_URL?>a_dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>
            <li class="nav-item  <?php echo ($this->uri->segment(1) == 'a_group' OR $this->uri->segment(2) == 'group') ? 'active' : ''?>  ">
                <a href="<?php echo BASE_URL?>a_group" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Group</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  <?php echo ($this->uri->segment(1) == 'a_user' OR $this->uri->segment(2) == 'user') ? 'active' : ''?>">
                <a href="<?php echo BASE_URL?>a_user" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  <?php echo ($this->uri->segment(1) == 'a_category' OR $this->uri->segment(2) == 'category') ? 'active' : ''?>">
                <a href="<?php echo BASE_URL?>a_category" class="nav-link nav-toggle">
                    <i class="icon-info"></i>
                    <span class="title">Category</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'a_product' OR $this->uri->segment(2) == 'product' OR $this->uri->segment(1) == 'a_product_info') ? 'active' : ''?>  ">
                <a href="<?php echo BASE_URL?>a_product" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Product</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  <?php echo ($this->uri->segment(1) == 'a_order') ? 'active' : ' '?>">
                <a href="<?php echo BASE_URL?>a_order" class="nav-link nav-toggle">
                    <i class="icon-basket"></i>
                    <span class="title">Order</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <!-- <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-notebook"></i>
                    <span class="title">Shipping</span>
                    <span class="arrow"></span>
                </a>
            </li> -->
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'a_paypal') ? 'active' : ' '?> ">
                <a href="<?php echo BASE_URL?>a_paypal" class="nav-link nav-toggle">
                    <i class="fa fa-paypal"></i>
                    <span class="title">Paypal History</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'a_contact') ? 'active' : ' '?> ">
                <a href="<?php echo BASE_URL?>a_contact" class="nav-link nav-toggle">
                    <i class="fa fa-question"></i>
                    <span class="title">Contact Inquiries</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(1) == 'a_commission') ? 'active' : ' '?> ">
                <a href="<?php echo BASE_URL?>a_commission" class="nav-link nav-toggle">
                    <i class="fa fa-file"></i>
                    <span class="title">Commission Management</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <!-- <li class="nav-item <?php echo ($this->uri->segment(1) == 'a_commission') ? 'active' : ' '?> ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Sales History</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="ui_colors.html" class="nav-link ">
                            <span class="title">Sales By Product</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="ui_general.html" class="nav-link ">
                            <span class="title">Sales By Product</span>
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>