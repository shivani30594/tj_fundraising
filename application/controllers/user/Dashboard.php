<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        $this->load->model('order_m');
        $this->load->helper('email_helper');  
        if ($this->user_m->u_loggedin() == FALSE) {
            redirect('u_login');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $relation = array(
            "fields" => "*",
            "conditions" => "user_id = ".$this->session->userdata('user_id')." AND is_active = 'Yes'"
        );
        $group_details = $this->fundraisierGroup_m->get_relation('', $relation);
        $this->data['own_group_details'] = $group_details;
        if (count($group_details) == 0)
        {
            $relation = array(
                "fields" => "*",
                "conditions" => "user_id = ".$this->session->userdata('user_id')." AND is_accept = 'Yes'"
            );
            $group_user_details = $this->groupUsers_m->get_relation('', $relation);
            if (count($group_user_details) > 0)
            {
                $relation = array(
                    "fields" => "*",
                    "conditions" => "group_id = ". $group_user_details[0]['group_id'] 
                );
                $group_details = $this->fundraisierGroup_m->get_relation('', $relation);
                $this->data['ia_already_accepted'] = true;
            }
            else{
                $this->data['ia_already_accepted'] = false;
            }
        }

        $this->data['group_details'] = count($group_details) > 0 ? $group_details[0] : '';
        $relation = array(
            "fields" => "*",
            "conditions" => "is_active = 'Yes'"
        );

        $this->data['active_groups'] = $this->fundraisierGroup_m->get_relation('', $relation);
        $relation = array(
            "fields" => "sum(order_quantity) as item_sold",
            "conditions" => "order_status = 'delivered' AND user_id = ".$this->data['user_details']->user_id
        );

        $this->data['item_sold'] = $this->order_m->get_relation('', $relation)[0]['item_sold'];
        $relation = array(
            "fields" => "sum(order_total) as sales_total ",
            "conditions" => "order_status = 'delivered' AND user_id = ".$this->data['user_details']->user_id
        );

        $this->data['sales_total'] = $this->order_m->get_relation('', $relation)[0]['sales_total'];

        $relation = array(
            "fields" => "*",
            "conditions" => "order_status = 'delivered' AND user_id = ".$this->data['user_details']->user_id,
            "ORDER_BY" => array(
                "field" => 'tj_orders.order_date',
                "order" => "ASC"
            )
        );

        $orders = $this->order_m->get_relation('', $relation);

        if (count($orders) > 0)
        {
            $start_date = strtotime($orders[0]['order_date']);
            $end_date = strtotime("now");
            $datediff = $end_date - $start_date;
            $days = round($datediff / (60 * 60 * 24));
            $avg_items = ($days) > 0 ? $this->data['item_sold'] / $days : 0;
            $this->data['avg_items'] = round($avg_items);
        }

        $this->data['subview'] = 'user/dashboard/index';
        $this->data['script'] = 'user/dashboard/script';
        $this->load->view('user_layout_main', $this->data);

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
                        'type' => 'JOIN'
                    ),
                ),
                'ORDER_BY' => array(
                    'field' => 'tj_users.created',
                    'order' => 'DESC'
                )
                );

            $group_member_details = $this->groupUsers_m->get_relation('', $jointOptions);
            $order_main_array = array();
            $order_main_arrayy = array();
            foreach($group_member_details as $member)
            {
                $relation = array(
                    "fields" => "sum(order_quantity) as total_quantity, sum(order_total) as total_amount",
                    "conditions" => "user_id = ".$member['user_id']. " AND order_status = 'delivered' ",
                    "GROUP_BY" => 'user_id'
                );
                $order_main_array = $this->order_m->get_relation('', $relation);
                if (count($order_main_array) > 0)
                {
                    $order_main_arrayy[$member['user_id']] = $order_main_array[0];
                    $order_main_arrayy[$member['user_id']]['first_name'] = $member['first_name'];
                    $order_main_arrayy[$member['user_id']]['last_name'] = $member['last_name'];
                    $this->data['leader_board'] = $order_main_arrayy;
                }
                else
                {
                    $order_main_arrayy[$member['user_id']]['first_name'] = $member['first_name'];
                    $order_main_arrayy[$member['user_id']]['last_name'] = $member['last_name'];
                    $order_main_arrayy[$member['user_id']]['total_quantity'] = 0 ;
                    $order_main_arrayy[$member['user_id']]['total_amount'] = 0.00;
                    $this->data['leader_board'] = $order_main_arrayy;
                }
            unset($order_main_array);
            }
            $price = array();
            foreach ($order_main_arrayy as $key => $row)
            {
                $price[$key] = $row['total_amount'];
            }
            $this->data['total_amount'] = array_sum(array_column($order_main_arrayy,'total_amount'));
            $this->data['total_quantity'] = array_sum(array_column($order_main_arrayy,'total_quantity'));
            array_multisort($price, SORT_DESC, $order_main_arrayy);
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'user/dashboard/statstics';
            $this->data['script'] = 'user/dashboard/script';
            $this->load->view('user_layout_main', $this->data);
        }
    }

    public function create_campaign()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/campaign/index';
        $this->data['script'] = 'user/campaign/script';
        $this->load->view('user_layout_main', $this->data);
    }

    public function set_status()
    {
        $status = $this->input->post('status');
        if ($status == 'individual')
        {
            redirect('u_campaign');
        }
        else
        {
        $this->join_group();
        redirect('u_dashboard');
        }
    }

    public function join_group()
    {
        $group_id = $this->input->post('group_id');
        $user_id = $this->session->userdata('user_id');
        $relation = array(
            "fields" => "*",
            "conditions" => "user_id = ".$user_id." AND is_active = 'Yes'"
        );
        $group_details = $this->fundraisierGroup_m->get_relation('', $relation);
        $requested_group = $this->fundraisierGroup_m->get($group_id);
        $requested_group_owner_details = $this->user_m->get($requested_group->user_id);

        if (!empty($group_details) && count($group_details) > 0)
        {
            echo json_encode(array('success'=>false,"message"=>"You are already part of group <b><u>".$group_details[0]['group_name']."</u></b>. Your current project is expired on ".date('M, d-Y', strtotime($group_details[0]['project_end']))." So, you may create/join after expired of current project. Happy Fundraising !!"));
        }
        else {

            // check request is already sent for this group
            $relation = array(
                "fields" => "*",
                "conditions" => "user_id = ".$user_id." AND group_id = ". $group_id . " AND is_accept = 'No'"
            );

            $no_of_requests = $this->groupUsers_m->get_relation('', $relation, true);

            if ($no_of_requests > 0)
            {
                echo json_encode(array('success'=>false,"message"=>"Request for group <b><u>".$requested_group->group_name."</u></b> is already sent before. Wait for accepting the request from the group admin."));

            }
            else
            {
                $userInfo['individual_status'] = 'group';
                $result = $this->user_m->save($userInfo, $this->session->userdata('user_id'));
                echo json_encode(array('success'=>true,"message"=>"Join request for <b><u>".$requested_group->group_name."</u></b> is sent to the owner of group successfully.You will get replied on your mail regarding the acceptance of the request. Please check you mail frequently."));
                $group_userArray['token'] = generate_refferal_code(20);
                $group_userArray['group_id'] = $group_id;
                $group_userArray['user_id'] = $user_id;
                $group_userArray['req_sent_at'] = date('Y-m-d H:i:s');
                $request_id = $this->groupUsers_m->save($group_userArray);
                $subject = GROUP_REQUEST_SUBJECT;
                $body = '<p><strong>Dear '.$requested_group_owner_details->first_name.' '.$requested_group_owner_details->last_name.',</strong></p>
                <p>My name is '.$this->data['user_details']->first_name.' '.$this->data['user_details']->last_name.'. I am looking to raise some amount to complete your project. Click on below link to accept the request and join me in your group.</p>
                <p style="text-align: center;"><span style="text-decoration: underline;"><a href='.BASE_URL.'common/accept_request?id='.base64_encode($request_id).'&token='.$group_userArray['token'].'>Click here to accept the request</a></span></p>
                <p>Thank you.&nbsp;</p>
                <p><strong>Sincerely,</strong></p>
                <p><strong>'.$this->data['user_details']->first_name.' '.$this->data['user_details']->last_name.'</strong></p>';
                send_mail($requested_group_owner_details->email, $subject, $body);
            }
        }
    }
    
    public function set_goal()
    {
        $user_info['set_amount'] = $this->input->post('amount');
        $user_info['set_quantity'] = $this->input->post('quantity');
        $result = $this->user_m->save($user_info,$this->data['user_details']->user_id);
        if ($result)
        {
            $this->session->set_flashdata('success','Your Goal is set. Now, you can invite more customer to see your progress.');
        }
        else{
            $this->session->set_flashdata('danger','Something happens wrong!');
        }
        redirect('u_dashboard');
    }

}