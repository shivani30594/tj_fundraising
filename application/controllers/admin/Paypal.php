<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('order_m');
        $this->load->model('payment_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/paypal/index';
        $this->data['script'] = 'admin/paypal/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('order_id','payer_mail','payment_id','subtotal','total','tax','payment_method','payment_status','created');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->payment_m->get_relation('', $relation, true);
        $totalFiltered =  $this->payment_m->get_relation('', $relation, true);
       
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
            for ($i = 1; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $_REQUEST['search']['value'] . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ') ';
        }
        $relation['conditions'] = $sWhere;
        $result = $this->payment_m->get_relation('', $relation);
       
        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->payment_m->get_relation('', $relation, true);
        }

        foreach ($result as $k => $v) {
            $relation = array(
                "fields" => "*",
                "conditions" => "transaction_id = ". $v['transaction_id']
            );
            $result_found = $this->order_m->get_relation('', $relation);
            $status = (count($result_found) > 0) ? $result_found[0]['order_id'] : '';
            $resullt_category[$k]['order_id'] = $status;
        }

        foreach ($result as $key => $value) {
            $result[$key]['order_id'] = $resullt_category[$key]['order_id'];
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


}