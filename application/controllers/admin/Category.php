<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('admin_m');
        $this->load->model('product_m');
        $this->load->model('productCategory_m');
        if ($this->admin_m->loggedin() == FALSE) {
            redirect('admin/security');
            exit;
        }
    }

    public function index()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/category/index';
        $this->data['script'] = 'admin/category/script';
        $this->data['list'] = true;
        $this->load->view('admin_layout_main', $this->data);
    }

    public function indexjson()
    {
        $aColumns = array('category_image','category_name', 'category_description');
        $relation = array(
            "fields" => "*",
        );
        $totalRecords = $this->productCategory_m->get_relation('', $relation, true);
        $totalFiltered =  $this->productCategory_m->get_relation('', $relation, true);

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
        $result = $this->productCategory_m->get_relation('', $relation);

        if (isset($_REQUEST['search']['value']) && $_REQUEST['search']['value'] != "") {
            $totalFiltered = $this->productCategory_m->get_relation('', $relation, true);
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

    public function add()
    {
        $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
        $this->data['subview'] = 'admin/category/add';
        $this->data['script'] = 'admin/category/script';
        $this->load->view('admin_layout_main', $this->data);
    }

    public function save()
    {
       $category['category_name'] = $this->input->post('category_name');
       $category['category_description'] = $this->input->post('category_description');
       if (!empty($_FILES['category_image']['name']))
       {
            $str = trim(preg_replace('/\s*\([^)]*\)/', '', $_FILES['category_image']['name']));
            $imagename = time() .'_'.$str;
            $config['upload_path'] = 'assets/uploads/catgeory';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $imagename;
        
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('category_image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error','Something happens wrong!');
            } else {
                $data = $this->upload->data();
                $category['category_image'] = $imagename;
                if ($this->input->post('category_id'))
                {
                    unlink('assets/uploads/catgeory/'.$this->input->post('image_name'));
                    $result = $this->productCategory_m->save($category,$this->input->post('category_id'));
                    $message = 'Category updated successfully';
                }
                else{
                    $result = $this->productCategory_m->save($category);
                    $message = 'Category added successfully';
                }
                if ($result)
                {
                    $this->session->set_flashdata('success',$message);
                }
                else{
                    $this->session->set_flashdata('error','Something happens wrong!');
                }
            }
       }
       else
       {
            $result = $this->productCategory_m->save($category,$this->input->post('category_id'));
            if ($result)
            {
                $this->session->set_flashdata('success','Category updated successfully');
            }
            else{
                $this->session->set_flashdata('error','Something happens wrong!');
            }
       }
       redirect('a_category');
    }


    public function edit($id = '')
    {
        if ($id)
        {
            $this->data['category_details'] = $this->productCategory_m->get($id);
            $this->data['meta_title'] = "TJ's-Pizza Fundraising Company";
            $this->data['subview'] = 'admin/category/add';
            $this->data['script'] = 'admin/category/script';
            $this->load->view('admin_layout_main', $this->data);
        }
    }

    public function delete()
    {
        if ($this->input->post('category_id'))
        {
            $category_info = $this->productCategory_m->get($this->input->post('category_id'));
            unlink('assets/uploads/catgeory/'.$category_info->category_image);
            $result = $this->productCategory_m->delete($this->input->post('category_id'));
            if ($result)
            {
                return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => true, 'message' => 'Catgeory deleted successfully')));
            }
            else{
                return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'message' => 'Something happens wrong')));
            }
        }
    }
    
}