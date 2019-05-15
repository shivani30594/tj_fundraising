<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('email_helper');  
        $this->load->model('admin_m');
    }

    public function index()
	{
        if ($this->session->userdata('loggedin')) {
            redirect('a_dashboard');
            exit;
        }
        $this->load->view('admin/login');
    }

    public function login()
    {
        if ($this->session->userdata('loggedin')) {
            redirect('a_dashboard');
            exit;
        }
        if ($this->admin_m->login() == FALSE)
        {
            $this->session->set_flashdata('error', "Password and email combination doesn't match");
            redirect('a_login');
            exit;
        }
        else
        {
            redirect('a_dashboard');
            exit;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('a_login');
    }

    public function forgetPassword()
    {
        if ($this->input->post())
        {
            $email = $this->input->post('email');
            $user = $this->admin_m->getUserByfield('tj_admin', 'email', $email );            
            if (!empty($user))
            {
                $token = md5($user->email . rand());
                $data = array(
                    'verification_code' => $token,
                );
                $this->admin_m->updateUser($user->id, $data);
                $to = $email;
                $subject = "Reset Your Password";
                $body = "<p><strong>Hello</strong> <strong>" . $user->first_name . "</strong>,</p>
                  Please click below link to change your password.<br>
                  <a href=" . base_url('admin/security/changePassword') . "?token=" . $token . ">Click Here</a>
                  <p><strong>Thanks,</strong><br>TJ's Fundraising Company</p>
                  <p>&nbsp;</p>";
                //$body="User name : ".$_POST['email']." "."<br>"."passowrd : ".'12345';
                $temp = send_mail($to, $subject, $body);

                if ($temp)
                {
                    $this->session->set_flashdata("success", "Reset password mail is successfully sent to your emailId " . $email);
                    redirect('a_login');
                }
                else
                {
                    $this->session->set_flashdata("error", "Opps Something went wrong!!");
                    redirect('a_login');
                }
            }
            else
            {
                $this->session->set_flashdata("error", "Email you have entered is not exists!!");
                redirect('a_login');
            }
        }
        else
        {
            $this->session->set_flashdata("error", "Sorry Something went wrong!!!!!");
            redirect('a_login');
        }
    }
/**
 * [changePassword description]
 * @return [type] [description]
 */
    public function changePassword()
    {
        // $this->load->view('admin/change_password');
        if (!isset($_GET['token']))
        {
            show_error('Invalid Url');
        }
        $token = $_GET['token'];

        $user = $this->admin_m->getUserByfield('tj_admin', 'verification_code', $token);
        if ($this->input->post())
        {
            $data = array(
                'password' => md5($this->input->post('password')),
                'verification_code' => NULL,
            );
            $this->admin_m->updateUser($user->id, $data);
            $this->session->set_flashdata("success", "Your password is changed successfully!!");
            redirect('a_login');
        }

        if (!empty($user))
        {
            if ($user->verification_code == NULL)
            {
                show_error("Your reset password link is expired");
            }
        }
        else
        {
            show_error("Your reset password link is expired");
        }

        $this->load->view('admin/change_password');
    }

}