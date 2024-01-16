<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_master_model extends CI_Model
{

    public $table = 'item_master';
    public $id = 'inventory_number';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function get_id(){
        $ct = $this->session->userdata('location_id');
        if($ct == 3) {
            $ct_id = "ID";
        }
        else if($ct == 2) {
            $ct_id = "AU";
        }
        else if($ct == 1) {
            $ct_id = "FJ";
        }

        $years = date("Y");
        $data = $this->db->like('inventory_number',"RISE-$ct_id/$years/",'after')
        ->get($this->table);
        $count = $data->num_rows();
        $count = $count + 1;
            return  "RISE-$ct_id/$years/IT-" . sprintf("%03d", $count);
       
    }

    function get_id2($cat_id){
        $ct = $this->session->userdata('location_id');
        // $cat_id = $this->input->post('cat_id',TRUE);

        if($ct == 3) {
            $ct_id = "ID";
        }
        else if($ct == 2) {
            $ct_id = "AU";
        }
        else if($ct == 1) {
            $ct_id = "FJ";
        }

        $years = date("Y");
        if($cat_id == 1){
            $cat_name = "IT";
        }
        else if($cat_id == 2){
            $cat_name = "LAB";
        }
        else if($cat_id == 3){
            $cat_name = "BLD";
        }
        else if($cat_id == 4){
            $cat_name = "OBJ";
        }
        else if($cat_id == 5){
            $cat_name = "OFF";
        }
        $data = $this->db->like('inventory_number',"RISE-$ct_id/$years/$cat_name-",'after')->get($this->table);

        $count = $data->num_rows();
        $count = $count + 1;
            return  "RISE-$ct_id/$years/$cat_name-" . sprintf("%03d", $count);
       
    }    
    
    function json() {
        $this->datatables->select('item_master.inventory_number,description,item_master.name,type,serial_number,item_master.category_id,
                    sub_category_id, item_master.fund_id,item_master.manufacture_id,item_master.supplier_id, item_master.scheduled,
                    item_category.name as category_name,
                    item_sub_category.name as sub_category_name,
                    item_fund.name as fund_name,
                    item_manufacture.name as manufacture_name,
                    item_supplier.name as supplier_name,
                    location_detail.name as loc_det_name,
                    location.name as loc_name,
                    item_qty.qty as qty
                    ');
       
        $this->datatables->join('item_category', 'item_master.category_id = item_category.id','left');
        $this->datatables->join('item_sub_category', 'item_master.sub_category_id = item_sub_category.id','left');
        $this->datatables->join('item_fund', 'item_master.fund_id = item_fund.id','left');
        $this->datatables->join('item_manufacture', 'item_master.manufacture_id = item_manufacture.id','left');
        $this->datatables->join('item_supplier', 'item_master.supplier_id = item_supplier.id','left');
        $this->datatables->join('item_qty', 'item_master.inventory_number = item_qty.inventory_number','left');
        $this->datatables->join('location_detail', 'item_master.location_det_id = location_detail.id','left');
        $this->datatables->join('location', 'location_detail.id_location = location.id','left');
        $this->datatables->where('item_master.status', 1);
        $this->datatables->where('location.id', $this->session->userdata('location_id'));
        $this->datatables->from('item_master');
        //add this line for join
        //$this->datatables->join('table2', 'item_master.field = table2.field');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 1){
            $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"> test</i>', array('class' => 'btn bg-navy btn-sm'))." 
            ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm'))." 
            ".anchor(site_url('item_master/delete?id=$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'inventory_number');
        }
        else if ($lvl == 2){
            $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"> test</i>', array('class' => 'btn bg-navy btn-sm'))." 
            ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm')), 'inventory_number');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"> test</i>', array('class' => 'btn bg-navy btn-sm')), 'inventory_number');
        }
        return $this->datatables->generate();
    }

    function history() {
        $this->datatables->select('*');
  
        $this->datatables->join('item_category', 'item_master.category_id = item_category.id','left');
        $this->datatables->join('item_sub_category', 'item_master.sub_category_id = item_sub_category.id','left');
        $this->datatables->join('location_detail', 'item_master.location_det_id = location_detail.id','left');
        $this->datatables->join('location', 'location_detail.id_location = location.id','left');
        $this->datatables->where('item_master.status', 1);
        $this->datatables->where('location.id', $this->session->userdata('location_id'));
        $this->datatables->from('item_master');
        //add this line for join
        //$this->datatables->join('table2', 'item_master.field = table2.field');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm')), 'inventory_number');
        }
        else if ($lvl == 2){
            $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm'))." 
            ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm')), 'inventory_number');
        }
        else if ($lvl == 1){
            $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm'))." 
            ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm'))." 
            ".anchor(site_url('item_master/delete?id=$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'inventory_number');
        }
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->select('inventory_number,description,item_master.name,type,serial_number,item_master.category_id,item_master.sub_category_id,item_master.scheduled,
        item_category.name as category_name,
        item_sub_category.name as sub_category_name');
      
        $this->db->join('item_category', 'item_master.category_id = item_category.id','left');
        $this->db->join('item_sub_category', 'item_master.sub_category_id = item_sub_category.id','left');
        $this->db->join('location_detail', 'item_master.location_det_id = location_detail.id','left');
        $this->db->join('location', 'location_detail.id_location = location.id','left');
        $this->db->where('item_master.status', 1);
        $this->db->where('location.id', $this->session->userdata('location_id'));
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_with_detail($query = null){
        $this->master('datatables');
        $this->datatables->select('im.purchase_date, im.purchase_price,im.inventory_number , im.name, im.type, im.description, im.scheduled,ic2.name  as category_name, isc.name as sub_category_name, serial_number,purchase_date,purchase_price ,transaction_at, staff_id, staff.name as staff_name , d.name  as department_name,
        l.name  as location_name , it2.condition_id, ic.name  as condition_name , purpose, remark, fund.name AS fund_name');
        if($query){
            foreach ($query as $key => $value) {
                if($value != '')
                $this->datatables->where(str_replace('-', '.', $key), $value);
            }
        }
        $this->datatables->where('loc.id', $this->session->userdata('location_id'));
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 1){
            return  $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm' , 'style'=> 'margin:0 3px 3px 0'))." 
            ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm', 'style'=> 'margin:0 3px 3px 0'))." 
            ".anchor(site_url('item_master/delete?id=$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"  style ="margin:0 3px 3px 0" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'inventory_number')
            ->generate();
        }
        else if ($lvl == 2){
            return  $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm' , 'style'=> 'margin:0 3px 3px 0'))." 
            ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm', 'style'=> 'margin:0 3px 3px 0')), 'inventory_number')
            ->generate();
        }
        else if ($lvl == 3){
            return  $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm' , 'style'=> 'margin:0 3px 3px 0')), 'inventory_number')
            ->generate();
        }

    }

    // function get_all_with_detail2($getinput){
    //     $this->master('datatables');
    //     $this->datatables->select('im.purchase_date, im.purchase_price,im.inventory_number , im.name, im.type, im.description, ic2.name  as category_name, isc.name as sub_category_name, serial_number,purchase_date,purchase_price ,transaction_at, staff_id, staff.name as staff_name , d.name  as department_name,
    //     l.name  as location_name , it2.condition_id, ic.name  as condition_name , purpose, remark, fund.name AS fund_name');
    //     $this->datatables->where('loc.id', $this->session->userdata('location_id'));
    //     $this->datatables->where('im.category_id', $getinput);

    //          return  $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm' , 'style'=> 'margin:0 3px 3px 0'))." 
    //             ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm', 'style'=> 'margin:0 3px 3px 0'))." 
    //                 ".anchor(site_url('item_master/delete?id=$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"  style ="margin:0 3px 3px 0" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'inventory_number')
    //                         ->generate();
    // }

    function get_all_by_user($query){
        $this->master('datatables');
        $this->datatables->select('im.purchase_date, im.purchase_price,im.inventory_number , im.name, im.type, im.description, im.scheduled, ic2.name as category_name, isc.name as sub_category_name, serial_number,purchase_date,purchase_price ,transaction_at, staff_id, staff.name as staff_name , d.name  as department_name,
        l.name  as location_name , it2.condition_id, ic.name  as condition_name , purpose, remark');
        if($query){
            foreach ($query as $key => $value) {
                if($value != '')
                $this->datatables->where(str_replace('-', '.', $key), $value);
            }
        }
        $this->datatables->where('loc.id', $this->session->userdata('location_id'));

             return  $this->datatables->add_column('action', anchor(site_url('item_master/read?id=$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn bg-navy btn-sm' , 'style'=> 'margin:0 3px 3px 0'))." 
                ".anchor(site_url('item_master/update?id=$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm', 'style'=> 'margin:0 3px 3px 0'))." 
                    ".anchor(site_url('item_master/delete?id=$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"  style ="margin:0 3px 3px 0" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'inventory_number')
                            ->generate();
    }

    function get_all_with_detail_excel()
    {
        return $this->db->select('im.purchase_date, im.purchase_price,im.inventory_number , im.name, im.type, im.description, im.scheduled,ic2.name  as category_name, isc.name as sub_category_name, serial_number,purchase_date,purchase_price ,transaction_at, staff_id, staff.name as staff_name , d.name  as department_name,
        l.name  as location_name , ic.name  as condition_name , purpose, remark')
            ->from("item_master im")
            ->join('(select max(id) as id,it.inventory_number   from item_transaction 
        join ( select  inventory_number  ,  max(transaction_at)  as transaction_at 
        from item_transaction it where status  = 1 group by inventory_number) it on it.inventory_number  = item_transaction.inventory_number  and it.transaction_at  = item_transaction.transaction_at 
                    group by item_transaction.inventory_number , item_transaction.transaction_at) hist', 'hist.inventory_number = im.inventory_number', 'left')
            ->join('item_transaction it2', 'it2.id = hist.id', 'left')
            ->join('staff', 'staff.id = it2.staff_id', 'left')
            ->join('location l', 'l.id = it2.location_id ', 'left')
            ->join('department d', 'd.id = it2.department_id ', 'left')
            ->join('item_condition ic', 'ic.id = it2.condition_id', 'left')
            ->join('item_category ic2', 'ic2.id  = im.category_id ', 'left')
            ->join('item_sub_category isc', 'isc.id = im.sub_category_id', 'left')
            ->where('im.status', 1)
            ->where('l.id', $this->session->userdata('location_id'))
            ->get()->result();
    }

    function master($tipe = 'db'){
        return    $this->$tipe->from("item_master im")->join('(select max(id) as id,it.inventory_number from item_transaction 
        join (select inventory_number, max(transaction_at) as transaction_at 
        from item_transaction it where status  = 1 group by inventory_number) it on it.inventory_number  = item_transaction.inventory_number  and it.transaction_at  = item_transaction.transaction_at 
                    group by item_transaction.inventory_number , item_transaction.transaction_at) hist','hist.inventory_number = im.inventory_number','left')
                ->join('item_transaction it2','it2.id = hist.id','left') 
                ->join('staff','staff.id = it2.staff_id','left') 
                ->join('location l','l.id = it2.location_id ','left') 
                ->join('department d','d.id = it2.department_id ','left') 
                ->join('item_condition ic','ic.id = it2.condition_id','left') 
                ->join('item_category ic2','ic2.id  = im.category_id ','left') 
                ->join('item_sub_category isc','isc.id = im.sub_category_id','left')
                ->join('item_fund fund', 'fund.id = im.fund_id', 'left')
                ->join('item_manufacture manu', 'manu.id = im.manufacture_id', 'left')
                ->join('item_supplier sup', 'sup.id = im.supplier_id', 'left')
                ->join('item_qty qty', 'qty.inventory_number = im.inventory_number', 'left')
                ->join('location_detail ldet', 'ldet.id = im.location_det_id','left')
                ->join('location loc', 'loc.id = ldet.id_location','left')
                ->where('loc.id', $this->session->userdata('location_id'))
                ->where('im.status',1) ;
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->select('item_master.inventory_number,item_master.*,
        item_fund.name as fund_name,
        item_manufacture.name as manufacture_name,
        item_supplier.name as supplier_name,
        item_category.name as category_name,
        item_qty.qty as qty,
        item_sub_category.name as sub_category_name,
        location.id as id_location,
        location.name as location_name,
        location_detail.name as location_detail_name,
        ');
        $this->db->join('item_category', 'item_master.category_id = item_category.id','left');
        $this->db->join('item_sub_category', 'item_master.sub_category_id = item_sub_category.id','left');
        $this->db->join('item_fund', 'item_master.fund_id = item_fund.id','left');
        $this->db->join('item_manufacture', 'item_master.manufacture_id = item_manufacture.id','left');
        $this->db->join('item_supplier', 'item_master.supplier_id = item_supplier.id','left');
        $this->db->join('item_qty', 'item_master.inventory_number = item_qty.inventory_number','left');
        $this->db->join('location_detail', 'item_master.location_det_id = location_detail.id','left');
        $this->db->join('location', 'location_detail.id_location = location.id','left');
        $this->db->where('item_master.status', 1);
        $this->db->where('location.id', $this->session->userdata('location_id'));
        $this->db->where('item_master.inventory_number', $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_image($id){
        return $this->db->where('inventory_number', $id)->get('item_image')->result();
    }

    function get_image_show($id){
        return $this->db->where('inventory_number', $id)->get('item_image');

    }

    function get_all_item_by_staff_id($id){
        $this->master('db');
        return $this->db->select('
        it2.inventory_number,
        it2.location_id,
        it2.department_id,
        it2.staff_id,
        it2.purpose,
        it2.condition_id,
        it2.remark,
        it2.transaction_at,
        it2.transaction_by,
        it2.created_at,
        it2.created_by')
        ->where('it2.staff_id', $id)
        ->get()
        ->result();
    }
    function get_summary_condition($id){
        $this->master('db');
        return $this->db->select('ic.name, count(*) as val')
        ->where('it2.staff_id', $id)->group_by('it2.condition_id,ic.name')->order_by('count(*)','desc')->get()->result() ;
       
    }

    function get_summary($id = ''){
        $this->master('db');
        if ($id != '')
            $this->db->where('it2.staff_id', $id);
        return $this->db->select('isc.name, count(*) as val')
        ->group_by('im.sub_category_id,isc.name')->order_by('count(*)','desc')->get()->result() ;

    }
    // get total rows
    function total_rows($q = NULL) {
        $this->db->where('item_master.status', 1);
        $this->db->like('inventory_number', $q);
        $this->db->or_like('description', $q);
        $this->db->or_like('name', $q);
        $this->db->or_like('type', $q);
        $this->db->or_like('serial_number', $q);
        $this->db->or_like('category_id', $q);
        $this->db->or_like('sub_category_id', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('created_by', $q);
        $this->db->or_like('status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->where('item_master.status', 1);

        $this->db->order_by($this->id, $this->order);
        $this->db->like('inventory_number', $q);
        $this->db->or_like('description', $q);
        $this->db->or_like('name', $q);
        $this->db->or_like('type', $q);
        $this->db->or_like('serial_number', $q);
        $this->db->or_like('category_id', $q);
        $this->db->or_like('sub_category_id', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('created_by', $q);
        $this->db->or_like('status', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insertqty($dataqty)
    {
        $this->db->insert('item_qty', $dataqty);
    }

    function insertImage($data){
        $this->db->insert_batch('item_image',$data);
    }
    // update data
    function update($id, $data)
    {
        $this->db->where('item_master.status', 1);

        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // public function qty_check ($inventory_number) {
    //     $this->db->where('inventory_number', $inventory_number);
    //     $query = $this->db->get('item_qty');

    //     return $query->num_rows();
    //     // return $query->num_rows() > 0; // Return true if the inventory number exists, false otherwise
    // }    
    
    function updateqty($id, $updqty, $dataqty)
    {
        $this->db->where('item_qty.inventory_number', $id);
        $query = $this->db->get('item_qty');

        if ($query->num_rows() > 0) {
            $this->db->where('item_qty.inventory_number', $id);
            $this->db->update('item_qty', $updqty);
            }
        else {
            $this->db->insert('item_qty', $dataqty);
        }
    }

    // delete data
    function delete($id)
    {
        $this->db->where('item_master.status', 1);
        $this->db->where($this->id, $id);
        $this->db->update($this->table,['status'=> 0]);
    }
    function removeImage($id,$image){
      return  $this->db->where('inventory_number', $id)->where('image', $image)->delete('item_image');
    }

    function global_search($q){
      return  $this->db->select('im.*, ct.name as category_name, sct.name as sub_category_name')
      ->join('item_category ct', 'ct.id = im.category_id', 'left')
      ->join('item_sub_category sct', 'sct.id = im.category_id', 'left')
      ->where('im.status',1)
        ->group_start()
            ->like('im.inventory_number', $q, 'both')
            ->or_like('im.name', $q, 'both')
            ->or_like('im.description', $q, 'both')
            ->or_like('im.type', $q, 'both')
            ->or_like('im.serial_number', $q, 'both')
            ->or_like('im.purchase_date', $q, 'both')
            ->or_like('ct.name', $q, 'both')
            ->or_like('sct.name', $q, 'both')
        ->group_end()
        ->limit(7)
    ->get('item_master im')->result();
    }

    function get_staff_activity(){
        $this->master('db');
        return $this->db->select('staff.name,staff.image,d.name as department_name, staff.id')
        ->where('staff.location_id', $this->session->userdata('location_id'))
        ->group_by('staff.name,staff.image,d.name,staff.id')
        ->limit(10)
        ->get()
        ->result();
    }
    function count_item_by_staff($id){
        $this->master('db');
      return  $this->db->select('im.inventory_number')
        ->where('it2.staff_id',$id)
        ->group_by('im.inventory_number')->get()->num_rows();
    }

    function get_image_by_id($id){
        return $this->db->where('inventory_number', $id)->get('item_image');
    }

    function get_condition(){
        $this->master('db');
        return $this->db->select('count(*) as val ,ic.id')
            ->group_by('ic.id')->get()->result();
    }
}

/* End of file Item_master_model.php */
/* Location: ./application/models/Item_master_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 02:55:12 */
/* http://harviacode.com */