<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('fundraisierGroup_m');
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
        $this->data['subview'] = 'user/order/index';
        $this->data['script'] = 'user/order/script';
        $jointOptions = array(
            "fields" => "com_manage.created, com_manage.reason,tj_orders.order_status,tj_orders.order_id, tj_orders.order_date, tj_orders.delivery_date, tj_orders.order_quantity,customer.first_name,customer.last_name, customer.street, customer.city, customer.zip, customer.state",
            "conditions" => "(tj_orders.order_status = 'pending' OR tj_orders.order_status = 'shipped') AND tj_orders.user_id = ".$this->data['user_details']->user_id,
            'JOIN' => array(
                array(
                    'table' => 'tj_customers as customer',
                    'condition' => 'customer.customer_id = tj_orders.customer_id' ,
                    'type' => 'LEFT'
                ),
                array(
                    'table' => 'tj_cancellation_requests as com_manage',
                    'condition' => 'tj_orders.order_id = com_manage.order_id' ,
                    'type' => 'LEFT'
                ),
            ),
        );
        $this->data['order_details'] = $this->order_m->get_relation('',$jointOptions);
        $this->load->view('user_layout_main', $this->data);
    }
}