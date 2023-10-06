<section class="sidebar">
    <!-- search form -->
    <div class="sidebar-form" style="text-align: center;">
        <input type="hidden" id="id_user" value="<?php echo $this->session->userdata('id_users')?>">
        <select id='id_country' name="id_country" class="form-control">
            <?php  
            if ($this->session->userdata('id_user_level') == 1) {
                if ($this->session->userdata('location_id') == 1) {
                    echo "<option value='3'>Indonesia</option>";
                    echo "<option value='2'>Australia</option>";
                    echo "<option value='1' selected='selected'>Fiji</option>";
                }
                else if ($this->session->userdata('location_id') == 2) {
                    echo "<option value='3'>Indonesia</option>";
                    echo "<option value='2' selected='selected'>Australia</option>";
                    echo "<option value='1'>Fiji</option>";
                }    
                else if ($this->session->userdata('location_id') == 3) {
                    echo "<option value='3' selected='selected'>Indonesia</option>";
                    echo "<option value='2'>Australia</option>";
                    echo "<option value='1'>Fiji</option>";
                }    
                }    
            else {
                if ($this->session->userdata('location_id') == 1) {
                    echo "<option value='1' selected='selected'>Fiji</option>";
                }
                else if ($this->session->userdata('location_id') == 2) {
                    echo "<option value='2' selected='selected'>Australia</option>";
                }    
                else if ($this->session->userdata('location_id') == 3) {
                    echo "<option value='3' selected='selected'>Indonesia</option>";
                }    
            }
                ?>
        </select>
    </div>
    <!-- <form action="<?php echo base_url('search');?> " method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo $this->input->post('search',true); ?>" id="globalSearch">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
       
        
        <?php
        // chek settingan tampilan menu
        $setting = $this->db->get_where('tbl_setting',array('id_setting'=>1))->row_array();
        if($setting['value']=='ya'){
            // cari level user
            $id_user_level = $this->session->userdata('id_user_level');
            $sql_menu = "SELECT * 
            FROM tbl_menu 
            WHERE id_menu in(select id_menu from tbl_hak_akses where id_user_level=$id_user_level) and is_main_menu=0 and is_aktif='y' order by _index asc";
        }else{
            $sql_menu = "select * from tbl_menu where is_aktif='y' and is_main_menu=0";
        }

        $main_menu = $this->db->query($sql_menu)->result();
        
        foreach ($main_menu as $menu){
            // chek is have sub menu
            $this->db->where('is_main_menu',$menu->id_menu);
            $this->db->where('is_aktif','y');
            $submenu = $this->db->get('tbl_menu');
            if($submenu->num_rows()>0){
                // display sub menu
                echo "<li class='treeview'>
                        <a href='#'>
                            <i class='$menu->icon'></i> <span>".strtoupper($menu->title)."</span>
                            <span class='pull-right-container'>
                                <i class='fa fa-angle-left pull-right'></i>
                            </span>
                        </a>
                        <ul class='treeview-menu' style='display: none;'>";
                        foreach ($submenu->result() as $sub){
                            echo "<li>".anchor($sub->url,"<i class='$sub->icon'></i> ".strtoupper($sub->title))."</li>"; 
                        }
                        echo" </ul>
                    </li>";
            }else{
                // display main menu
                echo "<li>";
                echo anchor($menu->url,"<i class='".$menu->icon."'></i> ".strtoupper($menu->title));
                echo "</li>";
            }
        }
        ?>
        <li><?php echo anchor('auth/logout',"<i class='fa fa-arrow-circle-left'></i> LOGOUT");?></li>
    </ul>
</section>
<!-- /.sidebar -->


<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    $(function() {
        $("#id_country").change(function() {
            var id = $('#id_user').val();
            var id_cnt = $('#id_country').val();
            document.location.href="../../rise-inventory/index.php/kelolamenu/clab?id="+id+'&id_cnt='+id_cnt;
        });
    });

});

</script>