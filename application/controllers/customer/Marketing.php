<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
    }

    public function index($name = '', $code = '')
    {
        if($code)
        {
           $user_infor =  $this->user_m->get_by("referral_code = '$code' AND is_active = 'Yes'");
           if (isset($user_infor) AND count($user_infor) > 0)
           {    
                $this->session->set_userdata('user_for_customer',$user_infor[0]->user_id);
                redirect('display_product');
           }
           else{
               echo "your referral code if not valid or may be account is deactived of the user who sends you the link";
           }
        }
    }
}