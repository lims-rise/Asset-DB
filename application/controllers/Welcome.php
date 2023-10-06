<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        is_login();
    }
    public function index() {
        //$this->load->view('table');
        $this->load->model('Item_master_model');
        
        $condition = $this->Item_master_model->get_condition();
        $item = array('decommissioned' => 0, 'good' => 0, 'repair' => 0 , 'total' => 0);
        foreach ($condition as $row) {
            if ($row->id == 5)
                $item['decommissioned'] = $row->val;
            else if($row->id == 2)
                $item['good'] = $row->val;
            else if($row->id == 6)
                 $item['repair'] = $row->val;
            $item['total'] += $row->val;
        }
        $inventory = $this->Item_master_model->get_summary();

        $staff = $this->Item_master_model->get_staff_activity();
    
        $this->template->load('template', 'welcome',array('condition'=>$item,'inventory' => $inventory,'staff'=> $staff));
    }

    public function form() {
        //$this->load->view('table');
        $this->template->load('template', 'form');
    }
    
    function autocomplate(){
        autocomplate_json('tbl_user', 'full_name');
    }

    function __autocomplate() {
        $this->db->like('nama_lengkap', $_GET['term']);
        $this->db->select('nama_lengkap');
        $products = $this->db->get('pegawai')->result();
        foreach ($products as $product) {
            $return_arr[] = $product->nama_lengkap;
        }

        echo json_encode($return_arr);
    }

    function pdf() {
        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');
        $pdf->Output();
    }

}
