<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model("product_m");
        if ($this->user_m->u_loggedin() == FALSE) {
            redirect('u_login');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'user/product/index';
        $this->data['script'] = 'user/product/script';
        $total_row = count($this->product_m->get());
        $config["base_url"] = base_url() . "u_product";
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 1;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($config);
        if($this->uri->segment(2)){
            $page = ($this->uri->segment(2) - 1) ;
        }
        else{
             $page = 0;
        }
        $relation = array(
            "fields" => "*",
        );
        $relation['LIMIT']['start'] = 5;
        $relation['LIMIT']['end'] = $config["per_page"] * $page;
        $this->data['product_details'] = $this->product_m->get_relation('', $relation);
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('user_layout_main', $this->data);
    }
}