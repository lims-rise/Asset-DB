<?php
class Upload_model extends CI_Model{
 
    function simpan_upload($table,$path){
        $data = array(
                'table' => $table,
                'path' => $path
            );  
        $result= $this->db->insert('galery',$data);
        return $result;
    }
     
}