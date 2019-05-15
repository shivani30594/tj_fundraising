<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/registration/index';
        $this->data['script'] = 'user/registration/script';
        $this->load->view('user_layout_main', $this->data);
    }
}