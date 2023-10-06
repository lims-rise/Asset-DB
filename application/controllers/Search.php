<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model(['Item_master_model','Staff_model']);
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $q = $this->input->get('search');
        $staff = $this->Staff_model->global_search($q);
        foreach ($staff as $row) {
            $row->item = $this->Item_master_model->count_item_by_staff($row->id);
        }
        $inventory = $this->Item_master_model->global_search($q);
        foreach ($inventory as $row){
            $image = $this->Item_master_model->get_image_by_id($row->inventory_number);
            if ($image->num_rows() > 0)
                $row->image = $image->row('image');
            else
                $row->image = 'no-image.png';
        }
        $this->template->load('template','search',array(
           'staff' => $staff,'inventory'=>$inventory
        ));
    } 
     
}

