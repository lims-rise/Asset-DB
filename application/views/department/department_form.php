<div class="content-wrapper">
	<section class="content">
	<form action="<?php echo $action; ?>" method="post">
		<div class="box box-primary ">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA DEPARTMENT</h3>
			</div>
			
			<div class="box-body ">
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Department Name <?php echo form_error('name') ?></label>
						<div class='col-sm-10'>
						<input type="text" class="form-control" name="name" id="name" placeholder="Department Name" value="<?php echo $name; ?>" />
						</div>
					</div>
			</div>
					<div class='box-footer'>
							<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
		<a href="<?php echo site_url('department') ?>" class="btn btn-danger "><i class="fa fa-arrow-circle-left"></i> Back</a>
	 	<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
				</div>
	
	</div>
	</form>
	</section>
</div>