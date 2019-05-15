<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('contact_m');
        $this->load->model('customer_m');
        // $this->load->helper('email_helper');  
        if ($this->user_m->u_loggedin() == FALSE) {
            redirect('u_login');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/contact/index';
        $this->data['script'] = 'user/contact/script';
        $this->load->view('user_layout_main', $this->data);
    }

    public function save()
    {
        $contact_info['email_id'] = $this->input->post('email');
        $contact_info['message'] = $this->input->post('message');
        $contact_info['subject'] = $this->input->post('subject');
        $result = $this->contact_m->save($contact_info);
        if ($result)
        {
            $this->session->set_flashdata("success","You contact request for the admin will send successfully");
        }
        else{
            $this->session->set_flashdata("danger","Something happens wrong!");
        }
        redirect('u_contact');
    }
}