<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Department_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','department/department_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Department_model->json();
    }

    public function read($id) 
    {
        $row = $this->Department_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
	    );
            $this->template->load('template','department/department_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('department'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('department/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	 
	);
        $this->template->load('template','department/department_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'status' => 1,
		'created_at' => date('Y-m-d H:i:s'),
		'created_by' => $this->session->userdata('id_users'),
	    );

            $this->Department_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('department'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Department_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('department/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
	    );
            $this->template->load('template','department/department_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('department'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
	    );

            $this->Department_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('department'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Department_model->get_by_id($id);

        if ($row) {
            $this->Department_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('department'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('department'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "department.xls";
        $judul = "department";
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


	foreach ($this->Department_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);


	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Department.php */
/* Location: ./application/controllers/Department.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 01:09:04 */
/* http://harviacode.com */