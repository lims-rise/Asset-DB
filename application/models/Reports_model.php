<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports_model extends CI_Model
{

    public $table = 'v_item_report';
    public $id = 'inventory_number';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($date1,$date2,$cat,$fund,$loc,$con,$subcat) {
        $this->datatables->select('inventory_number, description, 
        `name`, type, serial_number, purchase_date, purchase_price, category,
        sub_category, fund, manufacture, supplier, qty, location,
        location_detail, location_all, staffname, condition, `status`');
        $this->datatables->where('status',1);
        $this->datatables->where('id_location', $this->session->userdata('location_id'));
        if (strlen($date1) > 0) {
            $this->datatables->where("(purchase_date >= IF('$date1' IS NULL or '$date1' = '', '0000-00-00', '$date1'))", NULL);
        }
        if (strlen($date2) > 0) {
            $this->datatables->where("(purchase_date <= IF('$date2' IS NULL or '$date2' = '', NOW(), '$date2'))", NULL);
        }
        if (strlen($cat) > 0) {
            $this->datatables->where("(category_id = '$cat')", NULL);
        }        
        if (strlen($fund) > 0) {
            $this->datatables->where("(fund_id = '$fund')", NULL);
        }
        if (strlen($loc) > 0) {
            $this->datatables->where("(location_det_id = '$loc')", NULL);
        }
        if (strlen($con) > 0) {
            $this->datatables->where("(condition_id = '$con')", NULL);
        }
        if (strlen($subcat) > 0) {
            $this->datatables->where("(sub_category_id = '$subcat')", NULL);
        }
        $this->datatables->from('v_item_report');

            //add this line for join
        //$this->datatables->join('table2', 'department.field = table2.field');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->where('status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get report
    function get_report($date1,$date2,$cat,$fund,$loc,$con,$subcat)
    {
        $this->db->where('status', 1);
        if (strlen($date1) > 0) {
            $this->db->where("(purchase_date >= IF('$date1' IS NULL or '$date1' = '', '0000-00-00', '$date1'))", NULL);
        }
        if (strlen($date2) > 0) {
            $this->db->where("(purchase_date <= IF('$date2' IS NULL or '$date2' = '', NOW(), '$date2'))", NULL);
        }
        if (strlen($cat) > 0) {
            $this->db->where("(category_id = '$cat')", NULL);
        }        
        if (strlen($fund) > 0) {
            $this->db->where("(fund_id = '$fund')", NULL);
        }
        if (strlen($loc) > 0) {
            $this->db->where("(location_det_id = '$loc')", NULL);
        }
        if (strlen($con) > 0) {
            $this->db->where("(condition_id = '$con')", NULL);
        }
        if (strlen($subcat) > 0) {
            $this->db->where("(sub_category_id = '$subcat')", NULL);
        }
        $this->db->where('id_location', $this->session->userdata('location_id'));

        $this->db->order_by($this->id, $this->order);
        return $this->db->get('v_item_report')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where('status', 1);

        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->where('status', 1);

        $this->db->like('id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->where('status', 1);

        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('name', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('created_by', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where('status', 1);
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where('status', 1);
        $this->db->where($this->id, $id);
        $this->db->update($this->table,['status' => 0]);
    }

}

/* End of file Department_model.php */
/* Location: ./application/models/Department_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 01:09:04 */
/* http://harviacode.com */