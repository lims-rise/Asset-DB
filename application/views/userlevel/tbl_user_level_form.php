<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">USER LEVEL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr>
            <td width='200'>Level Name<?php echo form_error('nama_level') ?></td>
            <td><input type="text" class="form-control" name="nama_level" id="nama_level" placeholder="Level Name" value="<?php echo $nama_level; ?>" /></td>
        </tr>
        <tr>
            <td width='200'>URL <?php echo form_error('url') ?></td>
            <td><input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url ?? ''; ?>" /></td>
        </tr>
	    <tr><td></td><td><input type="hidden" name="id_user_level" value="<?php echo $id_user_level; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('userlevel') ?>" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a></td></tr>
	</table></form>        </div>
</div>
</div>