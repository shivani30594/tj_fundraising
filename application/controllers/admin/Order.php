<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('order_m');
        $this->load->model('customer_m');
        $this->load->helper('email_helper');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/order/index';
        $this->data['script'] = 'admin/order/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('order_id', 'order_details','order_total', 'order_quantity','order_status','order_date','delivery_date');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->order_m->get_relation('', $relation, true);
        $totalFiltered =  $this->order_m->get_relation('', $relation, true);

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
        $result = $this->order_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->order_m->get_relation('', $relation, true);
        }

        foreach ($result as $k => $v) {
            $relation = array(
                "fields" => "first_name, last_name ",
                "conditions" => "customer_id = ". $v['customer_id']
            );
            $resullt_array  = $this->customer_m->get_relation('', $relation)[0];
            $resullt_category[$k]['customer_name'] = $resullt_array['first_name'].' '.$resullt_array['last_name'];
        }

        foreach ($result as $key => $value) {
            $result[$key]['customer_name'] = $resullt_category[$key]['customer_name'];
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

        // $result = $this->db->query("UPDATE tj_orders SET order_status = '".$order_status."' WHERE order_id = '".$order_id."'");
        // if ($result)
        // {
        //     return $this->output
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode(array('success' => true, 'message' => 'Order Status has been changed successfully')));
        // }
        // else{
        //     return $this->output
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode(array('success' => false, 'message' => 'Something happens wrong!')));
        // }
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
}