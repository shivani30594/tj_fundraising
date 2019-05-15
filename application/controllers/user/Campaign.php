<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->helper('email_helper');
        if ($this->user_m->u_loggedin() == FALSE) {
            redirect('u_login');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->load->view('user/campaign/index', $this->data);
    }

    public function create_campaign()
    {
        $campaignInfo['user_id'] = $this->session->userdata('user_id');
        $campaignInfo['group_name'] = $this->input->post('group_name');
        $campaignInfo['email'] = $this->input->post('email');
        $campaignInfo['address'] = $this->input->post('address');
        $campaignInfo['contact_person'] = $this->input->post('contact_person');
        $campaignInfo['contact_phone'] = $this->input->post('full_number');
        $campaignInfo['project_start'] = date('Y-m-d H:i:s',strtotime($this->input->post('project_start')));
        $campaignInfo['project_end'] = date('Y-m-d H:i:s',strtotime($this->input->post('project_end')));
        $campaignInfo['tax_document_name'] = $this->input->post('tax_document_name');
        $campaignInfo['delivery_method'] = $this->input->post('delivery_method');
        $campaignInfo['delivery_location'] = $this->input->post('delivery_location');
        if (!empty($_FILES['tax_document']['name'])) 
        {
            $document_name = 'tax_' . time() .'_'. $_FILES['tax_document']['name'];
            $config['upload_path'] = 'assets/uploads/tax_documents/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $document_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('tax_document')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $data = $this->upload->data();
                $campaignInfo['tax_document_name'] = $document_name;
            }
        } 
       $result = $this->fundraisierGroup_m->save($campaignInfo);
       $group_id = $this->db->insert_id();
       if ($result)
       {
            $userInfo['individual_status'] = 'individual';
            $result = $this->user_m->save($userInfo, $this->session->userdata('user_id'));
            // redirect('u_agreement/'.$group_id);
            redirect('u_invite');

       }
       else{
           redirect('u_campaign');
       }
    }

    public function aggrement($id = '')
    {
        $this->data['group_id'] = $id;
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->load->view('user/campaign/agreement', $this->data);
    }


    public function set_aggrement()
    {
        $group_id = $this->input->post('group_id');
        $group_array = $this->fundraisierGroup_m->get($group_id);
        $fundraising_option['is_active'] = 'Yes';
        $fundraising_option['agreement_option'] = $this->input->post('agreement');
        $result = $this->fundraisierGroup_m->save($fundraising_option, $group_id);
        if ($result)
        {
                $this->session->set_flashdata("success", "Campaign created successfully.");
                // send mail
                $subject= "Campaign created successfully";
                $body = '<p>Hello,<br /><br />You have set-up the fundraiser group successfully. Share the invite link to customer.<br />
                <a href='.BASE_URL.'marketing/'.trim($this->data['user_details']->first_name).'/'.trim($this->data['user_details']->referral_code).'>Invitation Link</a><br />Thanks.</p>';
                send_mail($group_array->email, $subject, $body);
                redirect("u_dashboard");
        }
        else
        {
                $this->session->set_flashdata("error", "Something happens wrong!");
                redirect('u_agreement/'.$group_id);
        }
    }
}