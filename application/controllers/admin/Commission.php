<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        $this->load->model('commission_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/commission/index';
        $this->data['script'] = 'admin/commission/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }


    public function indexjson()
    {
        $aColumns = array('commission_ratio','status','total_amount','owner_comm','fundraiser_comm','created','updated');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->commission_m->get_relation('', $relation, true);
        $totalFiltered =  $this->commission_m->get_relation('', $relation, true);

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
        $result = $this->commission_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->commission_m->get_relation('', $relation, true);
        }

        foreach ($result as $k => $v) {
                $relation = array(
                    "fields" => "group_name ",
                    "conditions" => "group_id = ". $v['group_id']
                );
                $resullt_category[$k]['group_name'] = $this->fundraisierGroup_m->get_relation('', $relation)[0]['group_name'];
        }

        foreach ($result as $key => $value) {
            $result[$key]['group_name'] = $resullt_category[$key]['group_name'];
        }

        $output = array(
            "draw"            => intval($_REQUEST['draw']),  
            "recordsTotal"    => intval($totalRecords),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $result   ,
        );

        return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($output));
    }


    public function change_status()
    {
        $commission_id = $this->input->post('commission_id');
        $commission_array['status'] = 'paid';
        // $commission_array['updated'] = date('Y-m-d H:i:s', strtotime("now"));
        $this->commission_m->save($commission_array, $commission_id);

        $commission_details = $this->commission_m->get($commission_id);

        // deactivate the group
        $fundraisierGroup_array['is_active'] = 'No';
        $this->fundraisierGroup_m->save($fundraisierGroup_array, $commission_details->group_id);
       
        // deactivate the group users
        $result = $this->db->query("UPDATE tj_group_users_managament SET is_accept= 'No' WHERE group_id = $commission_details->group_id") ;

        // generate new marketing link
        $group_dateils = $this->fundraisierGroup_m->get($commission_details->group_id);
        $user_info['referral_code'] =  generate_refferal_code();
        $user_info['individual_status'] = NULL;
        $this->user_m->save($user_info, $group_dateils->user_id);

        $group_users_details = $this->groupUsers_m->get_by("group_id = ".$commission_details->group_id);
        foreach($group_users_details as $group_users_detail)
        {
            $user_info['referral_code'] =  generate_refferal_code();
            $user_info['individual_status'] = NULL;
            $this->user_m->save($user_info, $group_users_detail->user_id);
            unset($user_info);
        }
        if ($result)
        {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array("success"=>true,"message"=> 'Mark as paid sussessfully!')));
        }
        else{
            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array("success"=>false,"message"=> 'Something happens wrong!')));
        }
    }
}