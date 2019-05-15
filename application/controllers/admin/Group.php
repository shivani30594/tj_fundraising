<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        $this->load->model('user_m');
        $this->load->model('order_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/group/index';
        $this->data['script'] = 'admin/group/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('group_name','contact_person','delivery_method','delivery_location','project_start','project_end','is_active');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->fundraisierGroup_m->get_relation('', $relation, true);
        $totalFiltered =  $this->fundraisierGroup_m->get_relation('', $relation, true);

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
        $result = $this->fundraisierGroup_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->fundraisierGroup_m->get_relation('', $relation, true);
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

    public function change_status($id = '')
    {
        if ($id)
        {
            $group_details = $this->fundraisierGroup_m->get($id);
            if ($group_details->is_active == 'Yes')
            {
                $group_users = $this->groupUsers_m->get_by("is_accept = 'Yes' AND group_id = $id");
                foreach($group_users as $group_user)
                {
                    $n_user_details['is_active'] = 'No';
                    $this->user_m->save($n_user_details, $group_user->user_id);
                }
                $n_group_details['is_active'] = 'No';
                $this->session->set_flashdata('success','Group (including group members) deactivated successfully');
            }
            else{
                $group_users = $this->groupUsers_m->get_by("is_accept = 'Yes' AND group_id = $id");
                foreach($group_users as $group_user)
                {
                    $n_user_details['is_active'] = 'Yes';
                    $this->user_m->save($n_user_details, $group_user->user_id);
                }
                $n_group_details['is_active'] = 'Yes';
                $this->session->set_flashdata('success','Group (including group members) activated successfully');
            }
            $result = $this->fundraisierGroup_m->save($n_group_details, $id);
            if (!$result)
            {
                $this->session->set_flashdata('danger','Something happens wrong!');
            }
            redirect("a_group");
        }
    }

    public function view($id = '')
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/group/view';
        $this->data['script'] = 'admin/group/script';
        $this->data['list'] = false;
        $this->data['group_details'] = $this->fundraisierGroup_m->get($id);
        $id = $this->data['group_details']->group_id;
        $jointOptions = array(
            'fields' => "tj_users.first_name,tj_users.last_name, tj_users.user_id",
            'JOIN' => array(
                array(
                    'table' => 'tj_users',
                    'condition' => 'tj_group_users_managament.user_id = tj_users.user_id AND tj_group_users_managament.group_id = '.$id,
                    'type' => 'LEFT'
                ),
            ),
            'ORDER_BY' => array(
                'field' => 'tj_users.created',
                'order' => 'DESC'
             )
            );
        $this->data['group_member_details'] = $this->groupUsers_m->get_relation('', $jointOptions);
        $this->load->view('admin_layout_main', $this->data);
    }

    public function edit($id = '')
    {
        if ($id)
        {
            $this->data['group_details'] = $this->fundraisierGroup_m->get($id);
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'admin/group/edit';
            $this->data['script'] = 'admin/group/script';
            $this->data['list'] = false;
            $this->load->view('admin_layout_main', $this->data);
        }
    }

    public function save()
    {
        $user_id = $this->session->userdata('user_id');
        $group_id = $this->input->post('group_id');
        $campaignInfo['group_name'] = $this->input->post('group_name');
        $campaignInfo['email'] = $this->input->post('email');
        $campaignInfo['address'] = $this->input->post('address');
        $campaignInfo['contact_person'] = $this->input->post('contact_person');
        $campaignInfo['contact_phone'] = $this->input->post('full_number');
        $campaignInfo['project_start'] = $this->input->post('project_start');
        $campaignInfo['project_end'] = $this->input->post('project_end');
        $campaignInfo['delivery_method'] = $this->input->post('delivery_method');
        $campaignInfo['delivery_location'] = $this->input->post('delivery_location');
        $result = $this->fundraisierGroup_m->save($campaignInfo, $group_id);
        if ($result)
        {
            $this->session->set_flashdata('success','Group information are updated successfully');
        }
        else{
            $this->session->set_flashdata('danger','Something happens wrong!');
        }
        redirect('a_group');
    }

    public function leader_board($id = '')
    {
        if($id)
        {
            $this->data['group_details'] = $this->fundraisierGroup_m->get($id);
            $jointOptions = array(
                'fields' => "tj_users.first_name,tj_users.last_name, tj_users.user_id",
                'JOIN' => array(
                    array(
                        'table' => 'tj_users',
                        'condition' => 'tj_group_users_managament.user_id = tj_users.user_id AND tj_group_users_managament.group_id = '.$id,
                        'type' => 'LEFT'
                    ),
                ),
                'ORDER_BY' => array(
                    'field' => 'tj_users.created',
                    'order' => 'DESC'
                 )
                );
               // print_r( $jointOptions);
            $group_member_details = $this->groupUsers_m->get_relation('', $jointOptions);
            // $user_id_array = implode(',',array_column($group_member_details,'user_id'));
            // echo "<pre>";
          // print_r($group_member_details);
          
            
            $order_main_array = array();
            foreach($group_member_details as $member)
            {
                // echo "indi";
                // print_r($member);
               if($member['user_id'] !=null )
               {
                $relation = array(
                    "fields" => "sum(order_quantity) as total_quantity, sum(order_total) as total_amount",
                    "conditions" => "user_id = ".$member['user_id']. " AND order_status = 'delivered' ",
                    "GROUP_BY" => 'user_id'
                );
                $order_main_array = $this->order_m->get_relation('', $relation);
                // print_r($order_main_array);
                if (count($order_main_array) > 0)
                {
                    $order_main_arrayy[$member['user_id']] = $order_main_array[0];
                    $order_main_arrayy[$member['user_id']]['first_name'] = $member['first_name'];
                    $order_main_arrayy[$member['user_id']]['last_name'] = $member['last_name'];
                    $this->data['leader_board'] = $order_main_arrayy;
                   
                }
                else{
                    $order_main_arrayy[$member['user_id']]['first_name'] = $member['first_name'];
                    $order_main_arrayy[$member['user_id']]['last_name'] = $member['last_name'];
                    $order_main_arrayy[$member['user_id']]['total_quantity'] = 0 ;
                    $order_main_arrayy[$member['user_id']]['total_amount'] = 0.00;
                    $this->data['leader_board'] = $order_main_arrayy;

                }
                unset($order_main_array);
               }
               
            }
           
            $price = array();
            // foreach ($order_main_arrayy as $key => $row)
            // {
            //     $price[$key] = $row['total_amount'];
            // }
            // array_multisort($price, SORT_DESC, $order_main_arrayy);
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'admin/group/leader_board';
            $this->data['script'] = 'admin/group/script';
            $this->load->view('admin_layout_main', $this->data);
        }
    }


    public function total_sales($id = '')
    {
        if ($id)
        {
            $this->data['group_details'] = $this->fundraisierGroup_m->get($id);
            $jointOptions = array(
                'fields' => "tj_users.first_name,tj_users.last_name, tj_users.user_id",
                'JOIN' => array(
                    array(
                        'table' => 'tj_users',
                        'condition' => 'tj_group_users_managament.user_id = tj_users.user_id AND tj_group_users_managament.group_id = '.$id,
                        'type' => 'LEFT'
                    ),
                ),
                'ORDER_BY' => array(
                    'field' => 'tj_users.created',
                    'order' => 'DESC'
                 )
                );
            $group_member_details = $this->groupUsers_m->get_relation('', $jointOptions);
            // $user_id_array = implode(',',array_column($group_member_details,'user_id'));
            $order_main_array = array();
            $sales_by_item_quantity = 0;
            $sales_by_cash_total = 0;
            foreach($group_member_details as $member)
            {
                 if($member['user_id'] !=null )
                 {
                $relation = array(
                    "fields" => "sum(order_quantity) as total_quantity, sum(order_total) as total_amount",
                    "conditions" => "user_id = ".$member['user_id']. " AND order_status = 'delivered' ",
                    "GROUP_BY" => 'user_id'
                );
                $order_main_array = $this->order_m->get_relation('', $relation);
                if (count($order_main_array) > 0)
                {
                    $sales_by_item_quantity =  $sales_by_item_quantity +  $order_main_array[0]['total_quantity'];
                    $sales_by_cash_total =  $sales_by_cash_total + $order_main_array[0]['total_amount'];
                }
                 }
            }
            $this->data['sales_by_item_quantity'] = $sales_by_item_quantity;
            $this->data['sales_by_cash_total'] = $sales_by_cash_total;
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'admin/group/total_sale';
            $this->data['script'] = 'admin/group/script';
            $this->load->view('admin_layout_main', $this->data);
        }
    }
}