<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_m extends My_Model{

    protected $_table_name     = 'tj_payment';
    protected $_primary_key    = 'transaction_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'transaction_id';
    protected $_timestamps     = TRUE;
   
}

