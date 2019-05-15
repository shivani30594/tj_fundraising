<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Security extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        require_once APPPATH.'third_party/src/Google_Client.php';
        require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
        $this->load->library('facebook'); 
        $this->session->keep_flashdata('message');
    }

    public function index()
	{
       
        if ($this->session->userdata('u_loggedin')) {
            $this->check_group_status();
            redirect('u_dashboard');
            exit;
        }
        $data['login_url'] = $this->facebook->login_url();
        $this->load->view('user/login', $data);
    }

    public function facebook()
    {
        if ($this->facebook->is_authenticated())
        {
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture,birthday');
        //    print_r($userProfile);
        //    die;
            $relation = array(
                "fields" => "*",
                'conditions' => "token ='" .$userProfile['id'] . "'"
            );
            $userInfo = $this->user_m->get_relation('', $relation, false);
            $data  = array();
            if (count($userInfo) == 0)
            {
                $userArray['token'] = $userProfile['id'];
                $userArray['first_name'] = $userProfile['first_name'];
                $userArray['last_name'] = $userProfile['last_name'];
                $userArray['email'] = $userProfile['email'];
                $userArray['picture'] = $userProfile['picture']['data']['url'];
                $userArray['is_active'] = 'Yes';
                $userArray['individual_status'] = NULL;
                $userArray['referral_code'] = generate_refferal_code();
                $userArray['username'] = $userProfile['first_name'] .' '. $userProfile['last_name'];
                $result = $this->user_m->save($userArray);
                $data['user_id'] =  $this->db->insert_id();
            }
            else{
                $data['user_id'] = $userInfo[0]['user_id'];
            }
            $data = array(
                'name' => $userProfile['first_name'],
                'username' => $userProfile['first_name'] .' '. $userProfile['last_name'],
                'picture' => $userProfile['picture']['data']['url'],
                'u_loggedin' => TRUE,
                'user_id' =>  $data['user_id']
            );
            $this->session->set_userdata($data);
            $this->check_group_status();
            redirect('u_dashboard');
        }
        else{
            redirect('u_login');
        }
    }
    public function google_login()
    {

        $clientId = GOOGLE_CLIENT_ID; //Google client ID
        $clientSecret = GOOGLE_CLIENT_SECRET ; //Google client secret
        $redirectURL = GOOGLE_REDIRECT_URL;

        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if(isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $this->session->set_userdata('token' , $gClient->getAccessToken());
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) 
        {
            $gClient->setAccessToken($this->session->userdata('token'));
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            $relation = array(
                "fields" => "*",
                'conditions' => "token ='" .$userProfile['id'] . "'"
            );
            $data  = array();
            $userInfo = $this->user_m->get_relation('', $relation, false);
            if (count($userInfo) == 0)
            {
                $userArray['token'] = $userProfile['id'];
                $userArray['first_name'] = $userProfile['given_name'];
                $userArray['last_name'] = $userProfile['family_name'];
                $userArray['email'] = $userProfile['email'];
                $userArray['username'] = $userProfile['name'];
                $userArray['picture'] = $userProfile['picture'];
                $userArray['is_active'] = 'Yes';
                $userArray['individual_status'] = NULL;
                $userArray['referral_code'] = generate_refferal_code();
                $result = $this->user_m->save($userArray);
            }
            else{
            }
            $data = array(
                'username' =>  $userProfile['name'],
                'name' =>  $userProfile['first_name'],
                'picture' => $userProfile['picture'],
                'user_id' => count($userInfo) == 0 ? $this->db->insert_id() : $userInfo[0]['user_id'],
                'u_loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
            $this->check_group_status();
            redirect('u_dashboard');
        } 
        else 
        {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }
    }	

    public function login()
    {
        if ($this->session->userdata('u_loggedin')) {
            $this->check_group_status();
            redirect('u_dashboard');
            exit;
        }
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        if ($this->user_m->login($email, $password) == FALSE)
        {
            redirect('u_login');
            exit;
        }
        else
        {
            $this->check_group_status();
            redirect('u_dashboard');
            exit;
        }
    }

    public function register()
    {
        $data['login_url'] = $this->facebook->login_url();
        $this->load->view('user/register', $data);
    }

    public function forgot()
    {
        $this->load->view('user/forgot');
    }

    public function signup()
    {
        $userInfo['password'] = md5($this->input->post('password'));
        $userInfo['email'] = $this->input->post('email');
        $userInfo['username'] = $this->input->post('first_name') . ' ' .  $this->input->post('last_name');
        $userInfo['picture'] = DEFAULT_IMAGE;
        $userInfo['contact_phone'] = $this->input->post('full_number');
        $userInfo['first_name'] = $this->input->post('first_name');
        $userInfo['last_name'] = $this->input->post('last_name');
        $userInfo['referral_code'] = generate_refferal_code();
        $result = $this->user_m->save($userInfo);
        if ($result)
        {
            $this->session->set_flashdata('success', "Registration done successfully");
            redirect('u_login');
            exit; 
        }
        else{
            $this->session->set_flashdata('error', "Something happens wrong!");
            redirect('u_login');
            exit; 
        }

    }

    public function validate_email()
    {
        $email = $this->input->post('email');
        $result = $this->user_m->get_by("email = '$email'");
        if (count($result) > 0)
        {
            return  $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'found')));
        }
        else{
            return  $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'not_found')));
        }

    }

    public function forgot_password()
    {
        $this->load->helper('email_helper');  
        if ($this->input->post())
        {
            $email = $this->input->post('email');
            $user = $this->user_m->get_by("email = '$email'")[0];  
            if (!empty($user))
            {
                $token = md5($user->email . rand());
                $data = array(
                    'verification_code' => $token,
                    'updated' => date('Y-m-d H:i:s')
                );
                $this->user_m->save($data, $user->user_id);
                $to = $email;
                $subject = "TJ's Fundraising Password Reset";
                $body = "<p><strong>Hello</strong><strong>" . $user->first_name . "</strong>,</p>Looks like you'd like to change your                 password. Please click the following link to do so:<br>
                        <a href=" . base_url('security/changePassword') . "?token=" . $token . ">Click Here</a>
                        <P>Please disregard this e-mail if you did not request a password rest.</p>
                        <p><strong>Cheers,</strong></p>
                        <p><b>The TJ's Pizza Fundraising Company<b></p>
                        <img src='". ASSETS. "global/img/login-logo.png' height='100px' width='100px'>";
                //$body="User name : ".$_POST['email']." "."<br>"."passowrd : ".'12345';
                $temp = send_mail($to, $subject, $body);

                if ($temp)
                {
                    $this->session->set_flashdata("success", "Reset password mail is successfully sent to your emailId " . $email);
                    redirect('u_login');
                }
                else
                {
                    $this->session->set_flashdata("error", "Opps Something went wrong!!");
                    redirect('u_login');
                }
            }
            else
            {
                $this->session->set_flashdata("error", "Email you have entered is not exists!!");
                redirect('u_login');
            }
        }
        else
        {

            $this->session->set_flashdata("error", "Sorry Something went wrong!!!!!");
            redirect('a_login');
        }
    }

    public function changePassword()
    {
        if (!isset($_GET['token']))
        {
            show_error('Invalid Url');
        }
        $token = $_GET['token'];

        $user = $this->user_m->get_by("verification_code = '$token'")[0];
        if ($this->input->post())
        {
            $data = array(
                'password' => md5($this->input->post('password')),
                'verification_code' => NULL,
            );
            $this->user_m->save($data, $user->user_id);
            $this->session->set_flashdata("success", "Your password is changed successfully!!");
            redirect('u_login');
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

        $this->load->view('user/change_password');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('u_login');
    }

    public function check_group_status()
    {
        $user_id = $this->session->userdata('user_id');
        $this->data['user_details'] = $this->user_m->get($user_id);
        if ($this->data['user_details']->individual_status == 'individual')
        {
            $relation = array(
                "fields" => "*",
                "conditions" => "user_id = ".$this->session->userdata('user_id')." AND is_active = 'Yes'"
            );
            $this->data['is_group_joined'] = $this->fundraisierGroup_m->get_relation('', $relation, true);
            if ($this->data['is_group_joined'] == 0)
            {
                // $userArray['individual_status'] = NULL;
                // $this->user_m->save($userArray, $user_id);
                redirect('u_dashboard');
            }
        }
        else if ($this->data['user_details']->individual_status == 'group')
        {
            $relation = array(
                "fields" => "*",
                "conditions" => "user_id = ".$this->session->userdata('user_id')." AND is_accept = 'Yes'"
            );
            $this->data['is_group_joined'] = $this->groupUsers_m->get_relation('', $relation, true);
          
        }
        else{
            $this->data['is_group_joined'] = 1;
        }
    }

}