<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends MY_Controller {
    
    public $_api_context;

    public function __construct() {
        parent::__construct();
        
        $this->load->model('customer_m');
        $this->load->model('user_m');
        $this->load->model('product_m');
        $this->load->model('notification_m');
        $this->load->model('order_m');
        $this->load->library('cart');
        $this->load->helper('email_helper');  
        if ($this->user_m->u_loggedin() == FALSE) {
            redirect('u_login');
            exit;
        }
    }

    public function index()
    {
        $jointOptions = array(
            "fields" => "tj_orders.order_id, tj_orders.order_date, tj_orders.delivery_date, tj_orders.order_quantity,customer.first_name,customer.last_name, customer.street, customer.city, customer.state, customer.zip",
            "conditions" => "(tj_orders.order_status = 'pending' OR tj_orders.order_status = 'shipped') AND tj_orders.user_id = ".$this->data['user_details']->user_id,
            'JOIN' => array(
                array(
                    'table' => 'tj_customers as customer',
                    'condition' => 'customer.customer_id = tj_orders.customer_id' ,
                    'type' => 'LEFT'
                ),
            ),
        );
       
        $this->data['order_details'] = $this->order_m->get_relation('',$jointOptions);
        // echo "gfhfg".$this->data['user_details']->user_id;
        $relation = array(
            "fields" => "sum(order_quantity) as total_sale",
            "conditions" => "user_id = ".$this->data['user_details']->user_id." AND order_status = 'delivered' AND delivery_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)"
        );
        $this->data['total_sale'] = $this->order_m->get_relation('',$relation)[0]['total_sale'];
        $relationn = array(
            "fields" => "*",
            "conditions" => "user_id = ".$this->data['user_details']->user_id." AND order_status = 'delivered' AND delivery_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) "
        );
        $this->data['sale_of_the_week'] = $this->order_m->get_relation('',$relationn);
        $newarray = array();
        $array_name = array();
        $total_qty = 0;
        foreach( $this->data['sale_of_the_week']  as $order)
        {
           
            $total = json_decode($order['order_details']);
            $total = json_decode(json_encode($total), True);
            $total = array_values($total);
            $total_qty = $total_qty + $order['order_quantity'];
            for($i=0;$i<count($total);$i++)
            {   
                if (array_key_exists($total[$i]['rowid'],$newarray))
                {
                    $newarray[$total[$i]['rowid']] = $newarray[$total[$i]['rowid']]  + $total[$i]['qty'];
                }
                else{
                    $newarray[$total[$i]['rowid']] =  $total[$i]['qty'];
                    $array_name[$total[$i]['rowid']] = $total[$i]['name'];
                }
            }
        }
        $this->data['total_qty'] = $total_qty;
        $this->data['newarray'] = $newarray;
        $this->data['array_name'] = $array_name;
        
        $jointOptions = array(
            "fields" => "tj_orders.comment",
            "conditions" => "tj_orders.order_status = 'delivered' AND ( tj_orders.comment != '') AND tj_orders.user_id = ".$this->data['user_details']->user_id,
            'JOIN' => array(
                array(
                    'table' => 'tj_customers as customer',
                    'condition' => 'customer.customer_id = tj_orders.customer_id' ,
                    'type' => 'LEFT'
                ),
            ),
        );
        $this->data['comments'] = $this->order_m->get_relation('',$jointOptions);
        $relation = array(
            "fields" => "*",
            'ORDER_BY' => array(
                'field' => 'tj_notification.created',
                'order' => 'DESC'
            ),
            'LIMIT' => array(
                "start" => 5,
                "end" => 0
            )
        );
      
        $this->data['notifications'] = $this->notification_m->get_relation('',$relation);
        // echo $this->db->last_query();
        // die;
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/sale/index';
        $this->data['script'] = 'user/sale/script';
        $this->load->view('user_layout_main', $this->data);
    }
}