<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('contact_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
        $this->load->helper('email_helper');
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/contact/index';
        $this->data['script'] = 'admin/contact/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('email_id','subject','message');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->contact_m->get_relation('', $relation, true);
        $totalFiltered =  $this->contact_m->get_relation('', $relation, true);

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
        $result = $this->contact_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->contact_m->get_relation('', $relation, true);
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


    public function respond()
    {
        $contact_info = $this->contact_m->get($this->input->post('contact_id'));
        $subject = "Response of Contact Query";
        $body = "<p>Hello <strong>Shp</strong>,<br /><br />Your response for the&nbsp; query '<strong>".$contact_info->subject."</strong>' is as follow:</p>
        <p><strong>Response</strong> : ".$this->input->post("response")."</p>
        <p>Thanks,<br /><strong>TJ's Fundraising</strong></p>
        <p>-------------------------------------------------------------------</p>
        <p>Original Message:</p>
        <p><em>".$contact_info->message."</em></p>
        <p>-------------------------------------------------------------------</p>";
        $result = send_mail($contact_info->email_id, $subject, $body);
        redirect('a_contact');
    }
}