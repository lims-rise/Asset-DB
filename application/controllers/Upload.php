<?php
class Upload extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Upload_model');
         
    }
 
    function index(){
        $this->load->view('v_upload');    
    }
 
    function do_upload(){
        $config['upload_path']="./assets/images";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
 
            $table= $this->input->post('table');
            $image= $data['upload_data']['file_name']; 
             
            $result= $this->Upload_model->simpan_upload($table,$image);
            echo json_decode($result);
        }
 
     }
     
} 