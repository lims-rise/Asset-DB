<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model(['Staff_model','Item_master_model','Item_transaction_model']);
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $id = $this->input->get('id', TRUE);
        $data = $this->Staff_model->get_by_id($id);
        if ($id != ''){
            $data->button = 'Edit';
            $data->link = site_url('staff/update_action');
            $data->button_color = 'btn-success';
        }
        $this->template->load('template','staff/staff_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Staff_model->json();
    }

    public function read() 
    {
        $id = $this->input->get('id', true);
        if($id == '')
            $id = $this->session->userdata('staff_id');
        $row = $this->Staff_model->get_by_id($id);
        if ($row) {
            $row->item = $this->Item_master_model->get_summary($id);
            $row->condition = $this->Item_master_model->get_summary_condition($id);
            $this->template->load('template','staff/staff_read', $row);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('staff'));
        }
    }
    
    public function get_summary($id)
    {
        $data = $this->Item_master_model->get_summary($id);
        echo json_encode($data);
    }
    
    public function data()
    {
        $input = $this->input->post('cari',true);
        // $data = $this->input->get();
        header('Content-Type: application/json');
        echo $this->Item_master_model->get_all_with_detail($input);
    }

    public function item_mutation()
    {
        $data = array(
            'inventory_number' => $this->input->post('inventory_number', TRUE),
            'location_id' => $this->input->post('location_id', TRUE),
            'department_id' => $this->input->post('department_id', TRUE),
            'staff_id' => $this->input->post('staff_id', TRUE),
            'purpose' => $this->input->post('purpose', TRUE),
            'condition_id' => $this->input->post('condition_id', TRUE),
            'remark' => $this->input->post('remark', TRUE),
            'status' => 1,
            'transaction_at' => $this->input->post('transaction_at', TRUE),
            'transaction_by' => $this->session->userdata('id_users'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_users')
        );
        $this->Item_transaction_model->insert($data);;
        header('Content-Type: application/json');
        echo json_encode(['success']);

    }

    public function transfer_all()
    {
        $item = $this->Item_master_model->get_all_item_by_staff_id($this->input->post('id'));
        if($item){
            foreach ($item as $row) {
                $row->location_id = $this->input->post('location_id_transfer'); 
                $row->department_id = $this->input->post('department_id_transfer'); 
                $row->staff_id = $this->input->post('staff_id_transfer'); 
                $row->purpose = $this->input->post('purpose'); 
                $row->remark = $this->input->post('remark'); 
                $row->transaction_at = date('Y-m-d H:i:s'); 
                $row->transaction_by = $this->session->userdata('id_users'); 
                $row->created_at = date('Y-m-d H:i:s'); 
                $row->created_by = $this->session->userdata('id_users'); 
            }
            // var_dump($item);
            $this->Item_transaction_model->insert_batch($item);
            header('Content-Type: application/json');
            echo json_encode(['success']);
        }
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => base_url('staff/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'department_id' => set_value('department_id'),
	    'location_id' => set_value('location_id'),
	    'image' => set_value('image'),
	);
        $this->template->load('template','staff/staff_form', $data);
    }
    
    public function upload()
    {
        $config['upload_path']          = './assets/images/';
            $config['allowed_types']='gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            $data = array('error' => false);
            if(!$this->upload->do_upload("image"))
                $data['error'] = $this->upload->display_errors();
            else {
                $upload = $this->upload->data();
                $data['data']= $upload['file_name'];
            }
            echo json_encode($data);
    }
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'name' => $this->input->post('name',TRUE),
            'department_id' => $this->input->post('department_id',TRUE),
            'location_id' => $this->input->post('location_id',TRUE),
            'status' => 1,
            );
            $image = $this->input->post('file', TRUE);
                if ($image != '')
                    $data['image'] = $image;

            $this->Staff_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(base_url('staff'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Staff_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => base_url('staff/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'department_id' => set_value('department_id', $row->department_id),
                'location_id' => set_value('location_id', $row->location_id),
                'image' => set_value('image', $row->image),
                );
            $this->template->load('template','staff/staff_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('staff'));
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
                'department_id' => $this->input->post('department_id',TRUE),
                'location_id' => $this->input->post('location_id',TRUE),
                );
                $image = $this->input->post('file', TRUE);
                if ($image != '')
                    $data['image'] = $image;
          
            $this->Staff_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('staff'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Staff_model->get_by_id($id);

        if ($row) {
            $this->Staff_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('staff'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('staff'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('department_id', 'departmen id', 'trim|required');
	$this->form_validation->set_rules('location_id', 'location id', 'trim');
	$this->form_validation->set_rules('image', 'image', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "staff.xls";
        $judul = "staff";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Departmen Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Location Id");


	foreach ($this->Staff_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->department_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->location_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function get_detail()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->Staff_model->get_detail($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

/* End of file Staff.php */
/* Location: ./application/controllers/Staff.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 08:19:00 */
/* http://harviacode.com */