<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_m extends My_Model{

    protected $_table_name     = 'tj_products';
    protected $_primary_key    = 'product_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'product_id';
    protected $_timestamps     = TRUE;
   
}

