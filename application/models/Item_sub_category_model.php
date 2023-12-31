<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_sub_category_model extends CI_Model
{

    public $table = 'item_sub_category';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('item_sub_category.id, item_sub_category.name, item_category.name as category_name');
        $this->datatables->from('item_sub_category');
        $this->datatables->where('item_sub_category.status',1);
        //add this line for join
        $this->datatables->join('item_category', 'item_sub_category.category_id = item_category.id');
        $this->datatables->add_column('action', anchor(site_url('item_sub_category/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm'))." 
            ".anchor(site_url('item_sub_category/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm'))." 
                ".anchor(site_url('item_sub_category/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->select('item_sub_category.id, item_sub_category.name, item_category.name as category_name');
        $this->db->where('item_sub_category.status', 1);
        $this->db->join('item_category', 'item_category.id = item_sub_category.category_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_by_category($id = '')
    {
     return   $this->db->where('category_id', $id)
            ->order_by('name', 'asc')
            ->get('item_sub_category');
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('item_sub_category.id, item_sub_category.name, item_sub_category.category_id,item_category.name as category_name');
        $this->db->join('item_category', 'item_category.id = item_sub_category.category_id');
        $this->db->where('item_sub_category.status', 1);
        $this->db->where('item_sub_category.'.$this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('category_id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
    $this->db->where('status', 1);

	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('category_id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
    $this->db->where('status', 1);

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
        $this->db->update($this->table,['status'=>0]);
    }

}

/* End of file Item_sub_category_model.php */
/* Location: ./application/models/Item_sub_category_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-17 07:21:02 */
/* http://harviacode.com */