<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->model('customer_m');
        $this->load->helper('email_helper');  
        if ($this->user_m->u_loggedin() == FALSE) {
            redirect('u_login');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/customer/index';
        $this->data['script'] = 'user/customer/script';
        $jointOptions = array(
            "fields" => "*",
            "conditions" => "user_id = ".$this->data['user_details']->user_id,
        );
        $this->data['customer_details'] = $this->customer_m->get_relation('',$jointOptions);
       
        $this->load->view('user_layout_main', $this->data);
    }

    public function send_email_to_cutsomer()
    {
        $emails = $this->input->post('email');
        $subject = $this->input->post('subject');
        $body = $this->input->post('message');
        $body = $body.'<p ><span style="text-decoration: underline;"><a href='.BASE_URL.'marketing/'.trim($this->data['user_details']->first_name).'/'.trim($this->data['user_details']->referral_code).'>Click here to purchase and share the food</a></span></p>
                <p>Thank you.&nbsp;</p>';
        send_mail_to_customers($emails, $subject, $body);
        redirect("u_invite");
    }

    public function invite()
    {
        // if( $this->data['user_details']->set_amount == '' OR $this->data['user_details']->set_quantity == 0)
        // {
        //     $this->session->set_flashdata('success',"Hello User. Would you please set your goal from Make Money->Set Goal");
        //     redirect("u_dashboard");
        // }
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/invite/index';
        $this->data['script'] = 'user/invite/script';
        $this->load->view('user_layout_main', $this->data);
    }

    public function cust_invite()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/invite/cust_invite';
        $this->data['script'] = 'user/invite/script';
        $this->load->view('user_layout_main', $this->data);
    }

    public function share()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/invite/share';
        $this->data['script'] = 'user/invite/script';
        $this->load->view('user_layout_main', $this->data);
    }
}