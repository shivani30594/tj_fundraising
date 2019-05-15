<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FundraisierGroup_m extends My_Model {

    protected $_table_name     = 'tj_fundraisergroup';
    protected $_primary_key    = 'group_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'group_id';
    protected $_timestamps     = TRUE;
 
}

