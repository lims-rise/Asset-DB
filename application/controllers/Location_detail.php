<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Location_detail_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','location_detail/location_detail_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Location_detail_model->json();
    }

    public function list($id = '')
    {
        $id = $this->input->post('id', true);
        $select = $this->input->post('select', true);
        $data = $this->Location_detail_model->get_by_category($id);
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
    // public function read($id) 
    // {
    //     $row = $this->Location_detail_model->get_by_id($id);
    //     if ($row) {
    //         $data = array(
	// 	'id' => $row->id,
	// 	'category_name' => $row->category_name,
	// 	'name' => $row->name,
	//     );
    //         $this->template->load('template','location_detail/location_detail_read', $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('location_detail'));
    //     }
    // }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('location_detail/create_action'),
	    'id' => set_value('id'),
	    'id_location' => set_value('id_location'),
	    'name' => set_value('name'),
	);
        $this->template->load('template','location_detail/location_detail_form', $data);
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

            $this->Location_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('location_detail'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Location_detail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('location_detail/update_action'),
		        'id' => set_value('id', $row->id),
                'id_location' => $row->id_location,
                'name' => set_value('name', $row->name),
            );
            $this->template->load('template','location_detail/location_detail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('location_detail'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_location' => $this->input->post('id_location',TRUE),
		'name' => $this->input->post('name',TRUE),
		'status' => 1,
		'created_at' => date('Y-m-d H:i:s'),
		'created_by' => $this->session->userdata('id_users'),
	    );

            $this->Location_detail_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('location_detail'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Location_detail_model->get_by_id($id);

        if ($row) {
            $this->Location_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('location_detail'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('location_detail'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_location', 'id location', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {

        $this->load->helper('exportexcel');
        $namaFile = "Location_detail.xls";
        $judul = "Location_detail";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
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
	foreach ($this->Location_detail_model->get_all() as $data) {
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

/* End of file Location_detail.php */
/* Location: ./application/controllers/Location_detail.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-17 07:21:02 */
/* http://harviacode.com */