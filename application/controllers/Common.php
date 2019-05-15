<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        $this->load->helper('email_helper');  
    }

    

    public function accept_request()
    {
        if (isset($_GET))
        {
            $request_id = base64_decode( $_GET['id'] );
            if ($request_id != '' AND $_GET['token'] != '')
            {
                $request_details = $this->groupUsers_m->get_by("id= $request_id AND token = '".$_GET["token"]."'");
                if (count($request_details) > 0)
                {
                    $group_detailsss = $this->fundraisierGroup_m->get($request_details[0]->group_id);
                   
                    $group_userArray['is_accept'] = 'Yes';
                    $group_userArray['token'] = '';
                    $group_userArray['req_accept_at'] = date('Y-m-d H:i:s');
                    $result = $this->groupUsers_m->save($group_userArray,$request_id );
                    if ($result)
                    {
                        
                        $this->session->set_flashdata("success",'Request accepted successfully. Now, Current user is part of your group.');
                     //    Send confirmation mail to user who sent this request
                        $body = "<p>Congratulations! Your request for the group : ".$group_detailsss->group_name."  is accepted</p><br><br>
                                <p>You can continue by clicking on <a href=".BASE_URL.">".BASE_URL."</p>";
                        $user_details = $this->user_m->get($request_details[0]->user_id);
                        send_mail($user_details->email, GROUP_REQUEST_ACCEPT_SUBJECT, $body);
                    }
                    else{
                        $this->session->set_flashdata("error",'Something happens wrong. Please try again later');
                    }
                }
                else{
                    $this->session->set_flashdata("error",'Request is expired');
                }
            }
            else{
                $this->session->set_flashdata("error",'Request is expired or token is invalid');
            }
            redirect("u_login");
        }
    }
}