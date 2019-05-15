<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategory_m extends My_Model{

    protected $_table_name     = 'tj_product_category';
    protected $_primary_key    = 'category_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'category_id';
    protected $_timestamps     = TRUE;
   
}

