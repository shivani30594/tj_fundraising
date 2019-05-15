<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('fundraisierGroup_m');
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
        $this->data['subview'] = 'admin/dashboard/index';
        $this->data['script'] = 'admin/dashboard/script';
        // Total active suers
        $relation = array(
            "fields" => "*",
            "conditions" => "is_active = 'Yes'"
        );
        $total_active_users = $this->user_m->get_relation('', $relation);
        $this->data['total_active_users'] = count($total_active_users);
        //Total current/active fundraisers
        $relation = array(
            "fields" => "*",
            "conditions" => "is_active = 'Yes'"
        );
        $total_active_fundraisers = $this->fundraisierGroup_m->get_relation('', $relation);
        $this->data['total_active_fundraisers'] = count($total_active_fundraisers);
        //5. Total completed fundraisers
        $relation = array(
            "fields" => "*",
            "conditions" => "project_end <= CURDATE()"
        );
        $total_completed_fundraisers = $this->fundraisierGroup_m->get_relation('', $relation);
        $this->data['total_completed_fundraisers'] = count($total_active_fundraisers);
        //6. Total fundraiser groups
        $relation = array(
            "fields" => "*",
        );
        $total_fundraiser_groups = $this->fundraisierGroup_m->get_relation('', $relation);
        $this->data['total_fundraiser_groups'] = count($total_fundraiser_groups);
        //7. Total items sold
        $relation = array(
            "fields" => "sum(order_quantity) as total_itmes_sold",
        );
        $total_itmes_sold = $this->order_m->get_relation('', $relation)[0]['total_itmes_sold'];
        $this->data['total_itmes_sold'] = $total_itmes_sold;
        $relation = array(
            "fields" => "sum(order_total) as total_sales",
        );
        $total_sales = $this->order_m->get_relation('', $relation)[0]['total_sales'];
        $this->data['total_sales'] = $total_sales;
        $this->load->view('admin_layout_main', $this->data);
    }
}