<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff_model extends CI_Model
{

    public $table = 'staff';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('staff.id,staff.name, department.name as department_name, location.name as location_name');
        $this->datatables->join('department', 'staff.department_id = department.id','left');
        $this->datatables->join('location', 'staff.location_id = location.id','left');
        $this->datatables->where('staff.status',1);
        $this->datatables->where('location.id', $this->session->userdata('location_id'));
        $this->datatables->from('staff');
        //add this line for join
        $this->datatables->add_column('action', anchor(site_url('staff/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm'))." 
            ".anchor(site_url('staff?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
                ".anchor(site_url('staff/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->select('staff.*, department.name as department_name, location.name as location_name');
        $this->db->join('department', 'staff.department_id = department.id','left');
        $this->db->join('location', 'staff.location_id = location.id','left');
        $this->db->where('status', 1);
        $this->db->where('location.id', $this->session->userdata('location_id'));
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('staff.*, department.name as department_name, location.name as location_name');
        $this->db->join('department', 'staff.department_id = department.id','left');
        $this->db->join('location', 'staff.location_id = location.id','left');
        $this->db->where('staff.status', 1);
        $this->db->where('location.id', $this->session->userdata('location_id'));
        $this->db->where('staff.'.$this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->where('status', 1);
        $this->db->where('location.id', $this->session->userdata('location_id'));

        $this->db->like('id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('department_id', $q);
	$this->db->or_like('location_id', $q);
	$this->db->or_like('image', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->where('status', 1);
        $this->db->where('location.id', $this->session->userdata('location_id'));

        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('department_id', $q);
	$this->db->or_like('location_id', $q);
	$this->db->or_like('image', $q);
	$this->db->or_like('status', $q);
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

    function get_detail($id){
       return  $this->db->select('department_id,location_id')
            ->where('id', $id)
            ->where('status', 1)
            ->get($this->table)->row();

    }

    function global_search($q){
        return $this->db->select('s.*, dp.name as department_name , lc.name as location_name')
            ->join('department dp', 'dp.id = s.department_id', 'left')
            ->join('location lc', 'lc.id = s.location_id', 'left')
            ->where('s.status', 1)
            ->where('location.id', $this->session->userdata('location_id'))
            ->group_start()
            ->like('s.name', $q, 'both')
            ->or_like('lc.name', $q, 'both')
            ->or_like('dp.name', $q, 'both')
            ->group_end()
            ->limit(6)
            ->get('staff s')->result();
    }

}

/* End of file Staff_model.php */
/* Location: ./application/models/Staff_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 08:19:00 */
/* http://harviacode.com */