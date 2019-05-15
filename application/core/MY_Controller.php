<?php
class MY_Controller extends CI_Controller 
{
	public $data = array();
		
		function __construct() 
		{
			parent::__construct();
			$this->data['errors'] = array();
			$this->load->model('admin_m');
			$this->load->model('user_m');
			$this->load->model('groupUsers_m');
			$this->load->model('fundraisierGroup_m');

			if ($this->session->userdata('admin_id'))
			{
				$this->data['admin_details'] = $this->admin_m->get($this->session->userdata('admin_id'), true);
			}
			if ($this->session->userdata('user_id')) {
			
				$this->data['user_details'] = $this->user_m->get($this->session->userdata('user_id'));
			}
		}
}