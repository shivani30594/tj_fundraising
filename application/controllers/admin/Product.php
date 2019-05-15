<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('product_m');
        $this->load->model('productCategory_m');
        $this->load->model('notification_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/product/index';
        $this->data['script'] = 'admin/product/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('product_sku', 'product_image','product_name', 'product_description','nutrition_facts','product_price','product_stock');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->product_m->get_relation('', $relation, true);
        $totalFiltered =  $this->product_m->get_relation('', $relation, true);

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
        $result = $this->product_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->product_m->get_relation('', $relation, true);
        }

        foreach ($result as $k => $v) {
                $relation = array(
                    "fields" => "category_name ",
                    "conditions" => "category_id = ". $v['category_id']
                );
                $resullt_category[$k]['category_name'] = $this->productCategory_m->get_relation('', $relation)[0]['category_name'];
        }

        foreach ($result as $key => $value) {
            $result[$key]['category_name'] = $resullt_category[$key]['category_name'];
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

    public function add($id = '')
    {
        if ($id)
        {
            $this->data['product_details'] =  $this->product_m->get($id);
        }
        $this->data['category_list'] = $this->productCategory_m->get();
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/product/add';
        $this->data['script'] = 'admin/product/script';
        $this->data['list'] = false;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function save()
    {
        $product_info['product_sku'] = $this->input->post('product_sku');
        $product_info['product_name'] = $this->input->post('product_name');
        $product_info['nutrition_facts'] = $this->input->post('nutrition_facts');
        $product_info['product_description'] = $this->input->post('product_description');
        $product_info['category_id'] = $this->input->post('category_id');
        $product_info['product_stock'] = $this->input->post('product_stock');
        $product_info['product_price'] = $this->input->post('product_price');
        $product_info['is_available'] = $this->input->post('is_available');
        if (!empty($_FILES['product_image']['name'])) 
        {
            $str = trim(preg_replace('/\s*\([^)]*\)/', '', $_FILES['product_image']['name']));
            $imagename = time() .'_'.$str;
            $config['upload_path'] = 'assets/uploads/products';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $imagename;
           
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error','Something happens wrong!');
            } else {
                if ($this->input->post('product_image_before'))
                {
                    unlink('assets/uploads/products/'.$this->input->post('product_image_before'));
                }
                $data = $this->upload->data();
                $product_info['product_image'] = $imagename;
                if ($this->input->post('product_id'))
                {
                    $result = $this->product_m->save($product_info, $this->input->post('product_id'));
                }
                else{
                    $result = $this->product_m->save($product_info);
                    $type = 'news';
                    $notification = $product_info['product_name'].' now here!';
                    save_notification($type, $notification);
                }
                if ($result)
                {
                    $this->session->set_flashdata('success','Product updated successfully');
                }
                else{
                    $this->session->set_flashdata('error','Something happens wrong!');
                }
            }
        }
        else{
            if ($this->input->post('product_id'))
            {
                $result = $this->product_m->save($product_info, $this->input->post('product_id'));
            }
            if ($result)
            {
                $this->session->set_flashdata('success','Product updated successfully');
            }
            else{
                $this->session->set_flashdata('error','Something happens wrong!');
            }
        } 
     
        redirect('a_product');
    }

    public function view_product($id = '')
    {
        if ($id)
        {
           $this->data['product_details'] = $this->product_m->get($id);
           $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
           $this->data['subview'] = 'admin/product/view';
           $this->data['script'] = 'admin/product/script';
           $this->data['list'] = false;
           $this->load->view('admin_layout_main', $this->data);
        }
    }

    public function delete()
    {
        if ($this->input->post('product_id'))
        {
            $product_info = $this->product_m->get($this->input->post('product_id'));
            unlink('assets/uploads/products/'.$product_info->product_image);
            $result = $this->product_m->delete($this->input->post('product_id'));
            if ($result)
            {
                $type = 'news';
                $notification = $product_info->product_name.' no more available!';
                save_notification($type, $notification);
                return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => true, 'message' => 'Product deleted successfully')));
            }
            else{
                return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'message' => 'Something happens wrong')));
            }
        }
    }
}