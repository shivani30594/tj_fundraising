<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_m extends My_Model {

    protected $_table_name     = 'tj_notification';
    protected $_primary_key    = 'notification_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'notification_id';
    protected $_timestamps     = TRUE;
 
}

