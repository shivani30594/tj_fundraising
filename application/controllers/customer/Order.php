<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('customer_m');
        $this->load->model('user_m');
        $this->load->model('product_m');
        $this->load->model('payment_m');
        $this->load->model('order_m');
        $this->load->model('cancelRequest_m');
        $this->load->helper('email_helper');

    }

    public function index($code = '')
    {
        if ($code != '')
        {
           // $code = base64_decode($code);
            $relation = array(
                'fields'=> "*",
                "conditions" => "unique_id = '".$code."'"
            );
            $customer_info = $this->customer_m->get_relation('',$relation);
            if (count($customer_info) > 0)
            {
                $this->data['order_details'] = $this->order_m->get_by("customer_id = ".$customer_info[0]['customer_id']);
                $this->session->set_userdata('customer_id', $customer_info[0]['customer_id']);
                $this->session->set_userdata('user_for_customer', $customer_info[0]['user_id']);
                $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
                $this->data['subview'] = 'customer/order/index';
                $this->data['script'] = 'customer/order/script';
                $this->load->view('customer_layout_main', $this->data);
            }
            else{
                show_404(current_url());
            }
        }
        else{
            show_404(current_url());
        }
    }

    public function change_status()
    {
        $order_status= $this->input->post('delivery_option');
        $order_id =  $this->input->post('order_id');    
        if (count($order_id) > 1)
        {
            $order_id_string = "'".implode("' , '", $order_id)."'";
            $result = $this->db->query("UPDATE tj_orders SET order_status = '".$order_status."' WHERE order_id IN ($order_id_string)");
        }
        else if (gettype($order_id) == 'array'){
            $result = $this->db->query("UPDATE tj_orders SET order_status = '".$order_status."' WHERE order_id = '".$order_id[0]."'");
        }
        else {
            $result = $this->db->query("UPDATE tj_orders SET order_status = '".$order_status."' WHERE order_id = '".$order_id."'");
        }
        if ($order_status == 'delivered')
        {
            $this->send_mail($order_id);
        }
        if ($result)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => true, 'message' => 'Order Status has been changed successfully')));
        }
        else{
            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => false, 'message' => 'Something happens wrong!')));
        }
    }

    public function send_mail($order_id)
    {
        if (count($order_id) > 1)
        {
            for($i=0;$i<count($order_id);$i++)
            {
               $this->data['order_id'] = $order_id[$i];
               $subject = "Your Order ".$order_id[$i]." has been delivered";
               $order_info = $this->order_m->get_by("order_id = '".$order_id[$i]."'");
               $custom_info = $this->customer_m->get($order_info[0]->customer_id);
               $body = $this->load->view('customer/order/comment',$this->data, true);
               send_mail($custom_info->email_id, $subject, $body);
            }
        }
        else if (gettype($order_id) == 'array'){
            $this->data['order_id'] = $order_id[0];
            $subject = "Your Order ".$order_id[0]." has been delivered";
            $order_info = $this->order_m->get_by("order_id = '".$order_id[0]."'");
            $custom_info = $this->customer_m->get($order_info[0]->customer_id);
            $body = $this->load->view('customer/order/comment',$this->data, true);
            send_mail($custom_info->email_id, $subject, $body);
        }
        else{
            $this->data['order_id'] = $order_id;
            $subject = "Your Order ".$order_id." has been delivered";
            $order_info = $this->order_m->get_by("order_id = '".$order_id."'");
            $custom_info = $this->customer_m->get($order_info[0]->customer_id);
            $body = $this->load->view('customer/order/comment',$this->data, true);
            send_mail($custom_info->email_id, $subject, $body);
        }
      
    }

    public function comment($order_id)
    {
        $order_id = base64_decode($order_id);
        if ($order_id)
        {
            $relation = array(
                'fields'=> "*",
                "conditions" => "order_id = '".$order_id."'"
            );
            $order_info = $this->order_m->get_relation('',$relation);
            $this->data['customer_info'] = $this->customer_m->get($order_info[0]['customer_id']);
            if (count($order_info) > 0)
            {
                $this->data['order_id'] = $order_id;
                if ($order_info[0]["ratings"] != 0 OR $order_info[0]["comment"] != '' )
                {
                    $this->session->set_flashdata('success', "Feedback for this order is already saved. Thank you!");
                }
            }
           else
           {
                show_404(current_url());
           }
        }
        else
        {
            show_404(current_url());
        }
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'customer/order/comment_form';
        $this->data['script'] = 'customer/order/script';
        $this->load->view('customer_layout_main', $this->data);
    }

    public function save()
    {
        $order_id = $this->input->post('order_id');
        $orderinfo['comment'] = $this->input->post('comment');
        $orderinfo['ratings'] = $this->input->post('star_rating');
        $result = $this->db->query("UPDATE tj_orders SET comment ='".$orderinfo['comment']."' , ratings = ".$orderinfo['ratings']." WHERE order_id = '".$order_id."'");
        $this->session->set_flashdata('success', "Thank you! Your feedback for ".$order_id."is saved!!");
        redirect("comment/".base64_encode( $order_id ));
    }

    public function cancel_order($order_id = '')
    {
        $relation = array(
            'fields'=> "*",
            "conditions" => "order_id = '".$order_id."'"
        );
        $order_info = $this->order_m->get_relation('',$relation);
        $cust_details = $this->customer_m->get($order_info[0]['customer_id']);
        if ($order_info[0]['order_status'] == 'delivered')
        {
            $this->session->set_flashdata("success", "You can not place cancel request as this order is already delivered to you.");
            redirect("my_orders/".$cust_details->unique_id);
        }
        $new_date = date('Y-m-d H:i:s', strtotime($order_info[0]['order_date']."+1 day"));
        if ($new_date < date('Y-m-d H:i:s'))
        {
            $this->session->set_flashdata("success", "You can not cancel the order after 24 hours from order placed.");
            redirect("my_orders/".$cust_details->unique_id);
        }
        $relation = array(
            'fields'=> "*",
            "conditions" => "order_id = '".$order_id."'"
        );
        $cancel_req_array = $this->cancelRequest_m->get_relation('',$relation);
        if (count($cancel_req_array) > 0)
        {
            $this->session->set_flashdata("success", "You have already placed the cancel request for this order.");
            redirect("my_orders/".$cust_details->unique_id);
        }
        $this->data['order_id'] = $order_id;
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'customer/order/cancel_form';
        $this->data['script'] = 'customer/order/script';
        $this->load->view('customer_layout_main', $this->data);
    }

    public function send_cancel_request()
    {
        $order_id = $this->input->post('order_id');
        $relation = array(
            'fields'=> "*",
            "conditions" => "order_id = '".$order_id."'"
        );
        $order_info = $this->order_m->get_relation('',$relation);
        $cancel_req_array['order_id'] = $order_id;
        $cancel_req_array['reason'] = $this->input->post('reason');
        $cancel_req_array['customer_id'] = $order_info[0]['customer_id'];
        $cancel_req_array['user_id'] = $order_info[0]['user_id'];
        $result = $this->cancelRequest_m->save($cancel_req_array);
        $user_Details = $this->user_m->get($cancel_req_array['user_id']);
        if ($result)
        {
            $cust_details = $this->customer_m->get( $order_info[0]['customer_id']   );
            // send mail
            $subject = "Cancel request for Order ".$order_id;
            $body = "<p>Hello,</p>
            <p>Cancel order request found for the order : ".$order_id."</p>
            <p><strong>Reason For cancellation :&nbsp;</strong><br />".$cancel_req_array['reason']."</p>
            <p><strong>Thanks.</strong></p>";
            send_mail($user_Details->email, $subject, $body); // send to sales person
            send_mail(ADMIN_MAIL, $subject, $body); // send to admin
            $subject = "Response from the cancel request for order : ".$order_id;
            $body = "<p>Hello,</p>
                    <p>We are sorry that you cancelled your order.I message from TJ's pizza should say that a refund will be placed on your account within 7 business days.</p>
            <p><strong>Thanks.</strong></p>";
            send_mail($cust_details->email_id, $subject , $body);
            $this->session->set_flashdata("success","We have placed the cancellation request for this order. Admin will contact you soon.");
        }
        else
        {
            $this->session->set_userdata('success',"Please try after some time");
        }
        redirect("my_orders/".$cust_details->unique_id);
    }
}