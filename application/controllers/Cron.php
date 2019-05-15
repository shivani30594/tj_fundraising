<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('fundraisierGroup_m');
        $this->load->model('groupUsers_m');
        $this->load->model('order_m');
        $this->load->model('commission_m');
        $this->load->model('user_m');
        $this->load->model('customer_m');
        $this->load->helper('email_helper');
    }

    public function check_completed_expired()
    {
        $relation = array(
            "fields" => "*",
            "conditions" => "project_end = CURDATE()"
        );
        $fundraisierGroup_details = $this->fundraisierGroup_m->get_relation('', $relation);
        if (count($fundraisierGroup_details) > 0)
        {
            foreach($fundraisierGroup_details as $fundraisierGroup_detail)
            {
                $jointOptions = array(
                    'fields' => "tj_users.first_name,tj_users.last_name, tj_users.user_id",
                    "conditions" => " tj_group_users_managament.group_id = ".$fundraisierGroup_detail['group_id'],
                    'JOIN' => array(
                        array(
                            'table' => 'tj_users',
                            'condition' => 'tj_group_users_managament.user_id = tj_users.user_id AND tj_group_users_managament.group_id = '.$fundraisierGroup_details[0]['group_id'] ,
                            'type' => 'LEFT'
                        ),
                    ),
                    'ORDER_BY' => array(
                        'field' => 'tj_users.created',
                        'order' => 'DESC'
                        )
                    );
                $group_member_details = $this->groupUsers_m->get_relation('', $jointOptions);
            
                if (count($group_member_details) > 0)
                {
                    $user_id_array = implode(',',array_column($group_member_details,'user_id'));
                    $user_id_array = $user_id_array. ','. $fundraisierGroup_detail['user_id'];
                }
                else{
                    $user_id_array = $fundraisierGroup_detail['user_id'];
                }
    
                $relation = array(
                    "fields" => "sum(order_quantity) as order_quantity , sum(order_total) as order_total",
                    "conditions" => "user_id IN (".$user_id_array.")",
                );
                $order_details = $this->order_m->get_relation('', $relation);
            
                // Save commission details
                $commissiom_array['group_id'] = $fundraisierGroup_detail['group_id'];
                $commissiom_array['commission_ratio'] = isset($fundraisierGroup_detail) ?  $fundraisierGroup_detail['agreement_option'] : '';
                $commissiom_array['total_amount'] = $order_details[0]['order_total'];
                $commissiom_array['owner_comm'] = $fundraisierGroup_detail['agreement_option'] == '0' ? ($order_details[0]['order_total'] * 30 )/100 : ($order_details[0]['order_total'] * 40 )/100;
                $commissiom_array['fundraiser_comm'] = $fundraisierGroup_detail['agreement_option'] == '0' ? ($order_details[0]['order_total'] * 70 )/100 : ($order_details[0]['order_total'] * 60 )/100;
                $commissiom_array['status'] = 'pending';
                $this->commission_m->save($commissiom_array);
    
                // send mail to sales person and admin
                $user_details = $this->user_m->get($fundraisierGroup_detail['user_id']);
                
                $subject = "Commission calculation history for - ".$fundraisierGroup_detail['group_name'];
                $selected_option = ($fundraisierGroup_detail['agreement_option'] == '0') ? '70/30' : '60/40';
                $body = "<p>Hello,<br /><br />
                    Group Name: ".$fundraisierGroup_detail['group_name']."<br />
                    Aggrement Option Selected: ". $selected_option ."<br />
                    Total Order Amount: $".$order_details[0]['order_total']."<br />
                    Total Quantity Sold: ".$order_details[0]['order_quantity']."</p>
                    <p>--------------------------------</p>
                    <p>Owner(You) : $".$commissiom_array['owner_comm']."<br />
                    Salesperson: $".$commissiom_array['fundraiser_comm']."</p>
                    <p>-------------------------------<br /><br />
                    <p>Thanks<br />
                    Fundraising Conmpany</p>";
                send_mail(ADMIN_MAIL, $subject, $body); 
                $body = "<p>Hello,<br /><br />
                    Group Name: ".$fundraisierGroup_detail['group_name']."<br />
                    Aggrement Option Selected: ". $selected_option ."<br />
                    Total Order Amount: $".$order_details[0]['order_total']."<br />
                    Total Quantity Sold: ".$order_details[0]['order_quantity']."</p>
                    <p>--------------------------------</p>
                    <p>Owner : $".$commissiom_array['owner_comm']."<br />
                    Salesperson(You): $".$commissiom_array['fundraiser_comm']."</p>
                    <p>-------------------------------<br /><br />
                    Admin will pay you within 7-10 working business days.&nbsp;</p>
                    <p>Thanks<br />
                    Fundraising Conmpany</p>";
                send_mail($user_details->email, $subject, $body);
                // notify the customer regarding the expiration
                $relation = array(
                    "fields" => "*",
                    "conditions" => "user_id IN (".$user_id_array.")"
                );
                $customer_details = $this->customer_m->get_relation('', $relation);
                foreach($customer_details as $customer_detail)
                {
                    $subject = "Your fundraiser group has completed";
                    $body = "<p>Hello ".$customer_detail['first_name'].' '.$customer_detail['last_name']."</p>
                    <pThe fundraising project has expired. Products are unable to be purchased at this time.</p>
                    <p>Thanks!<br />
                    TJ’s Pizza Fundraising Company</p>";
                    send_mail($customer_detail['email_id'], $subject, $body);
                }
            }
        }        
    }

    public function check_request_group()
    {
        $relation = array(
            "fields" => "*",
            "conditions" => "token != '' AND is_accept= 'No'"
        );
        $groupUsers_details = $this->groupUsers_m->get_relation('', $relation);
        foreach($groupUsers_details as $groupUser)
        {
           $new_date = date('Y-m-d H:i:s', strtotime($groupUser['req_sent_at']."+1 day"));
           if ($new_date < date('Y-m-d H:i:s'))
           {
               //expired the link
               $groupUsers_array['token'] = '';
               $groupUsers_array['is_accept'] = 'NO';
               $groupUsers_array['token'] = '';
               $this->groupUsers_m->save($groupUsers_array, $groupUser['id']);
               // Send the mail
               $user_details = $this->user_m->get($groupUser['user_id']);
               $group_array = $this->fundraisierGroup_m->get($groupUser['group_id']);
               $subject= 'Your group Join request is expired';
               $body = "<p>Hello ".$user_details->first_name.' '.$user_details->last_name.",</p>
               <p>You have send the request to join the group - ".$group_array->group_name.". Somehow admin of the group not able to accpet the request withtin 24 hours. Now, you have to request again.</p>
               <p><strong>Thanks,</strong><br /><strong>TJ Fundraising&nbsp;</strong></p>";
               send_mail_to_admin($user_details->email, $subject, $body);
           }
        }
    }
}