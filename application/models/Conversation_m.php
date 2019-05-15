<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conversation_m extends My_Model{

    protected $_table_name     = 'tj_conversation';
    protected $_primary_key    = 'comment_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'id';
    protected $_timestamps     = TRUE;
   
}

