<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commission_m extends My_Model{

    protected $_table_name     = 'tj_commission_management';
    protected $_primary_key    = 'commission_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'commission_id';
    protected $_timestamps     = TRUE;
   
}

