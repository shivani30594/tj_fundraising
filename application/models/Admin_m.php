<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends My_Model{

    protected $_table_name     = 'tj_admin';
    protected $_primary_key    = 'id';
    protected $_primary_filter = 'intval';
    protected $_timestamps     = TRUE;
    
    public function login()
    {
    	  $user = $this->get_by(array(
            'email' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
             ), TRUE);
    	 if (count($user))
    	 {
    	 	$data = array(
    	 		'loggedin' => TRUE ,
    	 		'admin_id' => $user->id,
                'username' => $user->first_name . ' ' . $user->last_name
            );

    	 	$this->session->set_userdata($data);
            return TRUE;
    	 }
    	 return FALSE;
    }

    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }

    public function getUserByfield($tbl, $field, $value, $filed2 = NULL, $value2 = NULL)
    {
        $this->db->where($field, $value);
         if ($filed2 != NULL)
        {
            $this->db->where($filed2, $value2);
        }
        $query = $this->db->get($tbl);

        if ($query->num_rows() == 1)
        {
            $row = $query->row();
            return $row;
        }
        return false;
    }

    public function updateUser($user_id, $data)
    {
        $this->db->where('id', $user_id);
        if ($this->db->update('tj_admin', $data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}

