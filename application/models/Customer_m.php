<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_m extends My_Model {

    protected $_table_name     = 'tj_customers';
    protected $_primary_key    = 'customer_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'customer_id';
    protected $_timestamps     = TRUE;
 
}

