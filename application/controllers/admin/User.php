<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/user/index';
        $this->data['script'] = 'admin/user/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('picture','first_name', 'last_name', 'email', 'is_active');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->user_m->get_relation('', $relation, true);
        $totalFiltered = $totalRecords;

        if (isset($_REQUEST['draw']) && $_REQUEST['draw'] != '-1') {
            $relation['LIMIT']['start'] = $_REQUEST['length'];
            $relation['LIMIT']['end'] = $_REQUEST['start'] ;
        }

        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['column'] != '') {
            $relation['ORDER_BY']['field'] = $aColumns[$_REQUEST['order'][0]['column']];
            $relation['ORDER_BY']['order'] = $_REQUEST['order'][0]['dir'];
        }

        $sWhere = '';
        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $sWhere .= " (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $_REQUEST['search']['value'] . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ') ';
        }
        $relation['conditions'] = $sWhere;
        $result = $this->user_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->user_m->get_relation('', $relation, true);
        }


        foreach ($result as $k => $v) {
            $relation = array(
                "fields" => "*",
                "conditions" => "user_id = ". $v['user_id']
            );
            $result_found = $this->fundraisierGroup_m->get_relation('', $relation);
            $status = (count($result_found) > 0) ? 'Captain' : 'SalesPerson';
            $resullt_category[$k]['status'] = $status;
        }

        foreach ($result as $key => $value) {
            $result[$key]['status'] = $resullt_category[$key]['status'];
        }

     
        $output = array(
            "draw"            => (int)$_REQUEST['draw'],  
            "recordsTotal"    => (int)$totalRecords,  
            "recordsFiltered" => (int)$totalFiltered, 
            "data"            => $result   ,
        );
        return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($output));
    }

    public function change_status($id = '')
    {
        if ($id)
        {
            $user_details = $this->user_m->get($id);
            if ($user_details->is_active == 'Yes')
            {
                $n_user_Details['is_active'] = 'No';
                $this->session->set_flashdata('success','User deactivated successfully');
            }
            else{
                $n_user_Details['is_active'] = 'Yes';
                $this->session->set_flashdata('success','User activated successfully');
            }
            $result = $this->user_m->save($n_user_Details, $id);
            if (!$result)
            {
                $this->session->set_flashdata('danger','Something happens wrong!');
            }
            redirect("a_user");
        }
    }

    public function get_user_info()
    {
        $user_id = $this->input->post('user_id');
        if ($user_id)
        {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->user_m->get($user_id)));
        }
    }

    public function view($id = '')
    {
        if ($id)
        {
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'admin/user/view';
            $this->data['script'] = 'admin/user/script';
            $this->data['list'] = false;
            $this->data['user_details'] = $this->user_m->get($id) ;
            $this->load->view('admin_layout_main', $this->data);
        }
    }

    public function edit($user_id = '')
    {
        if ($user_id)
        {
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'admin/user/edit';
            $this->data['script'] = 'admin/user/script';
            $this->data['list'] = false;
            $this->data['user_details'] = $this->user_m->get($user_id) ;
            $this->load->view('admin_layout_main', $this->data);
        }
    }

    public function save()
    {
        $user_info['first_name'] = $this->input->post('first_name');
        $user_info['last_name'] = $this->input->post('last_name');
        $user_info['email'] = $this->input->post('email');
        $user_info['is_active'] = $this->input->post('is_active');
        $result = $this->user_m->save($user_info, $this->input->post('user_id'));
        if ($result)
        {
            $this->session->set_flashdata('success','User information updated successfully');
        }
        else{
            $this->session->set_flashdata('error','Something happens wrong!');
        }
        redirect('a_user');
    }

    public function change_avatar()
    {
        
        if (!empty($_FILES['picture']['name'])) 
        {
            $str = trim(preg_replace('/\s*\([^)]*\)/', '', $_FILES['picture']['name']));
            $imagename = 'user_' . time() .'_'.$str;
            $config['upload_path'] = 'assets/uploads/users';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $imagename;
           
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('picture')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error','Something happens wrong!');
            } else {
                $data = $this->upload->data();
                $user_info['picture'] = BASE_URL.'assets/uploads/users/'.$imagename;
                $result = $this->user_m->save($user_info, $this->input->post('user_id'));
                if ($result)
                {
                    $this->session->set_flashdata('success','Profile picture updated successfully');
                }
                else{
                    $this->session->set_flashdata('error','Something happens wrong!');
                }
            }
            redirect('a_user');
        } 
    }
}