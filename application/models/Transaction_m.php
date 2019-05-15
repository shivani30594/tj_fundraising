<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_m extends My_Model {

    protected $_table_name     = 'tj_payment';
    protected $_primary_key    = 'user_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'id';
    protected $_timestamps     = TRUE;
 
}

