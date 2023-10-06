<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_transaction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Item_transaction_model');
        $this->load->library('form_validation');        
	// $this->load->library('datatables');
       $this->load->library('datatables2');
    }

    public function index()
    {
        $this->template->load('template','item_transaction/item_transaction_list');
    } 
    
    public function json() {
        $id = $this->input->post('id', TRUE);
        header('Content-Type: application/json');
        echo $this->Item_transaction_model->json($id);
    }


    public function read($id) 
    {
        $row = $this->Item_transaction_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'inventory_number' => $row->inventory_number,
		'location_id' => $row->location_id,
		'department_id' => $row->department_id,
		'user_id' => $row->user_id,
		'purpose' => $row->purpose,
		'condition_id' => $row->condition_id,
		'remark' => $row->remark,
		'status' => $row->status,
		'transaction_at' => $row->transaction_at,
		'transaction_by' => $row->transaction_by,
		'created_at' => $row->created_at,
		'created_by' => $row->created_by,
	    );
            $this->template->load('template','item_transaction/item_transaction_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_transaction'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('item_transaction/create_action'),
	    'id' => set_value('id'),
	    'inventory_number' => set_value('inventory_number'),
	    'location_id' => set_value('location_id'),
	    'department_id' => set_value('department_id'),
	    'user_id' => set_value('user_id'),
	    'purpose' => set_value('purpose'),
	    'condition_id' => set_value('condition_id'),
	    'remark' => set_value('remark'),
	    'status' => set_value('status'),
	    'transaction_at' => set_value('transaction_at'),
	    'transaction_by' => set_value('transaction_by'),
	    'created_at' => set_value('created_at'),
	    'created_by' => set_value('created_by'),
	);
        $this->template->load('template','item_transaction/item_transaction_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'inventory_number' => $this->input->post('inventory_number',TRUE),
		'location_id' => $this->input->post('location_id',TRUE),
		'department_id' => $this->input->post('department_id',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'purpose' => $this->input->post('purpose',TRUE),
		'condition_id' => $this->input->post('condition_id',TRUE),
		'remark' => $this->input->post('remark',TRUE),
		'status' => $this->input->post('status',TRUE),
		'transaction_at' => $this->input->post('transaction_at',TRUE),
		'transaction_by' => $this->input->post('transaction_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
	    );

            $this->Item_transaction_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('item_transaction'));
        }
    }
    
    public function action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'inventory_number' => $this->input->post('inventory_number',TRUE),
                'location_id' => $this->input->post('location_id',TRUE),
                'department_id' => $this->input->post('department_id',TRUE),
                'staff_id' => $this->input->post('staff_id',TRUE),
                'purpose' => $this->input->post('purpose',TRUE),
                'condition_id' => $this->input->post('condition_id',TRUE),
                'remark' => $this->input->post('remark',TRUE),
                'status' => 1,
                'transaction_at' => $this->input->post('transaction_at',TRUE),
                'transaction_by' => $this->session->userdata('id_users'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users'),
            );
            $id = $this->input->post('id',TRUE);
            if($id != '')
                $this->Item_transaction_model->update($id,$data);
            else
                $this->Item_transaction_model->insert($data);

            echo json_encode(array('massage' => 'Data Saved'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Item_transaction_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('item_transaction/update_action'),
		'id' => set_value('id', $row->id),
		'inventory_number' => set_value('inventory_number', $row->inventory_number),
		'location_id' => set_value('location_id', $row->location_id),
		'department_id' => set_value('department_id', $row->department_id),
		'user_id' => set_value('user_id', $row->user_id),
		'purpose' => set_value('purpose', $row->purpose),
		'condition_id' => set_value('condition_id', $row->condition_id),
		'remark' => set_value('remark', $row->remark),
		'status' => set_value('status', $row->status),
		'transaction_at' => set_value('transaction_at', $row->transaction_at),
		'transaction_by' => set_value('transaction_by', $row->transaction_by),
		'created_at' => set_value('created_at', $row->created_at),
		'created_by' => set_value('created_by', $row->created_by),
	    );
            $this->template->load('template','item_transaction/item_transaction_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_transaction'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
            'inventory_number' => $this->input->post('inventory_number',TRUE),
            'location_id' => $this->input->post('location_id',TRUE),
            'department_id' => $this->input->post('department_id',TRUE),
            'user_id' => $this->input->post('user_id',TRUE),
            'purpose' => $this->input->post('purpose',TRUE),
            'condition_id' => $this->input->post('condition_id',TRUE),
            'remark' => $this->input->post('remark',TRUE),
            'status' => $this->input->post('status',TRUE),
            'transaction_at' => $this->input->post('transaction_at',TRUE),
            'transaction_by' => $this->input->post('transaction_by',TRUE),
            'created_at' => $this->input->post('created_at',TRUE),
            'created_by' => $this->input->post('created_by',TRUE),
	    );

            $this->Item_transaction_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('item_transaction'));
        }
    }
    
    public function delete() 
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Item_transaction_model->get_by_id($id);

        if ($row) {
            $this->Item_transaction_model->delete($id);
            // $this->session->set_flashdata('message', 'Delete Record Success');
            // redirect(site_url('item_transaction'));
            $data = array('message' => 'Delete Record Success');
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('item_transaction'));
            $data = array('message' => 'Record Not Found');
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('inventory_number', 'inventory number', 'trim|required');
	$this->form_validation->set_rules('location_id', 'location id', 'trim|required');
	$this->form_validation->set_rules('department_id', 'department id', 'trim|required');
	$this->form_validation->set_rules('staff_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('purpose', 'purpose', 'trim');
	$this->form_validation->set_rules('condition_id', 'condition id', 'trim|required');
	$this->form_validation->set_rules('remark', 'remark', 'trim');
	$this->form_validation->set_rules('transaction_at', 'transaction at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "item_transaction.xls";
        $judul = "item_transaction";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Inventory Number");
	xlsWriteLabel($tablehead, $kolomhead++, "Location");
	xlsWriteLabel($tablehead, $kolomhead++, "Department");
	xlsWriteLabel($tablehead, $kolomhead++, "Responsible Person");
	xlsWriteLabel($tablehead, $kolomhead++, "Purpose");
	xlsWriteLabel($tablehead, $kolomhead++, "Condition");
	xlsWriteLabel($tablehead, $kolomhead++, "Remark");


	foreach ($this->Item_transaction_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->transaction_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->inventory_number);
	    xlsWriteLabel($tablebody, $kolombody++, $data->location_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->department_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->staff_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->purpose);
	    xlsWriteLabel($tablebody, $kolombody++, $data->condition_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->remark);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Item_transaction.php */
/* Location: ./application/controllers/Item_transaction.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 08:18:52 */
/* http://harviacode.com */