<?php
function cmb_dinamis($name,$table,$field,$pk,$selected=null,$order=null){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    if($order){
        $ci->db->where('status', 1);
        $ci->db->order_by($field,$order);
    }
    $ci->db->where('status', 1);
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}

function select2_dinamis($name,$table,$field,$placeholder,$id,$value=null,$where=null){
    $ci = get_instance();
    $select2 = '<select id="'.$name.'" name="'.$name.'" class="form-control select2 select2-hidden-accessible"  
               data-placeholder="'.$placeholder.'" style="width: 100%;" tabindex="-1" aria-hidden="true">
               <option value=""></option>';
    if($where)
        $ci->db->where($where);
    $data = $ci->db->where('status',1)->get($table)->result();
    foreach ($data as $row){
        if($value == $row->$id)
        $select2.= ' <option value="'. $row->$id .'" selected="selected" >'.$row->$field.'</option>';
        else 
        $select2.= ' <option value="'.$row->$id .'">'.$row->$field.'</option>';
    }
    $select2 .='</select>';
    return $select2;
}

function select2_dinamis_pc($name, $table, $field, $placeholder, $id, $value = null, $where = null)
{
    $ci = get_instance();
    // Modify the $select2 variable to include the empty option as a placeholder
    $select2 = '<div class="select2-container">';
    $select2 .= '<select id="'.$name.'" name="'.$name.'" class="form-control select2 select2-hidden-accessible"  
               data-placeholder="'.$placeholder.'" style="width: 100%;" tabindex="-1" aria-hidden="true">
               <option value=""></option>'; // Empty option added here

    if ($where)
        $ci->db->where($where);

    $data = $ci->db->where('status', 1)->get($table)->result();
    
    foreach ($data as $row) {
        if ($value == $row->$id) {
            $select2 .= '<option value="'. $row->$id .'" selected="selected">'.$row->$field.'</option>';
        } else {
            $select2 .= '<option value="'.$row->$id.'">'.$row->$field.'</option>';
        }
    }

    $select2 .= '</select>';
    $select2 .= '</div>'; // Closing div for select2-container

    // Add a clear button to reset the Select2 value
    $select2 .= '<button type="button" class="btn btn-default btn-clear" onclick="clearSelect2(\''.$name.'\')">Clear</button>';

    return $select2;
}

function datalist_dinamis($name,$table,$field,$value=null,$class=''){
    $ci = get_instance();
    $string = '<input value="'.$value.'" name="'.$name.'" list="'.$name.'" class="form-control">
    <datalist id="'.$name.'">';
    $ci->db->where('status', 1);
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $string.='<option value="'.$row->$field.'">';
    }
    $string .='</datalist>';
    return $string;
}

function rename_string_is_aktif($string){
        return $string=='y'?'Aktif':'Tidak Aktif';
    }
    

function is_login(){
    $ci = get_instance();
    if(!$ci->session->userdata('id_users')){
        redirect('auth');
    }else{
        $modul = $ci->uri->segment(1);
        
        $id_user_level = $ci->session->userdata('id_user_level');
        // dapatkan id menu berdasarkan nama controller
        $menu = $ci->db->select('id_menu')->where('url',$modul)->get('tbl_menu')->result();
        // chek apakah user ini boleh mengakses modul ini
        $hak_akses = $ci->db->where_in($menu)->where('id_user_level',$id_user_level)->get('tbl_hak_akses');
        if($hak_akses->num_rows()<1){
            // redirect('auth');
            // exit;
        }
    }
}

function alert($class,$title,$description){
    return '<div class="alert '.$class.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>
                '.$description.'
              </div>';
}

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level,$id_menu){
    $ci = get_instance();
    $ci->db->where('id_user_level',$id_user_level);
    $ci->db->where('id_menu',$id_menu);
    $data = $ci->db->get('tbl_hak_akses');
    if($data->num_rows()>0){
        return "checked='checked'";
    }
}


function autocomplate_json($table,$field){
    $ci = get_instance();
    $ci->db->like($field, $_GET['term']);
    $ci->db->select($field);
    $collections = $ci->db->get($table)->result();
    foreach ($collections as $collection) {
        $return_arr[] = $collection->$field;
    }
    echo json_encode($return_arr);
}
?>


