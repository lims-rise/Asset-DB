<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_transaction_model extends CI_Model
{

    public $table = 'item_transaction';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables2
    function json($id = '') {
        $this->datatables2->select('`item_transaction`.`id`, 
                                    item_transaction.inventory_number,
                                    item_transaction.location_id,
                                    item_transaction.department_id,
                                    item_transaction.staff_id,
                                    item_transaction.purpose,
                                    item_transaction.condition_id,
                                    item_transaction.remark,
                                    item_transaction.transaction_at,
                                    location.name as location_name,
                                    department.name as department_name,
                                    staff.name as staff_name,
                                    staff.id as staff_id,
                                    item_condition.name as condition_name
                                    ');
        $where = array('item_transaction.status' => 1);
        if ($id != '')
            $where['item_transaction.inventory_number'] =  $id;
        
        $this->datatables2->where($where);
        $this->datatables2->table('item_transaction');
        //add this line for join
        $this->datatables2->join('location', 'item_transaction.location_id = location.id','left');
        $this->datatables2->join('department', 'item_transaction.department_id = department.id','left');
        $this->datatables2->join('staff', 'item_transaction.staff_id = staff.id','left');
        $this->datatables2->join('item_condition', 'item_transaction.condition_id = item_condition.id','left');
        // $this->datatables2->add_column('action', '<button class="btn btn-primary btn-sm btn-edit" type="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
        //         ".'<button class="btn btn-danger btn-sm btn-remove" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'id');
        return $this->datatables2->draw();
    }

    function json2($id = '') {
        $this->datatables2->select('item_maintenance.id_maintenance, 
                                    item_maintenance.inventory_number,
                                    item_maintenance.last_service_date,
                                    item_maintenance.id_services,
                                    item_maintenance.provider_contact,
                                    item_maintenance.id_staff,
                                    item_maintenance.service_desc,
                                    item_maintenance.id_frequency,
                                    item_maintenance.service_schedule,
                                    ref_services.services as services_type,
                                    ref_frequency.frequency as frequency,
                                    staff.name as staff_name,
                                    staff.id as staff_id
                                    ');
        $where = array('item_maintenance.status' => 1);
        if ($id != '')
            $where['item_maintenance.inventory_number'] = $id;
        
        $this->datatables2->where($where);
        $this->datatables2->table('item_maintenance');
        //add this line for join
        $this->datatables2->join('ref_services', 'item_maintenance.id_services = ref_services.id_services','left');
        $this->datatables2->join('ref_frequency', 'item_maintenance.id_frequency = ref_frequency.id_frequency','left');
        $this->datatables2->join('staff', 'item_maintenance.id_staff = staff.id','left');
        // $this->datatables2->add_column('action', '<button class="btn btn-primary btn-sm btn-edit" type="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
        //         ".'<button class="btn btn-danger btn-sm btn-remove" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'id');
        return $this->datatables2->draw();
    }

    // get all
    function get_all()
    {
        $this->db->select('`item_transaction`.`id`, 
                                    item_transaction.inventory_number,
                                    item_transaction.location_id,
                                    item_transaction.department_id,
                                    item_transaction.staff_id,
                                    item_transaction.purpose,
                                    item_transaction.condition_id,
                                    item_transaction.remark,
                                    item_transaction.transaction_at,
                                    location.name as location_name,
                                    department.name as department_name,
                                    staff.name as staff_name,
                                    item_condition.name as condition_name
                                    ');
        $this->db->where('item_transaction.status',1);
        $this->db->join('location', 'item_transaction.location_id = location.id','left');
        $this->db->join('department', 'item_transaction.department_id = department.id','left');
        $this->db->join('staff', 'item_transaction.staff_id = staff.id','left');
        $this->db->join('item_condition', 'item_transaction.condition_id = item_condition.id','left');
        $this->db->order_by('transaction_at','desc');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_by_id2($id)
    {
        $this->db->where('id_maintenance', $id);
        return $this->db->get('item_maintenance')->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('inventory_number', $q);
	$this->db->or_like('location_id', $q);
	$this->db->or_like('department_id', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('purpose', $q);
	$this->db->or_like('condition_id', $q);
	$this->db->or_like('remark', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('transaction_at', $q);
	$this->db->or_like('transaction_by', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('inventory_number', $q);
	$this->db->or_like('location_id', $q);
	$this->db->or_like('department_id', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('purpose', $q);
	$this->db->or_like('condition_id', $q);
	$this->db->or_like('remark', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('transaction_at', $q);
	$this->db->or_like('transaction_by', $q);
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

    function insert2($data)
    {
        $this->db->insert('item_maintenance', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update2($id, $data)
    {
        $this->db->where('id_maintenance', $id);
        $this->db->update('item_maintenance', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where('status', 1);
        $this->db->where($this->id, $id);
        $this->db->update($this->table,['status'=>0]);
    }

    function delete2($id)
    {
        $this->db->where('status', 1);
        $this->db->where('id_maintenance', $id);
        $this->db->update('item_maintenance',['status'=>0]);
    }

    function insert_batch($data){
        $this->db->insert_batch('item_transaction', $data);
    }
}

/* End of file Item_transaction_model.php */
/* Location: ./application/models/Item_transaction_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 08:18:52 */
/* http://harviacode.com */