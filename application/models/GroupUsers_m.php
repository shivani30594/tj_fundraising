<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GroupUsers_m extends My_Model {

    protected $_table_name     = 'tj_group_users_managament';
    protected $_primary_key    = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'id';
    protected $_timestamps     = TRUE;
 
}

