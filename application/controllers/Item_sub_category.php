<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_sub_category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Item_sub_category_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','item_sub_category/item_sub_category_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Item_sub_category_model->json();
    }

    public function list($id = '')
    {
        $id = $this->input->post('id', true);
        $select = $this->input->post('select', true);
        $data = $this->Item_sub_category_model->get_by_category($id);
        $result = '<option value=""></option>';
        if($data->num_rows() > 0){
            foreach ($data->result() as $row) {
                if ($select == $row->id)
                    $result .= "<option value='$row->id' selected='selected'>$row->name</option>";
                else
                    $result .= "<option value='$row->id'>$row->name</option>";
    
            }
        }
        $result = array('data' =>$result);
        echo json_encode($result);
    }
    public function read($id) 
    {
        $row = $this->Item_sub_category_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'category_name' => $row->category_name,
		'name' => $row->name,
	    );
            $this->template->load('template','item_sub_category/item_sub_category_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_sub_category'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('item_sub_category/create_action'),
	    'id' => set_value('id'),
	    'category_id' => set_value('category_id'),
	    'name' => set_value('name'),
	);
        $this->template->load('template','item_sub_category/item_sub_category_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'category_id' => $this->input->post('category_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'status' => 1,
		'created_at' => date('Y-m-d H:i:s'),
		'created_by' => $this->session->userdata('id_users')
	    );

            $this->Item_sub_category_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('item_sub_category'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Item_sub_category_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('item_sub_category/update_action'),
		        'id' => set_value('id', $row->id),
                'category_id' => $row->category_id,
                'name' => set_value('name', $row->name),
            );
            $this->template->load('template','item_sub_category/item_sub_category_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_sub_category'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'category_id' => $this->input->post('category_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'status' => 1,
		'created_at' => date('Y-m-d H:i:s'),
		'created_by' => $this->session->userdata('id_users'),
	    );

            $this->Item_sub_category_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('item_sub_category'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Item_sub_category_model->get_by_id($id);

        if ($row) {
            $this->Item_sub_category_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('item_sub_category'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_sub_category'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('category_id', 'category id', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {

        $this->load->helper('exportexcel');
        $namaFile = "item_sub_category.xls";
        $judul = "item_sub_category";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        ob_clean();

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Name");
        xlsWriteLabel($tablehead, $kolomhead++, "Category Name");
	foreach ($this->Item_sub_category_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->name);
            xlsWriteLabel($tablebody, $kolombody++, $data->category_name);


	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Item_sub_category.php */
/* Location: ./application/controllers/Item_sub_category.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-17 07:21:02 */
/* http://harviacode.com */