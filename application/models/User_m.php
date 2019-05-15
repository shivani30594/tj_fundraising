<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends My_Model {

    protected $_table_name     = 'tj_users';
    protected $_primary_key    = 'user_id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'user_id';
    protected $_timestamps     = TRUE;
 
    public function u_loggedin() {
        return (bool) $this->session->userdata('u_loggedin');
    }

    public function login($email, $password)
    {
        $this->db->where('password', $password);
    	$this->db->where('email', $email);
        $user = $this->db->get('tj_users')->row();
        if (count($user) )
        {
            if ($user->is_active == 'Yes') {
                $data = array(
                    'username' => $user->first_name . ' ' . $user->last_name,
                    'user_id' => $user->user_id,
                    'u_loggedin' => TRUE,
                    'name' => $user->first_name 
                );
    
                $this->session->set_userdata($data);
                return TRUE;
            }
            else
            {
                $this->session->set_flashdata("error","Your account is deactivated. Please contact to admin.");
            }
        }
        else{
            $this->session->set_flashdata("error","Password and username combination doesn't match.");
        }
        return false;
    }
}

